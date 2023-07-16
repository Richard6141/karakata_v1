<?php

use Carbon\Carbon;
use App\Models\Pack;
use App\Models\User;
use App\Models\Order;
use App\Models\Client;
use App\Models\Coupon;
use App\Models\Paquet;
use App\Models\Survey;
use App\Models\Contain;
use App\Models\Contenir;
use App\Models\Receiver;
use App\Models\Brouillon;
use App\Models\Component;
use App\Models\Composants;
use App\Models\PaquetType;
use App\Models\AddressBook;
use App\Models\AvailableDeliver;
use Illuminate\Support\Facades\DB;

function upload($request)
{
    $file = $request->file('image');
    $filename = now() . $file->getClientOriginalName();
    $file->move(public_path('image'), $filename);
    return $filename;
}

function countUser()
{
    $users = User::all();
    return $users->count();
}

function countCommande()
{
    $Order = Order::where('status_order', false)->where('is_delete', false)->get();
    return $Order->count();
}

function countLivraison()
{
    $Order = Order::where('status_delivery', false)->get();
    return $Order->count();
}

function countnotify()
{
    $commande = Order::where('status_order', false)->get()->count();
    $livraison = Order::where('status_delivery', false)->get()->count();

    return $commande + $livraison;
}

function composants($id)
{
    //$composants = Composants::where('pack_id', $id)->where('publish_date', date('Y-m-d'))->get();
    $composants = DB::table('composants')
        ->select('composants.*', 'type_composants.labels as typecomposant')
        ->join('type_composants', 'composants.type_composant_id', 'type_composants.id')
        ->where('publish_date', date('Y-m-d'))
        ->where('composants.pack_id', $id)
        ->get();
    return $composants ?? [];
}

function commandeByTicket($request, $commande, $source, $modepaiement, $quota, $pack, $client, $carnet_adresse, $recep, $nbr, $infosup, $contain, $district, $info_more, $statutorder)
{

    $commande->customer_id = $client->id;
    $commande->paquet_id = $pack->id;
    $commande->district_id = $district->id;
    $commande->slip_number = 0;
    $commande->address_book_id = $carnet_adresse;
    $commande->more_information = $info_more;
    $commande->source_id = $source->id;
    $commande->payement_mode_id = $modepaiement->id;
    $commande->receiver_id = $recep->id ?? null;
    $commande->status_order = $statutorder ?? false;
    $commande->contain_id = $contain->id;
    // $commande->commentaire = "Commande en cours";
    $commande->date = date('Y-m-d H:i:s');
    $commande->number = $nbr;
    $commande->more_information = $infosup;
    $commande->unit_price = $pack->price;
    $commande->total = $nbr * $pack->price;
    $commande->save();

    // Update table quota
    $quota->quota_courant = $quota->quota_courant - $nbr;
    $quota->save();

    return redirect()->route('commande.index')->with('success', "Commande réussie !");
}

// function commandeByBank($request, $commande, $source, $modepaiement, $quota, $pack, $client, $carnet_adresse, $recep)
// {

//     $commande->client_id = $client->id;
//     $commande->pack_id = $pack->id;
//     $commande->carnet_adresse_id = $carnet_adresse->id;
//     $commande->source_commande_id = $source->id;
//     $commande->mode_paiement_id = $modepaiement->id;
//     $commande->receptionnaire_id = $recep->id ?? $recep;
//     $commande->statut_commande = false;
//     $commande->commentaire = "Commande en cours";
//     $commande->date = date('Y-m-d H:i:s');
//     $commande->nbr = $request->nbr;
//     $commande->description_localisation = $request->adresse_sup;
//     $commande->pu = $pack->price;
//     $commande->total = $request->nbr * $pack->price;
//     $commande->save();

//     // Update table quota
//     $quota->quota_courant = $quota->quota_courant - $request->nbr;
//     $quota->save();

//     return redirect()->route('commande.index')->with('success', "Commande réussie !");
// }


// function packpublie($id)
// {
//     $composant = Composants::where('pack_id', $id)->where('publish_date', date('Y-m-d'))->first();

//     if (!blank($composant)) {
//         return $compo = $composant->status;
//     } else {
//         return $compo = null;
//     }
// }

