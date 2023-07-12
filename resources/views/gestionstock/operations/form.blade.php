@extends('layouts.app')

@section('content')

<div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Enregistrement d'une opération</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/">Acceuil</a>
                        </li>
                        @if($typeOfOperation->label == 'Entrée')
                        <li class="breadcrumb-item"><a href="/operations/entree">Opération</a></li>
                        @endif
                        @if($typeOfOperation->label == 'Sortie')
                        <li class="breadcrumb-item"><a href="/operations/sortie">Opération</a></li>
                        @endif
                        @if($typeOfOperation->label == 'Inventaire')
                        <li class="breadcrumb-item"><a href="/operations/inventaire">Opération</a></li>

                        @endif
                        <li class="breadcrumb-item active">{{$typeOfOperation->label}}
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
                            @if (auth()->user()->hasRole('ADMINISTRATEUR') || auth()->user()->hasRole('CUISINIER'))
                            <div class="card-content">
                                {{-- <h5 class="ml-4 center">Enregistrement d'un produit</h5> --}}
                                <form id="addForm" class="" action="{{ route('operations.create') }}" method="POST">
                                    @csrf
                                    @if($typeOfOperation->label == 'Entrée')
                                    <div class="row margin">
                                        <div class="input-field col m6 s12">
                                            <select name="product_id" id="product_id">
                                                <option value=""></option>
                                                @foreach ($products as $index)
                                                <option value="{{$index->id}}">{{$index->label}}</option>
                                                @endforeach
                                            </select>
                                            <label for="product_id" class="center-align" style="color:black;">Produit :</label>

                                            @error('product_id')
                                            <small class="red-text ml-7" role="alert">
                                                {{ $message }}
                                            </small>i gbo
                                            @enderror
                                        </div>
                                        <input name="operation_type_id" value="{{$typeOfOperation->id}}" type="hidden">
                                        <div class="input-field col m6 s12">
                                            <input id="label" name="label" value="{{ old('label') }}" type="text" class="@error('code') is-invalid @enderror">
                                            <label for="label" class="center-align" style="color:black;">Libellé de l'opération :</label>
                                            @error('label')
                                            <small class="red-text ml-7" role="alert">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                        <div class="input-field col m6 s12" id="price_field">
                                            <input id="price" name="price" value="{{ old('price') }}" type="number" class="@error('code') is-invalid @enderror">
                                            <label for="price" class="center-align" style="color:black;">Prix :</label>
                                            @error('price')
                                            <small class="red-text ml-7" role="alert">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                        <div class="input-field col m6 s12">
                                            <input id="quantity" name="quantity" value="{{ old('quantity') }}" type="number" class="@error('code') is-invalid @enderror">
                                            <label id="quantity_label" for="quantity" class="center-align" style="color:black;">Quantité :</label>
                                            @error('quantity')
                                            <small class="red-text ml-7" role="alert">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                        <div class="input-field col m6 s12">
                                            <input id="dateOfOperation" name="dateOfOperation" max="{{$date}}" value="{{ old('dateOfOperation') }}" type="date" class="@error('code') is-invalid @enderror">
                                            <label for="dateOfOperation" class="center-align" style="color:black;">Date :</label>
                                            @error('dateOfOperation')
                                            <small class="red-text ml-7" role="alert">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>

                                        <div class="input-field col m6 s12" id="observation_field">
                                            <input id="observation" name="observation" value="{{ old('observation') }}" type="text" class="@error('code') is-invalid @enderror">
                                            <label for="observation" class="center-align" style="color:black;">Observations</label>
                                            @error('observation')
                                            <small class="red-text ml-7" role="alert">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>

                                    </div>
                                    @else
                                    <div class="row margin">
                                        <div class="input-field col s12">
                                            <select name="product_id" id="product_id">
                                                <option value=""></option>
                                                @foreach ($products as $index)
                                                <option value="{{$index->id}}">{{$index->label}}</option>
                                                @endforeach
                                            </select>
                                            <label for="product_id" class="center-align" style="color:black;">Produit :</label>

                                            @error('product_id')
                                            <small class="red-text ml-7" role="alert">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                        <input name="operation_type_id" value="{{$typeOfOperation->id}}" type="hidden">
                                        <div class="input-field col m6 s12">
                                            <input id="label" name="label" value="{{ old('label') }}" type="text" class="@error('code') is-invalid @enderror">
                                            <label for="label" class="center-align" style="color:black;">Libellé de l'opération :</label>
                                            @error('label')
                                            <small class="red-text ml-7" role="alert">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                        @if ($typeOfOperation->label == 'Sortie')
                                        <div class="input-field col m6 s12">
                                            <input id="quantity" name="quantity" value="{{ old('quantity') }}" type="number" class="@error('code') is-invalid @enderror">
                                            <label id="quantity_label" for="quantity" class="center-align" style="color:black;">Quantité :</label>
                                            @error('quantity')
                                            <small class="red-text ml-7" role="alert">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                        @else
                                        <div class="input-field col m6 s12">
                                            <input id="quantity" name="quantity" value="{{ old('quantity') }}" type="number" class="@error('code') is-invalid @enderror">
                                            <label id="quantity_label" for="quantity" class="center-align" style="color:black;">Stock réel :</label>
                                            @error('quantity')
                                            <small class="red-text ml-7" role="alert">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                        @endif
                                        <div class="input-field col m6 s12">
                                            <input id="dateOfOperation" name="dateOfOperation" max="{{$date}}" value="{{ old('dateOfOperation') }}" type="date" class="@error('code') is-invalid @enderror">
                                            <label for="dateOfOperation" class="center-align" style="color:black;">Date :</label>
                                            @error('dateOfOperation')
                                            <small class="red-text ml-7" role="alert">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>

                                        <div class="input-field col m6  s12" id="observation_field">
                                            <input id="observation" name="observation" value="{{ old('observation') }}" type="text" class="@error('code') is-invalid @enderror">
                                            <label for="observation" class="center-align" style="color:black;">Observations</label>
                                            @error('observation')
                                            <small class="red-text ml-7" role="alert">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>

                                    </div>
                                    @endif
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


{{-- page script --}}
@section('scripts')
<script src="{{ asset('js/scripts/page-users.js') }}"></script>
<script>
    $(document).ready(function() {
        $(document).on('change', '#typeOfOperation_id', function() {
            var TypeOfOperation = $(this).find(':selected').attr('data-id')
            var label = document.querySelector('#quantity_label')
            var price_field = document.querySelector('#price_field');
            var observation_field = document.querySelector('#observation_field');
            if (TypeOfOperation == 'Inventaire') {
                label.innerHTML = 'Stock réel :'
                price_field.style.display = 'none';
                observation_field.classList.add('m6');
                // $( "#price" ).attr('value') = 'Null'
            }
            if (TypeOfOperation == 'Entrée') {
                label.innerHTML = 'Quantité :'
                price_field.style.display = 'block';
                observation_field.classList.remove('m6');
            }
            if (TypeOfOperation == 'Sortie') {
                label.innerHTML = 'Quantité :'
                price_field.style.display = 'none';
                observation_field.classList.add('m6');
                // $( "#price" ).attr('value') = 'Null'
            }
        })
    })
</script>
@endsection