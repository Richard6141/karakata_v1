@extends('layouts.app')

@section('content')
    @if (session()->has('successMessage'))
        <div class="alert alert-success" role="alert">
            {{ session('successMessage') }}
        </div>
    @endif
    @if (session()->has('errorMessage'))
        <div class="alert alert-danger" role="alert">
            {{ session('errorMessage') }}
        </div>
    @endif
    <div class="row">
        <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
            <!-- Search for small screen-->
            <div class="container">
                <div class="row">
                    <div class="col s10 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Liste des utilisateurs</span></h5>
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="/">Acceuil</a>
                            </li>

                            <li class="breadcrumb-item active">Utilisateurs
                            </li>
                        </ol>
                    </div>

                    <a class="col s12 m4 l6"><a href="{{ route('user-register') }}"
                            class="btn-floating  waves-effect waves-light breadcrumbs-btn right mr-1 mb-1 btn-large"
                            href="#!" data-target="dropdown1"><i class="material-icons tooltipped" data-position="top" data-tooltip="Ajouter">add</i>
                    </a>
                    <a href="{{backUrl()}}" class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 right">RETOUR</a>

                </div>
            </div>
        </div>
        <div class="col s12">
            <div class="container">
                <div class="section">
                    <div class="card">
                        @if (\Session::has('successMessage'))
                            <div class="card-alert card green">
                                <div class="card-content white-text">
                                    <p>{!! \Session::get('successMessage') !!}</p>
                                </div>
                                <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        @endif
                        @if (\Session::has('errorMessage'))
                            <div class="card-alert card red">
                                <div class="card-content white-text">
                                    <p>{!! \Session::get('errorMessage') !!}</p>
                                </div>
                                <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        @endif
                        <div class="users-list-table">
                            <div class="card">
                                <div class="card-content">
                                    <!-- datatable start -->
                                    <div>
                                        <table id="data-table-simple" class="display" style="width: 100%">
                                            <!-- <table> -->
                                            <thead>
                                                <tr>
                                                    <!-- <th></th> -->
                                                    <th>Image</th>
                                                    <!-- <th>Id</th> -->
                                                    <th>Nom</th>
                                                    <th>Prénom</th>
                                                    <th>Email</th>
                                                    <th>Téléphone</th>
                                                    <th style="text-align: center">Rôle</th>
                                                    <th>Statut</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($users as $usr)
                                                    <tr>

                                                        <!-- <td></td> -->
                                                        {{-- @dump($usr) --}}
                                                        {{-- @dump($usr->nom . ' ' . $usr->prenom) --}}
                                                        <td>
                                                            @if (is_null($usr->image))
                                                            <div class="avatar">
                                                                <img src="{{ 'https://ui-avatars.com/api/?background=8EC741&color=ffff/?uppercase=true&name=' . $usr->name }}"
                                                                    alt="Photo de profil" class="z-depth-4 circle"
                                                                    height="40" width="40">
                                                            </div>
                                                            @else
                                                            <div class="avatar">
                                                                <img src="{{ asset('image/' . $usr->image) }}"
                                                                    alt="Photo de profil" class="z-depth-4 circle"
                                                                    height="40" width="40">
                                                            </div>
                                                            @endif

                                                        </td>
                                                        <td><a
                                                                href="{{ route('user.view', ['id' => $usr->id]) }}">{{ $usr->name }}</a>
                                                        </td>
                                                        <td><a
                                                                href="{{ route('user.view', ['id' => $usr->id]) }}">{{ $usr->firstname }}</a>
                                                        </td>
                                                        <td>{{ $usr->email }}</td>
                                                        <td>{{ $usr->phone }}</td>
                                                        <td style="text-align: center">
                                                        @foreach ($usr->roles as $role)
                                                        <span class="new badge blue "data-badge-caption="">{{ $role->name ?? 'Non renseigné' }}</span>
                                                        @endforeach
                                                        </td>
                                                        <td>

                                                            @if ($usr->status == '1')
                                                                <div class="z-depth-4 circle green darken-2"
                                                                    style="width: 20px; height: 20px; border: 1px solid">
                                                                </div>
                                                            @endif
                                                            @if ($usr->status == '0')
                                                                <div class="z-depth-4 circle red darken-2"
                                                                    style="width: 20px; height: 20px; border: 1px solid">
                                                                </div>
                                                            @endif
                                                        </td>

                                                        <td>
                                                            <div class="invoice-action">
                                                                @if ($usr->id !== Auth::user()->id)
                                                                <a href="{{ route('user.view', ['id' => $usr->id]) }}"><i
                                                                    class="material-icons tooltipped" data-position="top" data-tooltip="Voir">remove_red_eye</i></a>
                                                                @if ($usr->status == '0')
                                                                    <a
                                                                        href="{{ route('user.unlock', ['id' => $usr->id]) }}"><i
                                                                            class="material-icons tooltipped" data-position="top" data-tooltip="Débloquer">lock</i></a>
                                                                @endif
                                                                @if ($usr->status == '1')
                                                                    <a href="{{ route('user.lock', ['id' => $usr->id]) }}"><i
                                                                            class="material-icons tooltipped" data-position="top" data-tooltip="Bloquer">lock_open</i></a>
                                                                @endif
                                                                {{-- <a href="javascript:;" id="resetPassword"
                                                                    data-url="{{ route('user.reset', $usr->id) }}"
                                                                    class="invoice-action-view mr-4">
                                                                    <i class="material-icons">enhanced_encryption</i>
                                                                </a> --}}
                                                                <a href="{{ route('permissions', $usr->id) }}"
                                                                    id=""
                                                                    data-url="{{ route('permissions', $usr->id) }}"
                                                                    class="invoice-action-view mr-4">
                                                                    <i class="material-icons tooltipped" data-position="top" data-tooltip="Rôle">accessibility</i>
                                                                </a>
                                                                <a id="supBtn" href="#supuser" class="invoice-action-edit modal-trigger tooltipped" data-position="top" data-tooltip="Supprimer" data-id="{{ $usr->id }}" data-url="{{ route('user.sup', $usr->id) }}">
                                                                    <i class="material-icons" style="color:red ">delete</i>
                                                                </a>
                                                                @endif

                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            <tbody>

                                        </table>
                                    </div>
                                    <!-- datatable ends -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="content-overlay"></div>
            <div class="" style="display: none;">
                <form action="" method="POST" id="resetForm">
                    @csrf
                    <button form="resetForm" id="resetbtn"></button>
                </form>
            </div>

        </div>
    </div>
    @include('pages.delete_user')
@endsection
@section('scripts')
    @include('pages.js')
@endsection
