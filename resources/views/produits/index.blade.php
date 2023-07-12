@extends('layouts.app')

@section('content')
<div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Liste des Produits</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/">Acceuil</a>
                        </li>
                        <li class="breadcrumb-item">Cuisine</li>
                        <li class="breadcrumb-item active">Produits</li>
                    </ol>
                </div>
                <a href="{{ route('cuisine.store') }}" class="btn-floating  waves-effect waves-light breadcrumbs-btn right mr-1 mb-1 modal-trigger btn-large">
                    <i class="material-icons tooltipped" data-position="top" data-tooltip="Ajouter">add</i>
                </a>
                <a href="{{backUrl()}}" class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 right">RETOUR</a>

            </div>
        </div>
    </div>
    <div class="col s12">
        <div class="container">
            <div class="section">
                <div class="card">
                    <div class="card-content">
                        <p class="caption mb-0">
                        <section class="users-list-wrapper section">

                            @if (session()->has('successMessage'))
                            <div class="card-alert card green lighten-5">
                                <div class="card-content green-text">
                                    <p style="color:#336600;">{!! session('successMessage') !!}</p>
                                </div>
                                <button type="button" class="close green-text" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            @endif
                            @if (session()->has('alertMessage'))
                            <div class="card-alert card orange lighten-5">
                                <div class="card-content orange-text">
                                    <p>WARNING : {!! session('alertMessage') !!}</p>
                                </div>
                                <button type="button" class="close orange-text" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            @endif
                            @if (session()->has('errorMessage'))
                            <div class="card-alert card red lighten-5">
                                <div class="card-content red-text">
                                    <p>{!! session('errorMessage') !!}</p>
                                </div>
                                <button type="button" class="close red-text" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            @endif

                            <div class="users-list-table">
                                <div class="card">
                                    <div style="border: 1px solid; text-align: center; color: black; font-weight: bold;" class="card-content">
                                        <div style="margin-bottom: 15px;">FICHE DE SUIVIE DE STOCK : Riz</div>
                                        <div class="responsive-table" style="display: flex; flex-direction: row; justify-content: space-between">
                                            <table style="width: 40%; border-collapse: collapse">
                                                <tr>
                                                    <td style="border: 1px solid;">Stock minimum</td>
                                                    <td style="border: 1px solid;text-align: center;">50</td>
                                                </tr>
                                                <tr>
                                                    <!-- <td style="border: 1px solid;">Stock maximum</td>
                                                    <td style="border: 1px solid;">50</td>
                                                </tr> -->
                                            </table>
                                            <table style="width: 40%; border-collapse: collapse">
                                                <tr>
                                                    <td style="border: 1px solid;">Fournisseur</td>
                                                    <td style="border: 1px solid;text-align: center;">Entreprise Gamma</td>
                                                </tr>
                                                <!-- <tr>
                                                    <td style="border: 1px solid;">Livraison moyenne</td>
                                                    <td style="border: 1px solid;">24h</td>
                                                </tr> -->
                                            </table>
                                        </div>
                                        <table style="margin-top:20px; border-collapse:collapse">
                                            <thead>
                                                <tr>
                                                    <th style="border: 1px solid;; width: 100px">Date</th>
                                                    <th style="border: 1px solid; text-align: center; width: 100px">🔂 Opération</th>
                                                    <th style="border: 1px solid; text-align: center; width: 100px">Quantité</th>
                                                    <th style="border: 1px solid; text-align: center; width: 100px">Stock théorique </th>
                                                    <th style="border: 1px solid; text-align: center; width: 100px">Stock réel </th>
                                                    <th style="border: 1px solid; text-align: center; width: 100px">Observations</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="border: 1px solid; text-align: center; width: 100px">12/12/2021</td>
                                                    <td style="border: 1px solid; text-align: center; width: 100px">Inventaire</td>
                                                    <td style="border: 1px solid; text-align: center; width: 100px"></td>
                                                    <td style="border: 1px solid; text-align: center; width: 100px"></td>
                                                    <td style="border: 1px solid; text-align: center; width: 100px">100</td>
                                                    <td style="border: 1px solid; text-align: center; width: 100px">RAS</td>
                                                </tr>
                                                <tr>
                                                    <td style="border: 1px solid; text-align: center; color: green">01/01/2022</td>
                                                    <td style="border: 1px solid; text-align: center">Entrée</td>
                                                    <td style="border: 1px solid; text-align: center; color: green">500</td>
                                                    <td style="border: 1px solid; text-align: center">600</td>
                                                    <td style="border: 1px solid; text-align: center"></td>
                                                    <td style="border: 1px solid; text-align: center">RAS</td>
                                                </tr>
                                                <tr>
                                                <td style="border: 1px solid; text-align: center; color: red">02/02/2022</td>
                                                    <td style="border: 1px solid; text-align: center">Sortie</td>
                                                    <td style="border: 1px solid; text-align: center; color: red">350</td>
                                                    <td style="border: 1px solid; text-align: center">250</td>
                                                    <td style="border: 1px solid; text-align: center"></td>
                                                    <td style="border: 1px solid; text-align: center">RAS</td>
                                                </tr>
                                                <tr>
                                                    <td style="border: 1px solid; text-align: center; color: red">03/03/2022</td>
                                                    <td style="border: 1px solid; text-align: center">Sortie</td>
                                                    <td style="border: 1px solid; text-align: center; color: red">150</td>
                                                    <td style="border: 1px solid; text-align: center">100</td>
                                                    <td style="border: 1px solid; text-align: center"></td>
                                                    <td style="border: 1px solid; text-align: center">RAS</td>
                                                </tr>
                                                <tr>
                                                    <td style="border: 1px solid; text-align: center; color: green">04/04/2022</td>
                                                    <td style="border: 1px solid; text-align: center; color: green">500</td>
                                                    <td style="border: 1px solid; text-align: center">Entrée</td>
                                                    <td style="border: 1px solid; text-align: center">600</td>
                                                    <td style="border: 1px solid; text-align: center">  </td>
                                                    <td style="border: 1px solid; text-align: center">RAS</td>
                                                </tr>
                                                <tr>
                                                    <td style="border: 1px solid; text-align: center; color: red">05/05/2022</td>
                                                    <td style="border: 1px solid; text-align: center">Sortie</td>
                                                    <td style="border: 1px solid; text-align: center; color: red">50</td>
                                                    <td style="border: 1px solid; text-align: center">550</td>
                                                    <td style="border: 1px solid; text-align: center"></td>
                                                    <td style="border: 1px solid; text-align: center">RAS</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            @include('produits.sup_message')

                        </section>
                    </div>
                </div>
            </div>


        </div>
        <div class="content-overlay"></div>
    </div>
</div>
@endsection


{{-- page script --}}
@section('scripts')
<script src="{{ asset('js/scripts/page-users.js') }}"></script>
<script>
    $(document).on('click', '#supBtn', function() {
        document.forms.deleteForm.action = $(this).attr('data-url');
    })
</script>
@endsection