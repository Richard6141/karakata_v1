<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\District;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class DistrictController extends Controller
{
    public function index(): View
    {
        $districts = District::all();
        return view('districts.index', [
            'districts' => $districts,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'label' => 'required|string',
        ]);
        try {
            $label = ucfirst(strtolower(trim(strval($request->label))));
            $district = District::where('label', $label)->first();
            if (!blank($district)) {

                $message = "Cette zone existe déjà !";
                return redirect()->route('districts.index')->with('error', "$message");
            }

            $label = preg_replace('/\s\s+/', ' ', $label);

            // dd(Auth::user()->id);
            District::create([
                'id' => Str::uuid(),
                'label' => $label,
                // 'created_by' => Auth::user()->id,
            ]);

            $message = "Zone enregistrée !";
            return redirect()->route('districts.index')->with('success', "$message");
        } catch (\Throwable $th) {
            $message = "Erreur, veuillez contacter l'administration !";
            return redirect()->route('districts.index')->with('error', "$message");
        }
    }




    public function updatedistricts(Request $request, string $id): RedirectResponse
    {
        $id = htmlspecialchars(trim($id));
        try {
            $request->validate([
                'label' => 'required|string|unique:districts,label,' . $id,
            ]);

            $label = ucfirst(strtolower(strval($request->label)));
            //dd($label);


            $label = preg_replace('/\s\s+/', ' ', $label);
            $validator = District::where('id', $id)->update([
                'label' => $label,
                'updated_by' => Auth::user()->id ?? null,
            ]);
            $message = "Zone modifiée !";
            return redirect()->route('districts.index')->with('success', "$message");
        } catch (\Throwable $th) {
            $message = "Zone non modifiée!";
            return redirect()->route('districts.index')->with('error', "$message");
        }
    }



    public function destroy(string $id): RedirectResponse
    {
       
       try {
        $id = htmlspecialchars(trim($id));

        $district = (bool) District::where('id', $id)->exists();
        $district_details = District::where('id', $id)->first();
        if ($district) {
            $commande = (bool) Order::where('district_id', $district_details->id ?? null)->exists();
            if ($commande) {
                $message = "Cette zone a déjà été utilisée pour une opération!";
                return redirect()->route('districts.index')->with('error', "$message");
            } else {
                $district_details->delete();
                $message = "Zone supprimée !";
                return redirect()->route('districts.index')->with('success', "$message");
            }
        } else {
            $message = "Cette zone n'existe pas !";
            return redirect()->route('districts.index')->with('error', "$message");
        }
       } catch (\Throwable $th) {
        $message = "Erreur, veuillez contacter l'administration !";
        return redirect()->route('districts.index')->with('error', "$message");
   }
    }
}
