@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
            <!-- Search for small screen-->
            <div class="container">
                <div class="row">
                    <div class="col s10 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Modifier un livreur</span></h5>
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="/">Acceuil</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('delivers.index') }}">Liste</a>
                            </li>
                            <li class="breadcrumb-item active">Modifier
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

                                    <form class="login-form" method="POST" action="{{ route('delivers.update', $delivers->id) }}">
                                        @csrf
                                        <div class="row">
                                            <div class="input-field col m6 s12">
                                                <i class="material-icons prefix pt-2">person_outline</i>
                                                <input id="lastname" type="text" name="lastname"
                                                    value="{{ $delivers->lastname }}">
                                                <label for="lastname">Nom</label>
                                                @error('lastname')
                                                    <small class="red-text ml-7" role="alert">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>
                                            <div class="input-field col m6 s12">
                                                <i class="material-icons prefix pt-2">person_outline</i>
                                                <input id="firstname" type="text" name="firstname"
                                                    value="{{ $delivers->firstname }}">
                                                <label for="firstname">Prénom</label>
                                                @error('firstname')
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
                                                    value="{{ $delivers->email }}">
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
                                                    value="{{ $delivers->phone }}">
                                                <label for="phone">Téléphone</label>
                                                @error('phone')
                                                    <small class="red-text ml-7" role="alert">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>
                                        </div>
                       
                                        <div class="row">
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
