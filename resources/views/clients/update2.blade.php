@extends('layouts.app')

@section('content')

<div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Modification des information d'un client</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/">Acceuil</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('client.index') }}">Clients</a>
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
                                <h5 class="ml-4">Modifier les informations d'un client</h5>


                                <form class="" action="{{ route('client.updateclient2',$clients->id) }}" method="GET">
                @csrf

                <div class="row">
                    <div class="input-field col s12">
                        <input id="raison_social" name="raison_social" value="{{$clients->raison_social}}" type="text"
                            class="@error('raison_social') is-invalid @enderror">
                        <label for="labels">Raison social</label>
                        @error('raison_social')
                            <small class="red-text ml-7" role="alert">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>
                </div>
              
                <div class="row">


                    <div class="input-field col s12">
                        <input id="phone" name="phone" class="@error('phone') is-invalid @enderror"
                            type="number" placeholder="phone" value="{{$clients->phone}}" type="number">
                        <label for="phone">Téléphone</label>
                        @error('phone')
                            <small class="red-text ml-7" role="alert">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="input-field col s12">
                        <input id="email" name="email" class="@error('email') is-invalid @enderror"
                            type="email" placeholder="email" value="{{$clients->email}}" type="email">
                        <label for="email">Email</label>
                        @error('email')
                            <small class="red-text ml-7" role="alert">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <button type="submit" class="btn bcyan waves-effect waves-light right" type="submit">Enregistrer
                                <i class="material-icons right">send</i>
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

