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
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Acceuil</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('user.list') }}">Utilisateur</a>
                        </li>
                        <li class="breadcrumb-item active">Edition du profil
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
                    <div class="section users-edit">
                        <div class="card">
                            <div class="card-content">
                                <!-- <div class="card-body"> -->
                           
                                <div class="divider mb-3"></div>
                                <div class="row">
                                    <div class="col s12" id="account">
                                        <!-- users edit media object start -->
                                        <div class="media display-flex align-items-center mb-2">
                                            <a class="mr-2" href="#">
                                                @if (!$usr->image)
                                                <div class="avatar">
                                                    <img src="{{ 'https://ui-avatars.com/api/?background=8EC741&color=ffff/?uppercase=true&name=' . $usr->name. '+' .$usr->firstname }}" alt="Photo de profil" class="z-depth-4 circle" height="100" width="100">
                                                </div>
                                                @endif
                                                @if ($usr->image)
                                                <div class="avatar">
                                                    <img src="{{ asset('image/' . $usr->image) }}" alt="Photo de profil" class="z-depth-4 circle" height="40" width="40">
                                                </div>
                                                @endif
                                            </a>

                                            <div class="media-body">
                                                <h5 class="media-heading mt-0"><span>{{ $usr->name }} </span>
                                                    <span>{{ $usr->firstname }} </span>
                                                </h5>
                                                @if ($usr->id == $user->id)
                                                <div class="user-edit-btns">
                                                    <form method="POST" action="{{ route('update.image', $usr->id) }}" enctype="multipart/form-data" style="display: flex">
                                                        @csrf
                                                        <div class="file-field input-field row">
                                                            <div class="btn" style="margin: 0 20px;">
                                                                <span>Photo</span>
                                                                <input name="image" type="file">
                                                            </div>=
                                                        </div>
                                                        <div class="file-field input-field row">
                                                            <button type="submit" class="btn btn-small indigo">Enregistrer</button>


                                                            @if (Auth::user()->image != null)
                                                            <a href="{{ route('delete.profil.image') }}" class="mb-6 btn-floating waves-effect waves-light cyan">
                                                                <i class="material-icons">clear</i>
                                                            </a>

                                                            {{-- <a id="supBtn" href="#modal21" class="invoice-action-edit modal-trigger tooltipped" data-position="top" data-tooltip="Supprimer"
                                                                            data-id="{{ $user->image}}"
                                                            data-url="{{ route('delete.profil.image', $user->image) }}">

                                                            <i class="material-icons">clear</i>
                                                            </a> --}}
                                                            @endif
                                                    </form>
                                                </div>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                    <form id="accountForm" method="POST" action="{{ route('user.update', $usr->id) }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col s12 m6">
                                                <div class="row">
                                                    <div class="col s12 input-field">
                                                        <input id="nom" name="nom" type="text" class="validate" value="{{ $usr->name }}" data-error=".errorTxt1">
                                                        <label for="nom">Nom</label>
                                                        <small class="errorTxt1"></small>
                                                    </div>
                                                    <div class="col s12 input-field">
                                                        <input id="prenom" name="prenom" type="text" class="validate" value="{{ $usr->firstname }}" data-error=".errorTxt2">
                                                        <label for="prenom">Prénom</label>
                                                        <small class="errorTxt2"></small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col s12 m6">
                                                <div class="row">
                                                    <div class="col s12 input-field">
                                                        <input id="email" name="email" type="email" class="validate" value="{{ $usr->email }}" data-error=".errorTxt3">
                                                        <label for="email">E-mail</label>
                                                        <small class="errorTxt3"></small>
                                                    </div>
                                                    <div class="col s12 input-field">
                                                        <input id="phone" name="phone" type="tel" class="validate" value="{{ $usr->phone }}" data-error=".errorTxt3">
                                                        <label for="phone">Téléphone</label>
                                                        <small class="errorTxt3"></small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col s12">
                                            </div>
                                            <div class="col s12 display-flex justify-content-end mt-3">
                                                <button type="submit" class="btn indigo">
                                                    Enregistrer</button>
                                                <a href="{{ route('user.list') }}" class="btn-small indigo">Retour</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                            <!-- </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
</div>
@endsection
@section('js')
@endsection