@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
            <!-- Search for small screen-->
            <div class="container">
                <div class="row">
                    <div class="col s10 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Liste des commandes</span></h5>
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="/">Acceuil</a>
                            </li>
                            <li class="breadcrumb-item active ">Commandes
                            </li>
                            {{-- <li class="breadcrumb-item active">Liste
                        </li> --}}
                        </ol>
                    </div>
                    <a href="{{ route('commande.create') }}"
                        class="btn-floating  waves-effect waves-light breadcrumbs-btn right mr-1 mb-1 btn-large">
                        <i class="material-icons tooltipped" data-position="top" data-tooltip="Ajouter">add</i>
                    </a>
                    <a href="{{ backUrl() }}"
                        class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 right">RETOUR</a>

                </div>
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
                            <div class="users-list-table">
                                <div class="card">
                                    <div class="card-content">
                                        <!-- datatable start -->
                                        <div class="responsive-table">
                                            <table id="data-table-simple" class="display" style="width: 100%;">
                                                <thead>
                                                    <tr style="color:black">
                                                        <th style="text-align: left;">Nom du client</th>
                                                        <th style="text-align: left;">Bénéficiaire</th>
                                                        <th>Pack</th>
                                                        <th style="text-align: center">Statut commande</th>
                                                        <th style="text-align: center">Statut livraison</th>
                                                        <th style="text-align: center">Statut</th>
                                                        <th style="text-align: center">Qte</th>
                                                        <th style="text-align: right">Prix total</th>
                                                        <th style="text-align: right">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($Commandes as $Commandes)
                                                        <tr>
                                                            <td style="text-align: left"><span>
                                                                    {{ $Commandes->customer->particular->name ?? $Commandes->customer->company->name }}
                                                                    {{ $Commandes->customer->particular->firstname ?? $Commandes->customer->company->firstname }}
                                                                </span></td>
                                                            <td style="text-align: left">
                                                                <span>{{ $Commandes->receiver->firstname ?? 'N/A' }}
                                                                    {{ $Commandes->receiver->lastname ?? '' }}</span></td>
                                                            <td> <span>{{ $Commandes->paquet->paquetType->label ?? '' }}</span>
                                                            </td>
                                                            <td style="text-align: center">
                                                                @if ($Commandes->status_order == true)
                                                                    <span class="new badge gradient-45deg-light-blue-cyan"
                                                                        data-badge-caption=""
                                                                        style="font-weight: bold">Validée</span>
                                                                @else
                                                                    <span class="new badge" data-badge-caption=""
                                                                        style="font-weight: bold">En cours</span>
                                                                @endif
                                                            </td>
                                                            <td style="text-align: center">
                                                                @if ($Commandes->status_delivery == true)
                                                                    <span class="new badge gradient-45deg-light-blue-cyan"
                                                                        data-badge-caption=""
                                                                        style="font-weight: bold">Livrée</span>
                                                                @else
                                                                    <span class="new badge" data-badge-caption=""
                                                                        style="font-weight: bold">En cours</span>
                                                                @endif
                                                            </td>
                                                            <td style="text-align: center">
                                                                @if ($Commandes->finished == true)
                                                                    <span class="new badge gradient-45deg-light-blue-cyan"
                                                                        data-badge-caption=""
                                                                        style="font-weight: bold; color:white">Terminée</span>
                                                                @else
                                                                    <span class="new badge" data-badge-caption=""
                                                                        style="font-weight: bold">En cours</span>
                                                                @endif
                                                            </td>
                                                            <td style="text-align: center">
                                                                <span>{{ $Commandes->number }}</span></td>
                                                            <td style="text-align: right">
                                                                <span>{{ $Commandes->total }}</span></td>
                                                            <td style="text-align: right">
                                                                <div class="invoice-action">
                                                                    @if ($Commandes->finished == false)
                                                                        <a id="editBtn"
                                                                            href="{{ route('commande.show', $Commandes->id) }}"
                                                                            class="invoice-action-edit modal-trigger tooltipped"
                                                                            data-position="top" data-tooltip="Modifier"
                                                                            data-id="{{ $Commandes->id }}"
                                                                            data-Nom_client="{{ $Commandes->Nom_client }}"
                                                                            data-pack="{{ $Commandes->pack->label ?? '' }}"
                                                                            data-date_livraison="{{ $Commandes->date_livraison }}"
                                                                            data-description="{{ $Commandes->description }}"
                                                                            data-nombre="{{ $Commandes->nombre }}"
                                                                            data-total="{{ $Commandes->total }}"
                                                                            data-source_commande="{{ $Commandes->source_commande }}"
                                                                            data-url="{{ route('commande.updatecommande', $Commandes->id) }}">
                                                                            <i class="material-icons"
                                                                                style="color:green ;">edit</i>
                                                                        </a>

                                                                        <a id="suporderBtn" href="javascript:;"
                                                                            class="invoice-action-edit modal-trigger"
                                                                            data-pack="{{ $Commandes->id }}">
                                                                            <i class="material-icons tooltipped"
                                                                                style="color:red " data-position="top"
                                                                                data-tooltip="Supprimer">delete</i>
                                                                        </a>

                                                                        <a data-idcommande="{{ $Commandes->id }}"
                                                                            id="confBtn" href="javascript:;"
                                                                            class="invoice-action-edit modal-trigger tooltipped"
                                                                            data-position="top" data-tooltip="Cliquez pour finaliser tout le processus ">
                                                                            <i class="material-icons"
                                                                                style="color:rgb(151, 8, 132);">lock_outline</i>
                                                                        </a>
                                                                        <a data-idcommande="{{ $Commandes->id }}"
                                                                            id="activlivrBtn" href="javascript:;"
                                                                            class="invoice-action-edit modal-trigger tooltipped"
                                                                            data-position="top"
                                                                            data-tooltip="Cliquez pour valider la livraison">

                                                                            <i class="material-icons"
                                                                                style="color:rgb(7, 109, 109) ;">local_grocery_store
                                                                            </i>
                                                                        </a>
                                                                        <a data-idcommande="{{ $Commandes->id }}"
                                                                            id="activcomBtn" href="javascript:;"
                                                                            class="invoice-action-edit modal-trigger tooltipped"
                                                                            data-position="top"
                                                                            data-tooltip="Cliquez pour valider la Commande">
                                                                            <i class="material-icons"
                                                                                style="color:green">beenhere</i>
                                                                        </a>
                                                                    @endif
                                                                    @if($Commandes->status_order == true)
                                                                    <a href="{{ route('generate.pdf', ['id' => $Commandes->id]) }}"
                                                                        target="_blank"><i
                                                                            class="material-icons tooltipped"
                                                                            data-position="top"
                                                                            data-tooltip="Cliquez pour imprimer la commande">print</i></a>
                                                                    @endif

                                                                    
                                                                       
                                                               
                                                                    @if ($Commandes->finished == true)
                                                                        <a data-idcommande="{{ $Commandes->id }}"
                                                                            class="invoice-action-edit modal-trigger tooltipped"
                                                                            data-position="top"
                                                                            data-tooltip="Cliquez pour désactiver la Commande">
                                                                            <i class="material-icons"
                                                                                style="color:red">block</i>
                                                                        </a>
                                                                    @endif

                                                                </div>
                                                            </td>
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
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-overlay"></div>
        <div class="" style="display: none;">
            <form action="{{ route('confirm') }}" method="POST" id="formcommande">
                @csrf
                <input type="text" name="inpcommande" id="inpcommande">
                <button form="formcommande" id="resetbtn"></button>
            </form>
        </div>

        <div class="" style="display: none;">
            <form action="{{ route('actiliv') }}" method="POST" id="formorder">
                @csrf
                <input type="text" name="inpdeliver" id="inpdeliver">
                <button form="formorder" id="orderbtn"></button>
            </form>
        </div>
        <div class="" style="display: none">
            <form action="{{ route('deleteorder') }}" method="post" id="deleteorder">
                @csrf
                <input type="text" name="commandeformdelete" id="commandeformdelete">

                <button form="deleteorder" id=""></button>
            </form>
        </div>
        <div class="" style="display: none">
            <form action="{{ route('changeCommandeStatus') }}" method="post" id="valcommande">
                @csrf
                <input type="text" name="inpvalidation" id="inpvalidation">

                <button form="valcommande" id=""></button>
            </form>
        </div>
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
                $('#Nom_client').val($(this).attr('data-Nom_client'))
                $('#pack').val($(this).attr('data-pack'))
                $('#date_livraison').val($(this).attr('data-date_livraison'))
                $('#description').val($(this).attr('data-description'))
                $('#nombre').val($(this).attr('data-nombre'))
                $('#total').val($(this).attr('data-total'))
                $('#source_commande').val($(this).attr('data-source_commande'))

                document.forms.addForm.action = $(this).attr('data-url');
            })
        })

        $(document).on('click', '#supBtn', function() {
            document.forms.deleteForm.action = $(this).attr('data-url');
        })

        $(document).on('click', '#confBtn', function() {
            $('#inpcommande').val($(this).attr('data-idcommande'))
            swal({
                title: "Êtes-vous sûr ?",
                text: "Voulez-vous vraiment passer la commande a terminer ?",
                icon: 'warning',
                buttons: {
                    Annuler: true,
                    reset: 'Oui, Valider'
                }
            }).then((result) => {
                console.log(result);
                if (result == 'reset') {
                    $('#formcommande').submit();
                }
            });

        })
        $(document).on('click', '#activlivrBtn', function() {
            $('#inpdeliver').val($(this).attr('data-idcommande'))
            swal({
                title: "Êtes-vous sûr ?",
                text: "Voulez-vous vraiment valider cette livraison ?",
                icon: 'warning',
                buttons: {
                    Annuler: true,
                    reset: 'Oui, Valider'
                }
            }).then((result) => {
                console.log(result);
                if (result == 'reset') {
                    $('#formorder').submit();
                }
            });



        });
        $(document).on('click', '#suporderBtn', function() {
            $('#commandeformdelete').val($(this).attr('data-pack'))

            swal({
                title: "Êtes-vous sûr ?",
                text: "Voulez-vous vraiment supprimer cette commande ?",
                icon: 'warning',
                buttons: {
                    Annuler: true,
                    reset: 'Oui, Valider'
                }
            }).then((result) => {

                if (result == 'reset') {
                    $('#deleteorder').submit();
                }
            });
        });

        $(document).on('click', '#activcomBtn', function() {
            $('#inpvalidation').val($(this).attr('data-idcommande'))
            swal({
                title: "Êtes-vous sûr ?",
                text: "Voulez-vous vraiment valider cette commande?",
                icon: 'warning',
                buttons: {
                    Annuler: true,
                    reset: 'Oui, Valider'
                }
            }).then((result) => {
                console.log(result);
                if (result == 'reset') {
                    $('#valcommande').submit();
                }
            });



        });


    </script>
@endsection
