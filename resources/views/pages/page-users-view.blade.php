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
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Liste des utilisateurs</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="/">Acceuil</a>
            </li>
            <li class="breadcrumb-item"><a href="{{route('user.list')}}">Utilisateurs</a>
          </li>
            <li class="breadcrumb-item active">Profil de l'utlisateur
            </li>
          </ol>
      </div>
    </div>
  </div>
  <div class="col s12">
    <div class="container">
      <div class="section">
        <div class="card">
          <div class="section users-view">
            <div class="card-panel">
              <div class="row">
                <div class="col s12 m7">
                  <div class="display-flex media">
                    <div href="#" class="avatar">
                      @if(!$usr->image)
                      <div class="avatar">
                        <img src="{{ 'https://ui-avatars.com/api/?background=8EC741&color=ffff/?uppercase=true&name=' . $usr->name. '+' .$usr->firstname}}" alt="Photo de profil" class="z-depth-4 circle" height="40" width="40">
                      </div>
                      @endif
                      @if($usr->image)
                      <div class="avatar">
                        <img src="{{ asset('public/Image/'.$usr->image) }}" alt="Photo de profil" class="z-depth-4 circle" height="40" width="40">
                      </div>
                      @endif
                    </div>
                    <div class="media-body">
                      <h6 class="media-heading">
                        <span>{{$usr->name}} </span>
                        <span>{{$usr->firstname}} </span>
                      </h6>
                    </div>
                  </div>
                </div>
                <div class="col s12 m5 quick-action-btns display-flex justify-content-end align-items-center pt-2">
                  <a href="{{ route('user.edit', ['id' => $usr->id]) }}" class="btn-small indigo">Editer</a>
                  <a href="{{ route('user.list') }}" class="btn-small indigo">Retour</a>
                </div>
              </div>
            </div>
            <!-- users view media object ends -->
            <!-- users view card data start -->
            <div class="card">
              <div class="card-content">
                <div class="row">
                  <div class="col s12 m4">
                    <table class="striped">
                      <tbody>
                        <tr>
                          <td>Enrégistré le:</td>
                          <td>{{$user->created_at->format('d M Y')}}</td>
                        </tr>
                        <!-- <tr>
                <td>Latest Activity:</td>
                <td class="users-view-latest-activity">30/04/2019</td>
              </tr> -->
                        <!-- <tr>
                <td>Verified:</td>
                <td class="users-view-verified">Yes</td>
              </tr> -->
                        <tr>
                          @if(count($usr->roles) > 1)
                          <td>Rôles:</td>
                          @else
                          <td>Rôle:</td>
                          @endif
                          @for ($i = 0; $i < count($usr->roles); $i++)
                            <td>{{ ucfirst(trans($usr->roles[$i]->name)) }}</td>
                            @endfor
                        </tr>
                        <tr>
                          <td>Status:</td>
                          @if ($usr->status == '1')
                          <td><span class="chip green lighten-5 green-text">Actif</span></td>
                          @endif
                          @if ($usr->status == '0')
                          <td><span class="chip green lighten-5 green-text">Non actif</span></td>
                          @endif
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <!-- <div class="col s12 m8">
          <table class="responsive-table">
            <thead>
              <tr>
                <th>Module Permission</th>
                <th>Read</th>
                <th>Write</th>
                <th>Create</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Users</td>
                <td>Yes</td>
                <td>No</td>
                <td>No</td>
                <td>Yes</td>
              </tr>
              <tr>
                <td>Articles</td>
                <td>No</td>
                <td>Yes</td>
                <td>No</td>
                <td>Yes</td>
              </tr>
              <tr>
                <td>Staff</td>
                <td>Yes</td>
                <td>Yes</td>
                <td>No</td>
                <td>No</td>
              </tr>
            </tbody>
          </table>
        </div> -->
                </div>
              </div>
            </div>
            <!-- users view card data ends -->

            <!-- users view card details start -->
            <div class="card">
              <div class="card-content">
                <!-- <div class="row indigo lighten-5 border-radius-4 mb-2">
        <div class="col s12 m4 users-view-timeline">
          <h6 class="indigo-text m-0">Posts: <span>125</span></h6>
        </div>
        <div class="col s12 m4 users-view-timeline">
          <h6 class="indigo-text m-0">Followers: <span>534</span></h6>
        </div>
        <div class="col s12 m4 users-view-timeline">
          <h6 class="indigo-text m-0">Following: <span>256</span></h6>
        </div>
      </div> -->
                <div class="row">
                  <div class="col s12">
                    <table class="striped">
                      <tbody>
                        <!-- <tr>
                <td>Username:</td>
                <td>{{ $usr->name }}</td>
              </tr> -->
                        <!-- <tr>
                <td>Name:</td>
                <td class="users-view-name"></td>
              </tr> -->
                        <tr>
                          <td>E-mail:</td>
                          <td>{{ $usr->email }}</td>
                        </tr>
                        <!-- <tr>
                <td>Comapny:</td>
                <td>XYZ Corp. Ltd.</td>
              </tr> -->

                      </tbody>
                      <!-- </table>
          <h6 class="mb-2 mt-2"><i class="material-icons">link</i> Social Links</h6>
          <table class="striped">
            <tbody>
              <tr>
                <td>Twitter:</td>
                <td><a href="#">https://www.twitter.com/</a></td>
              </tr>
              <tr>
                <td>Facebook:</td>
                <td><a href="#">https://www.facebook.com/</a></td>
              </tr>
              <tr>
                <td>Instagram:</td>
                <td><a href="#">https://www.instagram.com/</a></td>
              </tr>
            </tbody>
          </table> -->
                      <h6 class="mb-2 mt-2"><i class="material-icons">error_outline</i> Informations personnelles</h6>
                      <table class="striped">
                        <tbody>
                          <!-- @if($usr->birthday)
                <tr>
                  <td>Birthday:</td>
                  <td>{{$usr->birthday}}</td>
                </tr>
                @else
                <tr>
                  <td>Birthday:</td>
                  <td>Pas disponible pour le moment</td>
                </tr>
                @endif -->
                          <tr>
                            <td>Pays:</td>
                            <td>Bénin</td>
                          </tr>
                          @if($usr->langage)
                          <tr>
                            <td>Langue:</td>
                            <td>{{$usr->langage}}</td>
                          </tr>
                          @else
                          <tr>
                            <td>Langue:</td>
                            <td>Français</td>
                          </tr>
                          @endif
                          @if($usr->phone)
                          <tr>
                            <td>Contact:</td>
                            <td>{{$usr->phone}}</td>
                          </tr>
                          @endif
                        </tbody>
                      </table>
                  </div>
                </div>
                <!-- </div> -->
              </div>
            </div>
            <!-- users view card details ends -->

          </div>
        </div>
      </div>


    </div>
    <div class="content-overlay"></div>
  </div>
</div>
@endsection
@section('js')
@endsection
