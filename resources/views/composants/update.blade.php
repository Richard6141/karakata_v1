
@extends('layouts.app')

@section('content')

<div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Modification de composant</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/">Acceuil</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('composant.index')}}">Composants</a>
                        </li>
                        <li class="breadcrumb-item active">Modifier
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
                                <h5 class="ml-4 center">Modification d'un composant</h5>


                <form id="addForm" class="" action="{{ route('composant.updatecomposants', $composant->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="input-field col m6 s12" id="usercolumn" style="margin-top: 30px;">
                        <select name="typecomposant" id="typecomposant"> @foreach ($typecomposants as $item)
                            @if($composant->component_type_id== $item->id)
                            <option selected value="{{ $item->id }}"><span>{{ $item->label }}</span></option>
                            @else
                            <option value="{{ $item->id }}"><span>{{ $item->label }}</span></option>
                            @endif 
                            @endforeach
                        </select>
                    <label>Type composant</label> 
                    </div>
                    <div class="input-field col m6 s12">
                        <input id="label" name="label" value="{{ $composant->label }}" type="text"
                            class="@error('label') is-invalid @enderror" style="margin-top: 15px;">
                        <label for="label">Libellé</label>
                        @error('label')
                            <small class="red-text ml-7" role="alert">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>
                </div>
               
                <div class="row">
                    <div class="input-field col m6 s12">
                        <input id="description" name="description" class="@error('description') is-invalid @enderror"
                            type="text"  value="{{ $composant->description }}" type="text">
                        <label for="description">Description:</label>
                        @error('description')
                            <small class="red-text ml-7" role="alert">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col m6 s12 file-field input-field">
                        <div class="btn float-right">
                            <label for="image"></label>
                            <span>Image</span>
                            <input id="image" name="image" value="{{ $composant->image }}" type="file">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate @error('image') is-invalid @enderror" type="text">
                        </div>
                        @error('image')
                            <small class="red-text ml-7" role="alert">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <button type="submit" class="btn bcyan waves-effect waves-light right" type="submit">Enregistrer
                            <i class="material-icons right">send</i>
                        </button>
                    </div>

                <input type="text" name="file1" id="file1" hidden>
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
@section('js')
@endsection






















{{-- @extends('layouts.app')

@section('content')

<div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Modification de composant</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="index.html">Acceuil</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('composant.index')}}">Composant</a>
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
                                <h5 class="ml-4">Modifier</h5>


                                <form  class="" action="{{ route('composant.updatecomposants', $composant->id) }}" method="GET"
                enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="input-field col m6 s12" id="usercolumn" style="margin-top: 30px;">
                        <select name="typecomposant" id="typecomposant">
                            <option value="" selected>Choisissez le type composant</option>
                            @foreach ($typecomposants as $item)
                                <option value="{{ $item->id }}"><span>{{ $item->label }}</span></option>
                            @endforeach
                        </select>
                        <label>Type composant</label>
                    </div>
                    <div class="input-field col s12">
                        <input id="label" name="label" value="{{ $composant->label }}" type="text"
                            class="@error('label') is-invalid @enderror">
                        <label for="label">Libellé</label>
                        @error('label')
                            <small class="red-text ml-7" role="alert">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>
                </div>
                
            <div class="row">
                    <div class="input-field col s12">
                        <input id="description" name="description" class="@error('description') is-invalid @enderror"
                            type="text" placeholder="description" value="{{ $composant->description }}" type="text">
                        <label for="description">Description:</label>
                        @error('description')
                            <small class="red-text ml-7" role="alert">{{ $message }}</small>
                        @enderror
                    </div>
                
                <div class="col m6 s12 file-field input-field">
                    <div class="btn float-right">
                        <label for="image"></label>
                        <span>Image</span>
                        <input id="image" name="image" value="{{ $composant->image }}" type="file">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate @error('image') is-invalid @enderror" type="text">
                    </div>
                    @error('image')
                        <small class="red-text ml-7" role="alert">{{ $message }}</small>
                    @enderror
                </div>
            </div>

                <div class="row">
                    <div class="input-field col s12">
                        <button type="submit" class="btn bcyan waves-effect waves-light right" type="submit">Modifier
                            <i class="material-icons right">send</i>
                        </button>
                    </div>

                <input type="text" name="file1" id="file1" hidden>
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
@section('js')
@endsection
  --}}