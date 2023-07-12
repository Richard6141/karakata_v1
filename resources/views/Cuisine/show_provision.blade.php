@extends('layouts.app')

@section('content')
<div class="col s12">
        <div class="card animate fadeUp">
          <div class="card-content">
            <div class="row" id="product-four" style="margin:2%; paddding:5%">

              <div class="col m6 s12">
               
              <img  class="" height="300" width="400" src="{{ url('image/' . $CuisineProvision->image) }}" alt="Recu d'achat">
          
            </div>
              <div class="col m6 s12">
        
                <h5 style="color: black;">{{$CuisineProvision->label}}</h5><ul class="list-bullet">
                  <li class="list-item-bullet" >Date d'achat : <span style="color: black;">
                  {{$CuisineProvision->purchase_date}}
                 </span> </li>

                 <li class="list-item-bullet" >Quantité achetée : <span style="color: black;">
                 {{$CuisineProvision->quantity}}
                 </span> </li>

                 <li class="list-item-bullet">Montant total : <span style="color: black;">
                 {{$CuisineProvision->amount}}
                 </span> </li>


                  <li class="list-item-bullet">Observation : <span style="color: black;">{{$CuisineProvision->comment}}</span></li>
                  
                <a href="{{route('cuisineprovision.index')}}" class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 ">RETOUR</a>
                <a id="editBtn" href="{{ route('cuisine.update',$CuisineProvision->id)}}"
              class="invoice-action-edit modal-trigger">
              <span class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 ">
                MODIFIER
              </span>

              </a>

              </div>
            </div>
          </div>
        </div>
      </div>
@endsection

