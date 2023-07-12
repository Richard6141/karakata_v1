@extends('layouts.app')

@section('content')

<div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Enregistrement d'un produit</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="index.html">Acceuil</a>
                        </li>
                        <li class="breadcrumb-item">Produits
                        </li>
                        <li class="breadcrumb-item active">Ajout
                        </li>
                    </ol>
                </div>
                <a href="{{backUrl()}}" class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 right tooltipped" data-tooltip="Retour">RETOUR</a>
            </div>
        </div>
    </div>
    <div class="col s12">
        <div class="container">
            <div class="section">
                <div class="card">
                    <div class="col s12 m12 l12">
                        <div id="Form-advance" class="card card card-default scrollspy">
                            @if (auth()->user()->hasRole('ADMINISTRATEUR') || auth()->user()->hasRole('CUISINIER'))
                            <div class="card-content">
                                {{-- <h5 class="ml-4 center">Enregistrement d'un produit</h5> --}}
                                <form id="addForm" class="" action="{{ route('store.product') }}" method="POST">
                                    @csrf
                                    <div class="row margin">
                                        <div class="input-field col m6 s12">
                                            <input id="label" name="label" value="{{ old('label') }}" type="text" class="@error('code') is-invalid @enderror">
                                            <label for="label" class="center-align" style="color:black;">Libellé :</label>
                                            @error('label')
                                            <small class="red-text ml-7" role="alert">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                        <div class="input-field col m6 s12">
                                            <input id="safetyStock" name="safetyStock" value="{{ old('safetyStock') }}" type="number" class="@error('safetyStock') is-invalid @enderror">
                                            <label for="safetyStock" class="center-align" style="color:black;">Stock de sécurité :</label>

                                            @error('safetyStock')
                                            <small class="red-text ml-7" role="alert">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                        <div class="input-field col  s12" id="usercolumn">
                                            <select name="uniteofmesure_id" id="uniteofmesure_id">
                                                <option value="{{ old('uniteofmesure_id') }}" selected>Choisissez l'unité de mesure</option>
                                                @foreach($unite as $index)
                                                <option value="{{$index->id}}">{{$index->label}}</option>
                                                @endforeach
                                            </select>
                                            <label>Unité de mesure</label>
                                            @error('uniteofmesure_id')
                                            <small class="red-text ml-7" role="alert">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <button type="submit" class="btn bcyan waves-effect waves-light right" type="submit">Enregistrer
                                                <i class="material-icons right">send</i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            @endif
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
@include('Coupons.js')
@endsection
