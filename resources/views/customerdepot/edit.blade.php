@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
            <!-- Search for small screen-->
            <div class="container">
                <div class="row">
                    <div class="col s10 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Modifier un dépôt</span></h5>
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="/">Acceuil</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('customerdepot.index') }}">Dépôts</a>
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
                                    <h5 class="center">
                                        Modification
                                    </h5>
                                    <form class="login-form" method="POST"
                                        action="{{ route('customerdepot.update', $customer_depots->id) }}">
                                        @csrf
                                        <fieldset class="scheduler-border">
                                            <legend class="scheduler-border-limite">customer</legend>
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <div class="control-group">
                                                        <div class="row">
                                                            <input id="customer_id" type="hidden" name="customer_id"
                                                                value="{{ $customer_depots->customer_id ?? '' }}">

                                                            <div class="input-field col m4 s12">
                                                                <!-- <input id="name" type="text" name="name" value="{{ $customer_depots->customer->name ?? '' }}" desabled>
                                                                <label for="name" style="color: black">name</label> -->
                                                                <span style="color: black"> {{ $name->name ?? '' }}
                                                                    {{ $name->firstname ?? '' }}</span>
                                                                @error('name')
                                                                    <small class="red-text ml-7" role="alert">
                                                                        {{ $message }}
                                                                    </small>
                                                                @enderror
                                                            </div>
                                                            <div class="input-field col m4 s12">
                                                                <!-- <input id="firstname" type="text" name="firstname" value="Bonjour" desabled>
                                                                <label style="color: black" for="firstname">Préname</label> -->
                                                                <span
                                                                    style="color: black">{{ $customer_depots->customer->firstname ?? '' }}</span>
                                                                @error('firstname')
                                                                    <small class="red-text ml-7" role="alert">
                                                                        {{ $message }}
                                                                    </small>
                                                                @enderror
                                                            </div>
                                                            <div class="row">
                                                                <div class="input-field col m4 s12">
                                                                    <!-- <input id="phone" type="tel" name="phone" value="{{ $customer_depots->customer->phone ?? '' }}" desabled>
                                                                    <label style="color: black" for="phone">Téléphone</label> -->
                                                                    <span style="color: black">Téléphone :
                                                                        {{ $customer_depots->customer->phone ?? '' }}</span>
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
                                            <legend class="scheduler-border-limite">Dépôt</legend>
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <div class="control-group">
                                                        <div class="row">
                                                            <!--  -->

                                                            <div class="input-field col m6 s12">
                                                                <input id="amount" type="number" name="amount"
                                                                    value="{{ $customer_depots->amount }}">
                                                                <label style="color: black" for="firstname">Montant</label>
                                                                @error('amount')
                                                                    <small class="red-text ml-7" role="alert">
                                                                        {{ $message }}
                                                                    </small>
                                                                @enderror
                                                            </div>

                                                            <div class="input-field col m6 s12">
                                                                <input id="date" type="date" name="date"
                                                                    value="{{ $customer_depots->date }}">
                                                                <label style="color: black" for="date">Date</label>
                                                                @error('date')
                                                                    <small class="red-text ml-7" role="alert">
                                                                        {{ $message }}
                                                                    </small>
                                                                @enderror
                                                            </div>


                                                        </div>
                                                        <div class="row">
                                                            {{-- <div class="input-field col s6">
                                                                <select class="browser-default" name="payement_modes">
                                                                    <option>Choisissez le mode de paiement</option>
                                                                    @foreach ($payement_modes as $item)
                                                                        @if ($customer_depots->payement_mode_id == $item->id)
                                                                            <option selected value="{{ $item->id }}">
                                                                                <span>{{ $item->label }}</span></option>
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
                                                            </div> --}}

                                                            {{-- <div class="input-field col s12">
                                                                <input id="description" type="text" name="description"
                                                                    value="{{ $customer_depots->description }}">
                                                                <label style="color: black"
                                                                    for="date">Description</label>
                                                                @error('description')
                                                                    <small class="red-text ml-7" role="alert">
                                                                        {{ $message }}
                                                                    </small>
                                                                @enderror
                                                            </div> --}}
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>

                                        </fieldset>







                                        <div class="row">
                                            <div class="input-field col s12">
                                                <button id="editBtnsuggestion" type="submit"
                                                    class="btn bcyan waves-effect waves-light right"
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
            <div class="content-overlay"></div>
        </div>


    </div>
@endsection
@section('scripts')
    @include('customerdepot.js')
@endsection
