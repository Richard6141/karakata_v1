@extends('layouts.app')

@section('content')
<div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Liste des clients</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/">Acceuil</a>
                        </li>
                        <li class="breadcrumb-item active"><a href="#">Clients</a>
                        </li>
                    </ol>
                </div>

                {{-- <a class="col s2 m6 l6"><a class="btn-floating  waves-effect waves-light breadcrumbs-btn right mr-1 mb-1 modal-trigger btn-large" href="{{ route('customer.add', $id=0) }}" id="addclientmodal"><i class="material-icons tooltipped" data-position="top" data-tooltip="Ajouter">add</i>
                    </a> --}}
                    <a href="{{backUrl()}}" class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 right">RETOUR</a>

            </div>
            <div class="row" style="margin-top: 15px;">

                <div id="test1" class="col s12">
                    <div class="container">

                        <div class="section">
                            <div class="card">
                                <a href="{{ route('customer.add') }}" class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 ml-2">Particulier</a>
                                <a href="{{ route('company.add') }}" class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 ml-2">Entreprise</a>
                                <div class="card-content">
                                    <div class="responsive-table">
                                        <table id="data-table-simple" class="display" style="width: 100%;">
                                            <div>
                                                <thead>
                                                    <tr style="color:black">
                                                        <th style="text-align: left">Nom</th>
                                                        <th>Prénom</th>
                                                        <th>Raison sociale</th>
                                                        <th style="text-align: center">Type</th>
                                                        <th>Username</th>

                                                        <th>Téléphone</th>

                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($customers as $Client)
                                                    <tr>
                                                        <td >
                                                        <a style="color:black" href="{{route('client.show',$Client->id )}}">
                                                        @if (!is_null($Client->particulars_id))
                                                            <span>{{ $Client->particular->name ?? 'N/A'}}</span>
                                                            @endif
                                                            @if (!is_null($Client->companies_id))
                                                            <span>{{ $Client->company->name ?? 'N/A' }}</span> 
                                                            @endif
                                                        </a>
                                                            
                                                        </td>
                                                        <td>
                                                        <a style="color:black" href="{{route('client.show',$Client->id )}}">
                                                            @if (!is_null($Client->particulars_id))
                                                            <span>{{ $Client->particular->firstname ?? 'N/A' }}</span> 
                                                            @endif
                                                            @if (!is_null($Client->companies_id))
                                                            <span>{{ $Client->company->firstname ?? 'N/A' }}</span> 
                                                            @endif
                                                        </a> 
                                                        </td>
                                                        <td> <span>{{ $Client->company->socialreason ?? 'N/A' }}</span></td>
                                                        <td style="text-align: center">
                                                            @if (!is_null($Client->particulars_id))
                                                            <span class="new badge blue "data-badge-caption="">Particuler</span>
                                                            @endif

                                                            @if (!is_null($Client->companies_id))
                                                            <span class="new badge info "data-badge-caption="">Entreprise</span>
                                                            @endif
                                                        </td>

                                                        <td> <span>{{ $Client->username }}</span></td>

                                                        <td><span>{{ $Client->phone}}</span></td>

                                                        <td>
                                                            <div class="invoice-action">
                                                                <a href="javascript:;" id="resetPassword" data-url="{{route('client.reset', $Client->id)}}" class="invoice-action-view mr-4 tooltipped" data-position="top" data-tooltip="générer">
                                                                    <i class="material-icons" style="color: blue;">lock_outline</i>
                                                                </a>
                                                                @if (!is_null($Client->particulars_id))
                                                                <a id="editBtn" href="{{ route('particular.show' , $Client->id)}}" class="invoice-action-edit modal-trigger tooltipped" data-position="top" data-tooltip="Modifier" data-id="{{ $Client->id }}" data-nom="{{ $Client->nom }}" data-prenom="{{ $Client->prenom }}" data-username="{{ $Client->username }}" data-phone="{{ $Client->phone }}" data-email="{{ $Client->email }}" data-url="{{ route('client.updateclient', $Client->id) }}">
                                                                    <i class="material-icons" style="color:green ;">edit</i>
                                                                </a>
                                                                @endif
                                                                @if (!is_null($Client->companies_id))
                                                                <a id="editBtn" href="{{ route('company.show' , $Client->id)}}" class="invoice-action-edit modal-trigger tooltipped" data-position="top" data-tooltip="Modifier" data-id="{{ $Client->id }}" data-nom="{{ $Client->nom }}" data-prenom="{{ $Client->prenom }}" data-username="{{ $Client->username }}" data-phone="{{ $Client->phone }}" data-email="{{ $Client->email }}" data-url="{{ route('client.updateclient', $Client->id) }}">
                                                                    <i class="material-icons" style="color:green ;">edit</i>
                                                                </a>
                                                                @endif

                                                                <a id="supBtn" href="#modal10" class="invoice-action-edit modal-trigger tooltipped" data-position="top" data-tooltip="Supprimer" data-id="{{ $Client->id }}" data-url="{{ route('client.sup', $Client->id) }}">
                                                                    <i class="material-icons" style="color:red ">delete</i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                        @endforeach
                                                    </tr>
                                                </tbody>
                                            </div>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="content-overlay"></div>
                <div class="" style="display: none;">
                    <form action="" method="POST" id="resetForm">
                        @csrf
                        <button form="resetForm" id="resetbtn"></button>
                    </form>
                </div>

            </div>
        </div>
    </div>

</div>
@include('clients.delete')
@endsection
@section('scripts')
@include('clients.js')
@endsection
