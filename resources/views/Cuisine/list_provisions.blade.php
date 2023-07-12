@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
            <!-- Search for small screen-->
            <div class="container">
                <div class="row">
                    <div class="col s10 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Liste des provisions de cuisine</span></h5>
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="/">Acceuil</a>
                            </li>
                            <li class="breadcrumb-item active"><a href="#">Provisions</a>
                        </ol>
                    </div>
                    <a href="/cuisine_provision"
                        class="btn-floating  waves-effect waves-light breadcrumbs-btn right mr-1 mb-1 modal-trigger btn-large">
                        <i class="material-icons tooltipped" data-position="top" data-tooltip="Ajouter">add</i>
                    </a>
                    <a href="{{backUrl()}}" class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 right">RETOUR</a>

                </div>
            </div>
        </div>
        <div class="col s12">
            <div class="container">
                <div class="section">
                    <div class="card">
                        <div class="card-content">
                            <p class="caption mb-0">
                            <section class="users-list-wrapper section">

                                @if (session()->has('successMessage'))
                                    <div class="card-alert card green lighten-5">
                                        <div class="card-content green-text">
                                            <p style="color:#336600;">{!! session('successMessage') !!}</p>
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

                                <div class="users-list-table">
                                    <div class="card">
                                        <div class="card-content">
                                            <!-- datatable start -->
                                            <div class="responsive-table">
                                                <table id="data-table-simple" class="display">
                                                    <thead>
                                                        <tr style="color:black">
                                                            <th style="width: 200px">Libellé</th>
                                                            <th style="width: 150px; text-align: center">Quantité</th>
                                                            <th style="width: 150px; text-align: right">Montant</th>
                                                            <th style="width: 150px; text-align: center">Date d'achat</th>
                                                            <th style="text-align: right; width: 100px">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        @foreach ($CuisineProvision as $item)
                                                            <tr>
                                                                <td style="width: 200px"><span>{{ $item->label }}</span></td>
                                                                <td style="width: 150px; text-align: center"><span>{{ $item->quantity }}</span></td>
                                                                <td style="text-align: left; width: 150px; text-align: right"><span>{{ $item->amount }}</span></td>
                                                                <td style="width: 150px; text-align: center"><span>{{ Carbon\carbon::parse($item->purchase_date)->format('d-m-Y') }}</span></td>
                                                                <td style="text-align: right; width: 100px">
                                                                    <div class="invoice-action">

                                                                        <div class="invoice-action">
                                                                            <a href="{{ route('provision', $item->id) }}"
                                                                                class="invoice-action-view mr-4 tooltipped" data-position="top" data-tooltip="Voir">
                                                                                <i class="material-icons">remove_red_eye</i>
                                                                            </a>
                                                                            <a id="editBtn" href="{{ route('cuisine.update',$item->id)}} "
                                                                                class="invoice-action-edit modal-trigger tooltipped" data-position="top" data-tooltip="Modifier"
                                                                                data-id="{{ $item->id }}"
                                                                                data-purchase_date="{{ $item->purchase_date }}"
                                                                                data-label="{{ $item->label }}"
                                                                                data-quantity="{{ $item->quantity }}"
                                                                                data-amount="{{ $item->amount }}"
                                                                                data-image="{{ $item->image }}"
                                                                                data-comment="{{ $item->comment }}"
                                                                                data-url="{{ route('cuisineprovision.update', $item->id) }}"
                                                                                >
                                                                                <i class="material-icons" style="color:green ;">edit</i>
                                                                            </a>
                                                                        @if ($use=true)

                                                                            <a id="supBtn" href="#modal2"
                                                                            class="invoice-action-edit modal-trigger tooltipped" data-position="top" data-tooltip="Supprimer"
                                                                            data-id="{{ $item->id }}"
                                                                            data-url="{{ route('cuisineprovision.sup', $item->id) }}">


                                                                            <i class="material-icons"
                                                                                style="color:red ">delete</i>
                                                                        </a>

                                                                        @endif

                                                                    </div>
                                                                </td>
                                                        @endforeach
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- datatable ends -->
                                        </div>
                                    </div>
                                </div>

                                @include('Cuisine.sup_message')

                            </section>
                        </div>
                    </div>
                </div>


            </div>
            <div class="content-overlay"></div>
        </div>
    </div>
    <!-- users list start -->

    <!-- users list ends -->
@endsection


{{-- page script --}}
@section('scripts')
    <script src="{{ asset('js/scripts/page-users.js') }}"></script>
    <script>


        $(document).ready(function() {
            $(document).on('click', '#editBtn', function() {
                $('#purchase_date').val($(this).attr('data-purchase_date'))
                $('#label').val($(this).attr('data-label'))
                $('#quantity').val($(this).attr('data-quantity'))
                $('#amount').val($(this).attr('data-amount'))
                $('#image').val($(this).attr('data-image'))
                $('#comment').val($(this).attr('data-comment'))


                document.forms.addForm.action = $(this).attr('data-url');
            })
        })

        $(document).on('click', '#supBtn', function() {
            document.forms.deleteForm.action = $(this).attr('data-url');
        })
    </script>
@endsection
