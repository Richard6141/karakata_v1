@extends('layouts.app')

@section('content')

<div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Enregistrement d'un produit pour cuisine</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="index.html">Acceuil</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('produits.index1')}}">Produits</a>
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
                                <h5 class="ml-4 center">Enregistrement d'un produit</h5>
                                <form id="addForm" class="" action="{{ route('operations.store') }}" method="POST">
                                    @csrf
                                    <div class="row margin">
                                        <div class="input-field col m6 s12">
                                            <select name="produit_id" id="produit_id">
                                                <option value="ajout">Ajouter un produit</option>
                                                @foreach($produits as $produit)
                                                <option value="{{$produit->id}}">{{$produit->label}}</option>
                                                @endforeach
                                            </select>
                                            <label for="produit_id" class="center-align" style="color:black;">Produit :</label>
                                            @error('produit_id')
                                            <small class="red-text ml-7" role="alert">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                        <div class="input-field col m6 s12">
                                            <input id="stock_reel" name="stock_reel" type="number" class="@error('stock_reel') is-invalid @enderror" value="{{ old('stock_reel') }}">
                                            <label for="stock_reel" class="center-align" style="color:black;">Stock réel :</label>

                                            @error('stock_reel')
                                            <small class="red-text ml-7" role="alert">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                        <div class="input-field col m6 s12">
                                            <select name="inventoriste" id="inventoriste">
                                                <option value=""></option>
                                                @foreach($users as $user)
                                                <option value="{{$user->nom}} {{$user->prenom}}">{{$user->nom}} {{$user->prenom}}</option>
                                                @endforeach
                                            </select>
                                            <label for="inventoriste" class="center-align" style="color:black;">Inventoriste :</label>

                                            @error('inventoriste')
                                            <small class="red-text ml-7" role="alert">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                        <div class="input-field col m6 s12">
                                            <input id="date" name="date" type="date" max="{{ $date }}" class="@error('date') is-invalid @enderror" value="{{ old('date') }}">
                                            <label for="date" class="center-align" style="color:black;">Date de l'inventaire :</label>

                                            @error('date')
                                            <small class="red-text ml-7" role="alert">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                        <div class="input-field col s12">
                                            <input id="comment" name="observations" type="text"  class="@error('observations') is-invalid @enderror" value="{{ old('observations') }}">
                                            <label for="comment" class="center-align" style="color:black;">Observations :</label>

                                            @error('observations')
                                            <small class="red-text ml-7" role="alert">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                        <div class="input-field col m6 s12">
                                            <input id="created_by" name="created_by" type="hidden" class="@error('created_by') is-invalid @enderror" value="{{Auth::user()->id}}">
                                        </div>
                                        <div class="input-field col m6 s12">
                                            <input id="domaine_id" name="domaine_id" type="hidden" class="@error('domaine_id') is-invalid @enderror" value="{{$domaine->id}}">
                                        <input type="hidden" name="quantite" value="NULL">
                                        </div><input type="hidden" name="status" value="2">
                                        

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