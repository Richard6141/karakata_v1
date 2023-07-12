<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\ModePaiement;
use Illuminate\Http\Request;
use App\Models\SourceCommande;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ModePaiementController extends Controller
{
    // public function list() :View
    // {
    //     $mode_paiement = ModePaiement::all();

    //     return view('/paiements.mode_paiement', [
    //         'payment_modes' => $mode_paiement ,
    //     ]);
    // }
    
    // public function storemode(Request $request):RedirectResponse
    // {

    //     $request->validate([
    //         'labels' => 'required|string',

    //     ]);

    //     $labels = ucfirst(strtolower(\htmlspecialchars(trim(strval($request->labels))) ));


    //     $labels = preg_replace('/\s\s+/', ' ', $labels);
    //     $validator = ModePaiement::create([
    //         'id' => Str::uuid(),
    //         'label' => $labels,

    //     ]);
    //     return back()->with('success', "Mode de paiement enregistré !");
    // }

    // public function updatemode_paiement(Request $request, string $id): RedirectResponse
    // {
    //     try {
    //         $request->validate([
    //             'labels' => 'required|string|unique:source_commandes,labels,' . $id,
    //         ]);

    //         $labels = ucfirst(strtolower($request->labels));

    //         $id = htmlspecialchars(trim(strval($id)));
    //         $labels = preg_replace('/\s\s+/', ' ', $labels);
    //         $validator = SourceCommande::where('id', $id)->update([
    //             'labels' => $labels,
    //         ]);

    //         $message = "Source commande modifié !";
    //         return back()->with('success', "$message");
    //     } catch (\Throwable $th) {
    //         $message = "Source commande non modifié !";
    //         return redirect()->route('list_mode_paiement')->with('error', "$message");
    //     }

    // }

    // public function destroy_mode(string $id): RedirectResponse 
    // {
    //     $id = htmlspecialchars(trim(strval($id)));
    //     $payment_mode= ModePaiement::where('id', $id)->first();
    //     if($payment_mode instanceof ModePaiement) {
    //         \abort(404);
    //     }
    //     if (!blank($payment_mode)) {
    //         $payment_mode->delete();
    //         $message = "Mode paiement supprimé !";
    //         return redirect()->route('mode_paiement')->with('success', "$message");
            
    //     }else {

    //         $message = "Ce mode de paiement n'existe plus !";
    //             return redirect()->route('sourcecommande.index')->with('error', "$message");
    //     }
    // }

    // public function updatemodepaiement(Request $request, string $id)
    // {
    //     try {
    //         $request->validate([
    //             'labels' => 'required|string' 
    //         ]);

    //         $labels = ucfirst(strtolower($request->labels));


    //         $labels = preg_replace('/\s\s+/', ' ', $labels);
    //         $id = htmlspecialchars(trim(strval($id)));
    //         $validator = ModePaiement::where('id', $id)->update([
    //             'label' => $labels,
    //         ]);

    //         $message = "Mode de paiement modifié !";
    //         return redirect()->route('mode_paiement')->with('success', "$message");
    //     } catch (\Throwable $th) {
    //         $message = "Mode de paiement non modifié !";
    //         return redirect()->route('mode_paiement')->with('error', "$message");
    //     }

    // }
}
