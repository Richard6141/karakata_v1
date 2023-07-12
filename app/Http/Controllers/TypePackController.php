<?php

namespace App\Http\Controllers;

use App\Models\Pack;
use App\Models\Paquet;
use App\Models\TypePack;
use App\Models\PaquetType;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class TypePackController extends Controller
{
    public function index()
    {
        return view('typepack.index', [
            'packs' => PaquetType::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required|string',

        ]);

        try {
            $label = ucfirst(strtolower($request->label));
            $Type_pack = PaquetType::where('label', $label)->first();

            if (!blank($Type_pack)) {

                $message = "Type pack existe déjà !";
                return redirect()->route('typepack.index')->with('error', "$message");
            }
            $label = ucfirst(strtolower($request->label));


            $label = preg_replace('/\s\s+/', ' ', $label);
            $validator = PaquetType::create([
                'id' => Str::uuid(),
                'label' => $label,
                'created_by' => Auth::user()->id,

            ]);

            $message = "Type pack enregistré !";
            return redirect()->route('typepack.index')->with('success', "$message");
        } catch (\Throwable $th) {
            $message = "Eurreur, veuillez contacter l'administrateur !";
            return redirect()->route('typepack.index')->with('error', "$message");
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'label' => 'required|string|unique:paquet_types,label,' . $id,
            ]);

            $label = ucfirst(strtolower($request->label));


            $label = preg_replace('/\s\s+/', ' ', $label);
            $validator = PaquetType::where('id', $id)->update([
                'label' => $label,
                'updated_by' => Auth::user()->id,
            ]);

            $message = "Type pack modifié !";
            return redirect()->route('typepack.index')->with('success', "$message");
        } catch (\Throwable $th) {
            $message = "Type pack non modifié !";
            return redirect()->route('typepack.index')->with('error', "$message");
        }
    }

    public function delete($id)
    {
        try {
            $Type_packs = PaquetType::where('id', $id)->first();
            if (!blank($Type_packs)) {
                # code...
                $pack = Paquet::where('paquet_type_id', $Type_packs->id)->first();
                if (!blank($pack)) {

                    $message = "Impossible de supprimer ce type de pack!";
                    return redirect()->route('typepack.index')->with('error', "$message");
                } else {
                    $Type_packs->delete();

                    $message = "Type pack supprimé !";
                    return redirect()->route('typepack.index')->with('success', "$message");
                }
            } else {

                $message = "Erreur d'ID !";
                return redirect()->route('typepack.index')->with('error', "$message");
            }
        } catch (\Throwable $th) {
            $message = "Eurreur, veuillez contacter l'administrateur !";
            return redirect()->route('typepack.index')->with('error', "$message");
        }
    }
}
