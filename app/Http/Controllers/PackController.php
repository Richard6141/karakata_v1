<?php

namespace App\Http\Controllers;

use App\Models\Pack;
use App\Models\Commande;
use App\Models\TypePack;
use App\Models\Commandes;
use App\Models\Composants;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Component;
use App\Models\ComponentType;
use App\Models\Contain;
use App\Models\Contenir;
use App\Models\Paquet;
use App\Models\PaquetType;
use Illuminate\Support\Facades\Auth;



class PackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Pack = Paquet::all();
        // $composants = Composants::all();
        $typepack = PaquetType::all();
        return view('packs.index', [
            'Packs' => $Pack,
            // 'composant' => $composants,
            'typepack' => $typepack,
        ]);
    }

    /**
     * Show the form composantfor creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $composants = Component::all();
        $typepack = PaquetType::all();
        return view('packs.add', [
            'composant' => $composants,
            'typepack' => $typepack,
            'typecomponent' => ComponentType::all(),
        ]);
    }

    public function showedit($id)
    {
        // $composants = Composants::all();
        $typepack = PaquetType::all();
        $Pack = Paquet::where('id', $id)->first();
        $typepack2 = $Pack->paquetType->label ?? '';

        return view('packs.update', [
            // 'composant' => $composants,
            'typepack' => $typepack,
            'Pack' => $Pack,
            'typepack2' => $typepack2,
            'typecomponent' => ComponentType::all(),
        ]);
    }

    /**composant
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    // Create a new pack

    public function store(Request $request)
    {
        $request->validate([
            'price' => 'required',
            'type_pack_id' => 'required',
            'component_type_id' => 'required',
        ]);

        try {
            $tab = [];
            if (is_array($request->component_type_id)) {
                foreach ($request->component_type_id as $key => $value) {
                    array_push($tab, $value);
                }
            }

            $label = ucfirst(strtolower($request->label));
            $label = preg_replace('/\s\s+/', ' ', $label);

            $paquet = Paquet::where('paquet_type_id', $request->type_pack_id)->first();

            if (!blank($paquet)) {

                $message = "Pack existe déjà !";
                return redirect()->route('pack.index')->with('warning', "$message");
            }
            $checkExistingPack = Paquet::where('label', $label)->first();

            if (!is_null($request->image)) {
                $file = upload($request);
            } else {
                $file = null;
            }

            // dd($request);
            if (blank($checkExistingPack)) {
                $pack = Paquet::create([
                    'id' => Str::uuid(),
                    // 'label' => $label,
                    'date' => $request->date,
                    'paquet_type_id' => $request->type_pack_id,
                    'price' => $request->price,
                    'created_by' => Auth::user()->id,
                    'image' => $file,
                    'component_type_id' => json_encode($tab),
                ]);

                return redirect()->route('pack.index')->with('success', "Pack enregistré !");
            } else {
                return redirect()->route('pack.index')->with('error', "Ce pack existe déjà !");
            }
        } catch (\Throwable $th) {
            $message = "Erreur, veuillez contacter l'administrateur!";
            return redirect()->route('pack.index')->with('error', "$message");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $request->validate([
            // 'label' => 'required|string|unique:Pack',
            'price' => 'required',
        ]);
        $Pack = Paquet::find($id);

        $validator = Paquet::create([
            'id' => Str::uuid(),
            // 'label' => $request->label,
            'price' => $request->price,
            'image' => $request->image,
        ]);

        $message = "Pack enregistré !";
        return back()->with('success', "$message");

        $Pack->label = $request->label;

        $Pack->save();

        return $this->index();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */



    // Update a specific pack identified by id
    public function updatepack(Request $request, $id)
    {
        // dd($request->all());

        $pack = Paquet::where('id', $id)->first();
        $request->validate([
            'type_pack_id' => 'required',
            // 'label' => 'required|string',
            'price' => 'required',
            'component_type_id' => 'required'
        ]);

        try {
            $tab = [];
            if (is_array($request->component_type_id)) {
                foreach ($request->component_type_id as $key => $value) {
                    array_push($tab, $value);
                }
            }

            // $label = ucfirst(strtolower($request->label));
            // $label = preg_replace('/\s\s+/', ' ', $label);
            if (is_null($request->image)) {
                $img = $pack->image;
            } else {

                $img = upload($request);
            }
            // $pack->label = $label;
            $pack->date = $request->date;
            $pack->paquet_type_id = $request->type_pack_id;
            $pack->price = $request->price;
            $pack->image = $img;
            $pack->component_type_id = json_encode($tab);
            $pack->updated_by = Auth::user()->id;
            $pack->save();
            return redirect()->route('pack.index')->with('success', "Pack Modifié !");
        } catch (\Throwable $th) {
            $message = "Erreur, veuillez contacter l'administrateur!";
            return redirect()->route('pack.index')->with('error', "$message");
        }
    }


    public function enregistrer_pack($id)
    {

        if ($id == 0) {

            $pack = null;
        } else {

            $Pack = Paquet::where('id', $id)->first();
        }

        return view('packs.enregistrer_pack', [
            'pack' => $Pack
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // delete a pack identified by ID

    public function destroy($id)
    {
        try {
            $searchpack = Contain::where('paquet_id', $id)->where('status', true)->first();
            if ($searchpack) {
                return back()->with('error', "Pack en cours d'utilisation");
            }

            $Pack = Paquet::where('id', $id)->first();
            if (!blank($Pack)) {
                # code...
                $contenir = Contain::where('paquet_id', $Pack->id)->first();
                if (!blank($contenir)) {
                    return back()->with('error', "Impossible de supprimé ce pack!");
                } else {
                    $Pack->delete();
                    return redirect()->route('pack.index')->with('success', "Pack supprimé !");
                }
            } else {
                return back()->with('errorMessage', "Erreur d'ID !");
            }
        } catch (\Throwable $th) {
            $message = "Erreur, veuillez contacter l'administrateur!";
            return redirect()->route('pack.index')->with('error', "$message");
        }
    }


    // Toggle pack status

    public function ChangePackStatus($id)
    {

        $searchpack = Contain::where('paquet_id', $id)->where('status', true)->first();
        if ($searchpack) {
            return back()->with('error', "Pack en cours d'utilisation");
        }

        $pack = Paquet::find($id);

        if (Auth::user()->hasRole('ADMINISTRATEUR')) {
            if ($pack->status == '0') {
                $pack->status = '1';
                $pack->save();
                return back()->with('success', " Pack activé avec succes");
            } else {
                $pack->status = '0';
                $pack->save();
                return back()->with('success', " Pack désactivé avec succes");
            }

            return back()->with('error', "Vous n'avez pas l'autorisation !");
        }
    }

    public function active(Request $request)
    {
        $request->validate([
            'idmenu' => 'required',
            'inpactivermenu' => 'required',
        ]);

        $menu = Menu::where('id', $request->idmenu)->first();
        if ($request->inpactivermenu == 1) {
            $active = true;
        } else {
            $active = false;
        }
        $menu->active = $active;
        $menu->save();

        if ($request->inpactivermenu == "1") {
            return back()->with('success', "Menu activé !");
        } else {
            return back()->with('success', "Menu désactivé !");
        }
    }
}
