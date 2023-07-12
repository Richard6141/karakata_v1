@extends('layouts.app')

@section('content')
<div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Nombre de commande par pack</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/">Acceuil</a>
                        </li>
                        <li class="breadcrumb-item active">Liste
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="col s12">
        <div class="container">
            <section class="users-list-wrapper section">
                <div class="users-list-filter">
                    <div class="card-panel">
                        <div class="row">

                            <form action="{{ route('searchcommandebypack') }}" method="POST">
                                @csrf
                                <div class="col s12 m6 l3">
                                    <label style="color: black" for="users-list-status">Date début</label>
                                    <div class="input-field">
                                        <input type="date" name="datedebut" id="datedebut" placeholder="" value="{{ $datedebut }}">
                                    </div>
                                </div>
                                <div class="col s12 m6 l3">
                                    <label style="color: black" for="users-list-status">Date fin</label>
                                    <div class="input-field">
                                        <input type="date" name="datefin" id="datefin" placeholder="" value="{{ $datefin }}">
                                    </div>
                                </div>
                                <div class="col s12 m6 l3">
                                    <label style="color: black" for="users-list-status">Pack</label>
                                    <div class="input-field">
                                        <select class="browser-default" name="pack" id="pack">
                                            <option value=""></option>
                                            @foreach ($pack  as $item)
                                            <option value="{{ $item->id }}" {{ $item->id == $type ? 'selected' : ''}}>
                                                {{ $item->label }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('carnet_adresse')
                                        <small class="red-text ml-7" role="alert">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col s12 m6 l3 display-flex align-items-center show-btn">
                                    <button type="submit" id="seachbtn" class="btn btn-block indigo waves-effect waves-light">
                                        <i class="material-icons">search</i>
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
                                <section class="users-list-wrapper section">
                                    <div class="users-list-table">
                                        <div class="card">
                                            <div class="card-content">
                                                <!-- datatable start -->
                                                <div class="responsive-table">
                                                    <table id="" class="display">
                                                        <thead>
                                                            <tr style="color:black">
                                                                <th style="text-align: left;">Pack</th>
                                                                <th style="text-align: right">Nombre</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($commandes as $item)
                                                            <tr>
                                                                <td style="text-align: left"><span>{{ $item->label }}</span></td>
                                                                <td style="text-align: right"><span>{{ $item->count }}</span></td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- datatable ends -->
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="content-overlay"></div>
    </div>
    <!-- <div class="" style="display: none">
        <a id="btnCarnetAdresse" class="btn-floating  waves-effect waves-light breadcrumbs-btn right mr-1 mb-1 modal-trigger btn-large" href="#modalCarnet"><i class="material-icons tooltipped" data-position="top" data-tooltip="Ajouter">add</i>
    </div> -->
</div>
@endsection
@section('scripts')
@endsection
