@extends('layouts.app')

@section('content')
<div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0">Liste des opérations</h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/">Acceuil</a>
                        </li>
                        <li class="breadcrumb-item">Cuisine</li>
                        <li class="breadcrumb-item active">Opérations</li>
                    </ol>
                </div>
                <a href="/add_operations_form" class="btn-floating  waves-effect waves-light breadcrumbs-btn right mr-1 mb-1 modal-trigger btn-large">
                    <i class="material-icons tooltipped" data-position="top" data-tooltip="Ajouter">add</i>
                </a>

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
                                <button type="button" class="close green-text" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×
                                </button>
                            </div>
                            @endif
                            @if (session()->has('alertMessage'))
                            <div class="card-alert card orange lighten-5">
                                <div class="card-content orange-text">
                                    <p>WARNING : {!! session('alertMessage') !!}</p>
                                </div>
                                <button type="button" class="close orange-text" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×
                                </button>
                            </div>
                            @endif
                            @if (session()->has('errorMessage'))
                            <div class="card-alert card red lighten-5">
                                <div class="card-content red-text">
                                    <p>{!! session('errorMessage') !!}</p>
                                </div>
                                <button type="button" class="close red-text" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×
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
                                                        <th>Date de l'opération</th>
                                                        <th>Produits</th>
                                                        <th>Quantité</th>
                                                        <th>Stock réel</th>
                                                        <th>Prix unitaire</th>
                                                        <th>Statut</th>
                                                        <th>Auteur</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                @foreach ($operations as $operation)
                                                <tbody>
                                                    <tr>
                                                        <td>{{$operation->date}}</td>
                                                        <td>{{$operation->produit->label}}</td>
                                                        <td>{{$operation->quantite}}</td>
                                                        @if($operation->status == 0)
                                                        <td>-</td>
                                                        @endif
                                                        @if($operation->status == 1)
                                                        <td>-</td>
                                                        @endif
                                                        @if($operation->status == 2)
                                                        <td>{{$operation->stock_reel}}</td>
                                                        @endif
                                                        @if($operation->status == 0)
                                                        <td>-</td>
                                                        @endif
                                                        @if($operation->status == 1)
                                                        <td>{{$operation->prix_unitaire}}</td>
                                                        @endif
                                                        @if($operation->status == 2)
                                                        <td>-</td>
                                                        @endif
                                                        @if($operation->status == 0)
                                                        <td>Sortie</td>
                                                        @endif
                                                        @if($operation->status == 1)
                                                        <td>Entrée</td>
                                                        @endif
                                                        @if($operation->status == 2)
                                                        <td>Inventaire</td>
                                                        @endif
                                                        <td>{{ $operation->user->nom .' '. $operation->user->prenom}}</td>
                                                        <td>
                                                            <div class="invoice-action">
                                                                @if ($use = true)
                                                                <a id="supBtn" href="#modal2" class="invoice-action-edit modal-trigger tooltipped" data-position="top" data-tooltip="Supprimer" data-id="{{ $operation->id }}" data-url="{{ route('operations.delete', $operation->id) }}"><i class="material-icons" style="color:red ">delete</i>
                                                                </a>
                                                                @endif
                                                            </div>
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                                @endforeach
                                            </table>
                                        </div>
                                        <!-- datatable ends -->
                                    </div>
                                </div>
                            </div>
                            @include('stocks.sup_message')
                            <!-- @include('Cuisine.sup_message') -->

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
    // $(document).ready(function() {
    //     $(document).on('click', '#editBtn', function() {
    //         $('#purchase_date').val($(this).attr('data-purchase_date'))
    //         $('#label').val($(this).attr('data-label'))
    //         $('#quantity').val($(this).attr('data-quantity'))
    //         $('#amount').val($(this).attr('data-amount'))
    //         $('#image').val($(this).attr('data-image'))
    //         $('#comment').val($(this).attr('data-comment'))


    //         document.forms.addForm.action = $(this).attr('data-url');
    //     })
    // })

    $(document).on('click', '#supBtn', function() {
        document.forms.deleteForm.action = $(this).attr('data-url');
    })
</script>
@endsection