@extends('layouts.app')

@section('content')
<div class="container" >
<div class="section">
  
  <div class="" id="user-profile" >
    <div class="row">
      <!-- User Profile Feed -->
      <div class="col s12 m4 l3 user-section-negative-margin">
        <div class="row">
          <div class="col s12 center-align">
            <img class="responsive-img circle z-depth-5" width="120" src="../../../app-assets/images/user/12.jpg"
              alt="">
            <br>
            @if (!is_null($clients->particulars_id))
            <a id="editBtn" href="{{ route('particular.show' , $clients->id)}}" class="waves-effect waves-light btn mt-5 border-radius-4">
                EDITER
            </a>
            @endif
            @if (!is_null($clients->companies_id))
            <a id="editBtn" href="{{ route('company.show' , $clients->id)}}" class="waves-effect waves-light btn mt-5 border-radius-4">
                EDITER
            </a>
            @endif
          </div>
        </div>
        <div class="row mt-5">
          <div class="col s6">
            <h6>SOLDE</h6>
            <h5 class="m-0">
            @if (is_null($clients->solde))
              <span>0</span>
              @else
              <span>{{$solde->sum}}</span>
              @endif
              <span>F CFA</span>
            </h5>
          </div>
          
        </div>
        <hr>
        <div class="row">
          <div class="col s12">
            <p class="m-0">Commande total :</p>
            <p class="m-0"><a href="#">200</a> et <a href="#">50</a> en cours de livraison</p>
          </div>
        </div>
        <hr>
        
        
       
        
      </div>
      <!-- User Post Feed -->
      <div class="col s12 m8 l9">
        <div class="row">
          <div class="card user-card-negative-margin z-depth-0" id="feed">
            <div class="card-content card-border-gray">
              <div class="row">
                <div class="col s12">
                  <h5>
                  <span>
                        @if (!is_null($clients->particulars_id))
                        <span>{{ $clients->particular->name ?? 'N/A'}}</span>
                        @endif
                        @if (!is_null($clients->companies_id))
                        <span>{{ $clients->company->name ?? 'N/A' }}</span> 
                        @endif
                        </span>
                        <span>
                        @if (!is_null($clients->particulars_id))
                        <span>{{ $clients->particular->firstname ?? 'N/A' }}</span> 
                        @endif
                        @if (!is_null($clients->companies_id))
                        <span>{{ $clients->company->firstname ?? 'N/A' }}</span> 
                        @endif
                        </span>
                  </h5>
                  <div class="col s12 m7 ">
                  
                  <a href="" style="margin:1%" class="btn-small indigo">Commande</a>
                  <a href="#modal1" style="margin:1%" class="btn-small indigo modal-trigger">Suggestion</a>
                  <a id="#depot" href="#modal2" style="margin:1%" class="btn-small indigo modal-trigger">Dépôt</a>
                  
                </div>
                </div>
              </div>
              <div class="row">
                <div class="col s12">
                  <ul class="tabs card-border-gray mt-4">
                    <li class="tab col m3 s6 p-0"><a class="active" href="#commande">
                        <i class="material-icons vertical-align-middle">crop_portrait</i> COMMANDES
                      </a></li>
                    <li class="tab col m3 s6 p-0"><a href="#depot">
                        <i class="material-icons vertical-align-middle">bookmark_border</i> DEPOTS
                      </a></li>
                    <li class="tab col m3 s6 p-0"><a href="#suggestion">
                        <i class="material-icons vertical-align-middle">date_range</i> SUGGESTIONS
                      </a></li>
                    
                  </ul>
                </div>
                <div id="commande" class="col s12">Liste des Commandes</div>
                <div id="depot" class="col s12">
                @include('clients.list_depots')
                </div>
                <div id="suggestion" class="col s12">
                @include('clients.list_suggestions')
                </div>
              </div>
              
             
            
            </div>
          </div>
        </div>
      </div>
      <!-- Today Highlight -->
      
    </div>
  </div>
</div><!-- START RIGHT SIDEBAR NAV -->

@include('clients.suggestion')
      @include('clients.depot')
          </div>
      
@endsection
@section('scripts')
@include('clients.js')
@endsection