@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
            <!-- Search for small screen-->
            <div class="container">
                <div class="row">
                    <div class="col s10 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Ajout d'un menu</span></h5>
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="/">Acceuil</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('allmenus') }}">Menu</a>
                            </li>

                            <li class="breadcrumb-item active">Ajout
                            </li>
                        </ol>
                    </div>
                    <a href="{{ backUrl() }}"
                        class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-1 right"
                        style="">RETOUR</a>

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

                                    <form id="formcommande" class="" action="{{ route('storemenus') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <fieldset class="scheduler-border" style="" id="cardrecep">
                                            <legend class="scheduler-border-limite">Pack</legend>
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <div class="control-group">
                                                        <section id="lesDoc">
                                                            <div class="form-group form-row" id="doc">
                                                                <div class="col-sm-2" style="float: right">
                                                                    <a id="ajouterDoc" type="button" href="javascript:;" class="btn-floating"
                                                                        style="background-color: blue">
                                                                        <i class="material-icons tooltipped" data-position="top" data-tooltip="Ajouter">add</i>
                                                                    </a>
                                                                </div>

                                                                <fieldset class="scheduler-border">

                                                                    <div class="form-row">
                                                                        <div class="input-field col m6 s6">
                                                                            <select class="browser-default" name="pack[]" id="pack" required>
                                                                                <option value="">Pack</option>
                                                                                {{-- <option class=""
                                                                                    style="background-color: rgb(114, 200, 114); color: white; text-align: center"
                                                                                    value="" data-id="Nouveau">
                                                                                    Nouveau</option> --}}
                                                                                @foreach ($packs as $item)
                                                                                    <option {{ old('pack') == $item->id ? "selected" : "" }} value="{{ $item->id }}"
                                                                                        @if ($packselectionne) {{ $item->id == $packselectionne->id ? 'selected' : '' }} @endif
                                                                                        data-price="{{ $item->price }}"
                                                                                        data-label="{{ $item->paquetType->label }}"
                                                                                        data-typepack="{{ $item->paquet_type_id }}">
                                                                                        {{ $item->paquetType->label }} | {{ $item->price }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                            @error('pack')
                                                                                <small class="red-text ml-7" role="alert">
                                                                                    {{ $message }}
                                                                                </small>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="col-md-12"
                                                                            style=""
                                                                            id="blockdetailpack">
                                                                            <div class="control-group">
                                                                                {{-- <div class="input-field col s6">
                                                                                    <input id="price" name="price"
                                                                                        value="{{ $packselectionne ? $packselectionne->price : '' }}"
                                                                                        disabled placeholder="Prix" type="text"
                                                                                        class="@error('price') is-invalid @enderror">
                                                                                    @error('price')
                                                                                        <small class="red-text ml-7" role="alert">
                                                                                            {{ $message }}
                                                                                        </small>
                                                                                    @enderror

                                                                                </div> --}}
                                                                                <div class="input-field col s6">
                                                                                    <input id="price" name="price[]" required
                                                                                        value=""
                                                                                         placeholder="Prix" type="number"
                                                                                        class="@error('price') is-invalid @enderror">
                                                                                    {{-- <label for="price">Prix</label> --}}
                                                                                    @error('price')
                                                                                        <small class="red-text ml-7" role="alert">
                                                                                            {{ $message }}
                                                                                        </small>
                                                                                    @enderror

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </fieldset>
                                                            <br>
                                                        </section>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset><br>

                                        <div  style="" class="" id="blockcomposant">
                                            <fieldset class="scheduler-border" style="" id="">
                                                <legend class="scheduler-border-limite">Composants</legend>
                                                <div class="form-row">
                                                    <div class="input-field col m6 s6" id="blockentree">
                                                        <select class="browser-default" name="entree" id="entree">
                                                            <option value="">Entrée</option>
                                                            @foreach ($entree as $item)
                                                                <option {{ old('entree') == $item->id ? "selected" : "" }} value="{{ $item->id }}">
                                                                    {{ $item->label }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('entree')
                                                            <small class="red-text ml-7" role="alert">
                                                                {{ $message }}
                                                            </small>
                                                        @enderror
                                                    </div>
                                                    <div class="input-field col m6 s6" id="dessertblock">
                                                        <select class="browser-default" name="dessert" id="dessert">
                                                            <option value="">Desert</option>
                                                            @foreach ($dessert as $item)
                                                                <option {{ old('dessert') == $item->id ? "selected" : "" }}  value="{{ $item->id }}">
                                                                    {{ $item->label }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('dessert')
                                                            <small class="red-text ml-7" role="alert">
                                                                {{ $message }}
                                                            </small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="input-field col m6 s6" id="boissonblock">
                                                        <select class="browser-default" name="boisson" id="boisson">
                                                            <option value="">Boisson</option>
                                                            @foreach ($boisson as $item)
                                                                <option {{ old('boisson') == $item->id ? "selected" : "" }}  value="{{ $item->id }}">
                                                                    {{ $item->label }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('boisson')
                                                            <small class="red-text ml-7" role="alert">
                                                                {{ $message }}
                                                            </small>
                                                        @enderror
                                                    </div>
                                                    <div class="input-field col m6 s6" id="">
                                                        <select class="browser-default" name="accompagnement" id="accompagnement">
                                                            <option value="">Accompagnement</option>
                                                            @foreach ($accompagnement as $item)
                                                                <option {{ old('accompagnement') == $item->id ? "selected" : "" }} value="{{ $item->id }}">
                                                                    {{ $item->label }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('accompagnement')
                                                            <small class="red-text ml-7" role="alert">
                                                                {{ $message }}
                                                            </small>
                                                        @enderror
                                                    </div>
                                                    <div class="input-field col m6 s6">
                                                        <select name="resistance[]"
                                                            class="@error('resistance') is-invalid @enderror" multiple>
                                                            @foreach ($resistance as $user)
                                                                <option @if (old('resistance')) @foreach (old('resistance') as $item2) {{ $item2 == $user->id ? "selected" : "" }} @endforeach @endif  value="{{ $user->id }}">{{ $user->label }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <label style="color: black; font-size: 100%;">&nbsp;&nbsp;&nbsp;Résistance</label>
                                                        @error('resistance')
                                                            <small class="red-text ml-7" role="alert">
                                                                {{ $message }}
                                                            </small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </fieldset><br>
                                        </div>
                                        <fieldset class="scheduler-border" style="" id="autre">
                                            <legend class="scheduler-border-limite">Autres</legend>
                                            <div class="form-row">
                                                <div class="col-md-12"
                                                    style=""
                                                    id="blockdetailpack">
                                                    <div class="control-group">
                                                        <div class="input-field col s6">
                                                            <input id="date" name="date"
                                                                value="{{old('date')}}" min="{{ $datemin }}"
                                                                 placeholder="Date menu" type="date"
                                                                class="@error('date') is-invalid @enderror">
                                                            {{-- <label for="price">Prix</label> --}}
                                                            @error('date')
                                                                <small class="red-text ml-7" role="alert">
                                                                    {{ $message }}
                                                                </small>
                                                            @enderror

                                                        </div>

                                                        <div class="input-field col s6">
                                                            <div class="switch">
                                                                <label>
                                                                    <input type="checkbox" id="" name="activemenutoday"
                                                                        {{ old('activemenutoday') == "on" ? 'checked' : '' }}
                                                                        >
                                                                    <span class="lever"></span>
                                                                </label>Voulez-vous publier le menu ?
                                                            </div>
                                                            @error('activemenutoday')
                                                                <small class="red-text ml-7" role="alert">
                                                                    {{ $message }}
                                                                </small>
                                                            @enderror

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset><br>
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <button id="" type="submit"
                                                    class="btn bcyan waves-effect waves-light right"
                                                    type="submit">Enregistrer
                                                    <i class="material-icons right">send</i>
                                                </button>
                                                <button id="saveBtnCommande" type="submit" form="formcommande"
                                                    style="display: none"></button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="" style="display: none">
                                        <a id="btnCarnetAdresse"
                                            class="btn-floating  waves-effect waves-light breadcrumbs-btn right mr-1 mb-1 modal-trigger btn-large"
                                            href="#modalCarnet"><i class="material-icons tooltipped" data-position="top"
                                                data-tooltip="Ajouter">add</i></a>
                                    </div>
                                    @include('menu.addPack')
                                    @include('menu.constituant')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="content-overlay"></div>
            <div class="" style="display: none">
                <button id="alerterror" type="button" class="btn bcyan waves-effect waves-light right">Enregistrer
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @include('menu.js')
@endsection
