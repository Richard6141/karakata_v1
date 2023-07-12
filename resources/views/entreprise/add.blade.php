@extends('layouts.app')

@section('content')
<div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Ajout d'une entreprise</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/">Acceuil</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('customer.index') }}">Clients</a>
                        </li>
                        <li class="breadcrumb-item active">Ajout
                        </li>
                    </ol>
                </div>
                <a href="{{backUrl()}}" class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 right">RETOUR</a>

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



                                <form id="addForm" class="" action="{{ route('company.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row" id="nom_div">
                                        <div class="input-field col s12">
                                            <input id="name" name="name" value="{{old('name')}}" type="text" placeholder="" class="@error('name') is-invalid @enderror">
                                            <label for="labels">Nom</label>
                                            @error('name')
                                            <small class="red-text ml-7" role="alert">
                                                {{ $message }}
                                            </small>
                                            @enderror
  
                                        </div>
                                    </div>
                                    <div class="row" id="prenom_div">
                                        <div class="input-field col s12">
                                            <input id="firstname" value="{{old('firstname')}}" name="firstname" class="@error('firstname') is-invalid @enderror" type="text" placeholder="" value="" type="text">
                                            <label for="firstname">Prénom</label>
                                            @error('firstname')
                                            <small class="red-text ml-7" role="alert">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row" id="nom_div">
                                        <div class="input-field col s12">
                                            <input id="socialreason" name="socialreason" value="{{old('socialreason')}}" type="text" placeholder="" class="@error('socialreason') is-invalid @enderror">
                                            <label for="labels">Raison sociale</label>
                                            @error('socialreason')
                                            <small class="red-text ml-7" role="alert">
                                                {{ $message }}
                                            </small>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="phone" name="phone" class="@error('phone') is-invalid @enderror" type="number" placeholder="" value="{{old('phone')}}" type="number">
                                            <label for="phone">Téléphone</label>
                                            @error('phone')
                                            <small class="red-text ml-7" role="alert">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="input-field col s12">
                                            <input id="email" name="email" class="@error('email') is-invalid @enderror" type="email" placeholder="" value="{{old('email')}}" type="email">
                                            <label for="email">Email</label>
                                            @error('email')
                                            <small class="red-text ml-7" role="alert">{{ $message }}</small>
                                            @enderror

                                        </div>
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <button type="submit" class="btn bcyan waves-effect waves-light right" type="submit">Enregistrer
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
@section('scripts')
@include('clients.js')
@endsection
