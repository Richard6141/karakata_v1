<?php

namespace App\Http\Controllers;

use App\Models\Component;
use App\Models\Composants;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ComponentType;
use App\Models\Type_composants;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class Type_ComposantsController extends Controller
{

    public function index(): View
    {
        $Types_composants = ComponentType::all();
        return view('type_composants.index', [
            'Types_composants' => $Types_composants,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'label' => 'required|string',

        ]);
        try {
            $label = ucfirst(strtolower(strval($request->label)));
            $Type_composant = ComponentType::where('label', $label)->first();

            if (!blank($Type_composant)) {

                $message = "Type composant existe déjà !";
                return redirect()->route('typecomposant.index')->with('error', "$message");
            }


            $label = ucfirst(strtolower(strval($request->label)));


            $label = preg_replace('/\s\s+/', ' ', $label);
            $validator = ComponentType::create([
                'id' => Str::uuid(),
                'label' => $label,
                'created_by' => Auth::user()->id ?? null,

            ]);

            $message = "Type composant enregistré !";
            return redirect()->route('typecomposant.index')->with('success', "$message");
        } catch (\Throwable $th) {
            $message = "Erreur, veuillez contacter l'administrateur";
            return redirect()->route('typecomposant.index')->with('error', "$message");
        }
    }




    public function updatecomposant(Request $request, string $id): RedirectResponse
    {

        $id = htmlspecialchars(trim(strval($id)));
        try {
            $request->validate([
                'label' => 'required|string|unique:component_types,label,' . $id,
            ]);

            $label = ucfirst(strtolower(strval($request->label)));


            $label = preg_replace('/\s\s+/', ' ', $label);
            $validator = ComponentType::where('id', $id)->update([
                'label' => $label,
                'updated_by' => Auth::user()->id ?? null,
            ]);

            $message = "Type composant modifié !";
            return redirect()->route('typecomposant.index')->with('success', "$message");
        } catch (\Throwable $th) {
            $message = "Type composant non modifié !";
            return redirect()->route('typecomposant.index')->with('error', "$message");
        }
    }



    public function enregistrer_type_composant(string $id): View
    {
        try {
            if ($id == 0) {

                $typecomposant = null;
            } else {
                /** @var ComponentType */
                $typecomposant = ComponentType::where('id', $id)->first();
            }

            return view('Types_composants.enregistrer_type_composant', [
                'typecomposant' => $typecomposant
            ]);
        } catch (\Throwable $th) {
            $message = "Erreur, veuillez contacter l'administrateur!";
            return redirect()->route('typecomposant.index')->with('error', "$message");
        }
    }

    public function edit(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'label' => 'required|string|unique:component_types',
        ]);

        try {
            $Type_composants = ComponentType::find($id);

            $validator = ComponentType::create([
                'id' => Str::uuid(),
                'label' => $request->label,
                // 'created_by'=> Auth::user()->id,
                'updated_by' => Auth::user()->id ?? null,

            ]);

            $message = "Type composant enregistré !";
            return back()->with('success', "$message");
        } catch (\Throwable $th) {
            $message = "Erreur, veuillez contacter l'administrateur !";
            return back()->with('error', "$message");
        }
    }

    public function destroy(string $id): RedirectResponse
    {
        try {
            $id = \htmlspecialchars(trim(strval($id)));
            /** @var ComponentType */
            $Type_composants = ComponentType::where('id', $id)->first();
            if (!blank($Type_composants)) {
                # code...
                $composant = Component::where('component_type_id', $Type_composants->id)->first();
                if (!blank($composant)) {

                    $message = "Impossible de supprimer ce type composant !";
                    return redirect()->route('typecomposant.index')->with('error', "$message");
                } else {
                    $Type_composants->delete();

                    $message = "Type composant supprimé !";
                    return redirect()->route('typecomposant.index')->with('success', "$message");
                }
            } else {

                $message = "Erreur d'ID !";
                return redirect()->route('typecomposant.index')->with('error', "$message");
            }
        } catch (\Throwable $th) {
            $message = "Erreur, veuillez contacter l'administrateur!";
            return redirect()->route('typecomposant.index')->with('error', "$message");
        }
    }
}
