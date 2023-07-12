<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Paquet;
use App\Models\Contain;
use App\Models\Component;
use App\Models\PaquetType;
use App\Jobs\PublishMenuJob;
use Illuminate\Http\Request;
use App\Models\ComponentType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use PhpCsFixer\Tokenizer\CT;

class MenuDayController extends Controller
{
    public function index(): View
    {

        updateContainTable();
        $contenir = DB::table('contains')
            ->select('contains.paquet_id', 'contains.date', 'paquets.label', 'contains.price')
            ->join('paquets', 'contains.paquet_id', 'paquets.id')
            ->join('components', 'contains.component_id', 'components.id')
            ->groupBy('contains.paquet_id', 'contains.date', 'paquets.label', 'contains.price')
            ->get();

        return view('menu.index', [
            'menus' => $contenir,
            'packs' => Paquet::where('status', true)->get(),
            'packselectionne' => null,
        ]);
    }

    public function create(string $id, string $date): View
    {
        if ($id == "0") {
            $packselectionne = null;
        } else {
            $packselectionne = Paquet::where('id', $id)->first();
        }

        // Entree
        $typecomposantentree = ComponentType::where('label', 'Entrée')->first();
        $composantentree = Component::where('component_type_id', $typecomposantentree->id ?? null)->get();
        // Desert
        $typecomposantDessert = ComponentType::where('label', 'Dessert')->first();
        $composantdessert = Component::where('component_type_id', $typecomposantDessert->id ?? null)->get();
        // Boisson
        $typecomposantBoisson = ComponentType::where('label', 'Boisson')->first();
        $composantboisson = Component::where('component_type_id', $typecomposantBoisson->id ?? null)->get();
        // Accompagnement
        $typecomposantAccompagnement = ComponentType::where('label', 'Accompagnement')->first();
        $composantAccompagnement = Component::where('component_type_id', $typecomposantAccompagnement->id ?? null)->get();
        // Resistance
        $typecomposantresistance = ComponentType::where('label', 'Résistance')->first();
        $composantresistance = Component::where('component_type_id', $typecomposantresistance->id ?? null)->get();

        return view('menu.add', [
            'datemin' => date('Y-m-d'),
            'date' => $date,
            'packs' => Paquet::where('status', true)->get(),
            'entree' => $composantentree,
            'dessert' => $composantdessert,
            'boisson' => $composantboisson,
            'accompagnement' => $composantAccompagnement,
            'resistance' => $composantresistance,
            'packselectionne' => $packselectionne,
            'typepacks' => PaquetType::all(),
            'composants' => Component::all(),
            'typecomposants' => ComponentType::all(),
        ]);
    }

    public function addpack(Request $request): JsonResponse
    {
        $pack = Paquet::create([
            'label' => $request->addlabel,
            'date' => date('Y-m-d'),
            'status' => $request->addcheckboxclient,
            'price' => $request->addprice,
            'paquet_type_id' => $request->addtype_pack_id,
            'created_by' => Auth::user()->id ?? null,
        ]);

        $data = [
            'success' => 1,
            'pack' => $pack,
            'packs' => Paquet::all(),
        ];

        return response()->json($data);
    }



    public function searchpack(Request $request): JsonResponse
    {
        $pack = Paquet::where('id', $request->param)->first();

        $data = [
            'success' => 1,
            'pack' => $pack,
        ];

        return response()->json($data);
    }

    public function filtrecomposant(Request $request): JsonResponse
    {
        $composants = Component::where('component_type_id', $request->typecomposant)->get();

        $data = [
            'success' => 1,
            'composants' => $composants,
        ];

        return response()->json($data);
    }

