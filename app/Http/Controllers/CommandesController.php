<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Quota;
use App\Models\Paquet;
use App\Models\Source;
use App\Models\Company;
use App\Models\Contain;
use App\Models\Customer;
use App\Models\District;
use App\Models\Receiver;
use App\Models\Particular;
use App\Models\AddressBook;
use App\Models\PayementMode;
use Illuminate\Http\Request;
use App\Models\ComponentType;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Session\Session;
use App\Interfaces\OrderRepositoryInterface;
use App\Interfaces\PaquetRepositoryInterface;
use App\Interfaces\SourceRepositoryInterface;
use App\Interfaces\CompanyRepositoryInterface;
use App\Interfaces\PaymentRepositoryInterface;
use App\Interfaces\ContenirRepositoryInterface;
use App\Interfaces\CustomerRepositoryInterface;
use App\Interfaces\ParticularRepositoryInterface;
use App\Interfaces\AddressBookRepositoryInterface;

class CommandesController extends Controller
{
    private OrderRepositoryInterface $orderRepository;
    private PaquetRepositoryInterface $paquetRepository;
    private SourceRepositoryInterface $sourceRepository;
    private CustomerRepositoryInterface $customerRepository;
    private ParticularRepositoryInterface $particularRepository;
    private CompanyRepositoryInterface $companyRepository;
    private AddressBookRepositoryInterface $addressbookRepository;
    private PaymentRepositoryInterface $paymentRepository;
    private ContenirRepositoryInterface $contenirRepository;


