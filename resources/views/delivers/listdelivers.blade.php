@extends('layouts.app')

@section('content')
<div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Livreurs disponibles</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item">Acceuil</li>
                        <li class="breadcrumb-item">livreurs</li>
                        <li class="breadcrumb-item active">Livreurs disponibles</li>
                    </ol>
                </div>
                <a href="{{backUrl()}}" class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 left">RETOUR</a>
                <a href="{{route('delivers.delivers_has_order')}}" class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 right">Livraison en cours</a>

                </a>
            </div>
        </div>
    </div>
    <div class="col s12">
        <div class="container">
    
            <div class="section">
                <div class="card">
                    <div class="col s12 m12 l12">
                        <div id="Form-advance" class="card card card-default scrollspy">
                            <div class="card-content">
                                 <form action="{{route('livreur.unavailable_deliver')}}" method="post">
                                @csrf
                                <section class="users-list-wrapper section">
                                    <div class="users-list-table">
                                        <div class="card">
                                            <div class="card-content">
                                                <!-- datatable start -->
                                                

                                                <div class="responsive-table">
                                                    <table id="data-table-simple" style="width:100%" class="display">
                                                        <thead>
                                                            <tr style="color:black">
                                                                <th >Nom</th>
                                                                <th >Prénoms</th>
                                                                <!--  <th style="text-align: right">En cours</th> -->
                                                                <!-- <th style="text-align: right">Livrée</th> -->
                                                                <th>Téléphone</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody style="">
                                                            @foreach ($delivers as $item)
                                                            <tr>
                                                                <td><span>{{ $item->deliver->lastname ?? 'N/A'}} </span></td>
                                                                <td><span>{{ $item->deliver->firstname ?? '' }} </span></td>
                                                                <td><span>{{ $item->deliver->phone ?? '' }} </span></td>
                                                                
                                                                <td style=""><span>
                                                                <div class="switch">
                                                                      <label>
                                                                        <input class="filled-in" id="checkme" name="deliver_id[]" value="{{ $item->id}}" type="checkbox">
                                                                        <span ></span>
                                                                    </label> 
                                                            </div>
                                                                </span></td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div id="supprimer" style = "display:none;">
                                                    <button
                                                    class="btn bcyan waves-effect waves-light right fixed" style="margin-top:5%;" 
                                                    type="submit">Retirer</a>
                                                    <i class="material-icons right">send</i>
                                                    </button>
                                                </div>
                                                
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
<script>
  checked = 0;
  checkers = document.querySelectorAll('#checkme'); 
  button = document.getElementById('supprimer'); 
  for (let i = 0; i < checkers.length; i++) {
    checkers[i].addEventListener("click", function() {
        if (checkers[i].checked==true) {
            checked++;
            console.log(checked);
        } else {
            checked --;
            console.log(checked);
        }
        if(checked>0){
            document.getElementById('supprimer').style.display = "block";
        }else{
            document.getElementById('supprimer').style.display = "none";
        }
    });
  }
// @include('delivers.js')
@endsection
