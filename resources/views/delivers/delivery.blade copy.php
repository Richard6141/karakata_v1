@extends('layouts.app')

@section('content')
<div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Commandes</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item">Acceuil</li>
                        <li class="breadcrumb-item">Livreurs</li>
                        <li class="breadcrumb-item active">Commandes</li>
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
                    <div class="col s12 m12 l12">
                        <div id="Form-advance" class="card card card-default scrollspy">
                            
                            @foreach($orders as $item)
                                <div class="center" style="font-size: 2em;" >
                                @once
                                <span>{{ $item->prenom}} {{ $item->nom}}</span>
                                @endonce
                                </div>
                            @endforeach
                        
                            <div class="card-content">
                                

                                <a href="{{route('delivers.assign', $item->deliver_id)}}" class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 ml-2">Assigner</a>
                                <a href="{{route('delivers.desassign', $item->deliver_id)}}" class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 ml-2">Désassigner</a>
                                <a href="{{route('delivers.delivery', $item->deliver_id)}}" style="background-color:green" class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 ml-2 active">Livraisons en cours</a>
                                <a href="{{route('delivers.deliveryrecover', $item->deliver_id)}}" class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 ml-2">Livraisons effectuées</a>
                           
                                
                                <section class="users-list-wrapper section">
                                    <div class="users-list-table">
                                        <div class="card">
                                            <div class="card-content">
                                                <!-- datatable start -->
                                                                    <form action="{{route('delivers.delivery_statut', $item->deliver_id)}}" method="post">
                                                                        @csrf
                                                                        <input type="hidden" name="deliver_id" value="{{$item->deliver_id}}">
                                                <div class="responsive-table">
                                                    <table id="data-table-simple" class="display" style="width:100%">
                                                        <thead>
                                                            <tr style="color:black">
                                                                <th style="text-align: left;">Nom</th>
                                                                <th style="text-align: right">Prénoms</th>
                                                                <th style="text-align: right">Zone</th>
                                                                <th> </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            @foreach ($orders as $item)
                                                            <tr>
                                                                <td style="text-align: left"><span>{{ $item->name}} </span></td>
                                                                <td style="text-align: right"><span>{{ $item->firstname  }} </span></td>
                                                                <td style="text-align: right"><span>{{ $item->label  }} </span></td>
                                                                
                                                                <td style="text-align: right"><span>
                                                                <div class="invoice-action">
                                                                <div class="switch">
                                                                      <label>
                                                                        <input class="filled-in" id="commande" name="commande[]" value="{{ $item->order_id}}" type="checkbox">
                                                                        <span ></span>
                                                                    </label>  
                                                        
                                                    </div>
                                                            </div>
                                                                </span></td>
                                                            </tr>
                                                            @endforeach

                                                            

                                                        </tbody>
                                                    </table>
                                                </div>
                                                <button id="modalBtnCommande"
                                                    class="btn bcyan waves-effect waves-light right" style="margin-top:5%"
                                                    type="submit">Livrer
                                                    <i class="material-icons right">done_all</i>
                                                </button>
                                                </form>
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

            @include('Suggestion.delete')

        </div>
        <div class="content-overlay"></div>
    </div>
    <!-- <div class="" style="display: none">
        <a id="btnCarnetAdresse" class="btn-floating  waves-effect waves-light breadcrumbs-btn right mr-1 mb-1 modal-trigger btn-large" href="#modalCarnet"><i class="material-icons tooltipped" data-position="top" data-tooltip="Ajouter">add</i>
    </div> -->
</div>
@endsection
@section('scripts')
@include('Suggestion.js')
@endsection
