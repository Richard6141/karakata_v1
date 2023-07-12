<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Commandes;
use App\Models\ModePaiement;
use App\Models\Pack;
use App\Models\SourceCommande;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RepportController extends Controller
{

    public function reportlist()
    {
        return view('report.index');
    }

    public function commandebysource()
    {
        $datedebut = date('Y-m-d');
        $datefin = date('Y-m-d');
        $type = null;

        $commdes = DB::table('commandes')
            ->select(DB::raw('count(commandes.id) as count'), 'commandes.source_commande_id as id', 'source_commandes.label as label')
            ->join('source_commandes', 'commandes.source_commande_id', 'source_commandes.id')
            ->whereBetween('date', [Carbon::parse($datedebut)->format('Y-m-d H:i:s'), Carbon::parse($datefin)->format('Y-m-d H:i:s')])
            ->groupBy('commandes.source_commande_id', 'source_commandes.label')
            ->get();

        $sources = SourceCommande::all();

        return view('report.commandebysource.index', [
            'datedebut' => $datedebut,
            'datefin' => $datefin,
            'type' => $type,
            'commandes' => $commdes,
            'sources' => $sources
        ]);
    }

    public function searchcommandebysource(Request $request)
    {
        $request->validate([
            'datedebut' => 'required',
            'datefin' => 'required',
            //'source'=>'required',
        ]);

        $datedebut = $request->datedebut;
        $datefin = $request->datefin;


        if (is_null($request->source)) {
            $type = null;
        } else {
            $type = $request->source;
        }


        if (is_null($request->source)) {
            $commdes = DB::table('commandes')
                ->select(DB::raw('count(commandes.id) as count'), 'commandes.source_commande_id as id', 'source_commandes.label as label')
                ->join('source_commandes', 'commandes.source_commande_id', 'source_commandes.id')
                ->whereBetween('date', [Carbon::parse($datedebut)->format('Y-m-d H:i:s'), Carbon::parse($datefin)->format('Y-m-d H:i:s')])
                ->groupBy('commandes.source_commande_id', 'source_commandes.label')
                ->get();
        } else {
            $commdes = DB::table('commandes')
                ->select(DB::raw('count(commandes.id) as count'), 'commandes.source_commande_id as id', 'source_commandes.label as label')
                ->join('source_commandes', 'commandes.source_commande_id', 'source_commandes.id')
                ->orWhere('commandes.source_commande_id', $type)
                ->whereBetween('date', [Carbon::parse($datedebut)->format('Y-m-d H:i:s'), Carbon::parse($datefin)->format('Y-m-d H:i:s')])
                ->groupBy('commandes.source_commande_id', 'source_commandes.label')
                ->get();
        }

        $sources = SourceCommande::all();

        return view('report.commandebysource.index', [
            'datedebut' => $datedebut,
            'datefin' => $datefin,
            'type' => $type,
            'commandes' => $commdes,
            'sources' => $sources
        ]);
    }


    public function commandebymode()
    {
        $datedebut = date('Y-m-d');
        $datefin = date('Y-m-d');
        $type = null;

        $commdes = DB::table('commandes')
            ->select(DB::raw('count(commandes.id) as count'), 'commandes.mode_paiement_id as id', 'mode_paiements.label as label')
            ->join('mode_paiements', 'commandes.mode_paiement_id', 'mode_paiements.id')
            ->whereBetween('date', [Carbon::parse($datedebut)->format('Y-m-d H:i:s'), Carbon::parse($datefin)->format('Y-m-d H:i:s')])
            ->groupBy('commandes.mode_paiement_id', 'mode_paiements.label')
            ->get();

        $mode = ModePaiement::all();

        return view('report.commandebymodepaiement.index', [
            'datedebut' => $datedebut,
            'datefin' => $datefin,
            'type' => $type,
            'commandes' => $commdes,
            'mode' => $mode
        ]);
    }

    public function searchcommandebymode(Request $request)
    {
        $request->validate([
            'datedebut' => 'required',
            'datefin' => 'required',
        ]);

        $datedebut = $request->datedebut;
        $datefin = $request->datefin;


        if (is_null($request->mode)) {
            $type = null;
        } else {
            $type = $request->mode;
        }


        if (is_null($request->mode)) {
            $commdes = DB::table('commandes')
                ->select(DB::raw('count(commandes.id) as count'), 'commandes.mode_paiement_id as id', 'mode_paiements.label as label')
                ->join('mode_paiements', 'commandes.mode_paiement_id', 'mode_paiements.id')
                ->whereBetween('date', [Carbon::parse($datedebut)->format('Y-m-d H:i:s'), Carbon::parse($datefin)->format('Y-m-d H:i:s')])
                ->groupBy('commandes.mode_paiement_id', 'mode_paiements.label')
                ->get();
        } else {
            $commdes = DB::table('commandes')
                ->select(DB::raw('count(commandes.id) as count'), 'commandes.mode_paiement_id as id', 'mode_paiements.label as label')
                ->join('mode_paiements', 'commandes.mode_paiement_id', 'mode_paiements.id')
                ->orWhere('commandes.mode_paiement_id', $type)
                ->whereBetween('date', [Carbon::parse($datedebut)->format('Y-m-d H:i:s'), Carbon::parse($datefin)->format('Y-m-d H:i:s')])
                ->groupBy('commandes.mode_paiement_id', 'mode_paiements.label')
                ->get();
        }

        $mode = ModePaiement::all();

        return view('report.commandebymodepaiement.index', [
            'datedebut' => $datedebut,
            'datefin' => $datefin,
            'type' => $type,
            'commandes' => $commdes,
            'mode' => $mode
        ]);
    }

    public function commandebypack()
    {
        $datedebut = date('Y-m-d');
        $datefin = date('Y-m-d');
        $type = null;

        $commdes = DB::table('commandes')
            ->select(DB::raw('count(commandes.id) as count'), 'commandes.pack_id as id', 'packs.label as label')
            ->join('packs', 'commandes.pack_id', 'packs.id')
            ->whereBetween('date', [Carbon::parse($datedebut)->format('Y-m-d H:i:s'), Carbon::parse($datefin)->format('Y-m-d H:i:s')])
            ->groupBy('commandes.pack_id', 'packs.label')
            ->get();

        $pack = Pack::all();

        return view('report.commandebypack.index', [
            'datedebut' => $datedebut,
            'datefin' => $datefin,
            'type' => $type,
            'commandes' => $commdes,
            'pack' => $pack
        ]);
    }

    public function searchcommandebypack(Request $request)
    {
        $request->validate([
            'datedebut' => 'required',
            'datefin' => 'required',
        ]);

        $datedebut = $request->datedebut;
        $datefin = $request->datefin;


        if (is_null($request->pack)) {
            $type = null;
        } else {
            $type = $request->pack;
        }


        if (is_null($request->pack)) {
            $commdes = DB::table('commandes')
                ->select(DB::raw('count(commandes.id) as count'), 'commandes.pack_id as id', 'packs.label as label')
                ->join('packs', 'commandes.pack_id', 'packs.id')
                ->whereBetween('date', [Carbon::parse($datedebut)->format('Y-m-d H:i:s'), Carbon::parse($datefin)->format('Y-m-d H:i:s')])
                ->groupBy('commandes.pack_id', 'packs.label')
                ->get();
        } else {
            $commdes = DB::table('commandes')
                ->select(DB::raw('count(commandes.id) as count'), 'commandes.pack_id as id', 'packs.label as label')
                ->join('packs', 'commandes.pack_id', 'packs.id')
                ->orWhere('commandes.pack_id', $type)
                ->whereBetween('date', [Carbon::parse($datedebut)->format('Y-m-d H:i:s'), Carbon::parse($datefin)->format('Y-m-d H:i:s')])
                ->groupBy('commandes.pack_id', 'packs.label')
                ->get();
        }

        $pack = Pack::all();

        return view('report.commandebypack.index', [
            'datedebut' => $datedebut,
            'datefin' => $datefin,
            'type' => $type,
            'commandes' => $commdes,
            'pack' => $pack
        ]);
    }

    public function commandebylivreur()
    {
        $datedebut = date('Y-m-d');
        $datefin = date('Y-m-d');
        $type = null;

        $commdes = DB::table('commandes')
            ->select(DB::raw('count(commandes.id) as count'), 'commandes.livreur_id as id', 'users.nom as nom', 'users.prenom as prenom')
            ->join('users', 'commandes.livreur_id', 'users.id')
            ->whereBetween('date', [Carbon::parse($datedebut)->format('Y-m-d H:i:s'), Carbon::parse($datefin)->format('Y-m-d H:i:s')])
            ->groupBy('commandes.livreur_id', 'users.nom', 'users.prenom')
            ->get();

        $livreurs = User::where('islivreur', true)->get();

        return view('report.commandebylivreur.index', [
            'datedebut' => $datedebut,
            'datefin' => $datefin,
            'type' => $type,
            'commandes' => $commdes,
            'livreurs' => $livreurs
        ]);
    }

    public function searchcommandebylivreur(Request $request)
    {
        $request->validate([
            'datedebut' => 'required',
            'datefin' => 'required',
        ]);

        $datedebut = $request->datedebut;
        $datefin = $request->datefin;


        if (is_null($request->livreur)) {
            $type = null;
        } else {
            $type = $request->livreur;
        }


        if (is_null($request->livreur)) {
            $commdes = DB::table('commandes')
                ->select(DB::raw('count(commandes.id) as count'), 'commandes.livreur_id as id', 'users.nom as nom', 'users.prenom as prenom')
                ->join('users', 'commandes.livreur_id', 'users.id')
                ->whereBetween('date', [Carbon::parse($datedebut)->format('Y-m-d H:i:s'), Carbon::parse($datefin)->format('Y-m-d H:i:s')])
                ->groupBy('commandes.livreur_id', 'users.nom', 'users.prenom')
                ->get();
        } else {
            $commdes = DB::table('commandes')
                ->select(DB::raw('count(commandes.id) as count'), 'commandes.livreur_id as id', 'users.nom as nom', 'users.prenom as prenom')
                ->join('users', 'commandes.livreur_id', 'users.id')
                ->orWhere('commandes.livreur_id', $type)
                ->whereBetween('date', [Carbon::parse($datedebut)->format('Y-m-d H:i:s'), Carbon::parse($datefin)->format('Y-m-d H:i:s')])
                ->groupBy('commandes.livreur_id', 'users.nom', 'users.prenom')
                ->get();
        }

        $livreurs = User::where('islivreur', true)->get();

        return view('report.commandebylivreur.index', [
            'datedebut' => $datedebut,
            'datefin' => $datefin,
            'type' => $type,
            'commandes' => $commdes,
            'livreurs' => $livreurs
        ]);
    }

    public function commandebycustomer()
    {
        $datedebut = date('Y-m-d');
        $datefin = date('Y-m-d');
        $type = null;

        $commdes = DB::table('commandes')
            ->select(DB::raw('count(commandes.id) as count'), 'commandes.client_id as id', 'clients.nom as nom', 'clients.prenom as prenom')
            ->join('clients', 'commandes.client_id', 'clients.id')
            ->whereBetween('date', [Carbon::parse($datedebut)->format('Y-m-d H:i:s'), Carbon::parse($datefin)->format('Y-m-d H:i:s')])
            ->groupBy('commandes.client_id', 'clients.nom', 'clients.prenom')
            ->get();

        $clients = Client::all();

        return view('report.commandebycustomer.index', [
            'datedebut' => $datedebut,
            'datefin' => $datefin,
            'type' => $type,
            'commandes' => $commdes,
            'clients' => $clients
        ]);
    }

    public function searchcommandebycustomer(Request $request)
    {
        $request->validate([
            'datedebut' => 'required',
            'datefin' => 'required',
        ]);

        $datedebut = $request->datedebut;
        $datefin = $request->datefin;


        if (is_null($request->client)) {
            $type = null;
        } else {
            $type = $request->client;
        }


        if (is_null($request->client)) {
            $commdes = DB::table('commandes')
                ->select(DB::raw('count(commandes.id) as count'), 'commandes.client_id as id', 'clients.nom as nom', 'clients.prenom as prenom')
                ->join('clients', 'commandes.client_id', 'clients.id')
                ->whereBetween('date', [Carbon::parse($datedebut)->format('Y-m-d H:i:s'), Carbon::parse($datefin)->format('Y-m-d H:i:s')])
                ->groupBy('commandes.client_id', 'clients.nom', 'clients.prenom')
                ->get();
        } else {
            $commdes = DB::table('commandes')
                ->select(DB::raw('count(commandes.id) as count'), 'commandes.client_id as id', 'clients.nom as nom', 'clients.prenom as prenom')
                ->join('clients', 'commandes.client_id', 'clients.id')
                ->orWhere('commandes.client_id', $type)
                ->whereBetween('date', [Carbon::parse($datedebut)->format('Y-m-d H:i:s'), Carbon::parse($datefin)->format('Y-m-d H:i:s')])
                ->groupBy('commandes.client_id', 'clients.nom', 'clients.prenom')
                ->get();
        }

        $clients = Client::all();

        return view('report.commandebycustomer.index', [
            'datedebut' => $datedebut,
            'datefin' => $datefin,
            'type' => $type,
            'commandes' => $commdes,
            'clients' => $clients
        ]);
    }

    public function topscustomer()
    {
        $datedebut = date('Y-m-d');
        $datefin = date('Y-m-d');
        $type = null;

        $commdes = DB::table('commandes')
            ->select(DB::raw('count(commandes.id) as count'), 'commandes.client_id as id', 'clients.nom as nom', 'clients.prenom as prenom')
            ->join('clients', 'commandes.client_id', 'clients.id')
            ->whereBetween('date', [Carbon::parse($datedebut)->format('Y-m-d H:i:s'), Carbon::parse($datefin)->format('Y-m-d H:i:s')])
            ->orderBy('count', 'DESC')
            ->limit($type)
            ->groupBy('commandes.client_id', 'clients.nom', 'clients.prenom')
            ->get();

        return view('report.topscustomers.index', [
            'datedebut' => $datedebut,
            'datefin' => $datefin,
            'type' => $type,
            'commandes' => $commdes,
        ]);
    }

    public function searchtopscustomer(Request $request)
    {
        $request->validate([
            'datedebut' => 'required',
            'datefin' => 'required',
        ]);

        $datedebut = $request->datedebut;
        $datefin = $request->datefin;


        if (is_null($request->limit)) {
            $type = null;
        } else {
            $type = $request->limit;
        }


        $commdes = DB::table('commandes')
            ->select(DB::raw('count(commandes.id) as count'), 'commandes.client_id as id', 'clients.nom as nom', 'clients.prenom as prenom')
            ->join('clients', 'commandes.client_id', 'clients.id')
            ->whereBetween('date', [Carbon::parse($datedebut)->format('Y-m-d H:i:s'), Carbon::parse($datefin)->format('Y-m-d H:i:s')])
            ->orderBy('count', 'DESC')
            ->limit($type)
            ->groupBy('commandes.client_id', 'clients.nom', 'clients.prenom')
            ->get();


        return view('report.topscustomers.index', [
            'datedebut' => $datedebut,
            'datefin' => $datefin,
            'type' => $type,
            'commandes' => $commdes,
        ]);
    }

    public function commandebyperiod()
    {
        $datedebut = date('Y-m-d');
        $datefin = date('Y-m-d');

        $commdes = Commandes::whereBetween('date', [Carbon::parse($datedebut)->format('Y-m-d H:i:s'), Carbon::parse($datefin)->format('Y-m-d H:i:s')])
            ->get();

        return view('report.commandebyperiod.index', [
            'datedebut' => $datedebut,
            'datefin' => $datefin,
            'commandes' => $commdes,
        ]);
    }

    public function searchcommandebyperiod(Request $request)
    {
        $request->validate([
            'datedebut' => 'required',
            'datefin' => 'required',
        ]);

        $datedebut = $request->datedebut;
        $datefin = $request->datefin;
        $com = $request->commande;
        $liv = $request->livrer;

        if ($com == "true") {
            $com = true;
        } else {
            $com = false;
        }

        if ($liv == "true") {
            $liv = true;
        } else {
            $liv = false;
        }


        if (is_null($request->commande) && is_null($request->livrer)) {

            $commdes = Commandes::whereBetween('date', [Carbon::parse($datedebut)->format('Y-m-d H:i:s'), Carbon::parse($datefin)->format('Y-m-d H:i:s')])
                ->get();
        }

        if (!is_null($request->commande) && is_null($request->livrer)) {

            $commdes = Commandes::whereBetween('date', [Carbon::parse($datedebut)->format('Y-m-d H:i:s'), Carbon::parse($datefin)->format('Y-m-d H:i:s')])
                ->where('statut_commande', $com)
                ->get();
        }

        if (is_null($request->commande) && !is_null($request->livrer)) {

            $commdes = Commandes::whereBetween('date', [Carbon::parse($datedebut)->format('Y-m-d H:i:s'), Carbon::parse($datefin)->format('Y-m-d H:i:s')])
                ->where('statut_livraison', $liv)
                ->get();
        }

        if (!is_null($request->commande) && !is_null($request->livrer)) {

            $commdes = Commandes::whereBetween('date', [Carbon::parse($datedebut)->format('Y-m-d H:i:s'), Carbon::parse($datefin)->format('Y-m-d H:i:s')])
                ->where('statut_commande', $com)
                ->where('statut_livraison', $liv)
                ->get();
        }

        return view('report.commandebyperiod.index', [
            'datedebut' => $datedebut,
            'datefin' => $datefin,
            'commandes' => $commdes,
        ]);
    }

    public function chiffreaffairebyperiod()
    {
        $datedebut = date('Y-m-d');
        $datefin = date('Y-m-d');
        $type = null;

        $commdes = DB::table('commandes')
            ->select(DB::raw('sum(commandes.total) as sum'))
            ->whereBetween('date', [Carbon::parse($datedebut)->format('Y-m-d H:i:s'), Carbon::parse($datefin)->format('Y-m-d H:i:s')])
            ->get();

        // $commdes = DB::table('commandes')
        // ->select(DB::raw('sum(packs.price) as sum'))
        // ->join('packs', 'commandes.pack_id', 'packs.id')
        // ->whereBetween('date', [Carbon::parse($datedebut)->format('Y-m-d H:i:s'), Carbon::parse($datefin)->format('Y-m-d H:i:s')])
        // ->groupBy('commandes.pack_id', 'packs.label')
        // ->get();

        $pack = Pack::all();

        return view('report.chiffreaffairebyperiod.index', [
            'datedebut' => $datedebut,
            'datefin' => $datefin,
            'type' => $type,
            'commandes' => $commdes,
            'pack' => $pack
        ]);
    }

    public function searchchiffreaffairebyperiod(Request $request)
    {
        $request->validate([
            'datedebut' => 'required',
            'datefin' => 'required',
        ]);

        $datedebut = $request->datedebut;
        $datefin = $request->datefin;


        if (is_null($request->pack)) {
            $type = null;
        } else {
            $type = $request->pack;
        }


        if (is_null($request->pack)) {

            $commdes = DB::table('commandes')
                ->select(DB::raw('sum(commandes.total) as sum'))
                ->whereBetween('date', [Carbon::parse($datedebut)->format('Y-m-d H:i:s'), Carbon::parse($datefin)->format('Y-m-d H:i:s')])
                ->get();
        } else {
            $commdes = DB::table('commandes')
                ->select(DB::raw('sum(commandes.total) as sum'))
                ->join('packs', 'commandes.pack_id', 'packs.id')
                ->orWhere('commandes.pack_id', $type)
                ->whereBetween('date', [Carbon::parse($datedebut)->format('Y-m-d H:i:s'), Carbon::parse($datefin)->format('Y-m-d H:i:s')])
                ->get();
        }

        $pack = Pack::all();

        return view('report.chiffreaffairebyperiod.index', [
            'datedebut' => $datedebut,
            'datefin' => $datefin,
            'type' => $type,
            'commandes' => $commdes,
            'pack' => $pack
        ]);
    }


    public function chiffreaffairebymodepaiement ()
    {
        $datedebut = date('Y-m-d');
        $datefin = date('Y-m-d');
        $type = null;

        $commdes = DB::table('commandes')
            ->select(DB::raw('sum(commandes.total) as sum'))
            ->whereBetween('date', [Carbon::parse($datedebut)->format('Y-m-d H:i:s'), Carbon::parse($datefin)->format('Y-m-d H:i:s')])
            ->get();

        // $commdes = DB::table('commandes')
        // ->select(DB::raw('sum(packs.price) as sum'))
        // ->join('packs', 'commandes.pack_id', 'packs.id')
        // ->whereBetween('date', [Carbon::parse($datedebut)->format('Y-m-d H:i:s'), Carbon::parse($datefin)->format('Y-m-d H:i:s')])
        // ->groupBy('commandes.pack_id', 'packs.label')
        // ->get();

        $mode = ModePaiement::all();

        return view('report.chiffreaffairebymodepaiement.index', [
            'datedebut' => $datedebut,
            'datefin' => $datefin,
            'type' => $type,
            'commandes' => $commdes,
            'mode' => $mode
        ]);
    }

    public function searchchiffreaffairebymodepaiement(Request $request)
    {
        $request->validate([
            'datedebut' => 'required',
            'datefin' => 'required',
        ]);

        $datedebut = $request->datedebut;
        $datefin = $request->datefin;


        if (is_null($request->mode)) {
            $type = null;
        } else {
            $type = $request->mode;
        }


        if (is_null($request->mode)) {

            $commdes = DB::table('commandes')
                ->select(DB::raw('sum(commandes.total) as sum'))
                ->whereBetween('date', [Carbon::parse($datedebut)->format('Y-m-d H:i:s'), Carbon::parse($datefin)->format('Y-m-d H:i:s')])
                ->get();
        } else {
            $commdes = DB::table('commandes')
                ->select(DB::raw('sum(commandes.total) as sum'))
                ->join('mode_paiements', 'commandes.mode_paiement_id', 'mode_paiements.id')
                ->orWhere('commandes.mode_paiement_id', $type)
                ->whereBetween('date', [Carbon::parse($datedebut)->format('Y-m-d H:i:s'), Carbon::parse($datefin)->format('Y-m-d H:i:s')])
                ->get();
        }

        $mode = ModePaiement::all();

        return view('report.chiffreaffairebymodepaiement.index', [
            'datedebut' => $datedebut,
            'datefin' => $datefin,
            'type' => $type,
            'commandes' => $commdes,
            'mode' => $mode
        ]);
    }
}
