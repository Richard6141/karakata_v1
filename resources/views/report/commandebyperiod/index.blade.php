@extends('layouts.app')

@section('content')
<div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Liste des commandes par période</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/">Acceuil</a>
                        </li>
                        <li class="breadcrumb-item active">Liste
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="col s12">
        <div class="container">
            <section class="users-list-wrapper section">
                <div class="users-list-filter">
                    <div class="card-panel">
                        <div class="row">

                            <form action="{{ route('searchcommandebyperiod') }}" method="POST">
                                @csrf
                                <div class="col s12 m6 l2">
                                    <label style="color: black" for="users-list-status">Date début</label>
                                    <div class="input-field">
                                        <input type="date" name="datedebut" id="datedebut" placeholder="" value="{{ $datedebut }}">
                                    </div>
                                </div>
                                <div class="col s12 m6 l2">
                                    <label style="color: black" for="users-list-status">Date fin</label>
                                    <div class="input-field">
                                        <input type="date" name="datefin" id="datefin" placeholder="" value="{{ $datefin }}">
                                    </div>
                                </div>
                                <div class="col s12 m6 l2">
                                    <label style="color: black" for="users-list-status">Commande</label>
                                    <div class="input-field">
                                        <select class="browser-default" name="commande" id="commande">
                                            <option value=""></option>
                                            <option value="true">Validée</option>
                                            <option value="false">En cours</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col s12 m6 l2">
                                    <label style="color: black" for="users-list-status">Livraison</label>
                                    <div class="input-field">
                                        <select class="browser-default" name="livrer" id="livrer">
                                            <option value=""></option>
                                            <option value="true">Livrée</option>
                                            <option value="false">En cours</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col s12 m6 l3 display-flex align-items-center show-btn">
                                    <button type="submit" id="seachbtn" class="btn btn-block indigo waves-effect waves-light">
                                        <i class="material-icons">search</i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </section>
            <div class="section">
                <div class="card">
                    <div class="col s12 m12 l12">
                        <div id="Form-advance" class="card card card-default scrollspy">
                            <div class="card-content">
                                <section class="users-list-wrapper section">
                                    <div class="users-list-table">
                                        <div class="card">
                                            <div class="card-content">
                                                <!-- datatable start -->
                                                <div class="responsive-table">
                                                    <table id="data-table-simple" class="display">
                                                        <thead>
                                                            <tr style="color:black">
                                                                <th style="text-align: left;">Nom du client</th>
                                                                <th style="text-align: left;">Bénéficiaire</th>
                                                                <th>Pack</th>
                                                                <th style="text-align: center">Commande</th>
                                                                <th style="text-align: center">Livraison</th>
                                                                <th style="text-align: center">Qte</th>
                                                                <th style="text-align: right">Total</th>
                                                                <th style="text-align: right">Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($commandes as $item)
                                                            <tr>
                                                                <td style="text-align: left"><span>{{ $item->client->nom }} {{ $item->client->prenom }}</span></td>
                                                                <td style="text-align: left"><span>{{ $item->receptionnaire->nom ?? 'N/A' }} {{ $item->receptionnaire->prenom ?? '' }}</span></td>
                                                                <td> <span>{{ $item->pack->label ?? '' }}</span></td>
                                                                <td style="text-align: center">
                                                                    @if ($item->statut_commande == true)
                                                                    <span class="new badge gradient-45deg-light-blue-cyan" data-badge-caption="" style="font-weight: bold">Validée</span>
                                                                    @else
                                                                    <span class="new badge" data-badge-caption="" style="font-weight: bold">En cours</span>
                                                                    @endif
                                                                </td>
                                                                <td style="text-align: center">
                                                                    @if ($item->statut_livraison == true)
                                                                    <span class="new badge gradient-45deg-light-blue-cyan" data-badge-caption="" style="font-weight: bold">Livrée</span>
                                                                    @else
                                                                    <span class="new badge" data-badge-caption="" style="font-weight: bold">En cours</span>
                                                                    @endif
                                                                </td>
                                                                <td style="text-align: center"><span>{{ $item->nbr }}</span></td>
                                                                <td style="text-align: right"><span>{{ $item->total }}</span></td>
                                                                <td style="text-align: right">
                                                                    <div class="invoice-action">
                                                                        <a id="editBtn" href="" class="invoice-action-edit modal-trigger" data-id="{{ $item->id }}" data-Nom_client="{{ $item->Nom_client }}" data-pack="{{ $item->pack->label ?? '' }}" data-date_livraison="{{ $item->date_livraison }}" data-description="{{ $item->description }}" data-nombre="{{ $item->nombre }}" data-total="{{ $item->total }}" data-source_commande="{{ $item->source_commande }}" data-url="{{ route('commande.updatecommande', $item->id) }}">
                                                                            <i class="material-icons" style="color:green ;">edit</i>
                                                                        </a>
                                                                        <a href="{{ route('generate.pdf', ['id' => $item->id]) }}" target="_blank"><i class="material-icons">print</i></a>

                                                                        <a id="supBtn" href="#modal4" class="invoice-action-edit modal-trigger" data-id="{{ $item->id }}" data-url="{{ route('commande.sup', $item->id) }}">
                                                                            <i class="material-icons" style="color:red ">delete</i>
                                                                        </a>
                                                                        <!-- <a href="{{ route('generate.pdf', ['id' => $item->id]) }}" class="invoice-action-edit modal-trigger">
                                                                            <i class="material-icons" style="color:red ">print</i>
                                                                        </a> -->
                                                                    </div>
                                                                </td>
                                                                @endforeach
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- datatable ends -->
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="content-overlay"></div>
    </div>
    <!-- <div class="" style="display: none">
        <a id="btnCarnetAdresse" class="btn-floating  waves-effect waves-light breadcrumbs-btn right mr-1 mb-1 modal-trigger btn-large" href="#modalCarnet"><i class="material-icons tooltipped" data-position="top" data-tooltip="Ajouter">add</i>
    </div> -->
</div>
@endsection
@section('scripts')
@endsection
