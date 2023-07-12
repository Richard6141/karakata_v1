@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
            <!-- Search for small screen-->
            <div class="container">
                <div class="row">
                    <div class="col s10 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Ajout d'une commande</span></h5>
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="/">Acceuil</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('commande.index') }}">Commandes</a>
                            </li>
                            <li class="breadcrumb-item active">Ajout
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12">
            <div class="container">

                <div class="section">
                    <div class="card">
                        <div class="col s12 m12 l12">
                            <div id="Form-advance" class="card card card-default scrollspy">
                                <div class="card-content">
                                    <form class="login-form" method="POST" action="{{ route('commande.update', $commande->id) }}"
                                        id="formcommande">
                                        @csrf
                                        @include('commandes.update.client')


                                        @if (is_null($commande->receptionnaire_id))

                                        @else
                                        <div class="input-field col m12 s12">
                                            <div class="switch">
                                                <br>
                                            </div>
                                            <div class="switch">
                                                <label style="font-weight: bold;">
                                                    <input type="checkbox" id="checkboxclient" name="checkboxclient"
                                                        value="1" checked>
                                                    <span class="lever"></span>
                                                    Voulez-vous envoyer le pack a un bénéficiaire ?
                                                </label>
                                            </div>

                                        </div>
                                        @endif

                                        @if (is_null($commande->receiver_id))
                                            @include('commandes.update.adresselivraisonclient')
                                        @else
                                            @include('commandes.update.receptionnaire')
                                        @endif
                                        @include('commandes.update.autres')


                                        <div class="row">
                                            <div class="input-field col s12">
                                                <button id="modalBtnCommande" type="button"
                                                    class="btn bcyan waves-effect waves-light right"
                                                    type="submit">Modifier
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
