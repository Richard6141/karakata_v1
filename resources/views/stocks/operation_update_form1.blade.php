@extends('layouts.app')

@section('content')

<div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Modification des opérations</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/">Acceuil</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('cuisine')}}">Opérations</a>
                        </li>
                        <li class="breadcrumb-item active">Modification 
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
                                <h5 class="ml-4">Modification d'une opération</h5>
                                @if($operations->status == '1')
                                <form class="login-form" method="POST" action="{{ route('operations.update', [$operations->id]) }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="input-field col m6 s12">
                                            <select name="status" id="status">
                                                <option value="" selected>Choisissez le type d'opération</option>
                                                @if($operations->status == 1)
                                                <option selected value="1">Entrée</option>
                                                @endif
                                                @if($operations->status == '0')
                                                <option selected value="0">Sortie</option>
                                                @endif
                                            </select>
                                            <label>Type d'opération</label>
                                            @error('status')
                                            <small class="red-text ml-7" role="alert">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                        <div class="input-field col m6 s12">
                                            <select name="produit_id" id="produit_id">
                                                <option value="" selected>Choississez le produit</option>
                                                @foreach ($produits as $item)
                                                @if($item->label == $operations->produit->label)
                                                <option selected value="{{ $item->id }}"><span>{{ $item->label }}</span></option>
                                                @else
                                                <option value="{{ $item->id }}"><span>{{ $item->label }}</span></option>
                                                @endif
                                                @endforeach
                                            </select>
                                            <label>Produit</label>
                                            @error('produit_id')
                                            <small class="red-text ml-7" role="alert">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col m6 s12">
                                            <input id="quantite" type="number" name="quantite" value="{{ $operations->quantite }}">
                                            <label for="quantite">Quantité</label>
                                            @error('quantite')
                                            <small class="red-text ml-7" role="alert">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                        <div class="input-field col m6 s12">
                                            <input id="prix" type="number" name="prix" value="{{ $operations->prix_unitaire }}">
                                            <label for="prix">Prix</label>
                                            @error('prix')
                                            <small class="red-text ml-7" role="alert">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col m6 s12">
                                            <input id="date" class="datepicker" type="text" name="date" value="{{ $operations->date }}">
                                            <label for="date">Date d'achat</label>
                                            @error('date')
                                            <small class="red-text ml-7" role="alert">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                        <div class="input-field col m6 s12">
                                            <input id="comment" type="text" name="comment" value="{{ $operations->comment }}">
                                            <label for="comment">Observations</label>
                                            @error('comment')
                                            <small class="red-text ml-7" role="alert">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="input-field col s12">
                                            <button type="submit" class="btn bcyan waves-effect waves-light right" type="submit">Enregistrer
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                @endif
                                @if($operations->status == '0')
                                <form class="login-form" method="POST" action="{{ route('operations.update', [$operations->id]) }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="input-field col m6 s12">
                                            <select name="status" id="status">
                                                <option value="" selected>Choisissez le type d'opération</option>
                                                @if($operations->status == 1)
                                                <option selected value="1">Entrée</option>
                                                @endif
                                                @if($operations->status == '0')
                                                <option selected value="0">Sortie</option>
                                                @endif
                                            </select>
                                            <label>Type d'opération</label>
                                            @error('status')
                                            <small class="red-text ml-7" role="alert">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                        <div class="input-field col m6 s12">
                                            <select name="produit_id" id="produit_id">
                                                <option value="" selected>Choississez le produit</option>
                                                @foreach ($produits as $item)
                                                @if($item->label == $operations->produit->label)
                                                <option selected value="{{ $item->id }}"><span>{{ $item->label }}</span></option>
                                                @else
                                                <option value="{{ $item->id }}"><span>{{ $item->label }}</span></option>
                                                @endif
                                                @endforeach
                                            </select>
                                            <label>Produit</label>
                                            @error('produit_id')
                                            <small class="red-text ml-7" role="alert">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col m6 s12">
                                            <input id="quantite" type="number" name="quantite" value="{{ $operations->quantite }}">
                                            <label for="quantite">Quantité</label>
                                            @error('quantite')
                                            <small class="red-text ml-7" role="alert">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                        <div class="input-field col m6 s12">
                                            <input id="date" class="datepicker"  name="date" value="{{ $operations->date }}">
                                            <label for="date">Date d'achat</label>
                                            @error('date')
                                            <small class="red-text ml-7" role="alert">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="input-field col  s12">
                                            <input id="comment" type="text" name="comment" value="{{ $operations->comment }}">
                                            <label for="comment">Observations</label>
                                            @error('comment')
                                            <small class="red-text ml-7" role="alert">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="input-field col s12">
                                            <button type="submit" class="btn bcyan waves-effect waves-light right" type="submit">Enregistrer
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                @endif
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
@section('js')
@endsection
