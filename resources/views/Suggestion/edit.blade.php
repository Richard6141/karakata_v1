@extends('layouts.app')

@section('content')
<div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Modification d'une Suggestion</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/">Acceuil</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('suggestion.index')}}">Suggestions</a>
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
                            <h5 class="center">
                            Modification
                        </h5>
                                <form class="login-form" method="POST" action="{{ route('suggestion.update', $Suggestion->id) }}" >
                                    @csrf
                                    <fieldset class="scheduler-border">
                                        <legend class="scheduler-border-limite">customer</legend>
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <div class="control-group">
                                                    <div class="row">
                                                    <input id="customers_id" type="hidden" name="customers_id" value="{{ $Suggestion->customers_id ?? '' }}">

                                                        <div class="input-field col m4 s12">
                                                            <!-- <input id="name" type="text" name="name" value="{{$Suggestion->customer->name ?? '' }}" desabled>
                                                            <label for="name" style="color: black">name</label> -->
                                                            <span style="color: black"> {{ $name->name?? ''}} {{ $name->firstname ?? '' }}</span>
                                                            @error('name')
                                                            <small class="red-text ml-7" role="alert">
                                                                {{ $message }}
                                                            </small>
                                                            @enderror
                                                        </div>
                                                        <div class="input-field col m4 s12">
                                                            <!-- <input id="firstname" type="text" name="firstname" value="Bonjour" desabled>
                                                            <label style="color: black" for="firstname">Préname</label> -->
                                                            <span style="color: black">{{$Suggestion->customer->firstname ?? ''  }}</span>
                                                            @error('firstname')
                                                            <small class="red-text ml-7" role="alert">
                                                                {{ $message }}
                                                            </small>
                                                            @enderror
                                                        </div>
                                                        <div class="row">
                                                            <div class="input-field col m4 s12">
                                                                <!-- <input id="phone" type="tel" name="phone" value="{{$Suggestion->customer->phone ?? ''  }}" desabled>
                                                                <label style="color: black" for="phone">Téléphone</label> -->
                                                                <span style="color: black">Téléphone : {{$Suggestion->customer->phone ?? ''  }}</span>
                                                                @error('phone')
                                                                <small class="red-text ml-7" role="alert">
                                                                    {{ $message }}
                                                                </small>
                                                                @enderror
                                                            </div>

                                                        </div>

                                                    </div>


                                                </div>
                                            </div>
                                        </div>

                                    </fieldset>

                                    <fieldset class="scheduler-border">
                                        <legend class="scheduler-border-limite">Suggestion</legend>
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <div class="control-group">
                                                    <div class="row">
                                                        <!--  -->

                                                        <div class="input-field col m4 s12">
                                                            <input id="preference" type="text" name="preference" value="{{$Suggestion ->preference}}">
                                                            <label style="color: black" for="firstname">Suggestion</label>
                                                            @error('preference')
                                                            <small class="red-text ml-7" role="alert">
                                                                {{ $message }}
                                                            </small>
                                                            @enderror
                                                        </div>

                                                        <div class="input-field col m4 s12">
                                                            <input id="date" type="date" name="date" value="{{$Suggestion ->date}}">
                                                            <label style="color: black" for="date">Date</label>
                                                            @error('date')
                                                            <small class="red-text ml-7" role="alert">
                                                                {{ $message }}
                                                            </small>
                                                            @enderror
                                                        </div>
                                                        <div class="row">
                                                        <div class="input-field col s4">
                                                            <select class="browser-default" name="sources" >
                                                                <option>Choisissez la source</option>
                                                                @foreach ($sources as $item)
                                                                @if($Suggestion->sources_id == $item->id)
                                                                <option selected value="{{ $item->id }}"><span>{{ $item->label }}</span></option>
                                                                @else
                                                                <option value="{{ $item->id }}">
                                                                    {{ $item->label }}
                                                                </option>
                                                                @endif
                                                                @endforeach
                                                            </select>
                                                            @error('source_commande')
                                                            <small class="red-text ml-7" role="alert">
                                                                {{ $message }}
                                                            </small>
                                                            @enderror
                                                        </div>

                                                        </div>

                                                    </div>


                                                </div>
                                            </div>
                                        </div>

                                    </fieldset>







                                    <div class="row">
                                        <div class="input-field col s12">
                                            <button id="editBtnsuggestion" type="submit" class="btn bcyan waves-effect waves-light right" type="submit">Enregistrer
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
        <div class="content-overlay"></div>
    </div>


</div>
@endsection
@section('scripts')
@include('Suggestion.js')
@endsection
