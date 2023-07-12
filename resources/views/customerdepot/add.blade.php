@extends('layouts.app')

@section('content')
<div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Ajout d'une suggestion</span></h5>
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
            <section class="users-list-wrapper section">
                <div class="users-list-filter">
                    <div class="card-panel">
                        <div class="row">
                            <div class="col s12 m6 l3">

                            </div>
                            <div class="col s12 m6 l3">

                            </div>
                            <form action="{{ route('customerdepot.seach') }}" method="POST">
                                @csrf
                                <div class="col s12 m6 l3">
                                    <label style="color: black" for="users-list-status">Rechercher le customer</label>
                                    <div class="input-field">
                                        <input type="text" name="phone" id="phone" placeholder="Le numéro du customer">
                                    </div>
                                </div>
                                <div class="col s12 m6 l3 display-flex align-items-center show-btn">
                                    <button type="submit" id="seachbtn" class="btn btn-block indigo waves-effect waves-light">
                                        <i class="material-icons tooltipped" data-position="top" data-tooltip="Rechercher">add</i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </section>
            <div class="section">
                <div class="card">
                    <div class="col s12 m12 l12">
                        <div id="Form-advance" class="card card card-default scrollspy">
                            <div class="card-content">
                                <form class="login-form" method="POST" action="{{ route('customerdepot.store') }}" id="formsuggestion">
                                    @csrf
                                    <fieldset class="scheduler-border">
                                        <legend class="scheduler-border-limite">Client</legend>
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <div class="control-group">
                                                    <div class="row center">
                                                    <input id="customer_id" type="hidden" name="customer_id" value="{{ $customer ? $customer->id : '' }}">
                                                        <div class="input-field col m4 s12">
                                                        <!-- <label for="name" style="color: black">name</label> -->
                                                            <span><strong>  <h6>{{ $customer->particular->name ?? ''}} {{ $customer->particular->firstname ?? '' }} {{ $customer->company->name ?? ''}}  {{ $customer->company->firstname ?? '' }}</h6></strong> </span>
                                                            <!-- <input id="name" type="text" name="name" value="" desabled> -->
                                                            @error('name')
                                                            <small class="red-text ml-7" role="alert">
                                                                {{ $message }}
                                                            </small>
                                                            @enderror
                                                        </div>
                                                            <div class="input-field col m4 s12">
                                                                <span><h6>Téléphone : {{ $customer ? $customer->phone : '' }}</h6>  </span>
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

                                    </fieldset>

                                    <fieldset class="scheduler-border">
                                        <legend class="scheduler-border-limite">Dépôt</legend>
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <div class="control-group">
                                                    <div class="row">
                                                        <!--  -->
                                                        
                                                        <div class="input-field col m4 s12">
                                                            <input id="amount" type="number" name="amount" value="{{ old('amount') }}">
                                                            <label style="color: black" for="firstname">Montant</label>
                                                            @error('amount')
                                                            <small class="red-text ml-7" role="alert">
                                                                {{ $message }}
                                                            </small>
                                                            @enderror
                                                        </div>

                                                        <div class="input-field col m4 s12">
                                                            <input id="date" type="date" name="date"  value="{{ old('date') }}">
                                                            <label style="color: black" for="date">Date</label>
                                                            @error('date')
                                                            <small class="red-text ml-7" role="alert">
                                                                {{ $message }}
                                                            </small>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                    <div class="input-field col s4">
                                                            <select class="browser-default" name="payement_mode" id="payement_mode">
                                                                <option value="{{ old('payement_mode') }}">Mode de paiement</option>
                                                                @foreach ($payement_modes as $item)
                                                                <option value="{{ $item->id }}">
                                                                    {{ $item->label }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                            @error('payement_modes')
                                                            <small class="red-text ml-7" role="alert">
                                                                {{ $message }}
                                                            </small>
                                                            @enderror
                                                        </div>

                                                        <div class="input-field col s4">
                                                        <input id="description" type="text" name="description"  value="{{ old('description') }}">
                                                            <label style="color: black" for="date">Description</label>
                                                            @error('description')
                                                            <small class="red-text ml-7" role="alert">
                                                                {{ $message }}
                                                            </small>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </fieldset>

                                     
                                    
                                    
                                    


                                    <div class="row">
                                        <div class="input-field col s12">
                                            <button  class="btn bcyan waves-effect waves-light right" type="submit">Enregistrer
                                                <i class="material-icons right">send</i>
                                            </button>
                                            <button id="saveBtnsuggestion" type="submit" form="formsuggestion" style="display: none"></button>
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
