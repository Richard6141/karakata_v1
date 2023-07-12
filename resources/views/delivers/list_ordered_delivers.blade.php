@extends('layouts.app')

@section('content')
<div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Les Livreurs ayant de commandes en attente</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item">Acceuil</li>
                        <li class="breadcrumb-item">Livreurs</li>
                        <li class="breadcrumb-item active">Commandes en attente</li>
                    </ol>
                </div>
                <a href="{{backUrl()}}" class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 right">RETOUR</a>
                </a>
            </div>
            <div class="row" style="margin-top: 15px;">
                <div class="col s12">
                    <div class="container">
                        <div class="section">
                            <div class="card">
                                <div class="card-content">
                                    <div class="responsive-table">
                                        <table id="data-table-simple" style="width:100%" class="display">
                                            <thead>
                                                <tr style="color:black">
                                                    <th>Nom</th>
                                                    <th>Prénoms</th>
                                                    <th>Téléphone</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($delivers as $item)
                                                <tr>
                                                    <td><span>{{ $item->lastname ?? 'N/A'}} </span></td>
                                                    <td><span>{{ $item->firstname ?? '' }} </span></td>
                                                    <td><span>{{ $item->phone ?? '' }} </span></td>

                                                    <td><span>
                                                            <div class="switch">
                                                                <a id="supBtn" href="{{route('delivers.desassign', $item->id)}}" class="invoice-action-edit  tooltipped" data-position="top" data-tooltip="details">
                                                                    <i class="material-icons" style="color:red ">visibility</i>
                                                                </a>
                                                            </div>
                                                        </span></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-overlay"></div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    checked = 0;
    checkers = document.querySelectorAll('#checkme');
    button = document.getElementById('supprimer');
    for (let i = 0; i < checkers.length; i++) {
        checkers[i].addEventListener("click", function() {
            if (checkers[i].checked == true) {
                checked++;
                console.log(checked);
            } else {
                checked--;
                console.log(checked);
            }
            if (checked > 0) {
                document.getElementById('supprimer').style.display = "block";
            } else {
                document.getElementById('supprimer').style.display = "none";
            }
        });
    }
</script>
// @include('delivers.js')
@endsection