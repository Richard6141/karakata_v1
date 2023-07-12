@extends('layouts.app')

@section('content')
<div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Liste des menus</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/">Acceuil</a>
                        </li>
                        <li class="breadcrumb-item active"><a href="#">Menus</a>
                        </li>
                    </ol>
                </div>
                <a class="btn-floating  waves-effect waves-light breadcrumbs-btn right mr-1 mb-1 modal-trigger btn-large" href="{{ route('createmenus', [($id = 0), ($date = 0)]) }}" id="addclientmodal"><i class="material-icons tooltipped" data-position="top" data-tooltip="Ajouter">add</i>
                </a>
            </div>
            {{-- <a href="{{backUrl()}}" class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 right">RETOUR</a> --}}
        </div>
    </div>
    <div class="col s12">
        <div class="container">
            <div class="section">
                <div class="card">
                    <div class="card-content">
                        <div class="responsive-table">
                            <table id="data-table-simple" class="display" style="width: 100%;">
                                <thead>
                                    <tr style="color:black">
                                        <th style="text-align: left">Packs</th>
                                        <th style="text-align: center">Active</th>
                                        <th>Date</th>
                                        <th style="text-align: right">Prix</th>
                                        <th style="text-align: right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($menus as $item)
                                    <tr>
                                        <td style="text-align: left">
                                            <span>{{ infotypepack($item->paquet_id)->label }}</span>
                                        </td>
                                        <td style="text-align: center">
                                            <div class="switch">
                                                <label>
                                                    <input type="checkbox" id="activemenutoday" {{ checkinfocomposant($item->paquet_id, $item->date) == 1 ? 'checked' : '' }} data-pack="{{ $item->paquet_id }}" data-date="{{ $item->date }}">
                                                    <span class="lever"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <span>{{ Carbon\carbon::parse($item->date)->format('d/m/Y') }}</span>
                                        </td>
                                        <td style="text-align: right">
                                            <span>{{ $item->price }}</span>
                                        </td>

                                        <td style="text-align: right">
                                            <div class="invoice-action">
                                                <a id="showmenubyperiod" href="#constituants" class=" modal-trigger tooltipped" data-position="top" data-tooltip="Voir" data-menu="{{ showinfocomposant($item->paquet_id, $item->date) }}" data-pack="{{ infopack1($item->paquet_id)->label }}">
                                                    <i class="material-icons" style="color:green ;">remove_red_eye</i>
                                                </a>

                                                @if ($item->date >= date('Y-m-d'))
                                                <a id="editBtn" href="{{ route('updatemenus', [$item->paquet_id, $item->date]) }}" class="invoice-action-edit tooltipped" data-position="top" data-tooltip="Modifier">
                                                    <i class="material-icons" style="color:green ;">edit</i>
                                                </a>
                                                <a id="supBtn1" href="#" class="invoice-action-edit modal-trigger" data-pack="{{ $item->paquet_id }}" data-date="{{ $item->date }}">
                                                    <i class="material-icons tooltipped" style="color:red " data-position="top" data-tooltip="Supprimer">delete</i>
                                                </a>
                                                @endif
                                                
                                                <a href="{{ route('updatemenusreconduit', [$item->paquet_id, $item->date]) }}" id="" data-pack="{{ $item->paquet_id }}" data-date="{{ $item->date }}" class="invoice-action-view mr-4">
                                                    <i class="material-icons tooltipped" data-position="top" data-tooltip="Reconduire">accessibility</i>
                                                </a>
                                            </div>
                                        </td>
                                        @empty
                                    <tr>
                                        <td colspan="8" class="center"><span class="center">{{ __('Aucune donnée') }}</span> </td>
                                    </tr>
                                    @endforelse
                                    </tr>
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
<div class="" style="display: none">
    <form action="{{ route('updatemenusbyactive') }}" method="post" id="activemenuform">
        @csrf
        <input type="text" name="idmenu" id="idmenu">
        <input type="text" name="inpactivermenu" id="inpactivermenu">
        <button form="activemenuform" id=""></button>
    </form>
</div>
<div class="" style="display: none">
    <form action="{{ route('deletemenu') }}" method="post" id="deletemenu">
        @csrf
        <input type="text" name="packformdelete" id="packformdelete">
        <input type="text" name="dateformdelete" id="dateformdelete">
        <button form="deletemenu" id=""></button>
    </form>
</div>
<div class="" style="display: none">
    <form action="{{ route('reconduitmenu') }}" method="post" id="reconduitmenu">
        @csrf
        <input type="text" name="packformreconduit" id="packformreconduit">
        <input type="text" name="dateformreconduit" id="dateformreconduit">
        <button form="reconduitmenu" id=""></button>
    </form>
</div>
<div class="" style="display: none">
    <form action="{{ route('activemenutoday') }}" method="post" id="activemenutoday11">
        @csrf
        <input type="text" name="packformactive" id="packformactive">
        <input type="text" name="dateformactive" id="dateformactive">
        <input type="text" name="checkformactive" id="checkformactive">
        <button form="activemenutoday" id=""></button>
    </form>
</div>
@include('menu.delete')
@include('menu.show')
@endsection
@section('scripts')
@include('menu.js')
@endsection
