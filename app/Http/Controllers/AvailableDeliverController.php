<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\AvailableDeliver;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AvailableDeliverController extends Controller
{
    public function availableDelivers(Request $request): RedirectResponse
    {
        $request->validate([
            'deliver_id' => ['required'],
            'start_day' => ['required'],
            'end_day' => ['required'],
        ]);

        // dd($request);

        if (!($request->deliver_id)) {
            return \back()->with('error', 'Choisissez de livreur');
        }


        try {
            $id = [];

            if (is_array($request->deliver_id)) {
                foreach ($request->deliver_id as $key => $value) {
                    array_push($id, $value);
                }
            }

            /** @var array $id*/
            foreach ($id as $available) {
                AvailableDeliver::create([
                    "deliver_id" => $available,
                    "start_day" => $request->start_day,
                    "end_day" => $request->end_day,
                    "created_by" => Auth::user()->id ?? null,
                ]);
            }
            $data = $request->deliver_id;
            $message = '';
            if (is_array($request->deliver_id)) {
                if (count($request->deliver_id) == 1) {
                    if (is_array($data)) {
                        $message = count($data) . " livreur est rendu disponible";
                    }

                    return back()->with('success', "$message");
                }
                $message = count($request->deliver_id) . " livreurs sont rendus disponibles";
            }
            return back()->with('success', "$message");
        } catch (\Throwable $th) {
            $message = "Une erreur est subvenue !";
            return back()->with('error', "$message");
        }
    }

    public function listAvailableDelivers(): View
    {
        $today = date('Y-m-d');
        $alldelivers = AvailableDeliver::where('status', true)->get();
        foreach ($alldelivers as $deliver) {
            if ($deliver->end_day < $today) {
                $deliver->status = false;
                $deliver->updated_by = Auth::user()->id ?? null;
                $deliver->save();
            }
        }
        $delivers = AvailableDeliver::where('status', true)->get();

        return view('delivers.list_available_delivers', ['delivers' => $delivers]);
    }

    public function unavailableDeliver(Request $request): RedirectResponse
    {
        try {
            if (is_array($request->deliver_id)) {
                foreach ($request->deliver_id as $co) {
                    $del = AvailableDeliver::where('id', $co)->first();
                    if (!is_null($del)) {
                        $del->delete() ?? null;
                    }
                }
            }
            $message = 'Livreur retiré !';
            return back()->with('success', "$message");
        } catch (\Throwable $th) {
            $message = 'Une erreur est subvenue !';
            return back()->with('error', "$message");
        }
    }

    public function deliversHasOrder(): View
    {
        $orders = DB::table('orders')->where('deliver_id', '!=', null)->where('status_delivery', false)
            ->join('delivers', 'delivers.id', 'orders.deliver_id')
            ->distinct('orders.deliver_id')
            ->select('delivers.*')
            ->get();

        return view('delivers.list_ordered_delivers', ['delivers' => $orders]);
    }
}
