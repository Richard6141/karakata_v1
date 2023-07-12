<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Commandes;
use App\Models\OrderType;
use Illuminate\Support\Str;
use App\Models\TypeCommande;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;


class TypeCommandeController extends Controller
{
    public function index(): View
    {
        $ordertype = OrderType::all();
        return view('type_commandes.index', [
            'OrderType' => $ordertype,
        ]);
    }

    
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'label' => 'required|string',
        ]);

        try {
            $label = ucfirst(strtolower(strval($request->label)));
            $ordertype = OrderType::where('label', $label)->first();

            if (!blank($ordertype)) {

                $message = "Type commande existe déjà !";
                return redirect()->route('typecommande.index')->with('error', "$message");
            }

            $label = preg_replace('/\s\s+/', ' ', $label);

            OrderType::create([
                'id' => Str::uuid(),
                'label' => $label,
                'number' => $request->number,
                'created_by' => Auth::user()->id ?? null,
            ]);

            $message = "Type de commande enregistré !";
            return redirect()->route('typecommande.index')->with('success', "$message");
        } catch (\Throwable $th) {
            $message = "Erreur, veuillez contacter l'adminstrateur!";
            return redirect()->route('typecommande.index')->with('error', "$message");
        }
    }


    public function updatetypecommande(Request $request, string $id): RedirectResponse
    {
        $id = htmlspecialchars(trim(strval($id)));
        try {
            $request->validate([
                'label' => 'required|string|unique:order_types,label,' . $id,
            ]);

            $label = ucfirst(strtolower(strval($request->label)));


            $label = preg_replace('/\s\s+/', ' ', $label);
            $validator = OrderType::where('id', $id)->update([
                'label' => $label,
                'number' => $request->number,
                'updated_by' => Auth::user()->id ?? null,
            ]);

            $message = "Tye de commande modifié !";
            return redirect()->route('typecommande.index')->with('success', "$message");
        } catch (\Throwable $th) {
            $message = "Type de commande non modifié !";
            return redirect()->route('typecommande.index')->with('error', "$message");
        }
    }


    public function edit(Request $request, string $id): RedirectResponse
    {
        try {
            $id = htmlspecialchars(trim(strval($id)));
            $request->validate([
                'label' => 'required|string|unique:TypeCommande',
            ]);
            /** @var User */
            $OrderType = OrderType::find($id);

            $validator = OrderType::create([
                'id' => Str::uuid(),
                'label' => $request->label,
                //'created_by'=> Auth::user()->id,
            ]);

            return back()->with('successMessage', "Type de commande enregistré !");
        } catch (\Throwable $th) {
            $message = "Erreur, veuillez contacter l'adminstrateur!";
            return redirect()->route('typecommande.index')->with('error', "$message");
        }
    }


    public function destroy(string $id): RedirectResponse
    {
        try {
            $id = htmlspecialchars(trim(strval($id)));
            /** @var OrderType */
            $ordertype = OrderType::where('id', $id)->first();
            if (!blank($ordertype)) {
                # code...
                $order = Order::where('order_type_id', $ordertype->id)->first();
                if (!blank($order)) {
                    $message = "Impossible de supprimé ce type de commande!";
                    return redirect()->route('typecommande.index')->with('error', "$message");
                } else {
                    $ordertype->delete();

                    $message = "Type de commande supprimé !";
                    return redirect()->route('typecommande.index')->with('success', "$message");
                }
            } else {

                $message = "Erreur d'ID !";
                return redirect()->route('typecommande.index')->with('error', "$message");
            }
        } catch (\Throwable $th) {
            $message = "Erreur, veuillez contacter l'adminstrateur!";
            return redirect()->route('typecommande.index')->with('error', "$message");
        }
    }
}