    public function __construct(OrderRepositoryInterface $orderRepository, PaquetRepositoryInterface $paquetRepository, SourceRepositoryInterface $sourceRepository, CustomerRepositoryInterface $customerRepository, ParticularRepositoryInterface $particularRepository, CompanyRepositoryInterface $companyRepository, AddressBookRepositoryInterface $addressbookRepository, PaymentRepositoryInterface $paymentRepository, ContenirRepositoryInterface $contenirRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->paquetRepository = $paquetRepository;
        $this->sourceRepository = $sourceRepository;
        $this->customerRepository = $customerRepository;
        $this->particularRepository = $particularRepository;
        $this->companyRepository = $companyRepository;
        $this->addressbookRepository = $addressbookRepository;
        $this->paymentRepository = $paymentRepository;
        $this->contenirRepository = $contenirRepository;
    }


    
    /**
     * Liste des commandes
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        session()->put('searchCustomer', null);
        return view('commandes.index', [
            'pack' => $this->paquetRepository->getAllPaquets(),
            'Commandes' => $this->orderRepository->getAllOrders(),
            'source_commandes' => $this->sourceRepository->getAllSources(),
            'clients' => $this->customerRepository->getAllCustomers(),
        ]);
    }

    public function todayorders()
    {
        $date = date('Y-m-d');

        $orders = Order::orderBy('created_at', 'DESC')->where('is_delete', false)->where('date', $date)->get();
        return view('commandes.todayorder', ['orders'=> $orders]);
    }


    /**
     * Liste des commandes
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        // dd($this->contenirRepository->getMenuToDate());
        return view('commandes.add', [
            'carnet_adresses' => null,
            'modepaiements' => $this->paymentRepository->getAllPayment(),
            'packs' => $this->paquetRepository->getActivePaquetToDay(),
            'menu' => $this->contenirRepository->getMenuToDate(),
            'source_commandes' => $this->sourceRepository->getAllSources(),
            'districts' => District::all(),
        ]);
    }

    // Rechercher un client par son numero
    public function search(Request $request): RedirectResponse
    {
        $request->validate([
            'phone' => 'required'
        ]);

        $customer = Customer::orWhere('phone', $request->phone)
            ->orWhere('email', $request->phone)
            ->first();

        if (is_null($customer)) {

            $message = "Aucune information trouvée !";
            return back()->with('error', "$message");
        } else {
            session()->put('searchCustomer', $customer);
            return redirect()->route('commande.create');
        }
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

        if ($customerEmail || $customerPhone) {

            $data = [
                'success' => false,
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

    // Ajouter une adresse de livraison pour un client
    public function carnetadresse(Request $request): JsonResponse
    {
        $request->validate([
            'addadresse' => 'required',
            'idclient' => 'required',
        ]);

        // Verifier si le client existe
        $customer = Customer::where('id', $request->idclient)->first();

        if ($customer) {

            $addressbookDetails = ([
                'address' => $request->addadresse,
                'customer_id' => $request->idclient,
            ]);

            $adresse = AddressBook::create([
                'address' => $request->addadresse,
                'customer_id' => $request->idclient,
            ]);
            // $adresse = $this->addressbookRepository->createAddressBook($addressbookDetails);

            $data = [
                'success' => true,
                'adresse' => $adresse->id,
                'carnetadresse' => AddressBook::where('customer_id', $request->idclient)->get(),
            ];
        } else {

            $data = [
                'success' => false,
                'adresse' => null,
                'carnetadresse' => [],
            ];
        }

        return response()->json($data);
    }

    public function confirm(Request $request): RedirectResponse
    {

        $request->validate([
            'inpcommande' => 'required',
        ]);
        try {
            $order = Order::where('id', $request->inpcommande)->first();

            if ($order) {

                if ($order->status_order == false) {
                    return back()->with('error', "Impossible d'effectué cette opération");
                }
                if ($order->status_delivery == false) {
                    return back()->with('error', "Impossible d'effectué cette opération");
                }
                $order->finished = true;
                $order->save();
            } else {
                return back()->with('error', "Commande non trouvée");
            }
            return redirect()->route('commande.index')->with('success', "opération effectuée");
        } catch (\Throwable $th) {
            return redirect()->route('commande.index')->with('error', "Erreur, veuillez contacter l'administrateur");
        }
    }


    public function actiliv(Request $request): RedirectResponse
    {
        $request->validate([
            'inpdeliver' => 'required',
        ]);
        try {
            $checkForOrder = Order::where('id', $request->inpdeliver)->exists();
            $order = Order::where('id', $request->inpdeliver)->first();

            if ($checkForOrder && $order->status_delivery == true) {

                $order->status_delivery = false;
                $order->save();
                return back()->with('success', "Livraison non validée");
            }
            if ($checkForOrder && $order->status_delivery == false) {
                $order->status_delivery = true;
                $order->save();
                return back()->with('commande.index')->with('success', "Livraison validée");
            }
        } catch (\Throwable $th) {
            return back()->with('commande.index')->with('error', "Erreur, veuillez contacter l'administrateur !");
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());

        // dd($request->all());
        $request->validate([
            'nom' => 'required',
            //'prenom' => 'required',
            'phone' => 'required',
            // 'carnet_adresse' => 'required',
            // 'email11' => 'required',
            'idcustomersearch' => 'required',
            // 'pack' => 'required',
            'mode_paiement' => 'required',
            'source_commande' => 'required',
        ]);

        try {
            if ($request->checkboxclient == true) {

                $request->validate([
                    'nomrecep' => 'required|array|min:1',
                    'prenomrecep' => 'required|array|min:1',
                    'phonerecep' => 'required|array|min:1',
                    'carnet_adresse' => 'required|array|min:1',
                    'district' => 'required|array|min:1',
                ]);

            } else {

                $request->validate([
                    'carnet_adresse_client' => 'required',
                    'idcustomersearch' => 'required',
                    'menu_client' => 'required',
                    'pack_client' => 'required',
                ]);
            }

            // Source commande
            $source = Source::where('id', $request->source_commande)->first();

            // Rechercher un client
            $client = Customer::where('id', $request->idcustomersearch)->first();
            if (!$client instanceof Customer) {
                return back();
            }

            // Récupération du mode de paiement
            $modepaiement = PayementMode::where('id', $request->mode_paiement)->first();

            // Compte TOPFOOD
            $comptetopfood = PayementMode::where('label', "Compte Top Food")->first();

            $statutorder = null;
            if ($comptetopfood->id == $modepaiement->id) {

                $soldeaccount = Customer::where('id', $request->idcustomersearch)->first();

                if ($soldeaccount->solde <= 0) {
                    return back()->with('warning', "Solde insuffisant");
                }

                if ($request->checkboxclient == true) {
                    $totalnbr = 0;
                    foreach ($request->nomrecep as $key => $value) {
                        $totalnbr += ($request->nbr[$key] * Paquet::where('id', $request->pack[$key])->first()->price);
                    }

                    if ($totalnbr > $soldeaccount->solde) {
                        return back()->with('warning', "Solde insuffisant");
                    }
                } else {

                    $totalnbr = $request->nbr_client * Paquet::where('id', $request->pack_client)->first()->price;
                    if ($totalnbr > $soldeaccount->solde) {
                        return back()->with('warning', "Solde insuffisant");
                    }
                }

                $soldeaccount->solde = $soldeaccount->solde - $totalnbr;
                $soldeaccount->save();

                $statutorder = true;
            }

            if ($request->checkboxclient == true) {

                if (is_array($request->nomrecep)) {
                    foreach ($request->nomrecep as $key => $value) {

                        // Enregistrement de contenir

                        // Enregistrement de contenir
                        $contain = Contain::where('component_id', $request->menu[$key])
                            ->where('paquet_id', $request->pack[$key])
                            ->where('date', date('Y-m-d'))
                            ->where('status', true)
                            ->first();

                        // Récupération du quota courant
                        $quota = Quota::where('date', date('Y-m-d'))->where('resistance_id', $contain->component_id)->first();

                        if (!$quota instanceof Quota) {
                            return back()->with('warning', "Menu non disponible !");
                        }


                        $recep = new Receiver();
                        $recep->firstname = $request->nomrecep[$key];
                        $recep->lastname = $request->prenomrecep[$key];
                        $recep->phone = $request->phonerecep[$key];
                        $recep->save();

                        // Pack
                        $pack = Paquet::where('id', $request->pack[$key])->first();

                        // Enregistrer une adresse
                        $carnet_adresse = AddressBook::create([
                            'address' => $request->carnet_adresse[$key],
                            'receiver_id' => $recep->id,
                        ]);

                        // District
                        $district = District::where('id', $request->district[$key])->first();

                        if (!$district instanceof District) {
                            return back()->with('warning', "Zone non trouvée !");
                        }

                        // Enregistrer une commande
                        $commande = new Order();

                        if ($request->nbr[$key] <= $quota->quota_courant) {

                            // Nombre de pack
                            /** @phpstan-ignore-next-line  */
                            $nbr = $request->nbr[$key];

