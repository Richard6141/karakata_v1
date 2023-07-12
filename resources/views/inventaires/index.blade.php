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
                        <li class="breadcrumb-item active">Produits
                    </ol>
                </div>
                @if($domaine->label == 'Cuisine')
                <a href="{{ route('create_inventaires_cuisine') }}" class="btn-floating  waves-effect waves-light breadcrumbs-btn right mr-1 mb-1 modal-trigger btn-large">
                    <i class="material-icons tooltipped" data-position="top" data-tooltip="Ajouter">add</i>
                </a>
                @endif
                @if($domaine->label == 'Empaquetage')
                <a href="{{ route('create_inventaires_empaquetage') }}" class="btn-floating  waves-effect waves-light breadcrumbs-btn right mr-1 mb-1 modal-trigger btn-large">
                    <i class="material-icons tooltipped" data-position="top" data-tooltip="Ajouter">add</i>
                </a>
                @endif
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
                                    <div class="card-content">
                                        <!-- datatable start -->
                                        <div class="responsive-table">
                                            @foreach($inventaires as $date => $items)
                                            <table id="data-table-simple" class="display">  
                                            <span style="margin-top: 30px;" class="new badge blue left" data-badge-caption="" style="font-weight: bold;">Inventaire du {{$date}}</span>
                                            <a href="{{route('print.inventaire', ['domaine' => $domaine->label, 'date' => $date]) }}" target="_blank"><span style="margin-top: 30px;" class="new badge red left" data-badge-caption="" style="font-weight: bold;">Imprimer la fiche</span></a>

                                                <!-- <thead> -->
                                                    <tr style="color:black">
                                                        <th style="width: 170px;">Produit</th>
                                                        <th style="width: 170px; text-align:center">Stock réel</th>
                                                        <th style="width: 170px; text-align:center">Bon</th>
                                                        <th style="width: 170px; text-align:center">Moyen</th>
                                                        <th style="width: 170px; text-align:center">Hors d'usage</th>
                                                        <th style="width: 170px; text-align: center">Expiré</th>
                                                        <th style="width: 170px; text-align: center">Observations</th>
                                                        <th style="text-align: center;">Inventoriste</th>
                                                    </tr>
                                                <!-- </thead> -->
                                                <tbody>
                                                    @foreach($items as $index)
                                                    <tr>
                                                        <td style="width: 170px;">{{$index->produit->label}}</td>
                                                        @if($index->produit->unitemesure->label == "Nombre")
                                                        <td style="width: 170px; text-align:center">{{$index->stock_reel}}</td>
                                                        <td style="width: 170px; text-align:center">{{$index->bon}}</td>
                                                        <td style="width: 170px; text-align:center">{{$index->moyen}}</td>
                                                        <td style="width: 170px; text-align:center">{{$index->hs}}</td>
                                                        <td style="width: 170px; text-align:center">{{$index->expire}}</td>
                                                        @else
                                                        <td style="width: 170px; text-align:center">{{$index->stock_reel}} {{$index->produit->unitemesure->label}}</td>
                                                        <td style="width: 170px; text-align:center">{{$index->bon}} {{$index->produit->unitemesure->label}}</td>
                                                        <td style="width: 170px; text-align:center">{{$index->moyen}} {{$index->produit->unitemesure->label}}</td>
                                                        <td style="width: 170px; text-align:center">{{$index->hs}} {{$index->produit->unitemesure->label}}</td>
                                                        <td style="width: 170px; text-align:center;">{{$index->expire}} {{$index->produit->unitemesure->label}}</td>
                                                        @endif
                                                        <td style="text-align: center;">{{$index->observations}}</td>
                                                        <td style="text-align: center;">{{$index->inventoriste}}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @endforeach
                                        </div>
                                        <!-- datatable ends -->
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