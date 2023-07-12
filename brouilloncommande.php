<?php

namespace App\Http\Controllers;

use App\Models\Pack;
use App\Models\Quota;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AddressBook;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Paquet;
use App\Models\Particular;
use App\Models\PayementMode;
use App\Models\Receiver;
use App\Models\Source;

class CommandesController1 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('commandes.index', [
            'pack' => Paquet::all(),
            'Commandes' => Order::all(),
            'source_commandes' => Source::all(),
            'clients' => Customer::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Customer $customer)
    {
        //Verifier si le client existe
        if (is_null($customer)) {
            $customer = null;
        }

        return view('commandes.add', [
            'customer' => $customer,
            'carnet_adresses' => null,
            'modepaiements' => PayementMode::all(),
            'packs' => Paquet::all(),
            // 'commande' => $commande,
            'menu' => [],
            'source_commandes' => Source::all(),
            // 'carnet_adresses' => $carnet_adresses,
        ]);
    }

    public function carnetadresse(Request $request)
    {
        $adresse = AddressBook::create([
            'adresse' => $request->addadresse,
            'client_id' => $request->idclient,
        ]);

        $data = [
            'success' => 1,
            'adresse' => $adresse->id,
            'carnetadresse' => AddressBook::where('client_id', $request->idclient)->get(),
        ];

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {

        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'phone' => 'required',
            'carnet_adresse' => 'required',
            // 'adresse_sup' => 'required',
            'pack' => 'required',
            'number' => 'required',
            'mode_paiement' => 'required',
            'source_commande' => 'required',
        ]);

        if ($request->checkboxclient == 1) {
            $request->validate([
                'nomrecep' => 'required',
                'prenomrecep' => 'required',
                'phonerecep' => 'required',
            ]);

            if (
                count($request->nomrecep) == count($request->prenomrecep) && count($request->prenomrecep) == count($request->phonerecep) &&
                count($request->pack) == count($request->nbr) && count($request->menu) == count($request->nbr) && (count($request->carnet_adresse)) == count($request->nbr)) {
            } else {
                return back()->with('error', "Tous les champs doivent être rempli");
            }

        }else {
            $request->nbr = array_filter($request->nbr,'strlen');
            $request->carnet_adresse = array_filter($request->carnet_adresse,'strlen');
            $request->menu = array_filter($request->menu,'strlen');
            $request->pack = array_filter($request->pack,'strlen');

            if ($request->carnet_adresse[0] == null || ($request->menu[0] ?? $request->menu[1]) == null || ($request->pack[0] ?? $request->pack[1]) == null || ($request->nbr[0] ?? $request->nbr[1]) == null) {
                return back()->with('error', "Le champs vides sont obligatoires !");
            }
        }

        // Récupération du quota courant
        $quota = Quota::where('date', date('Y-m-d'))->first();

        if (is_null($quota)) {
            return back()->with('warning', "Menu non disponible !");
        }


        // Source commande
        $source = Source::where('id', $request->source_commande)->first();

        // Enregistrer un client
        if (is_null($request->client_id)) {
            $client = Customer::where('phone', $request->phone)->first();
            if ($client) {
                $client->nom = $request->nom;
                $client->prenom = $request->prenom;
                $client->phone = $request->phone;
                $client->save();
            } else {

                $client = Customer::create([
                    'nom' => $request->nom,
                    'prenom' => $request->prenom,
                    'phone' => $request->phone,
                ]);
            }
        } else {
            $client = Customer::where('id', $request->client_id)->first();
        }

        if ($request->checkboxclient == 1) {

            foreach ($request->nomrecep as $key => $value) {
                # code...
                $recep = new Receiver();
                $recep->nom = $request->nomrecep[$key];
                $recep->prenom = $request->prenomrecep[$key];
                $recep->phone = $request->phonerecep[$key];
                $recep->save();

                // Pack
                $pack = Paquet::where('id', $request->pack[$key])->first();

                // Enregistrer une adresse
                $carnet_adresse = new AddressBook();
                $carnet_adresse->adresse = $request->carnet_adresse[$key];
                $carnet_adresse->client_id = $client->id;
                $carnet_adresse->save();

                // Enregistrer une commande
                $commande = new Order();

                if ($request->nbr[$key] <= $quota->quota_courant) {

                    // Nombre de pack
                    $nbr = $request->nbr[$key];

                    // Information suplementaire
                    $infosup = $request->adresse_sup[$key];

                    // Récupération du mode de paiement
                    $modepaiement = PayementMode::where('id', $request->mode_paiement)->first();

                    // Menu
                    // $menu = explode('|', $request->menu[$key]);
                    // dd($menu);

                    if ($modepaiement->label !== "MTN Mobile Money") {

                        $commande1 = commandeByTicket($request, $commande, $source, $modepaiement, $quota, $pack, $client, $carnet_adresse, $recep, $nbr, $infosup);
                    }

                    if ($modepaiement->label == "MTN Mobile Money") {

                        //return commandeByMomo($request, $commande, $source, $modepaiement, $quota, $pack);
                    }

                    return redirect()->route('commande.index')->with('success', "Commande effectué !");
                } else {

                    return back()->with('warning', "Il ne reste plus que " . $quota->quota_courant . " " . "en stock");
                }
            }
        } else {
            $recep = null;
        }

        // Nombre de pack
        $nbr = $request->nbr[0] ?? $request->nbr[1];

        // Information suplementaire
        $infosup = $request->adresse_sup[0] ?? $request->adresse_sup[1];

        // Pack
        $pack = Paquet::where('id', $request->pack)->first();

        // Enregistrer une commande
        $commande = new Order();

        // Enregistrer une adresse
        $carnet_adresse = new AddressBook();
        $carnet_adresse->adresse = $request->carnet_adresse[0] ?? $request->carnet_adresse[1];
        $carnet_adresse->client_id = $client->id;
        $carnet_adresse->save();



        if (($request->nbr[0] ?? $request->nbr[1]) <= $quota->quota_courant) {

            // Récupération du mode de paiement
            $modepaiement = PayementMode::where('id', $request->mode_paiement)->first();

            if ($modepaiement->label !== "MTN Mobile Money") {

                return commandeByTicket($request, $commande, $source, $modepaiement, $quota, $pack, $client, $carnet_adresse, $recep, $nbr, $infosup);
            }

            if ($modepaiement->label == "MTN Mobile Money") {

                //return commandeByMomo($request, $commande, $source, $modepaiement, $quota, $pack);
            }

        } else {

            return back()->with('warning', "Il ne reste plus que " . $quota->quota_courant . " " . "en stock");
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
        return view('/Commandes.show_commandes', [
            'Commandes' => Order::findOrFail($id),
            'pack' => Paquet::all(),
            'source_commandes' => Source::all(),
            'date' => date('Y-m-d'),
        ]);
    }


    public function updatecommandes(Request $request, Order $commande)
    {
        $pack = Paquet::where('id', $request->pack)->first();
        $packprice = $pack["price"];
        $date = date('Y-m-d');

        $total =  $request->nombre * $packprice;

        $request->validate([
            'date_livraison' => 'required',
            'nombre' => 'required',
            'Nom_client' => 'required',
            'source_commande' => 'required',
            'pack' => 'required',
        ]);


        $commande->date_livraison = $request->date_livraison;
        $commande->description = $request->description;
        $commande->nombre = $request->nombre;

        $commande->total = $total;
        $commande->Nom_client = $request->Nom_client;
        $commande->source_commande_id = $request->source_commande;
        $commande->pack_id = $request->pack;
        $commande->save();

        $message = "Commande modifiée !";
        return redirect()->back()->with('success', "$message");
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function enregistrer_commande($id)
    {

        // if ($id == 0) {

        //     $commande = null;

        // }else {

        //     $commande = Commandes::where('id', $id)->first();
        // }

        // return view('Commandes.enregistrer_commande', [
        //     'commande'=>$commande
        // ]);
    }


    public function edit(Request $request, Order $commande)
    {
        if (is_null($commande->id)) {
            $commande = null;
        }
        //$menu = Menu::where('active', true)->get();
        $client = Customer::where('id', $commande->client_id)->first();

        return view('commandes.edit', [
            'carnet_adresses' => AddressBook::where('client_id', $commande->client_id)->get(),
            'modepaiements' => PayementMode::all(),
            'packs' => Paquet::all(),
            'commande' => $commande,
           // 'menu' => $menu,
            'client' => $client,
            'source_commandes' => Source::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Commande = Order::find($id);
        $Commande->delete();

        $message = "Commande supprimée !";
        return redirect()->route('commande.index')->with('success', "$message");
    }

    // Rechercher un client par son numero
    public function search(Request $request)
    {
        $client = Customer::where('phone', 'like',  "%" . $request->phone . "%")->first();

        $Commandes = Order::all();
        if (is_null($client)) {
            $message = "Aucun client !";
            return back()->with('error', "$message");
        } else {
            $carnet_adresses = AddressBook::where('client_id', $client->id)->get();

            return redirect()->route('commande.create', $client->id);
        }
    }

    public function CreateBordereaux()
    {

        return view('bordereaux.bordereaux');
    }

    public function addNewCustomer(Request $request)
    {
        $request->validate([
            'typecustomer'=>'required',
            'firstname'=>'required',
            'lastname'=>'required',
            'phone'=>'required',
            'email'=>'required',
        ]);

        if ($request->typecustomer == 'Particulier') {
            $particular = Particular::create([
                'name'=>$request->firstname,
                'firstname'=>$request->lastname,
            ]);

            $customer = Customer::create([
                'particulars_id'=>$particular->id,
                'phone'=>$request->phone,
                'email'=>$request->email,
            ]);

            $data = [
                'success'=>1,
                'customer'=> $customer,
                'company'=> $particular,
                'type'=> 'Particulier',
            ];
        }

        if ($request->typecustomer == 'Entreprise') {
            $company = Company::create([
                'name'=>$request->firstname,
                'firstname'=>$request->lastname,
                'socialreason'=>$request->raisonsociale,
            ]);

            $customer = Customer::create([
                'companies_id'=>$company->id,
                'phone'=>$request->phone,
                'email'=>$request->email,
            ]);

            $data = [
                'success'=>1,
                'customer'=> $customer,
                'company'=> $company,
                'type'=> 'Entreprise',
            ];
        }


        return response()->json($data);
    }


    // Ajouter un client sur la page commande
    public function addNewCustomer(Request $request): JsonResponse
    {
        $request->validate([
            'typecustomer' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);

        $data = [];

        // Rechercher si le mail existe deja
        $customerEmail = Customer::where('email', $request->email)->first();

        // Rechercher si le numero existe deja
        $customerPhone = Customer::where('phone', $request->phone)->first();

        if ($customerEmail) {

            if ($customerEmail->particulars_id) {
                $agent = Particular::where('id', $customerEmail->particulars_id)->first();
            } else {
                $agent = Company::where('id', $customerEmail->companies_id)->first();
            }

            $data = [
                'success' => true,
                'customer' => $customerEmail,
                'company' => $agent,
                'type' => 'Particulier',
                'exist' => true,
            ];

        } elseif ($customerPhone) {

            if ($customerPhone->particulars_id) {
                $agent = Particular::where('id', $customerPhone->particulars_id)->first();
            } else {
                $agent = Company::where('id', $customerPhone->companies_id)->first();
            }

            $data = [
                'success' => true,
                'customer' => $customerPhone,
                'company' => $agent,
                'type' => 'Particulier',
                'exist' => true,
            ];

        } else {

            if ($request->typecustomer == 'Particulier') {

                $particularDetails = ([
                    'name' => $request->firstname,
                    'firstname' => $request->lastname,
                ]);

                $particular = $this->particularRepository->createParticular($particularDetails);

                $customerDetails = ([
                    'particulars_id' => $particular->id,
                    'phone' => $request->phone,
                    'email' => $request->email,
                ]);

                $customer = $this->customerRepository->CreateCustomer($customerDetails);

                $data = [
                    'success' => true,
                    'customer' => $customer,
                    'company' => $particular,
                    'type' => 'Particulier',
                    'exist' => false,
                ];
            }

            if ($request->typecustomer == 'Entreprise') {

                $companyDetails = ([
                    'name' => $request->firstname,
                    'firstname' => $request->lastname,
                    'socialreason' => $request->raisonsociale,
                ]);

                $company = $this->companyRepository->createCompany($companyDetails);

                $customerDetails = ([
                    'companies_id' => $company->id,
                    'phone' => $request->phone,
                    'email' => $request->email,
                ]);

                $customer = $this->customerRepository->CreateCustomer($customerDetails);

                $data = [
                    'success' => true,
                    'customer' => $customer,
                    'company' => $company,
                    'type' => 'Entreprise',
                    'exist' => false,
                ];
            }
        }
        return response()->json($data);
    }
}
