@extends('layouts.app')

@section('content')
@if (session()->has('successMessage'))
<div class="alert alert-success" role="alert">
  {{ session('successMessage') }}
</div>
@endif
@if (session()->has('errorMessage'))
<div class="alert alert-danger" role="alert">
  {{ session('errorMessage') }}
</div>
@endif
<div class="row">
  <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Liste des livreurs</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="/">Acceuil</a>
            </li>
            <li class="breadcrumb-item"><a href="{{route('delivers.index')}}">Livreurs</a>
          </li>
            <li class="breadcrumb-item active">Profil de livreur
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <div class="col s12">
    <div class="container">
      <div class="section">
        <div class="card">
          <div class="section users-view">
            <!-- users view media object start -->
            <div class="card-panel">
              <div class="row">
                <div class="col s12 m7">
                  <div class="display-flex media">
                    <div class="media-body">
                      <h6 class="media-heading">
                        <ul class="tabs tabs-fixed-width tab-demo z-depth-1">
                          <li class="tab"><a class="active" href="#test1">Informations</a></li>
                          <li class="tab" ><a  href="#test2">Livraisons effectuées</a></li>
                        </ul>
                        <div id="test1" class="col s12">
                            <table class="striped">
                              <tbody>               
                                <tr>
                                  <td>Nom:</td>
                                  <td>{{$deliver->lastname}}</td>
                                </tr>
                                
                                <tr>
                                  <td>Prénoms:</td>
                                  <td>{{$deliver->firstname}}</td>
                                </tr>
                                
                                <tr>
                                  <td>Téléphone:</td>
                                  <td>{{$deliver->phone}}</td>
                                </tr>
                              </tbody>
                            </table>
                        </div>
                        <div id="test2" class="col s12">
                          <div class="responsive-table">
                                                    <table id="data-table-simple" style="width:100%;">
                                                         <thead>
                                                            <tr style="color:black">
                                                                <th >Date</th>
                                                                <th style="text-align:right">Nombre de livraisons</th>
                                                                
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($orders as $item)
                                                            <tr>
                                                                <td><span>{{ $item->date ?? 'N/A'}} </span></td>
                                                                <td style="text-align:right"><span>{{ $item->total ?? '' }} </span></td>
                                                        
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
            </div>

                </div>
              </div>
            </div>
              </div>
              
            </div>
            <!-- users view card details ends -->
        </div>
      </div>


    </div>
  </div>
</div>
@endsection
@section('js')
@endsection
