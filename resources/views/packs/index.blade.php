@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
            <!-- Search for small screen-->
            <div class="container">
                <div class="row">
                    <div class="col s10 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Liste des Packs</span></h5>
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="/">Acceuil</a>
                            </li>
                            <li class="breadcrumb-item active">Packs
                            </li>
                        </ol>
                    </div>
                    <a class="btn-floating  waves-effect waves-light breadcrumbs-btn right mr-1 mb-1 modal-trigger btn-large"
                        href="{{ route('pack.add') }}">
                        <i class="material-icons tooltipped" data-position="top" data-tooltip="Ajouter">add</i>
                    </a>
                    <a href="{{ backUrl() }}"
                        class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 right">RETOUR</a>

                </div>
            </div>
        </div>
        <div class="col s12">
            <div class="container">
                <div class="section">
                    <div class="card">
                        <div class="card-content">
                            <p class="caption mb-0">
                            <div class="entete">

                                @if (session()->has('successMessage'))
                                    <div class="card-alert card green lighten-5">
                                        <div class="card-content green-text">
                                            <p style="color: #336600;">{!! session('successMessage') !!}</p>
                                        </div>
                                        <button type="button" class="close green-text" data-dismiss="alert"
                                            aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                @endif
                                @if (session()->has('alertMessage'))
                                    <div class="card-alert card orange lighten-5">
                                        <div class="card-content orange-text">
                                            <p>WARNING : {!! session('alertMessage') !!}</p>
                                        </div>
                                        <button type="button" class="close orange-text" data-dismiss="alert"
                                            aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                @endif
                                @if (session()->has('errorMessage'))
                                    <div class="card-alert card red lighten-5">
                                        <div class="card-content red-text">
                                            <p>{!! session('errorMessage') !!}</p>
                                        </div>
                                        <button type="button" class="close red-text" data-dismiss="alert"
                                            aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <div class="responsive-table" style="color:black">

                                <table id="data-table-simple" class=" display" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            {{-- <th style="font-size: 18px; color:#191970;font-weight: bold;text-align: left">
                                                Nom</th> --}}
                                            <th style="font-size: 18px; color:#191970;font-weight: bold;">Type</th>
                                            <th style="font-size: 18px; color:#191970;font-weight: bold;">Prix</th>
                                            <th style="font-size: 18px; color:#191970;font-weight: bold;">statut</th>
                                            <th style="font-size: 18px; color:#191970;font-weight: bold;">Image</th>

                                            <th style="font-size: 18px; color:#191970;font-weight: bold;text-align: right">
                                                Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($Packs as $Pack)
                                        <tr>
                                            {{-- <td style="text-align: left">
                                                <span>{{ $Pack->label }}</span>
                                            </td> --}}
                                            <td>
                                                <span>{{ $Pack->paquetType->label }}</span>
                                            </td>
                                            <td>
                                                <span>{{ $Pack->price }}</span>
                                            </td>
                                            
                                            @if ($Pack->status == 0)
                                                <td><a id="editBtn"
                                                        href="{{ route('pack.ChangePackStatus', $Pack->id) }}"
                                                        class="invoice-action-edit modal-trigger tooltipped"
                                                        data-position="top" data-tooltip="Cliquez pour activer le pack"
                                                        {{-- data-id="{{ $Pack->id }}" data-label="{{ $Pack->label }}" --}}
                                                        data-price="{{ $Pack->price }}"
                                                        data-image="{{ $Pack->image }}"
                                                        data-url="{{ route('pack.ChangePackStatus', $Pack->id) }}">
                                                        <i class="material-icons" style="color:red">block</i>
                                                    </a>
                                                </td>
                                            @endif
                                            @if ($Pack->status == 1)
                                                <td><a id="editBtn"
                                                        href="{{ route('pack.ChangePackStatus', $Pack->id) }}"
                                                        class="invoice-action-edit modal-trigger tooltipped"
                                                        data-position="top" data-tooltip="Cliquez pour désactiver le pack"
                                                        {{-- data-id="{{ $Pack->id }}" data-label="{{ $Pack->label }}" --}}
                                                        data-price="{{ $Pack->price }}"
                                                        data-image="{{ $Pack->image }}"
                                                        data-url="{{ route('pack.ChangePackStatus', $Pack->id) }}">
                                                        <i class="material-icons" style="color:green">beenhere</i>
                                                    </a>
                                                </td>
                                            @endif
                                            <td>
                                                <!--    <img class="z-depth-1 circle" height="40" width="40" src="{{ url('image/' . $Pack->image) }}" alt="Image" style="max-width: 50px;"> -->
                                                @if (is_null($Pack->image))
                                                    <img src="{{ 'https://ui-avatars.com/api/?background=8EC741&color=ffff/?uppercase=true&name=' . $Pack->paquetType->label }}"
                                                        alt="Photo de profil" class="z-depth-4 circle" height="40"
                                                        width="40">
                                                @else
                                                    <img class="z-depth-1 circle" height="40" width="40"
                                                        src="{{ asset('image/' . $Pack->image) }}" alt="Image"
                                                        style="max-width: 50px;">
                                                @endif
                                            </td>


                                            <td style="text-align: right">
                                                <div class="invoice-action">
                                                    <a id="editBtn" href="{{ route('pack.update', $Pack->id) }}"
                                                        class="invoice-action-edit modal-trigger tooltipped"
                                                        data-position="top" data-tooltip="Modifier"
                                                        data-id="{{ $Pack->id }}"
                                                        {{-- data-label="{{ $Pack->label }}" --}}
                                                        data-price="{{ $Pack->price }}"
                                                        data-image="{{ $Pack->image }}"
                                                        data-url="{{ route('pack.updatepack', $Pack->id) }}">
                                                        <i class="material-icons" style="color:green">edit</i>
                                                    </a>
                                                    <a id="supBtn" href="#modal2"
                                                        class="invoice-action-edit modal-trigger tooltipped"
                                                        data-position="top" data-tooltip="Supprimer"
                                                        data-id="{{ $Pack->id }}"
                                                        data-url="{{ route('pack.sup', $Pack->id) }}">
                                                        <i class="material-icons" style="color:red">delete</i>
                                                    </a>


                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="center"><span
                                                    class="center">{{ __('Aucune donnée') }}</span> </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="">
                            </div>

                            @include('packs.delete')
                            @include('packs.activate_confirm')
                            @include('packs.desable_confirm')
                            </p>
                        </div>

                        </p>
                    </div>
                </div>
            </div>


        </div>
        <div class="content-overlay"></div>
    </div>
    </div>
    <!-- invoice list -->
    <section class="invoice-list-wrapper section">

        <!-- create invoice button-->
        <!-- Options and filter dropdown button-->

    </section>
@endsection


{{-- page scripts --}}
@section('scripts')
    <script src="{{ asset('js/scripts/app-invoice.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '#editBtn', function() {
                $('#label').val($(this).attr('data-label'))
                $('#price').val($(this).attr('data-price'))
                document.forms.addForm.action = $(this).attr('data-url');
            })

            $(document).on('click', '#supBtn', function() {
                document.forms.deleteForm.action = $(this).attr('data-url');
            })
        })
    </script>
@endsection
