@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
            <!-- Search for small screen-->
            <div class="container">
                <div class="row">
                    <div class="col s10 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Ajout d'un pack</span></h5>
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="/">Acceuil</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('pack.index') }}">Packs</a>
                            </li>
                            <li class="breadcrumb-item active">Ajout
                            </li>
                        </ol>
                    </div>
                    <a href="{{ backUrl() }}"
                        class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 right">RETOUR</a>

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
                                    <form id="addForm" class="" action="{{ route('pack.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="input-field col  s12" id="usercolumn" style="margin-top: 30px;">
                                            <select name="type_pack_id" id="type_pack_id">
                                                <option value="" selected
                                                    class="@error('type_pack_id') is-invalid @enderror">Choisissez le type de pack</option>
                                                @foreach ($typepack as $item)
                                                    <option value="{{ $item->id }}"><span>{{ $item->label }}</span>
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label>Type Pack</label>
                                            @error('type_pack_id')
                                                <small class="red-text ml-7" role="alert">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        </div>
                                        <div class="input-field col m12 s12">
                                            <select name="component_type_id[]"
                                                class="@error('component_type_id') is-invalid @enderror" multiple>
                                                @foreach ($typecomponent as $item)
                                                    <option value="{{ $item->id }}"><span>{{ $item->label }}</span>
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label style="color: black; font-size: 100%;">Choisissez le (s) composant(s)</label>
                                            @error('component_type_id')
                                                <small class="red-text ml-7" role="alert">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        </div>

                                        {{-- <div class="input-field col m6 s12">
                                        <input id="label" name="label" value="" type="text" class="@error('code') is-invalid @enderror">
                                        <label for="label" class="center-align" style="color:black;">Libellé :</label>
                                        @error('label')
                                        <small class="red-text ml-7" role="alert">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div> --}}
                                        <div class="input-field col m6 s12" id="usercolumn">

                                            <label for="price" class="center-align" style="color:black;">Prix :</label>
                                            <input id="price" name="price" value="" type="number"
                                                class="@error('price') is-invalid @enderror">
                                            @error('price')
                                                <small class="red-text ml-7" role="alert">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        </div>
                                        {{-- <div class="input-field col m6 s12">
                                            <input type="date" class="" id="publish_date" name="date"
                                                value="" min=""
                                                class=" datepiker @error('publish_date') is-invalid @enderror">
                                            <label for="publish_date">Date de publication:</label>
                                            @error('publish_date')
                                                <small class="red-text ml-7" role="alert">{{ $message }}</small>
                                            @enderror
                                        </div> --}}
                                        <div class="col m6 s12 file-field input-field">
                                            <div class="btn float-right">
                                                <label for="image"></label>
                                                <span>Image</span>
                                                <input id="image" name="image" type="file">
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input name="image"
                                                    class="file-path validate @error('image') is-invalid @enderror"
                                                    type="text">
                                            </div>
                                            @error('image')
                                                <small class="red-text ml-7" role="alert">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="row margin">

                                            <div class="row">

                                            </div>


                                            <div class="row">



                                            </div>
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <button type="submit" class="btn bcyan waves-effect waves-light right"
                                                        type="submit">Enregistrer
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
