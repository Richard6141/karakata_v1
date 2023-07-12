<?php

namespace App\Http\Controllers;

use App\Models\Pack;
use App\Models\User;
use App\Models\Paquet;
use App\Models\Contain;
use App\Helpers\Helpers;
use App\Models\Component;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ComponentType;
use Illuminate\Support\Composer;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ComposantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $Composants = Component::all();
        $typecomposants = ComponentType::all();

        return view('composants.index', [
            'typecomposants' => $typecomposants,
            'Composants' => $Composants,
            // 'pack' => Pack::all(),
            // 'date' => date('Y-m-d'),
        ]);
    }

    /**
     *
     * @return View
     */

    public function add()
    {
        $Composants = Component::all();
        $typecomposants = ComponentType::all();

        return view('composants.add', [
            'typecomposants' => $typecomposants,
            'Composants' => $Composants,
            'pack' => Paquet::all(),
            'date' => date('Y-m-d'),
        ]);
    }


    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required|string',
            'typecomposant' => 'required',
        ]);

        try {
            $label = ucfirst(strtolower(strval($request->label)));

            $label = preg_replace('/\s\s+/', ' ', $label);
            $date = date('Y-m-d');
            $typecomposant = ComponentType::where(
                'id',
                $request->typecomposant
            )->first();
            if (!is_null($request->image)) {
                $file = upload($request);
            } else {
                $file = null;
            }

            $validator = new Component();
            $validator['id'] = Str::uuid();
            $validator['label'] = $label;
            $validator['description'] = $request->description;
            //$validator['publish_date'] = $request->publish_date;
            $validator['component_type_id'] = $request->typecomposant;
            //$validator['pack_id'] = $request->pack;
            $validator['image'] = $file;
            $validator['created_by'] = Auth::user()->id ?? null;
            $validator->save();

            $message = 'Composant enregistré !';
            return redirect()
                ->route('composant.index')
                ->with('success', "$message");
        } catch (\Throwable $th) {
            $message = "Erreur, veuillez contacter l'administrateur!";
            return redirect()->route('composant.index')->with('error', "$message");
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */

    public function showform(string $id)
    {

        try {
            $composant = Component::where('id', $id)->first();
            // $Composants = Composants::all();
            $typecomposants = ComponentType::all();


            if (blank($composant)) {
                \abort(404);
            }
            // dd($provision);
            return view('composants.update', [
                'composant' => $composant,
                'typecomposants' => $typecomposants,


            ]);
        } catch (\Throwable $th) {
            $message = "Erreur, veuillez contacter l'administrateur!";
            return redirect()->route('composant.index')->with('error', "$message");
        }
    }


    /**
     * Display the specified resource.
     *
     * @return View
     */

    public function show(string $id)
    {
        $id = htmlspecialchars(trim($id));
        $composant = Component::findOrFail($id);
        return view('/composants.show', [
            'Composants' => $composant,
            'typecomposants' => ComponentType::all(),
        ]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */

    public function updatecomposants(Request $request, $id)
    {
        $request->validate([
            'label' => 'required|string',
            'typecomposant' => 'required',
        ]);

        try {
            $composant = Component::where('id', $id)->first();
            if (!$composant instanceof Component) {
                \abort(404);
            }

            $label = ucfirst(strtolower(strval($request->label)));

            $label = preg_replace('/\s\s+/', ' ', $label);
            if (is_null($request->image)) {
                $img = $composant->image;
            } else {
                $img = upload($request);
            }

            $composant->component_type_id = (trim(strval($request->typecomposant)));
            $composant->label = ((trim(strval($label))));
            $composant->description = ucfirst((trim(strval($request->description))));
            $composant->image = $img;
            $composant->updated_by = auth()->user()->id ?? null;
            $composant->save();

            $message = 'Composant modifié !';
            return redirect()
                ->route('composant.index')
                ->with('success', "$message");
        } catch (\Throwable $th) {
            $message = "Erreur, veuillez contacter l'administrateur!";
            return redirect()->route('composant.index')->with('error', "$message");
        }
    }


    // public function enregistrer_composant(string $id) :View
    // {
    //     $id = htmlspecialchars(trim(strval($id)));
    //     if ($id == 0) {
    //         $composant = null;
    //     } else {
    //         $composant = Component::where('id', $id)->first();
    //     }

    //     return view('composants.enregistrer_composant', [
    //         'composant' => $composant,
    //     ]);
    // }




    /**

     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        try {
            $id = htmlspecialchars(trim(strval($id)));
            $Composants = Component::where('id', $id)->first();
            if (!blank($Composants)) {
                # code...
                $contenir = Contain::where('component_id', $Composants->id ?? null)->first();
                if (!blank($contenir)) {

                    $message = "Impossible de supprimer ce composant!";
                    return redirect()->route('composant.index')->with('error', "$message");
                } else {
                    if ($Composants) {
                        $Composants->delete();
                        $message = "Composant supprimé !";
                        return redirect()->route('composant.index')->with('success', "$message");
                    }
                    return back();
                }
            } else {
                $message = "Erreur d'ID !";
                return redirect()->route('composant.index')->with('error', "$message");
            }
        } catch (\Throwable $th) {
            $message = "Erreur, veuillez contacter l'administrateur!";
            return redirect()->route('composant.index')->with('error', "$message");
        }
    }
}
