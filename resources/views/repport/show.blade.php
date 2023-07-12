@extends('layouts.app')

@section('content')
<div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Ajout d'une Suggestion</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/">Acceuil</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('preference.index')}}">Suggestions</a>
                        </li>
                        <li class="breadcrumb-item active">Ajout
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

<style>
    table {
        border-collapse: collapse;
        margin-top: 20px;
        /* Les bordures du tableau seront collées (plus joli) */
    }

    td,
    thead,
    tr {
        border: 1px solid black;
    }

    .contenu,
    p,
    .tableau {
        padding: 20px;
        text-align: justify;
    }

    .gras {
        font-weight: 900;
        text-decoration: underline;
    }
</style>
<!-- app invoice View Page -->
<section class="invoice-edit-wrapper section">
    <div class="row">
        <!-- invoice view page -->
        <div class="col xl9 m8 s12" style="width: 100% !important;">
            <div class="card">
                <div class="card-content invoice-print-area" style="padding: 90px;">
                    <div class="en_tete" style="display: flex; justify-content:space-between; align-items:center">
                        <div class="reference">
                            <div class="ref">
                                <span class="gras">Réf :</span> {{$rapportunique->type_doc}}
                            </div>
                            <div class="date">
                                <span class="gras">Date :</span> {{$rapportunique->date}}
                            </div>
                            <div class="version">
                                <span class="gras">
                                    Version :</span> 1
                            </div>
                        </div>
                        <div class="logo" style="width: 300px; height:150px">
                            <img src="{{asset('images/gallery/logotc.png')}}" alt="logo" height="100%" width="100%">
                        </div>
                    </div>


                    <div class="divider mb-3 mt-3"></div>
                    <center>
                        <div class="titre">
                            <h5 class="gras">
                                COMPTE RENDU DE REUNION
                            </h5>
                            <br>
                        </div>
                    </center>
                    <p class="gras">
                        Détails de la réunion
                    </p>
                    <p>
                        <span class="gras">
                            Heure : {{$rapportunique->heure_debut}} - <span>{{$rapportunique->heure_debut}}</span></span>
                    </p>
                    <p>
                        <span class="gras">Emplacement :</span>
                        {{$rapportunique->emplacement}}
                    </p>
                    <p>
                        <span class="gras">Ordre du jour :</span>
                        {{$rapportunique->ordre_jour}}

                    </p>
                    <p class="gras">
                        Participants :
                    </p>
                    <p>

                        {{$rapportunique->participant}}


                    </p>
                    <p class="gras">
                        Résumé de la séance :
                    </p>
                    <div class="contenu">
                        {!! $rapportunique->contenu !!}

                    </div>
                    <div class="tableau">

                        <div class="divider mb-3 mt-3"></div>
                        <!-- product details table-->
                        <div class="invoice-product-details">
                            <table class="centered responsive-table">
                                <tbody>
                                    <tr class="gras">
                                        <td style="border-left: 1px solid white; border-top: 1px solid white;"></td>
                                        <td>Nom</td>
                                        <td>Fonction</td>
                                        <td>Date</td>
                                    </tr>
                                    <tr>
                                        <td>Rédacteur</td>
                                        <td>{{$rapportunique->radacteur}}</td>
                                        <td>CDEO</td>
                                        <td>{{$rapportunique->date}}</td>
                                    </tr>
                                    <tr>
                                        <td>Approbateur</td>
                                        <td>{{$rapportunique->approbateur}}</td>
                                        <td>Sa fonction</td>
                                        <td>{{$rapportunique->date}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- invoice subtotal -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class=" card-content" style="width: 60px; position:fixed; top:50%; bottom:50%; right:40px">
        <div class="invoice-action-btn" style="width: 100%; margin-bottom:20px">
            <a href="#" class="btn indigo waves-effect waves-light display-flex align-items-center justify-content-center">
                <i style="font-size: 30px; margin:15px" class="material-icons">share</i>
            </a>
        </div>
        <div class="invoice-action-btn" style="width: 100%; margin-bottom:20px">
            <a href="{{ url('impression/'. $rapportunique->id)}}" class="btn btn btn-light-indigo waves-effect waves-light display-flex align-items-center justify-content-center">
                <i style="font-size: 30px;" class="material-icons">print</i>
            </a>
        </div>
        <div class="invoice-action-btn" style="width: 100%; margin-bottom:20px">
            <a href="#" class="btn btn btn-light-indigo waves-effect waves-light display-flex align-items-center justify-content-center">
                <i style="font-size: 30px;" class="material-icons">edit</i>
            </a>
        </div>
        <div class="invoice-action-btn" style="width: 100%; margin-bottom:20px">
            <a href="#" class="btn btn btn-light-indigo waves-effect waves-light display-flex align-items-center justify-content-center">
                <i style="font-size: 30px;" class="material-icons">delete</i>
            </a>
        </div>
    </div>

</section>
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
<script src="{{asset('vendors/form_repeater/jquery.repeater.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
<script src="{{asset('js/scripts/app-invoice.js')}}"></script>
@endsection