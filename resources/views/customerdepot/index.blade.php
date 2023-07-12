@extends('layouts.app')

@section('content')
<div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Les dépôts effectués</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item">Acceuil
                        </li>
                        <li class="breadcrumb-item active">Liste
                        </li>
                    </ol>
                </div>
                <a href="{{backUrl()}}" class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 right">RETOUR</a>

                {{-- <a href="{{route('customerdepot.add',$id=0)}}" class="btn-floating  waves-effect waves-lig ht breadcrumbs-btn right mr-1 mb-1 modal-trigger btn-large">
                    <i class="material-icons tooltipped" data-position="top" data-tooltip="Ajouter">add</i>
                </a> --}}
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
                                                                <th style="text-align: right">Statut</th>
                                                                <th style="text-align: right">montant</th>
                                                                <th> </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($customer_depots as $item)
                                                            <tr>
                                                                <td style="text-align: left"><span>{{ $item->name ?? 'N/A'}} {{ $item->firstname ?? '' }} </span>

                                                             <span></span>

                                                            </td>
                                                            <td style="text-align: right"><span> {{ $item->socialreason ?? 'Particuler' }} </span></td>
                                                                <td style="text-align: right"><span>{{ $item->amount }}</span></td>
                                                                <td style="text-align: right"><span>
                                                                <div class="invoice-action">

                                                                <a id="" href="{{route('customerdepot.edit', $item->id)}}" class="invoice-action-edit modal-trigger tooltipped" data-position="top" data-tooltip="Modifier" >
                                                                    <i class="material-icons" style="color:green ;">edit</i>
                                                                </a>
                                                                <a id="supBtn" href="#modal11" class="invoice-action-edit modal-trigger tooltipped" data-position="top" data-tooltip="Supprimer" data-id="{{ $item->id }}" data-url="{{ route('customerdepot.sup', $item->id) }}">
                                                                    <i class="material-icons" style="color:red ">delete</i>
                                                                </a>
                                                            </div>
                                                                </span></td>
                                                            </tr>
                                                            @endforeach
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

            @include('customerdepot.delete')

        </div>
        <div class="content-overlay"></div>
    </div>
    <!-- <div class="" style="display: none">
        <a id="btnCarnetAdresse" class="btn-floating  waves-effect waves-light breadcrumbs-btn right mr-1 mb-1 modal-trigger btn-large" href="#modalCarnet"><i class="material-icons tooltipped" data-position="top" data-tooltip="Ajouter">add</i>
    </div> -->
</div>
@endsection
@section('scripts')
@include('customerdepot.js')
@endsection
