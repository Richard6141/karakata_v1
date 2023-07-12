@extends('layouts.app')
@section('content')
<div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Livreurs</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/">Acceuil</a></li>
                        <li class="breadcrumb-item active">Liste</li>
                    </ol>
                </div>
                <a href="{{backUrl()}}" class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 right">RETOUR</a>
                <a href="{{route('delivers.available')}}" class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 ml-2 right" st>Affectations</a>
                <a href="{{route('delivers.add')}}" class="btn-floating  waves-effect waves-lig ht breadcrumbs-btn right mr-1 mb-1 modal-trigger btn-large">
                    <i class="material-icons tooltipped" data-position="top" data-tooltip="Ajouter">add</i>
                </a>
            </div>
            <div class="row" style="margin-top: 15px;">
                <div class="col s12">
                    <div class="container">
                        <div class="section">
                            <div class="card">
                                <div class="card-content">
                                    <div class="responsive-table">
                                        <table id="data-table-simple" class="display" style="width: 100%;">
                                            <thead>
                                                <tr style="color:black">
                                                    <th style="text-align: left;">Nom</th>
                                                    <th style="text-align: right">Prénoms</th>
                                                    <th style="text-align: right">Téléphone</th>
                                                    <th style="text-align: right">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($delivers as $item)
                                                <tr>
                                                    <td style="text-align: left"><span>{{ $item->lastname ?? 'N/A'}} </span></td>
                                                    <td style="text-align: right"><span>{{ $item->firstname ?? '' }} </span></td>
                                                    <td style="text-align: right"><span>{{$item ->phone ?? '' }}</span></td>
                                                    <td style="text-align: right"><span>
                                                            <div class="invoice-action">
                                                                <a id="" href="{{route('delivers.show', $item->id)}}" class="invoice-action-edit modal-trigger tooltipped" data-position="top" data-tooltip="Voir">
                                                                    <i class="material-icons" style="color:green ;">visibility</i>
                                                                </a>
                                                                <a id="" href="{{route('delivers.edit', $item->id)}}" class="invoice-action-edit modal-trigger tooltipped" data-position="top" data-tooltip="Modifier">
                                                                    <i class="material-icons" style="color:green ;">edit</i>
                                                                </a>
                                                                <a id="supBtn" href="#modal11" class="invoice-action-edit modal-trigger tooltipped" data-position="top" data-tooltip="Supprimer" data-id="{{ $item->id }}" data-url="{{ route('delivers.sup', $item->id) }}">
                                                                    <i class="material-icons" style="color:red ">delete</i>
                                                                </a>
                                                            </div>
                                                        </span>
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
                </div>
                <div class="content-overlay"></div>
                @include('delivers.delete')
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
@include('Suggestion.js')
@endsection
