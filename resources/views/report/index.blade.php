@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
            <!-- Search for small screen-->
            <div class="container">
                <div class="row">
                    <div class="col s10 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Liste des requêtes</span></h5>
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
                <div class="section">
                    <div class="card">
                        <div class="col s12 m12 l12">
                            <ul class="collapsible categories-collapsible">
                                <li class="active">
                                    <a href="{{ route('commandebysource') }}" style="text-decoration: none; color: rgb(90, 86, 86)" class="">
                                        <div class="collapsible-header" style="text-decoration: none">Nombre de commande par
                                            source de commande </div>
                                    </a>

                                </li>
                            </ul>
                            <ul class="collapsible categories-collapsible">
                                <li class="active">
                                    <a href="{{ route('commandebymode') }}" style="text-decoration: none; color: rgb(90, 86, 86)" class="">
                                        <div class="collapsible-header" style="text-decoration: none">Nombre de commande par
                                            mode de paiement </div>
                                    </a>

                                </li>
                            </ul>
                            <ul class="collapsible categories-collapsible">
                                <li class="active">
                                    <a href="{{ route('commandebypack') }}" style="text-decoration: none; color: rgb(90, 86, 86)" class="">
                                        <div class="collapsible-header" style="text-decoration: none">Nombre de commande par
                                            pack </div>
                                    </a>

                                </li>
                            </ul>
                            <ul class="collapsible categories-collapsible">
                                <li class="active">
                                    <a href="{{ route('commandebylivreur') }}" style="text-decoration: none; color: rgb(90, 86, 86)" class="">
                                        <div class="collapsible-header" style="text-decoration: none">Nombre de commande par
                                            livreur </div>
                                    </a>

                                </li>
                            </ul>
                            <ul class="collapsible categories-collapsible">
                                <li class="active">
                                    <a href="{{ route('commandebycustomer') }}" style="text-decoration: none; color: rgb(90, 86, 86)" class="">
                                        <div class="collapsible-header" style="text-decoration: none">Nombre de commande par
                                            client </div>
                                    </a>

                                </li>
                            </ul>
                            <ul class="collapsible categories-collapsible">
                                <li class="active">
                                    <a href="{{ route('topscustomer') }}" style="text-decoration: none; color: rgb(90, 86, 86)" class="">
                                        <div class="collapsible-header" style="text-decoration: none">Tops
                                            clients </div>
                                    </a>

                                </li>
                            </ul>
                            <ul class="collapsible categories-collapsible">
                                <li class="active">
                                    <a href="{{ route('commandebyperiod') }}" style="text-decoration: none; color: rgb(90, 86, 86)" class="">
                                        <div class="collapsible-header" style="text-decoration: none">Liste des commandes par période </div>
                                    </a>

                                </li>
                            </ul>
                            <ul class="collapsible categories-collapsible">
                                <li class="active">
                                    <a href="{{ route('chiffreaffairebyperiod') }}" style="text-decoration: none; color: rgb(90, 86, 86)" class="">
                                        <div class="collapsible-header" style="text-decoration: none">Chiffre d'affaire sur une période </div>
                                    </a>

                                </li>
                            </ul>
                            <ul class="collapsible categories-collapsible">
                                <li class="active">
                                    <a href="{{ route('chiffreaffairebymodepaiement') }}" style="text-decoration: none; color: rgb(90, 86, 86)" class="">
                                        <div class="collapsible-header" style="text-decoration: none">Chiffre d'affaire par mode de paiement</div>
                                    </a>

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>


            </div>
            <div class="content-overlay"></div>
        </div>
    </div>
    <!-- users list start -->

    <!-- users list ends -->
@endsection
