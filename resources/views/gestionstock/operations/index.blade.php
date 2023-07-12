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
                    @if($typeOfOperation_label == "Entrée")
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/">Acceuil</a>
                        </li>
                        <li class="breadcrumb-item">Opérations</li>
                        <li class="breadcrumb-item active">Entrée</li>
                    </ol>
                    @endif
                    @if($typeOfOperation_label == "Sortie")
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/">Acceuil</a>
                        </li>
                        <li class="breadcrumb-item">Opérations</li>
                        <li class="breadcrumb-item active">Sortie</li>
                    </ol>
                    @endif
                    @if($typeOfOperation_label == "Inventaire")
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/">Acceuil</a>
                        </li>
                        <li class="breadcrumb-item">Opérations</li>
                        <li class="breadcrumb-item active">Inventaire</li>
                    </ol>
                    @endif
                </div>
                <a href="{{backUrl()}}" class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 right">RETOUR</a>
            </div>
        </div>
    </div>
    <div class="col s12">
        <div class="container">
            <div class="section">
                <div class="card">
                    @foreach($listeTypeOfOperation as $index)
                    <a href="/operations/formulaire/{{ strtolower($index) }}" class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 ml-2">{{$index}}</a>
                    @endforeach
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
                                            @if($typeOfOperation_label == "Entrée")
                                            <table id="data-table-simple" class="display">
                                                <thead>
                                                    <tr style="color:black">
                                                        <th>Date de l'opération</th>
                                                        <th>Libellé de l'opération</th>
                                                        <th>Produits</th>
                                                        <th>Quantité</th>
                                                        <th>Prix</th>
                                                        <th>Observations</th>
                                                        <th>Auteurs</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($operations as $key => $operation)
                                                    <tr>
                                                        <th>{{$operation->date_operation}}</th>
                                                        <th>{{$operation->label}}</th>
                                                        <th>{{$operation->product->label}}</th>
                                                        <th>{{$operation->quantity}} {{$operation->product->unitemesure->label}}</th>
                                                        <th>{{$operation->price}}</th>
                                                        <th>{{$operation->observation}}</th>
                                                        <th>{{$operation->user->name}} {{$operation->user->surname}}</th>
                                                        <th>
                                                            <div class="invoice-action">
                                                                <a class="waves-effect waves-light btn-small tooltipped" data-position="top" data-tooltip="Supprimer" href="{{route('operation.delete', ['id' => $operation->id]) }}"><i class="material-icons">delete</i></a>
                                                            </div>
                                                        </th>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @endif
                                            @if($typeOfOperation_label == "Sortie")
                                            <table id="data-table-simple" class="display">
                                                <thead>
                                                    <tr style="color:black">
                                                        <th>Date de l'opération</th>
                                                        <th>Libellé de l'opération</th>
                                                        <th>Produits</th>
                                                        <th>Quantité</th>
                                                        <th>Observations</th>
                                                        <th>Auteurs</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($operations as $key => $operation)
                                                    <tr>
                                                        <th>{{$operation->date_operation}}</th>
                                                        <th>{{$operation->label}}</th>
                                                        <th>{{$operation->product->label}}</th>
                                                        <th>{{$operation->quantity}} {{$operation->product->unitemesure->label}}</th>
                                                        <th>{{$operation->observation}}</th>
                                                        <th>{{$operation->user->name}} {{$operation->user->surname}}</th>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @endif
                                            @if($typeOfOperation_label == "Inventaire")
                                            <table id="data-table-simple" class="display">
                                                <thead>
                                                    <tr style="color:black">
                                                        <th>Date de l'opération</th>
                                                        <th>Libellé de l'opération</th>
                                                        <th>Produits</th>
                                                        <th>Stock théorique</th>
                                                        <th>Observations</th>
                                                        <th>Auteurs</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($operations as $key => $operation)
                                                    <tr>
                                                        <th>{{$operation->date_operation}}</th>
                                                        <th>{{$operation->label}}</th>
                                                        <th>{{$operation->product->label}}</th>
                                                        <th>{{$operation->quantity}} {{$operation->product->unitemesure->label}}</th>
                                                        <th>{{$operation->observation}}</th>
                                                        <th>{{$operation->user->name}} {{$operation->user->surname}}</th>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @endif
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
    $(document).on('click', '#supBtn', function() {
        document.forms.deleteForm.action = $(this).attr('data-url');
    })
</script>
@endsection