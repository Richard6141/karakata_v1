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
                        <li class="breadcrumb-item"><a href="{{ route('coupon.clients') }}">Coupon</a>
                        </li>
                        <li class="breadcrumb-item active">Editer
                        </li>
                    </ol>
                </div>
                <a href="{{backUrl()}}" class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 right tooltipped" data-tooltip="Retour">RETOUR</a>
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
                                <h5 class="ml-4 center">Modification de coupons</h5>
                                @if ($customer->particulars_id != null && $customer->companies_id == null)
                                <fieldset class="scheduler-border" id="particular">
                                    <legend class="scheduler-border-limite">Informations du client</legend>
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <div class="control-group">
                                                <div class="row">
                                                    <div class="input-field col m6 s12" style="display: flex;">
                                                        <span>Nom du client : </span> <span id="nonduclient1">{{$client_info->name}}</span>
                                                    </div>
                                                    <div class="input-field col m6 s12">
                                                        <span>Prénom du client : </span> <span id="prenomduclient1">{{$client_info->firstname}}</span>
                                                    </div>
                                                    <div class="input-field col m6 s12">
                                                        <span>Numéro du client : </span> <span id="phoneduclient1">{{$customer->phone}}</span>
                                                    </div>
                                                    <div class="input-field col m6 s12">
                                                        <span>Email du client : </span> <span id="emailduclient1">{{$customer->email}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                @endif
                                @if ($customer->particulars_id == null && $customer->companies_id != null)
                                <fieldset class="scheduler-border" id="company">
                                    <legend class="scheduler-border-limite">Informations du client</legend>
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <div class="control-group">
                                                <div class="row">
                                                    <div class="input-field col m6 s12">
                                                        <span>Raison sociale :</span> <span id="nonduclient2">{{$client_info->socialreason}}</span>
                                                    </div>
                                                    <div class="input-field col m6 s12">
                                                        <span>Numéro du client :</span> <span id="phoneduclient2">{{$customer->phone}}</span>
                                                    </div>
                                                    <div class="input-field col m6 s12">
                                                        <span>Email du client :</span> <span id="emailduclient2">{{$customer->email}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                @endif
                                <form id="addForm" class="" action="{{ route('edit.save') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
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
                                                                    @if ($price == $coupon->price)
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
                                                            <div class="input-field col m6 s12" style="display: none;">
                                                                <input type="tel" name="phone" value="{{$customer->phone}}">
                                                                <label for="numero" class="center-align" style="color:black;">Numéro de téléphone :</label>
                                                                @error('numero')
                                                                <small class="red-text ml-7" role="alert">
                                                                    {{ $message }}
                                                                </small>
                                                                @enderror
                                                            </div>
                                                            <div class="input-field col m6 s12" id="champemail" style="display: none;">
                                                                <input type="email" name="email" id="email" value="{{$customer->email}}">
                                                                <label for="email" class="center-align" style="color:black;">Email :</label>
                                                                @error('email')
                                                                <small class="red-text ml-7" role="alert">
                                                                    {{ $message }}
                                                                </small>
                                                                @enderror
                                                            </div>
                                                            <div class="input-field col m6 s12">
                                                                <input id="date_expiration" name="date_expiration" value="{{$coupon->expiry_date}}" type="date" min="{{ $date }}" class="@error('date_expiration') is-invalid @enderror" value="{{ old('date_expiration') }}">
                                                                <label for="date_expiration" class="center-align" style="color:black;">Date d'expiration :</label>
                                                                @error('date_expiration')
                                                                <small class="red-text ml-7" role="alert">
                                                                    {{ $message }}
                                                                </small>
                                                                @enderror
                                                            </div>
                                                            <input type="hidden" name="coupon_id" value="{{$coupon->id}}">
                                                            <input type="hidden" name="customer_id" value="{{$customer->username}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <button type="submit" class="btn bcyan waves-effect waves-light right" type="submit">Modifier
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