function allpermission($id)
{
    $user = User::where('id', $id)->first();

    if (
        $user->hasPermissionTo("show_user_list") &&
        $user->hasPermissionTo("create_user") &&  $user->hasPermissionTo("edit_user") && $user->hasPermissionTo("lock_user")
        && $user->hasPermissionTo("index_type_composant") && $user->hasPermissionTo("create_type_composant")
        && $user->hasPermissionTo("update_type_composant") && $user->hasPermissionTo("delete_type_composant")
        && $user->hasPermissionTo("index_composant") && $user->hasPermissionTo("create_composant") && $user->hasPermissionTo("update_composant")
        && $user->hasPermissionTo("delete_composant") && $user->hasPermissionTo("index_pack") && $user->hasPermissionTo("create_pack")
        && $user->hasPermissionTo("delete_pack") && $user->hasPermissionTo("index_commande") && $user->hasPermissionTo("create_commande")
        && $user->hasPermissionTo("delete_commande") && $user->hasPermissionTo("index_source_commande") && $user->hasPermissionTo("create_source_commande")
        && $user->hasPermissionTo("update_source_commande") && $user->hasPermissionTo("delete_source_commande")

    ) {
        return true;
    } else {
        return false;
    }
}

function chiffreaffairebymonthcurrent()
{
    $chiffreaffairemonth = DB::table('orders')
        ->select(DB::raw('sum(orders.total) as sum'))
        ->whereMonth('date', Carbon::now()->month)
        ->first();
    return $chiffreaffairemonth;
}

function topthreecostumer()
{
    $datedebut = date('Y-m-d');
    $datefin = date('Y-m-d');
    // dd( Carbon::parse($datefin)->format('Y-m-d 23:60:10'));
    // $topthreecostumer = DB::table('orders')
    //     ->select(DB::raw('count(orders.id) as count'), 'orders.customer_id as id', 'customers.nom as nom', 'customers.prenom as prenom', 'customers.raison_social as raison_social')
    //     ->join('customers', 'orders.customer_id', 'customers.id')
    //     ->whereBetween('date', [Carbon::parse($datedebut)->format('Y-m-d H:i:s'), Carbon::parse($datefin)->format('Y-m-d 23:59:09')])
    //     // ->whereMonth('date', Carbon::now()->month)
    //     ->orderBy('count', 'DESC')
    //     ->limit(3)
    //     ->groupBy('orders.customer_id', 'customers.nom', 'customers.prenom', 'customers.raison_social')
    //     ->get();
    $topthreecostumer = [];

    // $topthreecostumer = DB::table('Order')
    // ->select(DB::raw('count(Order.id) as count'), 'Order.client_id as id', 'clients.nom as nom', 'clients.prenom as prenom')
    // ->join('clients', 'Order.client_id', 'clients.id')
    // // ->whereBetween('date', [Carbon::parse($datedebut)->format('Y-m-d H:i:s'), Carbon::parse($datefin)->format('Y-m-d H:i:s')])
    // ->whereMonth('date', Carbon::now()->month)
    // ->orderBy('count', 'DESC')
    // ->limit(3)
    // ->groupBy('Order.client_id', 'clients.nom', 'clients.prenom')
    // ->get();

    return $topthreecostumer;
}

// function client($id)
// {

//     $client = Client::where('id', $id)->first();
//     return $client;
// }

function backUrl()
{

    $precedent = back()->getTargetUrl();

    return $precedent;
}
// function listconstituants ($id)
// {
//     $constituants = Contenir::where('pack_id', $id)->where('date', date('Y-m-d'))->get();
// }
function listconstituants($id, $date)
{
    $constituants = Brouillon::where('paquet_id', $id)->where('date', $date)->get();

    return $constituants ?? null;
}

function infopack($id)
{
    $pack = Paquet::where('id', $id)->first();

    return $pack ?? null;
}

function infotypepack($id)
{
    $pack = Paquet::where('id', $id)->first();

    $type = PaquetType::where('id', $pack->paquet_type_id)->first();

    return $type ?? null;
}

function infocomposant($id)
{
    $pack = Component::where('id', $id)->first();

    return $pack ?? null;
}

function checkinfocomposant($id, $date)
{
    // Rechercher les composants de ce pack
    $contenir = Contain::where('paquet_id', $id)->where('date', $date)->get();

    foreach ($contenir as $key => $value) {
        if ($value->status == false) {
            return 0;
        }
    }
    return 1;
}

function showinfocomposant($id, $date)
{
    // Rechercher les composants de ce pack

    $contenir = DB::table('contains As A')
        ->select('B.*', 'D.label As composants', 'A.id As contenir_id', 'A.paquet_id As pack_id', 'A.component_id As composant_id', 'C.label As type_packs', 'E.label As type_composants')
        ->join('paquets As B', 'A.paquet_id', 'B.id')
        ->join('paquet_types As C', 'B.paquet_type_id', 'C.id')
        ->join('components As D', 'A.component_id', 'D.id')
        ->join('component_types As E', 'D.component_type_id', 'E.id')
        ->where('A.paquet_id', $id)
        ->where('A.date', $date)
        ->get();

    return $contenir ?? [];
}

