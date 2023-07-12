@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
            <!-- Search for small screen-->
            <div class="container">
                <div class="row">
                    <div class="col s10 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Ajout d'un utilisateur</span></h5>
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="/">Acceuil</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('user.list') }}">Utilisateurs</a>
                            </li>
                            <li class="breadcrumb-item active">Ajout
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
                            <div id="Form-advance" class="card card card-default scrollspy">
                                <div class="card-content">
                                    <h5 class="ml-4"></h5>

                                    <form class="login-form" method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="input-field col m6 s12">
                                                <i class="material-icons prefix pt-2">person_outline</i>
                                                <input id="nom" type="text" name="nom"
                                                    value="{{ old('nom') }}">
                                                <label for="nom">Nom</label>
                                                @error('nom')
                                                    <small class="red-text ml-7" role="alert">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>
                                            <div class="input-field col m6 s12">
                                                <i class="material-icons prefix pt-2">person_outline</i>
                                                <input id="prenom" type="text" name="prenom"
                                                    value="{{ old('prenom') }}">
                                                <label for="prenom">Prénom</label>
                                                @error('prenom')
                                                    <small class="red-text ml-7" role="alert">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col m6 s12">
                                                <i class="material-icons prefix pt-2">mail_outline</i>
                                                <input id="email" type="email" name="email"
                                                    value="{{ old('email') }}">
                                                <label for="email">Email</label>
                                                @error('email')
                                                    <small class="red-text ml-7" role="alert">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>
                                            <div class="input-field col m6 s12">
                                                <i class="material-icons prefix pt-2">call_outline</i>
                                                <input id="phone" type="tel" name="phone"
                                                    value="{{ old('phone') }}">
                                                <label for="phone">Téléphone</label>
                                                @error('phone')
                                                    <small class="red-text ml-7" role="alert">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- <div class="row">
                                        <div class="input-field col s12">
                                            <i class="material-icons prefix pt-2">assignment_ind_outline</i>
                                            <select name="role" id="role">
                                                <option value=""></option>
                                                @foreach ($roles as $role)
                                                <option value="{{$role->id}}">{{$role->libelle}}</option>
                                                @endforeach
                                            </select>
                                            <label for="message">Choisissez le rôle</label>
                                            @error('role')
                                            <small class="red-text ml-7" role="alert">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>

                                    </div> --}}

                                        <div class="row">
                                            <div class="input-field col m6 s12">
                                                <i class="material-icons prefix pt-2">lock_outline</i>
                                                <input id="password" type="password" name="password">
                                                <label for="password">Mot de passe</label>
                                                @error('password')
                                                    <small class="red-text ml-7" role="alert">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>
                                            <div class="input-field col m6 s12">
                                                <i class="material-icons prefix pt-2">lock_outline</i>
                                                <input id="password_confirmation" type="password"
                                                    name="password_confirmation">
                                                <label for="password_confirmation">Confirmation du mot de passe</label>
                                                @error('password_confirmation')
                                                    <small class="red-text ml-7" role="alert">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>
                                            <!-- <div class="input-field col m6 s12">
                                                <div class="switch">
                                                    <br>
                                                </div>
                                                <div class="switch">
                                                    <label style="font-weight: bold;">
                                                        <input type="checkbox" id="checkboxlivreur" name="checkboxlivreur" value="1">
                                                        <span class="lever"></span>
                                                        Est il un livreur ?
                                                    </label>
                                                </div>

                                            </div> -->

                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <button type="submit" class="btn bcyan waves-effect waves-light right"
                                                        type="submit" name="action">Enregistrer
                                                        <i class="material-icons right">send</i>
                                                    </button>
                                                </div>
                                            </div>

                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="content-overlay"></div>
        </div>
    </div>
@endsection
@section('js')
@endsection
