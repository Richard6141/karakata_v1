@extends('layouts.app')

@section('content')

<div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    {{-- <h5 class="breadcrumbs-title mt-0 mb-0"><span>Enregistrement des opérations pour empaquetage</span></h5> --}}
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/">Acceuil</a>
                        </li>
                        <li class="breadcrumb-item active">Empaquetage</li>
                        <li class="breadcrumb-item"><a href="{{route('empaquetage')}}">Opérations</a>
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
                                <h5 class="ml-4">Enregistrement d'une opération</h5><form class="login-form" method="POST" action="{{ route('operations.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <input type="hidden" name="status" value="1">
                                        <!-- <input type="hidden" name="appartenance" value="Cuisine"> -->
                                        <div class="input-field">
                                            <select name="produit_id" id="produit_id">
                                                <option value="" selected>Choississez le produit</option>
                                                @foreach ($produits as $item)
                                                    <option value="{{ $item->id }}"><span>{{ $item->label }}</span></option>
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
                                            <input id="quantite" type="number" name="quantite" value="{{ old('quantite') }}">
                                            <label for="quantite">Quantité</label>
                                            @error('quantite')
                                            <small class="red-text ml-7" role="alert">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                        <div class="input-field col m6 s12">
                                            <input id="prix" type="number" name="prix" value="{{ old('prix') }}" required>
                                            <label for="prix">Prix unitaire</label>
                                            @error('prix')
                                            <small class="red-text ml-7" role="alert">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col m6 s12">
                                            <input id="date" max="{{ $date }}" type="date" type="text" name="date" value="{{ old('date') }}">
                                            <label for="date">Date d'achat</label>
                                            @error('date')
                                            <small class="red-text ml-7" role="alert">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                        <input type="hidden" name="domaine_id" value="{{ $domaine->id }}">
                                        <div class="input-field col m6 s12">
                                            <input id="comment" type="text" name="obervations">
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

