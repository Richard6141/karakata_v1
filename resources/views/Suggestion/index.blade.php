@extends('layouts.app')

@section('content')
<div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Les Suggestions</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/">Acceuil</a>
                        </li>
                        <li class="breadcrumb-item active">Liste
                        </li>
                    </ol>
                </div>
                <a href="{{backUrl()}}" class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 right">RETOUR</a>
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
                                                    <th style="text-align: left;">Nom du client</th>
                                                    <th style="text-align: right">Statut</th>
                                                    <th style="text-align: right">Suggestions</th>
                                                    <th style="text-align: right">Sources</th>
                                                    <th style="text-align: right">Date</th>
                                                    <th style="text-align: right">Actions </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($Suggestion as $item)
                                                <tr>
                                                    <td style="text-align: left"><span>{{ $item->name ?? 'N/A'}} {{ $item->firstname ?? '' }} </span>
                                                    </td>
                                                    <td style="text-align: right"><span> {{ $item->socialreason ?? 'Particuler' }} </span></td>
                                                    <td style="text-align: right"><span>{{ $item->preference }}</span></td>
                                                    <td style="text-align: right"><span>{{$item ->label ?? '' }}</span></td>
                                                    <td style="text-align: right"><span>{{ Carbon\carbon::parse($item->date)->format('d/m/Y') }}</span></td>
                                                    <td style="text-align: right"><span>
                                                            <div class="invoice-action">
                                                                <a id="" href="{{route('suggestion.edit', $item->id)}}" class="invoice-action-edit modal-trigger tooltipped" data-position="top" data-tooltip="Modifier">
                                                                    <i class="material-icons" style="color:green ;">edit</i>
                                                                </a>
                                                                <a id="supBtn" href="#modal11" class="invoice-action-edit modal-trigger tooltipped" data-position="top" data-tooltip="Supprimer" data-id="{{ $item->id }}" data-url="{{ route('suggestion.sup', $item->id) }}">
                                                                    <i class="material-icons" style="color:red ">delete</i>
                                                                </a>
                                                            </div>
                                                        </span></td>
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
            </div>
        </div>
    </div>
</div>
<!-- users list start -->
@include('Suggestion.delete')

<!-- users list ends -->
@endsection


@section('scripts')
<!-- <script src="{{ asset('js/scripts/page-users.js') }}"></script> -->
@include('Suggestion.js')

@endsection