function countCouponValid()
{
    $coupons = Coupon::all();
    $couponsvalid = [];
    foreach ($coupons as $coupon) {
        if ($coupon->coupon_status == 0) {
            array_push($couponsvalid, $coupon);
        }
    }
    return count($couponsvalid);
}

function couponsNoValid()
{
    $coupons = Coupon::all();
    $couponsNovalid = [];
    foreach ($coupons as $coupon) {
        if ($coupon->coupon_status == 1) {
            array_push($couponsNovalid, $coupon);
        }
    }
    return count($couponsNovalid);
}
function infopack1($id)
{
    // Rechercher les composants de ce pack

    $pack = Paquet::where('id', $id)->first();

    return $pack ?? null;
}

function updatecouponstatus($id)
{
    foreach ($id as $coupon) {
        if ($coupon->expiry_date < date('Y-m-d')) {
            $coupon->coupon_status = 1;
            $coupon->save();
        }
    }
}

function checkavailabledeliver($id)
{
    $availabledelever = AvailableDeliver::where('end_day', '>=', date('Y-m-d'))->first();
    if ($availabledelever) {
        return true;
    } else {
        return false;
    }
}

function checkexistdeliver($id)
{
    $availabledelever = AvailableDeliver::where('deliver_id', $id)->first();
    if ($availabledelever) {
        return true;
    } else {
        return false;
    }
}

function updateContainTable()
{
    $contain = Contain::where('status', true)->where('date', '<', date('Y-m-d'))->get();
    foreach ($contain as $key => $value) {
        $containUpdate = Contain::where('id', $value->id)->first();
        $containUpdate->status = false;
        $containUpdate->save();
    }
}

function listAddressCustomer($id)
{

    $address = AddressBook::where('customer_id', $id)->get();
    return $address;
}

function checkDateCustomer($id)
{

    if ($id == null) {
        return false;
    }

    $date1 = Carbon::parse($id)->format('d-m');
    $date2 = Carbon::parse(date('Y-m-d'))->format('d-m');
    if ($date1 == $date2) {
        return true;
    } else {
        return false;
    }
}

function checkSoldCustomer($id)
{

    $date1 = Carbon::parse($id)->format('d-m');
    $date2 = Carbon::parse(date('Y-m-d'))->format('d-m');
    if ($date1 == $date2) {
        return true;
    } else {
        return false;
    }
}

function infoResistance($id)
{

    $resistance = Component::where('id', $id)->first();

    return $resistance ?? null;
}

function infoPaquet($id)
{
    $paquet = Paquet::where('id', $id)->first();
    return $paquet ?? null;
}

function infoReceiver($id)
{
    $receiver = AddressBook::where('id', $id)->first();
    return $receiver ?? null;
}

function infoResistances($id)
{
    $contain = Contain::where('id', $id)->first();
    return $contain ?? null;
}


function import_CSV($filename, $delimiter = ';')
{
    if (!file_exists($filename) || !is_readable($filename))
        return false;
    $header = null;
    $data = array();
    if (($handle = fopen($filename, 'r')) !== false) {
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
            $row = array_map("utf8_encode", $row);
            if (!$header)
                $header = $row;
            else
                $data[] = array_combine($header, $row);
        }
        fclose($handle);
    }
    return $data;
}

function import_CSV1($filename, $delimiter = ';')
{
    if (!file_exists($filename) || !is_readable($filename))
        return false;
    $header = null;
    $data = array();
    if (($handle = fopen($filename, 'r')) !== false) {
        while (($row = fgetcsv($handle, 0, $delimiter)) !== false) {
            $row = array_map("utf8_encode", $row);
            if (!$header)
                $header = $row;
            else
                $data[] = array_combine($header, $row);
        }
        fclose($handle);
    }
    return $data;
}

function todaywork (){
    $date = date('Y-m-d');
    $results = Survey::where('user_id', '=', Auth::user()->id)
            // ->where('status_survey', true)
            ->whereDate('created_at', '=', Carbon::today()->toDateString())
            // ->select('deliver_id')
            ->get()->count();

    return $results;
}

function todaywork_date() {
    return date('Y-m-d');
}

function my_survey() {
    $my_results = Survey::where('user_id', '=', Auth::user()->id)
            ->get()->count();

    return $my_results;
}

function today_survey() {
    $today_survey = Survey::where('user_id', Auth::user()->id)->whereDate('created_at', '=', Carbon::today()->toDateString())
            // ->select('deliver_id')
            ->get()->count();

    return $today_survey;
}

function all_today_survey() {
    $today_survey = Survey::whereDate('created_at', '=', Carbon::today()->toDateString())
            // ->select('deliver_id')
            ->get()->count();

    return $today_survey;
}
function allsurvey() {
    $today_survey = Survey::all()->count();

    return $today_survey;
}
