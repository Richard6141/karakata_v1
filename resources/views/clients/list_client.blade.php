@extends('layouts.app')

@section('content')
<div id="">
  <div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="col s12">
      <div class="container">
      <a href="{{backUrl()}}" class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 right">RETOUR</a>

        <div style="bottom: 20px; right: 100px;" class="fixed-action-btn direction-top">
          <a class="btn-floating btn-large primary-text gradient-shadow modal-trigger">
            <i class="material-icons">person_add</i>
          </a>
          <ul>
            <li><a class="btn-floating green modal-trigger" href="#particuliermodal"><i class="material-icons tooltipped" data-position="left" data-tooltip="Particuler">account_circle</i></a></li>
            <li><a class="btn-floating green modal-trigger" href="#entreprisemodal"><i class="material-icons tooltipped" data-position="left" data-tooltip="Entreprise">home</i></a></li>
          </ul>
        </div>

        <!-- Sidebar Area Starts -->
        <div class="sidebar-left sidebar-fixed">
          <div class="sidebar">
            <div class="sidebar-content">
              <div class="sidebar-header">
                <div class="sidebar-details">
                  <h5 class="m-0 sidebar-title"><i class="material-icons app-header-icon text-top">perm_identity</i> CLIENTS
                  </h5>
                  <div class="mt-1 pt-2">
                    <h5 style="color:white">
                    {{count($customers)}} Client(s) au total
                    </h5><p class="m-0 text-muted">{{$nbrcompany}} personne(s) morale(s) et {{$nbrparticulier}} personne(s) physique(s)</p>
                  </div>
                </div>
              </div>

              <!-- <div id="sidebar-list" class="sidebar-menu list-group position-relative animate fadeLeft delay-1" style="width: 18%">
                <div class="sidebar-list-padding app-sidebar sidenav" id="contact-sidenav">
                  <ul class="contact-list display-grid">
                    <li class="sidebar-title">Filtrer</li>
                    <li class="active"><a href="javascript:void(0)" class="text-sub"><i class="material-icons mr-2">
                          perm_identity </i> Tous les clients</a></li>
                  </ul>
                </div>
              </div> -->
              <a href="#" data-target="contact-sidenav" class="sidenav-trigger hide-on-large-only"><i class="material-icons">menu</i></a>
            </div>
          </div>
        </div>
        <!-- Sidebar Area Ends -->

        <!-- Content Area Starts -->
        <div class="content-area content-right" style="width:100%">
          <div class="app-wrapper">
            <div class="datatable-search">
              <i class="material-icons mr-2 search-icon">search</i>
              <input type="text" placeholder="Rechercher un client" class="app-filter" id="global_filter">
            </div>
            <div id="button-trigger" class="card card card-default scrollspy border-radius-6 fixed-width">
              <div class="card-content p-0">
                <table id="data-table-contact" class="display" style="width:100%">
                  <thead>
                    <tr>
                      <th class="background-image-none ">
                        <label>
                          <input type="checkbox" onClick="toggle(this)" />
                          <span></span>
                        </label>
                      </th>
                      <th>Nom complet</th>
                      <th>Nom d'utilisateur</th>
                      <th>Telephone</th>
                      <th>Email</th>
                      <th>Type</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($customers as $Client)

                    <tr>
                      <td class=" contact-checkbox">
                        <label class="checkbox-label">
                          <input type="checkbox" name="foo" />
                          <span></span>
                        </label>
                      </td>
                      <td>
                        <a href="{{route('client.show',$Client->id )}}">
                          @if (!is_null($Client->particulars_id))
                          <span>{{ $Client->particular->name ?? 'N/A'}} {{ $Client->particular->firstname ?? 'N/A' }}</span>
                          @endif
                          @if (!is_null($Client->companies_id))
                          <span>{{ $Client->company->name ?? 'N/A' }} {{ $Client->company->firstname ?? 'N/A' }}</span>
                          @endif
                        </a>
                      </td>
                      <td>{{ $Client->username }}</td>
                      <td>{{ $Client->phone }}</td>
                      <td>{{ $Client->email }}</td>
                      <td><span class="favorite">
                          @if (!is_null($Client->particulars_id))
                          <span class="new badge blue " data-badge-caption="">Particuler</span>
                          @endif

                          @if (!is_null($Client->companies_id))
                          <span class="new badge info " data-badge-caption="">Entreprise</span>
                          @endif
                        </span>
                        </span></td>
                      <td>
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
                        <a
                            id="" href="{{ route('customer.search' , $Client->id)}}"
                            class="invoice-action-edit modal-trigger tooltipped"
                            data-position="top"
                            data-tooltip="Cliquez pour passer une commande">

                            <i class="material-icons"
                                style="color:rgb(7, 109, 109) ;">local_grocery_store
                            </i>
                        </a>

                        <a id="supBtn" href="#modal10" class="invoice-action-edit modal-trigger tooltipped" data-position="top" data-tooltip="Supprimer" data-id="{{ $Client->id }}" data-url="{{ route('client.sup', $Client->id) }}">
                          <i class="material-icons" style="color:red">delete</i>
                        </a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="content-overlay"></div>
    </div>
  </div>
</div>
@include('clients.delete')
@include('clients.entreprise')
@include('clients.particular')
@endsection
@section('scripts')
@include('clients.js')
@endsection
