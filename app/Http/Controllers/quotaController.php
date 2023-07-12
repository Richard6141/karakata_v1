<?php

namespace App\Http\Controllers;

use App\Models\Pack;
use App\Models\User;
use App\Models\Quota;
use App\Models\Paquet;
use App\Models\Component;
use Illuminate\Http\Request;
use App\Models\ComponentType;
use Illuminate\Support\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class quotaController extends Controller
{
    public function index(): View
    {

        $Quota = Quota::all();
        $packs = Paquet::all();


        // Resistance
        $typecomposantresistance = ComponentType::where('label', 'Résistance')->first();
        if (!$typecomposantresistance instanceof ComponentType) {
            abort(404);
        }

        // Composant
        $composant = Component::where('component_type_id', $typecomposantresistance->id)->get();
        return view('Quotas.quota', [
            'Quota' => $Quota,
            'packs' => $composant,
        ]);
    }

    public function add_quota(Request $request): RedirectResponse
    {
        $request->validate([
            'quota' => 'required|min:1|not_in:0',
            'date' => 'required',
            'pack_id' => 'required',
        ]);

        try {
            if (!Auth::user() instanceof User) {
                abort(404);
            }

            if (Auth::user()->hasRole('ADMINISTRATEUR') || Auth::user()->hasRole('CUISINIER') || Auth::user()->hasRole('COMMERCIAL')) {
                $date = Strval($request->date);
                $existant = Quota::where('date', date($date))->where('resistance_id', $request->pack_id)->first();

                if (!$existant) {

                    Quota::create([
                        'quota' => $request->quota,
                        'quota_courant' => $request->quota,
                        'date' => $request->date,
                        'resistance_id' => $request->pack_id,
                    ]);

                    return redirect()->route('quota.today')->with('success', "Enregistrement effectué avec succès !");
                } else {
                    return redirect()->route('quota.today')->with('warning', "Ce quota existe déjà pour ce jour !");
                }
            } else {
                return redirect()->route('quota.today')->with('error', 'Autorisation non accordée');
            }
        } catch (\Throwable $th) {
            return redirect()->route('quota.today')->with('error', "Erreur, veillez contacter l'administrateur !");
        }
    }

    public function update_quota(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'quota' => 'required|min:1|not_in:0',
            'date' => 'required',
            'pack_id' => 'required',
        ]);
        try {
            $quota = Quota::where('id', $id)->first();
            if (!$quota instanceof Quota) {
                abort(404);
            }
            // if (Auth::user() in  stanceof User)
            $vendu = $quota->quota - $quota->quota_courant;
            $quotacourant = $request->quota - $vendu;
            if ($quotacourant < 0) {
                return back()->with('warning', "Seuil atteint");
            }

            $quota->quota = intval($request->quota);
            $quota->date = strval($request->date);
            $quota->quota_courant = $request->quota - $vendu;
            $quota->resistance_id = strval($request->pack_id);
            // $quota->date = Carbon::today()->toDateString();
            $quota->save();

            return back()->with('success', "Quota modifié avec succès");
        } catch (\Throwable $th) {
            return back()->with('error', "Erreur, veuillez contacter l'administreur");
        }
    }
}
