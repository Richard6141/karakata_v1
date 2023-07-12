@extends('layouts.app')

@section('content')

<div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Enregistrement de provisions</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/">Acceuil</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('cuisineprovision.index')}}">Provisions</a>
                        </li>
                        <li class="breadcrumb-item active">Ajout d'une provision
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
                                <h5 class="ml-4">Ajout d'une provision</h5>


                                <form class="login-form" method="POST" action="{{ route('cuisineprovision.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="input-field col m6 s12">
                                            <input id="purchase_date" type="date" name="purchase_date" value="{{ old('purchase_date') }}">
                                            <label for="purchase_date">Date d'achat</label>
                                            @error('purchase_date')
                                            <small class="red-text ml-7" role="alert">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                        <div class="input-field col m6 s12">
                                            <input id="label" type="text" name="label" value="{{ old('label') }}">
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
                                            <input id="quantity" type="text" name="quantity" value="{{ old('quantity') }}">
                                            <label for="quantity">Quantité</label>
                                            @error('quantity')
                                            <small class="red-text ml-7" role="alert">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                        <div class="input-field col m6 s12">
                                            <input id="amount" type="number" name="amount" value="{{ old('amount') }}">
                                            <label for="amount">Montant</label>
                                            @error('amount')
                                            <small class="red-text ml-7" role="alert">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="input-field col m6 s" style="display:flex; padding:20px" >
                                        <div>
                                        <label for="image" class="center-align" style="color:; padding-right:20px; font-weight: bold;font-size: 15px;">Le reçu d'achat:</label>

                                        </div>
                                        <div>
                                        <input id="image" name="image" value="" type="file" class="@error('image') is-invalid @enderror">
                                            @error('image')
                                            <small class="red-text ml-7" role="alert">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>

                                        </div>
                                        <div class="input-field col m6 s12">
                                            <input id="comment" type="text" name="comment">
                                            <label for="comment">Observations</label>
                                            @error('comment')
                                            <small class="red-text ml-7" role="alert">
                                                {{ $message }}
                                            </small>
                                            @enderror
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

