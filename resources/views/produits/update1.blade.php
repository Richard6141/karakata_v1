@extends('layouts.app')

@section('content')

<div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Mise à jour de produit</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/">Acceuil</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('produits.index1')}}">Produits</a>
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
                                {{-- <h5 class="ml-4 center">Mise à jour de produit</h5> --}}


                                <form id="addForm" class="" action="{{ route('update.validation', ['id' => $produit->id]) }}" method="POST">
                                    @csrf
                                    <div class="row margin">



                                        <div class="input-field col m6 s12">
                                            <input id="label" name="label" value="{{$produit->label}}" type="text" class="@error('code') is-invalid @enderror">
                                            <label for="label" class="center-align" style="color:black;">Libellé :</label>
                                            @error('label')
                                            <small class="red-text ml-7" role="alert">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                        <div class="input-field col m6 s12">
                                            <input id="stock_securite" value="{{$produit->stock_securite}}" name="stock_securite" type="number" class="@error('stock_securite') is-invalid @enderror">
                                            <label for="stock_securite" class="center-align" style="color:black;">Stock de sécurité :</label>

                                            @error('stock_securite')
                                            <small class="red-text ml-7" role="alert">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                        <div class="input-field col  s12" id="usercolumn">
                                            <select name="unite_id" id="unite_id">
                                                <option value="" selected>Choisissez l'unité de mesure</option>
                                                @foreach($unite as $index)
                                                @if($index->label == $produit->unitemesure->label)
                                                <option selected value="{{$index->id}}">{{$index->label}}</option>
                                                @else
                                                <option value="{{$index->id}}">{{$index->label}}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                            <label>unité de mesure</label>
                                            @error('unite_id')
                                            <small class="red-text ml-7" role="alert">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>

                                        <input type="hidden" name="domaine_id" value="{{$domaine1->id}}">

                                        <!-- <div class="input-field col m6 s12" style="display: none;">
                                            <select name="appartenance" id="appartenance">
                                                <option value="">Choisissez l'unité de mesure</option>
                                                @if($produit->appartenance == 'cuisine')
                                                <option selected value="cuisine">Cuisine</option>
                                                @endif
                                                @if($produit->appartenance == 'empaquetage')
                                                <option selected value="empaquetage">Empaquetage</option>
                                                @endif
                                            </select>
                                            <label for="appartenance" class="center-align" style="color:black;">Appartenance :</label>
                                            @error('appartenance')
                                            <small class="red-text ml-7" role="alert">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div> -->

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
@endsection
