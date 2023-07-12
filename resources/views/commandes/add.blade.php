@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
            <!-- Search for small screen-->
            <div class="container">
                <div class="row">
                    <div class="col s10 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Enregistrement d'une commande</span></h5>
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="/">Acceuil</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('commande.index') }}">Commandes</a>
                            </li>
                            <li class="breadcrumb-item active">Enregistrement
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
                                <div class="col s12 m6 l3">

                                </div>
                                <div class="col s12 m6 l2">

                                </div>
                                <div class="col m2 l0">

                                </div>
                                <form action="{{ route('commande.seach') }}" method="POST">
                                    @csrf
                                    <div class="col s12 m6 l3">
                                        <label style="color: black" for="users-list-status">Rechercher
                                            un client</label>
                                        <div class="input-field">
                                            <input type="text" name="phone" id="phone" value=""
                                                placeholder="Numéro ou Adresse mail">
                                                @error('phone')
                                <small class="red-text ml-7" role="alert">
                                    {{ $message }}
                                </small>
                            @enderror
                                        </div>
                                    </div>
                                    <div class="display-flex">
                                        <div class="display-flex align-items-center show-btn">
                                            <button type="submit" id="seachbtn"
                                                class="btn btn-block indigo waves-effect waves-light" style="width:30%">
                                                <i class="material-icons tooltipped " data-position="top"
                                                    data-tooltip="Rechercher">search</i>
                                            </button>
                                        </div>
                                        <div class="display-flex align-items-center show-btn">
                                            <a id="seachbtn" href="{{ backUrl() }}"
                                                class="btn btn-block waves-effect waves-light breadcrumbs-btn"
                                                style="width:30%">
                                                <i class="material-icons tooltipped" data-position="top"
                                                    data-tooltip="Retour"> arrow_forward</i>
                                            </a>
                                        </div>
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
                                    <form class="login-form" method="POST" action="{{ route('commande.store') }}"
                                        id="formcommande">
                                        @csrf
                                        <div style="flex-direction:row; text-align:end; margin-bottom:30px"><a href="#modalcomposant" id="NewCustomerBtn" class=" modal-trigger">
                                                <div class="waves-effect waves-light btn" style="color: white">Nouveau
                                                    client</div>
                                            </a></div>

                                        <div>
                                            @include('commandes.add.client')
                                        </div>


                                        <div class="input-field col m12 s12">
                                            <div class="switch">
                                                <br>
                                            </div>
                                            <div class="switch">
                                                <label style="font-weight: bold;">
                                                    <input type="checkbox" id="checkboxclient" name="checkboxclient"
                                                        value="true">
                                                    <span class="lever"></span>
                                                    Voulez-vous envoyer le pack a un bénéficiaire ?
                                                </label>
                                            </div>

                                        </div>
                                        @include('commandes.add.adresselivraisonclient')
                                        @include('commandes.add.receptionnaire')
                                        @include('commandes.add.autres')
                                        @include('commandes.add.tickets')
                                        @include('commandes.customer.add')


                                        <div class="row">
                                            <div class="input-field col s12">
                                                <button id="modalBtnCommande" type="button"
                                                    class="btn bcyan waves-effect waves-light right"
                                                    type="submit">Enregistrer
                                                    <i class="material-icons right">send</i>
                                                </button>
                                                <button id="saveBtnCommande" type="submit" form="formcommande"
                                                    style="display: none"></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <div class="" style="display: none">
            <a id="btnCarnetAdresse"
                class="btn-floating  waves-effect waves-light breadcrumbs-btn right mr-1 mb-1 modal-trigger btn-large"
                href="#modalCarnet"><i class="material-icons tooltipped" data-position="top"
                    data-tooltip="Ajouter">add</i></a>
        </div>
        @include('commandes.addCarnet')
    </div>
@endsection
@section('scripts')
    @include('commandes.js')
@endsection
