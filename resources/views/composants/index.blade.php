@extends('layouts.app')

@section('content')
<div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Liste des composants</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/">Acceuil</a>
                        </li>
                        <li class="breadcrumb-item active">Composants
                        </li>
                    </ol>
                </div>
                <a class="col s2 m6 l6"><a class="btn-floating  waves-effect waves-light breadcrumbs-btn right mr-1 mb-1 modal-trigger btn-large" href="{{ route('composant.add') }}"><i class="material-icons tooltipped" data-position="top" data-tooltip="Ajouter">add</i>
                    </a>
                    <a href="{{ backUrl() }}" class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 right">RETOUR</a>

            </div>
        </div>
    </div>
    <div class="col s12">
        <div class="container">
            <div class="section">
                <div class="card">
                    <div class="card-content">
                        <div class="responsive-table">
                            <table id="data-table-simple" class="display" style="width: 100%;">
                                <thead>
                                    <tr style="color:black">
                                        <th style="text-align: left">Type composant</th>
                                        {{-- <th>Packs</th> --}}
                                        <th>Libellé</th>
                                        <th>Description</th>
                                        {{-- <th>Date de publication</th> --}}
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($Composants as $Composants)
                                    <tr>
                                        <td style="text-align: left">
                                            <span>{{ $Composants->componentType->label ?? '' }}</span>
                                        </td>
                                        {{-- <td> <span>{{ $Composants->pack->label ?? '' }}</span></td> --}}
                                        <td> <span>{{ $Composants->label }}</span></td>
                                        <td>
                                            <span>
                                                {{ $Composants->description }}
                                            </span>
                                        </td>
                                        {{-- <td><span>{{ $Composants->publish_date }}</span></td> --}}
                                        <td>
                                            @if (is_null($Composants->image))
                                            <img src="{{ 'https://ui-avatars.com/api/?background=8EC741&color=ffff/?uppercase=true&name=' . $Composants->label }}" alt="Photo de profil" class="z-depth-4 circle" height="40" width="40">
                                            @else
                                            <img class="z-depth-1 circle" height="40" width="40" src="{{ asset('image/' . $Composants->image) }}" alt="Image" style="max-width: 50px;">
                                            @endif
                                        </td>
                                        <td>
                                            <div class="invoice-action">
                                                <a href="{{ route('composant.show', $Composants->id) }}" class="invoice-action-view mr-4 tooltipped" data-position="top" data-tooltip="Voir">
                                                    <i class="material-icons">remove_red_eye</i>
                                                </a>
                                                <a id="editBtn" href="{{ route('composant.update', $Composants->id) }}" class="invoice-action-edit modal-trigger tooltipped" data-position="top" data-tooltip="Modifier" data-id="{{ $Composants->id }}" data-label="{{ $Composants->label }}" data-description="{{ $Composants->description }}" {{-- data-publish_date="{{ $Composants->publish_date }}" --}} data-image="{{ $Composants->image }}" data-typecomposant="{{ $Composants->typecomposant->id ?? '' }}" data-url="{{ route('composant.updatecomposants', $Composants->id) }}">
                                                    <i class="material-icons" style="color:green ;">edit</i>
                                                </a>
                                                <a id="supBtn" href="#modal4" class="invoice-action-edit modal-trigger tooltipped" data-position="top" data-tooltip="Supprimer" data-id="{{ $Composants->id }}" data-url="{{ route('composant.sup', $Composants->id) }}">
                                                    <i class="material-icons" style="color:red ">delete</i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="center"><span class="center">{{ __('Aucune donnée') }}</span> </td>
                                    </tr>
                                    @endforelse
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
@include('composants.delete')
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $(document).on('click', '#editBtn', function() {
            $('#label').val($(this).attr('data-label'))
            $('#description').val($(this).attr('data-description'))
            $('#typecomposant').val($(this).attr('data-typecomposant'))

            // $('#publish_date').val($(this).attr('data-publish_date'))
            $('#file1').val($(this).attr('data-image'))

            document.forms.addForm.action = $(this).attr('data-url');
        })
    })

    $(document).on('click', '#supBtn', function() {
        document.forms.deleteForm.action = $(this).attr('data-url');
    })

    $(document).on('click', '#addcomposantmodal', function() {
        $('#label').val('')
        $('#description').val('')
        // $('#publish_date').val('')
        // $('#publish_date').val('')


    })


    $(document).ready(function() {
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
@endsection