    public function deletecomposant(Request $request): JsonResponse
    {
        $composants = Contain::where('id', $request->contenir)->first();
        if ($composants instanceof Contain) {
            $composants->delete();
        }

        $contenir = DB::table('contenirs')
            ->select('packs.* As pack', 'composants.* As composants', 'contenirs.id As contenir_id', 'contenirs.pack_id As pack_id', 'contenirs.composant_id As composant_id')
            ->join('packs', 'contenirs.pack_id', 'packs.id')
            ->join('composants', 'contenirs.composant_id', 'composants.id')
            ->where('pack_id', $request->pack)
            ->get();

        $data = [
            'success' => 1,
            'contenirs' => $contenir,
        ];

        return response()->json($data);
    }


    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'pack' => 'required|array|min:1',
            'pack.*' => 'required|string|distinct|min:3',
            'resistance' => 'required|array|min:1',
            'date' => 'required',
            'price' => 'required|min:1|not_in:0|array|min:1',
        ]);

        if ($request->activemenutoday == "on") {
            $check = true;
        } else {
            $check = false;
        }

        if (!is_iterable($request->pack)) {
            abort(404);
        }

        try {
            // /** @var string $key1 */
            foreach ($request->pack as $key1 => $value1) {

                // Verifier
                $verify = Contain::where('paquet_id', $value1)->where('date', $request->date)->first();


                if ($verify) {
                    return redirect()->route('allmenus')->with('warning', "Ce menu existe déjà pour ce jour");
                }

                // Entree
                $typecomposantentree = ComponentType::where('label', 'Entrée')->first();
                // Desert
                $typecomposantDessert = ComponentType::where('label', 'Dessert')->first();
                // Boisson
                $typecomposantBoisson = ComponentType::where('label', 'Boisson')->first();
                // Accompagnement
                $typecomposantAccompagnement = ComponentType::where('label', 'Accompagnement')->first();
                // Resistance
                $typecomposantresistance = ComponentType::where('label', 'Résistance')->first();

                // Verifier le pack
                $searchpack = Paquet::where('id', $value1)->first();



                if (!is_null($searchpack->component_type_id)) {
                    foreach (json_decode($searchpack->component_type_id) as $keypack => $valuepack) {
                        // Entree
                        if ($valuepack == $typecomposantentree->id) {
                            if (!is_array($request->price)) {
                                abort(404);
                            }
                            if (!is_null($request->entree)) {
                                $contains = Contain::create([
                                    'component_id' => $request->entree,
                                    'paquet_id' => $value1,
                                    'date' => $request->date,
                                    'created_by' => Auth::user()->id ?? null,
                                    'price' => $request->price[$key1],
                                    'status' => $check,
                                    'component_type_id' => $typecomposantentree->id ?? null,
                                ]);
                            }
                        }

                        // Dessert
                        if ($valuepack == $typecomposantDessert->id) {
                            if (!is_null($request->dessert)) {
                                $contains = Contain::create([
                                    'component_id' => $request->dessert,
                                    'paquet_id' => $value1,
                                    'date' => $request->date,
                                    'created_by' => Auth::user()->id ?? null,
                                    'price' => $request->price[$key1],
                                    'status' => $check,
                                    'component_type_id' => $typecomposantDessert->id ?? null,
                                ]);
                            }
                        }

                        // Boisson
                        if ($valuepack == $typecomposantBoisson->id) {
                            if (!is_null($request->boisson)) {

                                $contains = Contain::create([
                                    'component_id' => $request->boisson,
                                    'paquet_id' => $value1,
                                    'date' => $request->date,
                                    'created_by' => Auth::user()->id ?? null,
                                    'price' => $request->price[$key1],
                                    'status' => $check,
                                    'component_type_id' => $typecomposantBoisson->id ?? null,
                                ]);
                            }
                        }

                        // Accompagnement
                        if ($valuepack == $typecomposantAccompagnement->id) {
                            if (!is_null($request->accompagnement)) {

                                $contains = Contain::create([
                                    'component_id' => $request->accompagnement,
                                    'paquet_id' => $value1,
                                    'date' => $request->date,
                                    'created_by' => Auth::user()->id ?? null,
                                    'price' => $request->price[$key1],
                                    'status' => $check,
                                    'component_type_id' => $typecomposantAccompagnement->id ?? null,
                                ]);
                            }
                        }

                        // Résistance
                        if ($valuepack == $typecomposantresistance->id) {
                            if (!is_iterable($request->resistance)) {
                                abort(404);
                            }
                            foreach ($request->resistance as $key => $value) {
                                $contains = Contain::create([
                                    'component_id' => $value,
                                    'paquet_id' => $value1,
                                    'date' => $request->date,
                                    'created_by' => Auth::user()->id ?? null,
                                    'price' => $request->price[$key1],
                                    'status' => $check,
                                    'component_type_id' => $typecomposantresistance->id ?? null,
                                ]);
                            }
                        }
                    }
                }
            }

            if ($check == true) {
                foreach ($request->pack as $key => $value) {
                    $contains = Contain::where('paquet_id', $value)->where('date', $request->date)->get();

                    $tab = array();
                    foreach ($contains as $key => $contain) {

                        if ($contain->component_type_id == ($typecomposantentree->id ?? null)) {
                            $entree = ($contain->component ?? null)->label;
                        }

                        if (($typecomposantDessert->id ?? null) == $contain->component_type_id) {
                            $dessert = ($contain->component ?? null)->label;
                        }

                        if (($typecomposantBoisson->id ?? null) == $contain->component_type_id) {
                            $boisson = ($contain->component ?? null)->label;
                        }

                        if (($typecomposantAccompagnement->id ?? null) == $contain->component_type_id) {
                            $accompagnement = ($contain->component ?? null)->label;
                        }

                        if (($typecomposantresistance->id ?? null) == $contain->component_type_id) {
                            $resistance = ($contain->component ?? null)->label;
                            array_push($tab, $resistance);
                        }
                    }


                    $resisCont = Contain::where('paquet_id', $value)->where('date', $request->date)->where('component_type_id', $typecomposantresistance->id ?? null)->first();

                    $data = [
                        'entree' => $entree ?? null,
                        'dessert' => $dessert ?? null,
                        'boisson' => $boisson ?? null,
                        'accompagnement' => $accompagnement ?? null,
                        'resistance' => $tab,
                        'pack' => $resisCont->paquet->paquetType->label ?? null,
                        'image' => $resisCont->paquet->image ?? null,
                        'date' => Carbon::parse($resisCont->date ?? null)->format('d/m/Y'),
                    ];

                    PublishMenuJob::dispatch($data);
                }
            }

            return redirect()->route('allmenus')->with('success', "Enregistrement effectué");
        } catch (\Throwable $th) {
            return redirect()->route('allmenus')->with('error', "error");
        }
    }

    public function active(Request $request): RedirectResponse
    {
        $request->validate([
            'idmenu' => 'required',
            'inpactivermenu' => 'required',
        ]);

        //$menu = Menu::where('id', $request->idmenu)->first();
        if ($request->inpactivermenu == 1) {
            $active = true;
        } else {
            $active = false;
        }
        //$menu->active = $active;
        //$menu->save();

        if ($request->inpactivermenu == "1") {
            return back()->with('success', "Menu activé !");
        } else {
            return back()->with('success', "Menu désactivé !");
        }
    }

    public function show(string $id, string $date): View
    {
        if ($id == "0") {
            $packselectionne = null;
        } else {
            $packselectionne = Paquet::where('id', $id)->first();
        }

        // Entree
        $typecomposantentree = ComponentType::where('label', 'Entrée')->first();
        $composantentree = Component::where('component_type_id', $typecomposantentree->id ?? null)->get();
        // Desert
        $typecomposantDessert = ComponentType::where('label', 'Dessert')->first();
        $composantdessert = Component::where('component_type_id', $typecomposantDessert->id ?? null)->get();
        // Boisson
        $typecomposantBoisson = ComponentType::where('label', 'Boisson')->first();
        $composantboisson = Component::where('component_type_id', $typecomposantBoisson->id ?? null)->get();
        // Accompagnement
        $typecomposantAccompagnement = ComponentType::where('label', 'Accompagnement')->first();
        $composantAccompagnement = Component::where('component_type_id', $typecomposantAccompagnement->id ?? null)->get();
        // Resistance
        $typecomposantresistance = ComponentType::where('label', 'Résistance')->first();
        $composantresistance = Component::where('component_type_id', $typecomposantresistance->id ?? null)->get();

        // info pack selectionné
        // Entrée
        $containentree = Contain::where('paquet_id', $id)->where('date', $date)->where('component_type_id', $typecomposantentree->id ?? null)->first();

        // Dessert
        $containdessert = Contain::where('paquet_id', $id)->where('date', $date)->where('component_type_id', $typecomposantDessert->id ?? null)->first();

        // Boisson
        $containboisson = Contain::where('paquet_id', $id)->where('date', $date)->where('component_type_id', $typecomposantBoisson->id ?? null)->first();
        // Accompagnement
        $containaccompagnement = Contain::where('paquet_id', $id)->where('date', $date)->where('component_type_id', $typecomposantAccompagnement->id ?? null)->first();

        // Resistance
        $containresistance = Contain::where('paquet_id', $id)->where('date', $date)->where('component_type_id', $typecomposantresistance->id ?? null)->get();
        return view('menu.update', [
            'datemin' => date('Y-m-d'),
            'date' => $date,
            'packs' => Paquet::where('status', true)->get(),
            'entree' => $composantentree,
            'dessert' => $composantdessert,
            'boisson' => $composantboisson,
            'accompagnement' => $composantAccompagnement,
            'resistance' => $composantresistance,
            'entreeselectionne' => $containentree,
            'dessertselectionne' => $containdessert,
            'boissonselectionne' => $containboisson,
            'accompagnementselectionne' => $containaccompagnement,
            'resistanceselectionne' => $containresistance,
            'packselectionne' => $packselectionne,
            'typepacks' => PaquetType::all(),
            'composants' => Component::all(),
            'typecomposants' => ComponentType::all(),
        ]);
    }

    public function showreconduit(string $id, string $date): View
    {
        if ($id == "0") {
            $packselectionne = null;
        } else {
            $packselectionne = Paquet::where('id', $id)->first();
        }

        // Entree
        $typecomposantentree = ComponentType::where('label', 'Entrée')->first();
        $composantentree = Component::where('component_type_id', $typecomposantentree->id ?? null)->get();
        // Desert
        $typecomposantDessert = ComponentType::where('label', 'Dessert')->first();
        $composantdessert = Component::where('component_type_id', $typecomposantDessert->id ?? null)->get();
        // Boisson
        $typecomposantBoisson = ComponentType::where('label', 'Boisson')->first();
        $composantboisson = Component::where('component_type_id', $typecomposantBoisson->id ?? null)->get();
        // Accompagnement
        $typecomposantAccompagnement = ComponentType::where('label', 'Accompagnement')->first();
        $composantAccompagnement = Component::where('component_type_id', $typecomposantAccompagnement->id ?? null)->get();
        // Resistance
        $typecomposantresistance = ComponentType::where('label', 'Résistance')->first();
        $composantresistance = Component::where('component_type_id', $typecomposantresistance->id ?? null)->get();

        // info pack selectionné
        // Entrée
        $containentree = Contain::where('paquet_id', $id)->where('date', $date)->where('component_type_id', $typecomposantentree->id ?? null)->first();

        // Dessert
        $containdessert = Contain::where('paquet_id', $id)->where('date', $date)->where('component_type_id', $typecomposantDessert->id ?? null)->first();

        // Boisson
        $containboisson = Contain::where('paquet_id', $id)->where('date', $date)->where('component_type_id', $typecomposantBoisson->id ?? null)->first();
        // Accompagnement
        $containaccompagnement = Contain::where('paquet_id', $id)->where('date', $date)->where('component_type_id', $typecomposantAccompagnement->id ?? null)->first();

        // Resistance
        $containresistance = Contain::where('paquet_id', $id)->where('date', $date)->where('component_type_id', $typecomposantresistance->id ?? null)->get();

        return view('menu.reconduit', [
            'datemin' => date('Y-m-d'),
            'date' => $date,
            'packs' => Paquet::where('status', true)->get(),
            'entree' => $composantentree,
            'dessert' => $composantdessert,
            'boisson' => $composantboisson,
            'accompagnement' => $composantAccompagnement,
            'resistance' => $composantresistance,
            'entreeselectionne' => $containentree,
            'dessertselectionne' => $containdessert,
            'boissonselectionne' => $containboisson,
            'accompagnementselectionne' => $containaccompagnement,
            'resistanceselectionne' => $containresistance,
            'packselectionne' => $packselectionne,
            'typepacks' => PaquetType::all(),
            'composants' => Component::all(),
            'typecomposants' => ComponentType::all(),
        ]);
    }

    public function update(Request $request, string $id, string $date): RedirectResponse
    {
        $request->pack = $id;
        $request->validate([
            // 'pack' => 'required',
            'resistance' => 'required',
            'date' => 'required',
            'price' => 'required|min:1|not_in:0',
        ]);
        try {
            if ($request->activemenutoday == "on") {
                $check = true;
            } else {
                $check = false;
            }


            // Entree
            $typecomposantentree = ComponentType::where('label', 'Entrée')->first();
            // Desert
            $typecomposantDessert = ComponentType::where('label', 'Dessert')->first();
            // Boisson
            $typecomposantBoisson = ComponentType::where('label', 'Boisson')->first();
            // Accompagnement
            $typecomposantAccompagnement = ComponentType::where('label', 'Accompagnement')->first();
            // Resistance
            $typecomposantresistance = ComponentType::where('label', 'Résistance')->first();

            // Verifier le pack
            $searchpack = Paquet::where('id', $request->pack)->first();


            if (!is_null($searchpack->component_type_id)) {
                foreach (json_decode($searchpack->component_type_id) as $keypack => $valuepack) {
                    // Entree
                    if ($valuepack == $typecomposantentree->id) {
                        if (!is_null($request->entree)) {
                            $contains = Contain::where('paquet_id', $id)->where('component_type_id', $typecomposantentree->id ?? null)->where('date', $date)->update([
                                'component_id' => $request->entree,
                                'paquet_id' => $request->pack,
                                'date' => $request->date,
                                'created_by' => Auth::user()->id ?? null,
                                'price' => $request->price,
                                'status' => $check,
                                'component_type_id' => $typecomposantentree->id ?? null,
                            ]);
                        }
                    }

                    // Dessert
                    if ($valuepack == $typecomposantDessert->id) {
                        if (!is_null($request->dessert)) {
                            $contains = Contain::where('paquet_id', $id)->where('component_type_id', $typecomposantDessert->id ?? null)->where('date', $date)->update([
                                'component_id' => $request->dessert,
                                'paquet_id' => $request->pack,
                                'date' => $request->date,
                                'created_by' => Auth::user()->id ?? null,
                                'price' => $request->price,
                                'status' => $check,
                                'component_type_id' => $typecomposantDessert->id ?? null,
                            ]);
                        }
                    }

                    // Boisson
                    if ($valuepack == $typecomposantBoisson->id) {
                        if (!is_null($request->boisson)) {

                            $contains = Contain::where('paquet_id', $id)->where('component_type_id', $typecomposantBoisson->id ?? null)->where('date', $date)->update([
                                'component_id' => $request->boisson,
                                'paquet_id' => $request->pack,
                                'date' => $request->date,
                                'created_by' => Auth::user()->id ?? null,
                                'price' => $request->price,
                                'status' => $check,
                                'component_type_id' => $typecomposantBoisson->id ?? null,
                            ]);
                        }
                    }

                    // Accompagnement
                    if ($valuepack == $typecomposantAccompagnement->id) {
                        if (!is_null($request->accompagnement)) {

                            $contains = Contain::where('paquet_id', $id)->where('component_type_id', $typecomposantAccompagnement->id ?? null)->where('date', $date)->update([
                                'component_id' => $request->accompagnement,
                                'paquet_id' => $request->pack,
                                'date' => $request->date,
                                'created_by' => Auth::user()->id ?? null,
                                'price' => $request->price,
                                'status' => $check,
                                'component_type_id' => $typecomposantAccompagnement->id ?? null,
                            ]);
                        }
                    }

                    // Résistance
                    if ($valuepack == $typecomposantresistance->id) {
                        if (!is_iterable($request->resistance)) {
                            abort(404);
                        }
                        foreach ($request->resistance as $key => $value) {
                            $resis = Contain::where('paquet_id', $id)->where('component_type_id', $typecomposantresistance->id ?? null)->where('date', $date)->get();
                            foreach ($resis as $key => $resis) {

                                $contains = Contain::where('id', $resis->id)->update([
                                    'component_id' => $value,
                                    'paquet_id' => $request->pack,
                                    'date' => $request->date,
                                    'created_by' => Auth::user()->id ?? null,
                                    'price' => $request->price,
                                    'status' => $check,
                                    'component_type_id' => $typecomposantresistance->id ?? null,
                                ]);
                            }
                        }
                    }
                }
            }


            return redirect()->route('allmenus')->with('success', "Modification effectuée");
        } catch (\Throwable $th) {
            return redirect()->route('allmenus')->with('success', "Modification effectuée");
        }
    }

    public function updatereconduit(Request $request, string $id, string $date): RedirectResponse
    {
        $request->validate([
            'pack' => 'required',
            'resistance' => 'required',
            'date' => 'required',
            'price' => 'required',
        ]);

        try {
            if ($request->activemenutoday == "on") {
                $check = true;
            } else {
                $check = false;
            }

            if (!is_iterable($request->pack)) {
                abort(404);
            }
            foreach ($request->pack as $key1 => $value1) {
                # code...


                // Verifier
                $verify = Contain::where('paquet_id', $value1)->where('date', $request->date)->first();

                if ($verify) {
                    return redirect()->route('createmenus', [0, 0])->with('warning', "Menu déjà enregistré pour ce jour");
                }

                // Entree
                $typecomposantentree = ComponentType::where('label', 'Entrée')->first();
                // Desert
                $typecomposantDessert = ComponentType::where('label', 'Dessert')->first();
                // Boisson
                $typecomposantBoisson = ComponentType::where('label', 'Boisson')->first();
                // Accompagnement
                $typecomposantAccompagnement = ComponentType::where('label', 'Accompagnement')->first();
                // Resistance
                $typecomposantresistance = ComponentType::where('label', 'Résistance')->first();

                // Verifier le pack
                $searchpack = Paquet::where('id', $value1)->first();
                if (($searchpack->paquetType ?? null)->label == "Small Pack" || ($searchpack->paquetType ?? null)->label == "Interne Pack") {
                    // Résistance
                    if (!is_iterable($request->resistance)) {
                        abort(404);
                    }
                    if (!is_array($request->price)) {
                        abort(404);
                    }
                    foreach ($request->resistance as $key => $value) {
                        $contains = Contain::create([
                            'component_id' => $value,
                            'paquet_id' => $value1,
                            'date' => $request->date,
                            'created_by' => Auth::user()->id ?? null,
                            'price' => $request->price[$key1],
                            'status' => $check,
                            'component_type_id' => $typecomposantresistance->id ?? null,
                        ]);
                    }
                } else {

                    if (!is_array($request->price)) {
                        abort(404);
                    }

                    // Entree
                    if (!is_null($request->entree)) {
                        $contains = Contain::create([
                            'component_id' => $request->entree,
                            'paquet_id' => $value1,
                            'date' => $request->date,
                            'created_by' => Auth::user()->id ?? null,
                            'price' => $request->price[$key1],
                            'status' => $check,
                            'component_type_id' => $typecomposantentree->id ?? null,
                        ]);
                    }

                    // Dessert
                    if (!is_null($request->dessert)) {
                        $contains = Contain::create([
                            'component_id' => $request->dessert,
                            'paquet_id' => $value1,
                            'date' => $request->date,
                            'created_by' => Auth::user()->id ?? null,
                            'price' => $request->price[$key1],
                            'status' => $check,
                            'component_type_id' => $typecomposantDessert->id ?? null,
                        ]);
                    }

                    // Boisson
                    if (!is_null($request->boisson)) {

                        $contains = Contain::create([
                            'component_id' => $request->boisson,
                            'paquet_id' => $value1,
                            'date' => $request->date,
                            'created_by' => Auth::user()->id ?? null,
                            'price' => $request->price[$key1],
                            'status' => $check,
                            'component_type_id' => $typecomposantBoisson->id ?? null,
                        ]);
                    }

                    // Accompagnement
                    if (!is_null($request->accompagnement)) {

                        $contains = Contain::create([
                            'component_id' => $request->accompagnement,
                            'paquet_id' => $value1,
                            'date' => $request->date,
                            'created_by' => Auth::user()->id ?? null,
                            'price' => $request->price[$key1],
                            'status' => $check,
                            'component_type_id' => $typecomposantAccompagnement->id ?? null,
                        ]);
                    }

                    // Résistance/
                    if (is_iterable($request->resistance)) {
                        foreach ($request->resistance as $key => $value) {
                            $contains = Contain::create([
                                'component_id' => $value,
                                'paquet_id' => $value1,
                                'date' => $request->date,
                                'created_by' => Auth::user()->id ?? null,
                                'price' => $request->price[$key1],
                                'status' => $check,
                                'component_type_id' => $typecomposantresistance->id ?? null,
                            ]);
                        }
                    } else {
                        abort(404);
                    }
                }
            }
            return redirect()->route('allmenus')->with('success', "Menu reconduit");
        } catch (\Throwable $th) {
            return redirect()->route('allmenus')->with('error', "Erreur, veuillez contacter l'administrateur");
        }
    }

    public function deletemenu(Request $request): RedirectResponse
    {
        try {
            // check menu if it's valided
            $contenir = Contain::where('paquet_id', $request->packformdelete)->where('date', $request->dateformdelete)->where('status', true)->first();
            if ($contenir) {
                return redirect()->route('allmenus')->with('warning', "Impossible de supprimer un menu activé");
            }

            // Supprimer les composants de ce pack
            $contenir = Contain::where('paquet_id', $request->packformdelete)->where('date', $request->dateformdelete)->get();

            foreach ($contenir as $key => $value) {
                $contenirdelete = Contain::where('id', $value->id)->first();
                if ($contenirdelete instanceof Contain) {
                    $contenirdelete->delete();
                }
            }
            return redirect()->route('allmenus')->with('success', "Menu supprimé");
        } catch (\Throwable $th) {
            return redirect()->route('allmenus')->with('error', "Erreur, veuillez contacter l'administrateur");
        }
    }

    public function reconduitmenu(Request $request): RedirectResponse
    {

        // Supprimer les composants de ce pack
        $contenirsearch = Contain::where('paquet_id', $request->packformreconduit)->where('date', date('Y-m-d'))->first();

        if ($contenirsearch) {
            return redirect()->route('allmenus')->with('success', "Impossible de reconduire ce menu");
        }

        // Supprimer les composants de ce pack
        $contenir = Contain::where('paquet_id', $request->packformreconduit)->where('date', $request->dateformreconduit)->get();
        foreach ($contenir as $key => $value) {
            Contain::create([
                'component_id' => $value->component_id,
                'paquet_id' => $value->paquet_id,
                'date' => date('Y-m-d'),
                'created_by' => Auth::user()->id ?? null,
                'price' => $value->price,
                'status' => $value->status,
                'component_type_id' => $value->component_type_id,
            ]);
        }


        return redirect()->route('allmenus')->with('success', "Menu reconduit");
    }

    public function activemenutoday(Request $request): RedirectResponse
    {
        try {
            if ($request->checkformactive == "1") {

                // Rechercher les composants de ce pack
                /** @var object $contenir */
                $contenir = Contain::where('paquet_id', $request->packformactive)->where('date', $request->dateformactive)->get();

                if (!is_iterable($contenir)) {
                    abort(404);
                }
                foreach ($contenir as $key => $value) {
                    $conteniractive = Contain::where('id', $value->id)->first();
                    if ($conteniractive instanceof Contain) {
                        $conteniractive->status = true;
                        $conteniractive->save();
                    }
                }
            } else {

                // Rechercher les composants de ce pack
                /** @var object $contenir */
                $contenir = Contain::where('paquet_id', $request->packformactive)->where('date', $request->dateformactive)->get();

                if (!is_iterable($contenir)) {
                    abort(404);
                }
                foreach ($contenir as $key => $value) {
                    $conteniractive = Contain::where('id', $value->id ?? null)->first();
                    if ($conteniractive instanceof Contain) {
                        $conteniractive->status = false;
                        $conteniractive->save();
                    }
                }
            }
            return redirect()->route('allmenus')->with('success', "Opération éffectuée");
        } catch (\Throwable $th) {
            return redirect()->route('allmenus')->with('error', "Erreur, veuillez contacter l'administration");
        }
    }

    public function menuview()
    {
        $pubdate = date('Y-m-d');
        // Les composants du jour
        $pack = Paquet::all();
        // $menu = Contain::where('status', true)->where('date', date('Y-m-d'))->distinct('paquet_id')->get();
        $menu = Contain::select(DB::raw('DISTINCT(paquet_id)'))
            ->where('date', date('Y-m-d'))
            ->where('status', true)
            ->get();

        // $coupons = Coupon::orderBy('created_at', 'DESC')->distinct('client_id')->get();

        return view('menus.index', [
            "menu" => $menu
        ]);
    }
}