                            // Information suplementaire
                            $infosup = $request->adresse_sup[$key];



                            // Information supplementaire
                            $info_more = $request->adresse_sup[$key];


                            if ($modepaiement instanceof PayementMode) {
                                if ($modepaiement->label !== "MTN Mobile Money" || $modepaiement->label == "MTN Mobile Money") {

                                    $commande1 = commandeByTicket($request, $commande, $source, $modepaiement, $quota, $pack, $client, $carnet_adresse->id, $recep, $nbr, $infosup, $contain, $district, $info_more, $statutorder);
                                }
                            }

                            if ($modepaiement->label == "MTN Mobile Money") {

                                //return commandeByMomo($request, $commande, $source, $modepaiement, $quota, $pack);
                            }

                            return redirect()->route('commande.index')->with('success', "Commande effectuée !");
                        } else {

                            return back()->with('warning', "Il ne reste plus que " . $quota->quota_courant . " " . "en stock");
                        }
                    }
                }
            } else {
                $recep = null;
            }

            // Nombre de pack
            $nbr = $request->nbr_client ?? $request->nbr_client;

            // Information suplementaire
            $infosup = $request->adresse_sup_client ?? $request->adresse_sup_client;

            // Pack
            $pack = Paquet::where('id', $request->pack_client)->first();

            // Enregistrer une commande
            $commande = new Order();

            // Enregistrer une adresse
            $carnetNouveau = AddressBook::where('id', $request->carnet_adresse_client)->first();
            if ($carnetNouveau instanceof AddressBook) {
                $carnet1001 = $carnetNouveau;
            } else {
                $carnet1001 = AddressBook::create([
                    'address'=>$request->carnet_adresse_client,
                    'customer_id'=>$client->id,
                ]);
            }
            $carnet_adresse = $carnet1001->id;

            // Enregistrement de contenir
            $contain = Contain::where('component_id', $request->menu_client)
                ->where('paquet_id', $request->pack_client)
                ->where('date', date('Y-m-d'))
                ->where('status', true)
                ->first();

            // Récupération du quota courant
            $quota = Quota::where('date', date('Y-m-d'))->where('resistance_id', $contain->component_id)->first();

            if (!$quota instanceof Quota) {
                return back()->with('warning', "Menu non disponible !");
            }

            // District
            $district = District::where('id', $request->district_client)->first();

            if (!$district instanceof District) {
                return back()->with('warning', "Zone non trouvée !");
            }

            $info_more = $request->adresse_sup_client;


            if ($request->nbr_client <= $quota->quota_courant) {

                // // Récupération du mode de paiement
                // $modepaiement = PayementMode::where('id', $request->mode_paiement)->first();

                if ($modepaiement->label !== "MTN Mobile Money" || $modepaiement->label == "MTN Mobile Money") {

                    return commandeByTicket($request, $commande, $source, $modepaiement, $quota, $pack, $client, $carnet_adresse, $recep, $nbr, $infosup, $contain, $district, $info_more, $statutorder);
                }

                if ($modepaiement->label == "MTN Mobile Money") {

                    //return commandeByMomo($request, $commande, $source, $modepaiement, $quota, $pack);
                }
            } else {

                return back()->with('warning', "Il ne reste plus que " . $quota->quota_courant . " " . "en stock");
            }
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->route('commande.index')->with('error', "Erreur, veuillez contacter l'administrateur !");
        }
    }

    public function edit(Request $request, Order $commande)
    {

        if (!$commande instanceof Order) {
            return back()->with('error', "Commande non trouvée !");
        }

        if ($commande->date == date('Y-m-d')) {
            $menu = $this->contenirRepository->getMenuToDate();
            $packs = $this->paquetRepository->getActivePaquetToDay();
        } else {

            $menu = Contain::select(DB::raw('DISTINCT(component_id)'), 'contains.*')
                ->where('status', true)
                ->where('id', $commande->contain_id)
                ->get();

            $menu = $menu->groupBy('component_id');

            $packs = Contain::select(DB::raw('DISTINCT(paquet_id)'))
                ->where('status', true)
                ->where('paquet_id', $commande->paquet_id)
                ->where('id', $commande->contain_id)
                ->get();
        }

        //$menu = Menu::where('active', true)->get();
        $client = Customer::where('id', $commande->customer_id)->first();

        return view('commandes.edit', [
            'carnet_adresses' => AddressBook::where('customer_id', $commande->customer_id)->get(),
            'modepaiements' => PayementMode::all(),
            'packs' => $packs,
            'commande' => $commande,
            'menu' => $menu,
            'client' => $client,
            'source_commandes' => Source::all(),
            'districts' => District::all(),
        ]);
    }

    public function changeCommandeStatus(Request $request): RedirectResponse
    {

        $request->validate([
            'inpvalidation' => 'required',
        ]);
        try {
            $checkForOrder = Order::where('id', $request->inpvalidation)->exists();
            $orderInfos = Order::where('id', $request->inpvalidation)->first();
            if ($checkForOrder && $orderInfos->status_order == false) {
                $orderInfos->status_order = true;
                $orderInfos->save();

                return back()->with('success', 'Commande validée avec succès');
            }
            if ($checkForOrder && $orderInfos->status_order == true) {
                $orderInfos->status_order = false;
                $orderInfos->save();
                return back()->with('success', 'Commande invalidée avec succès');
            }
        } catch (\Throwable $th) {
            return back()->with('error', "Erreur, veuillez contacter l'administrateur");
        }
    }



    public function update(Request $request, Order $commande)
    {
        // dd($request->all());

        $request->validate([
            'source_commande' => 'required',
            'mode_paiement' => 'required',
        ]);
        try {
            $recep = null;
            $address = null;
            if ($request->inforeceptionnaire == "receptionnaire") {
                $request->validate([
                    'nomrecep' => 'required',
                    'prenomrecep' => 'required',
                    'phonerecep' => 'required',
                    'carnet_adresse' => 'required',
                    'district_client' => 'required',
                    'inforeceptionnaire' => 'required',
                    'pack' => 'required',
                    'nbr' => 'required',
                    'menu' => 'required',
                    'pack' => 'required',
                ]);

                // Recherche du receptionnaire
                $recep = Receiver::where('id', $request->idreceptionnaire)->first();
                $recep->firstname = $request->nomrecep;
                $recep->lastname = $request->prenomrecep;
                $recep->phone = $request->phonerecep;
                $recep->save();

                // Recherche de l'adresse

                $address = AddressBook::where('receiver_id', $recep->id)->first();
                $address->address = $request->carnet_adresse;
                $address->save();
            } else {
                $request->validate([
                    'menu' => 'required',
                    'pack' => 'required',
                    'nbr' => 'required',
                    'carnet_adresse' => 'required',
                    'district_client' => 'required',
                ]);

                // Recherche de l'adresse

                $address = AddressBook::where('customer_id', $request->idcustomer)->first();
                $address->address = $request->carnet_adresse;
                $address->save();
            }

            // Récupération du mode de paiement
            $modepaiement = PayementMode::where('id', $request->mode_paiement)->first();

            // Compte TOPFOOD
            $comptetopfood = PayementMode::where('label', "Compte Top Food")->first();

            $statutorder = null;
            if ($comptetopfood->id == $modepaiement->id) {

                // Verifier si la commande etait deja enregistré sur solde
                $serachmode = PayementMode::where('id', $commande->payement_mode_id)->first();
                if ($serachmode->id == $comptetopfood->id) {
                    $accountavaibilite = Customer::where('id', $request->idcustomer)->first();
                    $accountavaibilite->solde + $commande->total;
                    $accountavaibilite->save();
                }

                $soldeaccount = Customer::where('id', $request->idcustomer)->first();

                if ($soldeaccount->solde <= 0) {
                    return back()->with('warning', "Solde insuffisant");
                }

                $totalnbr = $request->nbr * Paquet::where('id', $request->pack)->first()->price;
                if ($totalnbr > $soldeaccount->solde) {
                    return back()->with('warning', "Solde insuffisant");
                }

                $soldeaccount->solde = $soldeaccount->solde - $totalnbr;
                $soldeaccount->save();

                $statutorder = true;
            }

            $pack = Paquet::where('id', $request->pack)->first();

            $total =  $request->nbr * $request->price;

            // Enregistrement de contenir
            $contain = Contain::where('component_id', $request->menu)
                ->where('paquet_id', $request->pack)
                ->where('status', true)
                ->first();


            $commande->paquet_id = $pack->id;
            $commande->district_id = $request->district_client;
            $commande->slip_number = 0;
            $commande->status_order = $statutorder ?? $commande->status_order;
            $commande->address_book_id = $address->id ?? null;
            $commande->more_information = $request->adresse_sup;
            $commande->source_id = $request->source_commande;
            $commande->payement_mode_id = $request->mode_paiement;
            $commande->receiver_id = $recep->id ?? null;
            $commande->contain_id = $contain->id;
            $commande->date = date('Y-m-d');
            $commande->number = $request->nbr;
            $commande->unit_price = $request->price;
            $commande->total = $total;
            $commande->save();

            return redirect()->route('commande.index')->with('success', "Commande modifiée !");
        } catch (\Throwable $th) {
            return redirect()->route('commande.index')->with('error', "Erreur, veuillez contacter l'administrateur!");
        }
    }


    public function destroy(Request $request): RedirectResponse
    {
        try {
            $checkForOrder = Order::where('id', $request->commandeformdelete)->exists();
            $orderInfos = Order::where('id', $request->commandeformdelete)->first();
            if ($checkForOrder) {
                if ($orderInfos->status_order == true || $orderInfos->status_delivery  == true || $orderInfos->finished == true) {
                    $message = "Impossible de supprimer cette commande!";
                    return redirect()->route('commande.index')->with('error', "$message");
                } else {
                    $orderInfos->is_delete = true;
                    $orderInfos->save();
                    $message = "Commande supprimé !";
                    return redirect()->route('commande.index')->with('success', "$message");
                }
            } else {
                return back()->with('error', 'Impossible de supprimer cette commande');
            }
        } catch (\Throwable $th) {
            return back()->with('error', "Veuillez contacter l'administrateur");
        }
    }

    public function searchCustomer(Customer $customer)
    {

        if (is_null($customer)) {

            $message = "Aucune information trouvée !";
            return back()->with('error', "$message");
        } else {
            session()->put('searchCustomer', $customer);
            return redirect()->route('commande.create');
        }
    }
}
