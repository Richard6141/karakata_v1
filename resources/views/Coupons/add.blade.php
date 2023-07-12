@extends('layouts.app')

@section('content')

<div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Enregistrement d'un coupon</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/">Acceuil</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('coupon.clients') }}">Coupons</a>
                        </li>
                        <li class="breadcrumb-item active">Ajout
                        </li>
                    </ol>
                </div>
                <a href="{{backUrl()}}" class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 right tooltipped" data-tooltip="Retour">RETOUR</a>
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
                            <form id="theForm">
                                <div class="col s12 m6 l3">
                                    <label for="phonetosearch">Numéro du client</label>
                                    <input type="tel" name="phoneforsearch" id="phoneforsearch">
                                </div>
                                <div onclick="reseach()" class="display-flex align-items-center show-btn" style="width:40px">
                                    <a class="btn-floating  waves-effect waves-light breadcrumbs-btn right mr-1 mb-1 modal-trigger btn-small">
                                        <i class="material-icons tooltipped" data-position="top" data-tooltip="Rechercher">search</i>
                                    </a>
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
                                <h5 class="ml-4 center">Générer des coupons</h5>

                                <form id="addForm" class="" action="{{ route('coupon.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <fieldset class="scheduler-border" id="particular">
                                        <legend class="scheduler-border-limite">Informations du client</legend>
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <div class="control-group">
                                                    <div class="row">
                                                        <div class="input-field col m6 s12" style="display: flex; align-items: center;">
                                                            <div style="width: 35%;">Nom du client / Raison sociale :</div>
                                                            <input name="nonduclient1" id="nonduclient1" value="{{ old('nonduclient1') }}" style="width: 65%; margin-top: 10px; outline:1px solid white !important; border:none" type="text">
                                                        </div>
                                                        <div class="input-field col m6 s12" style="display: flex; align-items: center;">
                                                            <div style="width: 20%;">Prénom du client :</div>
                                                            <input name="prenomduclient1" id="prenomduclient1" value="{{ old('prenomduclient1') }}" style="width: 80%; margin-top: 10px; outline:1px solid white !important; border:none" type="text">
                                                        </div>
                                                        <div class="input-field col m6 s12" style="display: flex; align-items: center;">
                                                            <div style="width: 20%;">Numéro du client :</div>
                                                            <input name="phoneduclient1" id="phoneduclient1" value="{{ old('phoneduclient1') }}" style="width: 80%; margin-top: 10px; outline:1px solid white !important; border:none" type="text">
                                                        </div>
                                                        <div class="input-field col m6 s12" style="display: flex; align-items: center;">
                                                            <div style="width: 17%;">Email du client :</div>
                                                            <input name="emailduclient1" id="emailduclient1" value="{{ old('emailduclient1') }}" style="width: 83%; margin-top: 10px; outline:1px solid white !important; border:none" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <!-- <fieldset class="scheduler-border" id="company" style="display: none;">
                                    <legend class="scheduler-border-limite">Informations du client</legend>
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <div class="control-group">
                                                <div class="row">
                                                    <div class="input-field col m6 s12" style="display: flex; align-items: center;">
                                                        <div style="width: 17%;">Raison sociale :</div>
                                                        <input name="nonduclient2" id="nonduclient2" value="{{ old('nonduclient2') }}" style="width: 83%; margin-top: 10px; outline:1px solid white !important; border:none" type="text">
                                                    </div>
                                                    <div class="input-field col m6 s12" style="display: flex; align-items: center;">
                                                        <div style="width: 20%;">Numéro du client :</div>
                                                        <input name="phoneduclient2" id="phoneduclient2" value="{{ old('phoneduclient2') }}" style="width: 80%; margin-top: 10px; outline:1px solid white !important; border:none" type="text">
                                                    </div>
                                                    <div class="input-field col m6 s12" style="display: flex; align-items: center;">
                                                        <div style="width: 17%;">Email du client :</div>
                                                        <input name="emailduclient2" id="emailduclient2" value="{{ old('emailduclient2') }}" style="width: 83%; margin-top: 10px; outline:1px solid white !important; border:none" type="text">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset> -->

                                    <fieldset class="scheduler-border" style="margin-top:3%">
                                        <legend class="scheduler-border-limite">Coupon</legend>
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <div class="control-group">
                                                    <div class="row">
                                                        <div class="row margin">
                                                            <div class="input-field col m6 s12" id="usercolumn">
                                                                <select name="coupon_value" id="pack" value="{{ old('coupon_value') }}">
                                                                    <option value="" class="@error('pack') is-invalid @enderror" selected>Choisissez le prix du coupon</option>
                                                                    @foreach ($prices as $price)
                                                                    @if (old('coupon_value') == $price)
                                                                    <option value="{{ $price }}" selected><span>{{ $price }}</span></option>
                                                                    @else
                                                                    <option value="{{ $price }}"><span>{{ $price }}</span></option>
                                                                    @endif
                                                                    @endforeach
                                                                </select>
                                                                <label>Prix coupon</label>
                                                                @error('pack')
                                                                <small class="red-text ml-7" role="alert">
                                                                    {{ $message }}
                                                                </small>
                                                                @enderror
                                                            </div>
                                                            <div class="input-field col m6 s12">
                                                                <input id="nombre" type="number" name="nombre" value="{{ old('nombre') }}">
                                                                <label for="nombre" class="center-align" style="color:black;">Nombre :</label>
                                                                @error('nombre')
                                                                <small class="red-text ml-7" role="alert">
                                                                    {{ $message }}
                                                                </small>
                                                                @enderror
                                                            </div>
                                                            <div class="input-field col m6 s12">
                                                                <input type="tel" name="phone" value="{{ old('phone') }}">
                                                                <label for="numero" class="center-align" style="color:black;">Numéro de téléphone :</label>
                                                                @error('phone')
                                                                <small class="red-text ml-7" role="alert">
                                                                    {{ $message }}
                                                                </small>
                                                                @enderror
                                                            </div>
                                                            <div class="input-field col m6 s12" id="champemail">
                                                                <input type="email" name="email" id="email" value="{{ old('email') }}">
                                                                <label for="email" class="center-align" style="color:black;">Email :</label>
                                                                @error('email')
                                                                <small class="red-text ml-7" role="alert">
                                                                    {{ $message }}
                                                                </small>
                                                                @enderror
                                                            </div>
                                                            <div class="input-field col  s12">
                                                                <input id="date_expiration" name="date_expiration" value="{{ old('date_expiration') }}" type="date" min="{{ $date }}" class="@error('date_expiration') is-invalid @enderror" value="{{ old('date_expiration') }}">
                                                                <label for="date_expiration" class="center-align" style="color:black;">Date d'expiration :</label>
                                                                @error('date_expiration')
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
                                        <input type="hidden" name="customer_id" value="{{ old('customer_id') }}">
                                        <div class="input-field col s12">
                                            <button type="submit" class="btn bcyan waves-effect waves-light right" type="submit">Générer
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