<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use App\Models\Coupon;
use App\Models\Paquet;
use App\Models\Source;
use App\Models\Company;
use App\Models\Commande;
use App\Models\Customer;
use App\Models\Categorie;
use App\Models\Commandes;
use App\Models\Composants;
use App\Models\Particular;
use App\Models\Suggestion;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\IdentifiantMail;
use App\Models\CustomerDepot;
use App\Models\Order;
use App\Models\SourceCommande;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ClientsController extends Controller
{
    public function index(): View
    {
        $customers = Customer::all();

        // dd($entreprise);
        return view('clients.index', [
            'customers' => $customers,
        ]);
    }

    public function showform(string $id): View
    {

        $client = Customer::where('id', $id)->first();
        $raison_social = $client->raison_social ?? null;
        if (blank($client)) {
            return view('clients.index', [
                'customers' => Customer::all(),
            ])->with('error', "Ce client n'existe pas !");
        } elseif (is_null($raison_social))
            return view('clients.update', ['clients' => $client]);
        else
            return view('clients.update2', ['clients' => $client]);
    }

    public function show(string $id): View
    {
        $particulars1 = DB::table('customer_depots')
            ->join('customers', 'customer_depots.customer_id', 'customers.id')
            ->join('particulars', 'customers.particulars_id', 'particulars.id')
            ->where('customer_depots.customer_id', $id)
            ->select('particulars.*', 'customer_depots.*')
            ->orderBy('customer_depots.created_at', 'DESC')
            ->get()->toArray();

        $companies1 = DB::table('customer_depots')
            ->join('customers', 'customer_depots.customer_id', 'customers.id')
            ->join('companies', 'customers.companies_id', 'companies.id')
            ->where('customer_depots.customer_id', $id)
            ->select('companies.*', 'customer_depots.*')
            ->orderBy('customer_depots.created_at', 'DESC')
            ->get()->toArray();

        $customers1 = array_merge($particulars1, $companies1);
        $top5depots = array_slice($customers1, 0, 5);

        $particulars2 = DB::table('orders')
            ->join('customers', 'orders.customer_id', 'customers.id')
            ->join('payement_modes', 'orders.payement_mode_id', 'payement_modes.id')
            ->join('paquets', 'orders.source_id', 'paquets.id')
            ->join('particulars', 'customers.particulars_id', 'particulars.id')
            ->where('orders.customer_id', $id)
            ->where('orders.status_order', false)
            ->where('orders.date', date('Y-m-d'))
            ->select('particulars.*', 'orders.*', 'payement_modes.label', 'paquets.label')
            ->orderBy('orders.created_at', 'DESC')
            ->get()->toArray();

        $companies2 = DB::table('orders')
            ->join('customers', 'orders.customer_id', 'customers.id')
            ->join('payement_modes', 'orders.payement_mode_id', 'payement_modes.id')
            ->join('paquets', 'orders.source_id', 'paquets.id')
            ->join('companies', 'customers.companies_id', 'companies.id')
            ->where('orders.customer_id', $id)
            ->where('orders.status_order', false)
            ->where('orders.date', date('Y-m-d'))
            ->select('companies.*', 'orders.*', 'payement_modes.label', 'paquets.label')
            ->orderBy('orders.created_at', 'DESC')
            ->get()->toArray();

        $customers2 = array_merge($particulars2, $companies2);
        // dd($customers2);

        $particulars = DB::table('suggestions')
            ->join('customers', 'suggestions.customers_id', 'customers.id')
            ->join('sources', 'suggestions.sources_id', 'sources.id')
            ->join('particulars', 'customers.particulars_id', 'particulars.id')
            ->where('suggestions.customers_id', $id)
            ->select('particulars.*', 'suggestions.*', 'sources.label')
            ->orderBy('suggestions.created_at', 'DESC')
            ->get()->toArray();

        $companies = DB::table('suggestions')
            ->join('customers', 'suggestions.customers_id', 'customers.id')
            ->join('sources', 'suggestions.sources_id', 'sources.id')
            ->join('companies', 'customers.companies_id', 'companies.id')
            ->where('suggestions.customers_id', $id)
            ->select('companies.*', 'suggestions.*', 'sources.label')
            ->orderBy('suggestions.created_at', 'DESC')
            ->get()->toArray();

        $customers = array_merge($particulars, $companies);
        $top5suggestions = array_slice($customers, 0, 5);
        $client = Customer::where('id', $id)->first();
        $date = date('Y-m-d');
        $sources = Source::all();
        $solde = DB::table('customer_depots')
            ->select(DB::raw('sum(customer_depots.amount) as sum'))
            ->where('customer_depots.customer_id', $id)
            ->first();

        $pack = Paquet::all();
        $pack = $pack->groupBy('price');
        $prices = [];
        foreach ($pack as $price => $paquets) {
            array_push($prices, $price);
        }

        $coupons = Coupon::orderBy('created_at', 'DESC')->get();
        $users = User::all();
        if (blank($client)) {
            abort(404);
        } else {

            return view('clients.customer-view', [
                'clients' => $client,
                'date' => $date,
                'sources' => $sources,
                'solde' => $solde,
                'Suggestion' => $top5suggestions,
                'customer_depots' => $top5depots,
                'commandes' => $customers2,
                'users' => $users,
                'coupons' => $coupons,
                'prices' => $prices,
                'date' => date('Y-m-d'),

            ]);
        }
    }


    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {


    //     $request->validate([
    //         'phone' => 'required|integer|unique:clients,phone',
    //         'email' => 'unique:clients,email',
    //     ]);

    //     try {
    //         $password = substr($request->nom, 0, 1) . substr($request->prenom, 0, 1) . uniqid();
    //         $categorie = Categorie::where('id', $request->categorie_id)->first();
    //         $username = substr($request->nom, 0, 1) . substr($request->prenom, 0, 1) . uniqid();

    //         if ($categorie->label == 'Particulier') {
    //             $username = substr($request->nom, 0, 1) . substr($request->prenom, 0, 1) . uniqid();
    //         } else {
    //             $username = substr($request->raison_social, 0, 2) . uniqid();
    //         }

    //         $nom = ucfirst(strtolower($request->nom));


    //         $nom = preg_replace('/\s\s+/', ' ', $nom);

    //         $prenom = ucfirst(strtolower($request->prenom));


    //         $prenom = preg_replace('/\s\s+/', ' ', $prenom);

    //         $raison_social = ucfirst(strtolower($request->raison_social));


    //         $raison_social = preg_replace('/\s\s+/', ' ', $raison_social);



    //         $client = Customer::create([
    //             'id' => Str::uuid(),
    //             'categorie_id' => $request->categorie_id,
    //             'nom' => $nom,
    //             'prenom' => $prenom,
    //             'raison_social' => $raison_social,
    //             'username' => $username,
    //             'phone' => $request->phone,
    //             'email' => $request->email,
    //             'password' => Hash::make($password),
    //         ]);
    //         if (!blank($request->email)) {

    //             $data = [
    //                 'email' => $client->email,
    //                 'username' => $client->username,
    //                 'password' => $password,
    //                 'url' => route('maintenance'),
    //             ];

    //             Mail::to($data['email'])->send(new IdentifiantMail($data));
    //         }
    //         if (!blank($request->email)) {

    //             $data = [
    //                 'email' => $client->email,
    //                 'username' => $client->username,
    //                 'password' => $password,
    //                 'url' => route('maintenance'),
    //             ];

    //             Mail::to($data['email'])->send(new IdentifiantMail($data));
    //         }
    //         return redirect()->route('client.index')->with('success', "Client enregistré !");
    //     } catch (\Throwable $th) {
    //         return back()->with('Erreur', $th->getMessage());
    //     }
    // }






    // public function updateclient(Request $request, Client $client)
    // {
    //     $request->validate([
    //         'nom' => 'required|string',
    //         'prenom' => 'required|string',
    //         'phone' => 'required|integer|unique:clients,phone,' . $client->id,
    //         'email' => 'unique:clients,email,' . $client->id,
    //     ]);


    //     try {


    //         $nom = ucfirst(strtolower($request->nom));


    //         $nom = preg_replace('/\s\s+/', ' ', $nom);

    //         $prenom = ucfirst(strtolower($request->prenom));


    //         $prenom = preg_replace('/\s\s+/', ' ', $prenom);

    //         $client->nom = $nom;
    //         $client->prenom = $prenom;

    //         $client->phone = $request->phone;
    //         $client->email = $request->email;
    //         $client->save();

    //         $message = "Client modifié !";
    //         return redirect()->route('client.index')->with('success', "$message");
    //     } catch (\Throwable $th) {
    //         return back()->with('Erreur', $th->getMessage());
    //     }
    // }


    // public function updateclient2(Request $request, Client $client)
    // {
    //     $request->validate([
    //         'raison_social' => 'required|string',
    //         'phone' => 'required|integer|unique:clients,phone,' . $client->id,
    //         'email' => 'unique:clients,email,' . $client->id,
    //     ]);


    //     try {


    //         // $raison_social = ucfirst(strtolower($request->raison_social));


    //         // $raison_social = preg_replace('/\s\s+/', ' ', $raison_social);

    //         // $client->raison_social = $raison_social;
    //         $client->raison_social = $request->raison_social;

    //         $client->phone = $request->phone;
    //         $client->email = $request->email;
    //         $client->save();

    //         $message = "Client modifié !";
    //         return redirect()->route('client.index')->with('success', "$message");
    //     } catch (\Throwable $th) {
    //         return back()->with('Erreur', $th->getMessage());
    //     }
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit(Request $request, $id)
    // {
    //     $request->validate([
    //         'labels' => 'required|string|unique:SourceCommande',
    //     ]);
    //     $SourceCommande = SourceCommande::find($id);

    //     $validator = SourceCommande::create([
    //         'id' => Str::uuid(),
    //         'label' => $request->labels,
    //         //'created_by'=> Auth::user()->id,
    //     ]);

    //     return back()->with('successMessage', "Source de commande enregistrée !");

    //     $SourceCommande->label = $request->labels;

    //     $SourceCommande->save();

    //     return $this->index();
    // }


    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Customer $customer)
    {
        try {
            if (!$customer instanceof Customer) {
                abort(404);
            }

            $suggestion = Suggestion::where('customers_id', ($customer->id ?? null))->first();

            if (!blank($suggestion)) {
                $message = "Impossible de supprimer ce client!";
                return redirect()->route('customer.index')->with('error', "$message");
            }

            $coupon = Coupon::where('customer_id', $customer->id ?? null)->first();

            $commande = Order::where('customer_id', $customer->id)->first();
            if ($commande instanceof Order) {
                $message = "Impossible de supprimer ce client!";
                return redirect()->route('customer.index')->with('error', "$message");
            }

            $depot = CustomerDepot::where('customer_id', $customer->id ?? null)->first();

            if (!blank($depot)) {
                $message = "Ce client a déja éffectué une opération !";
                return redirect()->route('customer.index')->with('error', "$message");
            }

            if (!blank($coupon)) {
                $message = "Impossible de supprimer ce client!";
                return redirect()->route('customer.index')->with('error', "$message");
            } else {

                if (!is_null($customer->particulars_id)) {
                    $cus1 = $customer->particulars_id ?? null;
                    $type = "Particulier";
                } else {
                    $cus2 = $customer->companies_id;
                    $type = "Entreprise";
                }


                $customer->delete();

                if ($type == "Particulier") {
                    $particular = Particular::where('id', $cus1)->first();
                    if (!is_null($particular)) {
                        $particular->delete();
                    }
                } else {
                    $particular = Company::where('id', $cus2)->first();
                    if (!is_null($particular)) {
                        $particular->delete();
                    }
                }

                return redirect()->route('customer.index')->with('success', "Client supprimé");
            }
        } catch (\Throwable $th) {
            return redirect()->route('customer.index')->with('error', "Erreur, veuillez contacter l'administrateur");
        }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */

    public function reset(Customer $customer)
    {

        if (!$customer instanceof Customer) {
            abort(404);
        }

        $password = substr(strval($customer->username), 0, 1) . uniqid();

        if (!blank($customer->email)) {

            $data = [
                'email' => $customer->email,
                'username' => $customer->username,
                'password' => $password,
                'url' => route('maintenance'),
            ];

            Mail::to($data['email'])->send(new IdentifiantMail($data));
        }

        return redirect()->route('customer.index')->with('success', "Opération effectuée");
    }


    public function maintenance(): View
    {
        return view('maintenance.maintenance');
    }


    // LES NOUVELLES FONCTIONS
    public function list(): View
    {
        $customers = Customer::all();
        $nbrparticulier = count(Customer::where('companies_id', null)->get());
        $nbrcompany = count(Customer::where('particulars_id', null)->get());
        // dd($customers);
        return view('clients.list_client', [
            'customers' => $customers,
            'nbrparticulier' => $nbrparticulier,
            'nbrcompany' => $nbrcompany,
        ]);
    }
}
