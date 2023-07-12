@extends('layouts.app')

@section('content')
<div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">

                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Liste des Produits</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/">Acceuil</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('produits.index') }}">Cuisine</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('produits.index') }}">Produits</a></li>
                        <li class="breadcrumb-item active"><a href="#">{{$produit->label}}</a></li>
                    </ol>

                </div>

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
                                <button type="button" class="close green-text" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            @endif
                            @if (session()->has('alertMessage'))
                            <div class="card-alert card orange lighten-5">
                                <div class="card-content orange-text">
                                    <p>WARNING : {!! session('alertMessage') !!}</p>
                                </div>
                                <button type="button" class="close orange-text" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            @endif
                            @if (session()->has('errorMessage'))
                            <div class="card-alert card red lighten-5">
                                <div class="card-content red-text">
                                    <p>{!! session('errorMessage') !!}</p>
                                </div>
                                <button type="button" class="close red-text" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            @endif


                            <div class="users-list-table">
                                <ul class="collapsible">
                                    <li class="active">
                                        <div class="collapsible-header"><i class="material-icons">zoom_out_map</i>Description</div>
                                        <div class="collapsible-body"><span>
                                                <div style="margin-bottom: 15px; text-align: left">FICHE DE SUIVIE DE STOCK : {{$produit->label}}</div>
                                                <div class="responsive-table" style="display: flex; flex-direction: row; justify-content: space-between">
                                                    <table style="width: 40%; border-collapse: collapse">
                                                        <tr>
                                                            <td style="border: 1px solid;">Stock d'alerte</td>
                                                            <td style="border: 1px solid;text-align: center;">{{$produit->safety_stock}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="border: 1px solid;">Stock disponible</td>
                                                            <td style="border: 1px solid;text-align: center;">{{$produit->available_stock}}</td>
                                                        </tr>
                                                    </table>
                                                    <table style="width: 40%; border-collapse: collapse">
                                                    </table>
                                                </div>
                                            </span></div>
                                    </li>
                                    <li>
                                        <div class="collapsible-header"><i class="material-icons">compare_arrows</i>Opérations</div>
                                        <div class="collapsible-body"><span>
                                                <div class="card">
                                                    <div style="border: 1px solid; text-align: center; color: black; font-weight: bold;" class="card-content">
                                                        <div style="margin-top:20px; border-collapse:collapse;">
                                                            <table id="data-table-simple" style="width:100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="border: 1px solid;; width: 100px; text-align: center;">Date</th>
                                                                        <th style="border: 1px solid; text-align: center; width: 100px">🔂 Opérations</th>
                                                                        <th style="border: 1px solid; text-align: center; width: 100px">Quantité</th>
                                                                        <th style="border: 1px solid; text-align: center; width: 100px">Stock théorique </th>
                                                                        <th style="border: 1px solid; text-align: center; width: 100px">Stock reel </th>
                                                                        <th style="border: 1px solid; text-align: center; width: 100px">Observations</th>
                                                                    </tr>
                                                                </thead>
                                                                
                                                                <tbody>
                                                                    @foreach ($operations as $operation)
                                                                    @if($entree->id == $operation->operation_type_id)
                                                                    <tr>
                                                                        <td style="border: 1px solid; text-align: center; width: 100px">{{$operation->date_operation}}</td>
                                                                        <td style="border: 1px solid; text-align: center; width: 100px">Entrée</td>
                                                                        <td style="border: 1px solid; text-align: center; width: 100px">{{$operation->quantity}}</td>
                                                                        <td style="border: 1px solid; text-align: center; width: 100px">{{$operation->theoricquantity}}</td>
                                                                        <td style="border: 1px solid; text-align: center; width: 100px">-</td>
                                                                        <td style="border: 1px solid; text-align: center; width: 100px">{{$operation->observation ?? "RAS"}}</td>
                                                                    </tr>
                                                                    @elseif($sortie->id == $operation->operation_type_id)
                                                                    <tr>
                                                                        <td style="border: 1px solid; text-align: center; width: 100px">{{$operation->date_operation}}</td>
                                                                        <td style="border: 1px solid; text-align: center; width: 100px">Sortie</td>
                                                                        <td style="border: 1px solid; text-align: center; width: 100px">{{$operation->quantity}}</td>
                                                                        <td style="border: 1px solid; text-align: center; width: 100px">{{$operation->theoricquantity}}</td>
                                                                        <td style="border: 1px solid; text-align: center; width: 100px">-</td>
                                                                        <td style="border: 1px solid; text-align: center; width: 100px">{{$operation->observation ?? "RAS"}}</td>
                                                                    </tr>
                                                                    @else($inventaire->id == $operation->operation_type_id)
                                                                    <tr>
                                                                        <td style="border: 1px solid; text-align: center; width: 100px">{{$operation->date_operation}}</td>
                                                                        <td style="border: 1px solid; text-align: center; width: 100px">Inventaire</td>
                                                                        <td style="border: 1px solid; text-align: center; width: 100px">-</td>
                                                                        <td style="border: 1px solid; text-align: center; width: 100px">-</td>
                                                                        <td style="border: 1px solid; text-align: center; width: 100px">{{$operation->theoricquantity}}</td>
                                                                        <td style="border: 1px solid; text-align: center; width: 100px">{{$operation->observation ?? "RAS"}}</td>
                                                                    </tr>
                                                                    @endif
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                    </div>
                                                </div>
                                        </div>
                                        </span>
                            </div>
                            </li>
                            </ul>

                    </div>

                    @include('produits.sup_message')

                    </section>
                </div>
            </div>
        </div>


    </div>
    <div class="content-overlay"></div>
</div>
</div>
@endsection


{{-- page script --}}
@section('scripts')
<script src="{{ asset('js/scripts/page-users.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.collapsible');
        var instances = M.Collapsible.init(elems, options);
    });

    // Or with jQuery

    $(document).ready(function() {
        $('.collapsible').collapsible();
    });
    $(document).on('click', '#supBtn', function() {
        document.forms.deleteForm.action = $(this).attr('data-url');
    })
</script>
@endsection