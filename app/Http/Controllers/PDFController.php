<?php

namespace App\Http\Controllers;

use App\Models\Pack;
use App\Models\Order;
use App\Models\Client;
use App\Models\Paquet;
use App\Models\Customer;
use App\Models\Commandes;
use App\Models\Company;
use App\Models\District;
use App\Models\ModePaiement;
use App\Models\Particular;
use App\Models\PayementMode;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;

class PDFController extends Controller
{
    public function index() : View
    {
        $pdf = PDF::loadView('myPDF');
        return view('bordereaux.bordereaux');

    }
    public function generatePDF(string $id)
    {
        $commande = Order::find($id);
        $customer = Customer::where('id', $commande->customer_id ?? null)->first();
        if (!is_null($customer->particulars_id) && is_null($customer->companies_id)) {
            $client = Particular::where('id', $customer->particulars_id ?? null)->first();
            $typeOfClient = 'Particular';
        }
        if (!is_null($customer->companies_id) && is_null($customer->particulars_id)) {
            $client = Company::where('id', $customer->companies_id ?? null)->first();
            $typeOfClient = 'Company';
        }
        $paymentMode = PayementMode::where('id', $commande->payement_mode_id ?? null)->first();
        $pack = Paquet::where('id', $commande->paquet_id)->first();
        $district = District::where('id', $commande->district_id)->first();
        // dd($district);
        // $user_id = $commande->client_id;
        // $mode_paiement_id = $commande->mode_paiement_id ;
        // $pack_id = $commande->pack_id;
        // $mode_paiement = ModePaiement::find($mode_paiement_id);
        // $client = Client::find($user_id);
        // $pack = Pack::find($pack_id);
        // $prix_total_paye = $commande->nbr * $pack->price;

        // dd($prix_total_paye);
        $data = [
            'commande' => $commande,
            'client' => $client,
            'customer' => $customer,
            'typeOfClient' => $typeOfClient,
            'mode_paiement' => $paymentMode,
            'pack' => $pack,
            'district' => $district,
            'price' => $commande->number * $pack->price,
        ];
        $pdf = PDF::loadView('bordereaux.bordereaux', $data);
        return $pdf->stream('bordereau.pdf');
    }
}
