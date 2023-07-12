@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
            <!-- Search for small screen-->
            <div class="container">
                <div class="row">
                    <div class="col s10 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Liste des mode de paiement</span></h5>
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="/">Acceuil</a>
                            </li>
                            <li class="breadcrumb-item active">Modes de paiment
                            </li>
                        </ol>
                    </div>
        <a href="#modal5"
                        class="btn-floating  waves-effect waves-light breadcrumbs-btn right mr-1 mb-1 modal-trigger btn-large">
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
                            <div class="responsive-table" style="color:black">
                                <table class="table invoice-data-table white border-radius-4 pt-1">

                                    <thead>
                                        <tr>
                                            <th style="font-size: 18px; color:#191970;font-weight: bold; text-align: left">Mode de paiement</th>

                                            <th style="font-size: 18px; color:#191970;font-weight: bold; text-align: right">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($payment_modes as $payment_mode)
                                            <tr>
                                                <td style="text-align: left">
                                                    <span>{{ $payment_mode->label }}</span>
                                                </td>

                                                <td style="text-align: right">
                                                    <div class="invoice-action">
                                                        <a id="editBtn" href="#modal5" class="invoice-action-edit modal-trigger tooltipped" data-position="top" data-tooltip="Modifier"
                                                            data-id="{{ $payment_mode->id }}" data-labels="{{ $payment_mode->label }}"
                                                            data-url="{{ route('updatemode_paiement', $payment_mode->id) }}">
                                                            <i class="material-icons" style="color:green">edit</i>
                                                        </a>
                                                        <a id="supBtn" href="#modal6" class="invoice-action-edit modal-trigger tooltipped" data-position="top" data-tooltip="Supprimer"
                                                            data-id="{{ $payment_mode->id }}"
                                                            data-url="{{ route('destroy_mode.sup', $payment_mode->id) }}">
                                                            <i class="material-icons" style="color:red">delete</i>
                                                        </a>
                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="content-overlay"></div>
        </div>
    </div>
    @include('paiements.mode_paiement_modal')
   
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '#editBtn', function() {
                $('#labels').val($(this).attr('data-labels'))
                $('#labels').click()

                document.forms.addForm.action = $(this).attr('data-url');
            })

            $(document).on('click', '#supBtn', function() {
                document.forms.deleteForm.action = $(this).attr('data-url');
            })
        })
    </script>
@endsection
