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
  </div>
  <div class="col s12">
    <div class="container">
      <div class="section">
        <div class="card">
          <!-- <div class="section users-view"> -->
            <div class="card-panel">
              <div class="row">
                <div class="col s12 m7">
                  <div class="display-flex media">
                    <div href="#" class="avatar">
                      @if(!$user->image)
                      <div class="avatar">
                        <img src="{{ 'https://ui-avatars.com/api/?background=8EC741&color=ffff/?uppercase=true&name=' . $user->name. '+' . $user->firstname }}" alt="Photo de profil" class="z-depth-4 circle" height="60" width="60">
                      </div>
                      @endif
                      @if($user->image)
                      <div class="avatar">
                        <img src="{{ asset('image/'.$user->image) }}" alt="Photo de profil" class="z-depth-4 circle" height="60" width="60">
                      </div>
                      @endif
                    </div>
                    <div class="media-body" style="margin-left:20px; margin-top:20px">
                      <h6 class="media-heading" style="font-weight: 900">
                        <span>{{$user->name}} </span>
                        <span>{{$user->firstname}} </span>
                      </h6>
                    </div>
                  </div>
                </div>
                <div class="col s12 m5 quick-action-btns display-flex justify-content-end align-items-center pt-2">
                  <a href="{{ route('user.edit', ['id' => $user->id]) }}" class="btn-small indigo">Editer</a>
                  <a href="{{ route('user.list') }}" class="btn-small indigo" style="margin-left: 20px;">Retour</a>
                </div>
              </div>
            </div>
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
                        <tr>
                          @if(count($user->roles) > 1)
                          <td>Rôles:</td>
                          @else
                          <td>Rôle:</td>
                          @endif
                          @for ($i = 0; $i < count($user->roles); $i++)
                            <td>{{ ucfirst(trans($user->roles[$i]->name)) }}</td>
                            @endfor
                        </tr>
                        <tr>
                          <td>Status:</td>
                          @if ($user->status == '1')
                          <td><span class="chip green lighten-5 green-text">Actif</span></td>
                          @endif
                          @if ($user->status == '0')
                          <td><span class="chip green lighten-5 green-text">Non actif</span></td>
                          @endif
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-content">
                <div class="row">
                  <div class="col s12">
                    <table class="striped">
                      <tbody>
                        <tr>
                          <td>E-mail:</td>
                          <td>{{ $user->email }}</td>
                        </tr>
                      </tbody>
                      <h6 class="mb-2 mt-2"><i class="material-icons">error_outline</i> Informations personnelles</h6>
                      <table class="striped">
                        <tbody>
                          <tr>
                            <td>Country:</td>
                            <td>Bénin</td>
                          </tr>
                          @if($user->langage)
                          <tr>
                            <td>Languages:</td>
                            <td>{{$user->langage}}</td>
                          </tr>
                          @else
                          <tr>
                            <td>Languages:</td>
                            <td>Français</td>
                          </tr>
                          @endif
                          @if($user->phone)
                          <tr>
                            <td>Contact:</td>
                            <td>{{$user->phone}}</td>
                          </tr>
                          @endif
                        </tbody>
                      </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col s12 m12 l12">
              <div id="inline-form" class="card card card-default scrollspy">
                <div class="card-content">
                  <h4 class="card-title">Changement du mot de passe</h4>
                  <form method="POST" action="{{route('update-password')}}">
                    @csrf
                    <div class="">
                      <div class="input-field col m4 s6">
                        <i class="material-icons prefix">lock_outline</i>
                        <input id="icon_prefix1" type="password" class="@error('old_password') is_invalid @enderror validate" name="old_password">
                        <label for="icon_prefix1">Actuel mot de passe</label>
                        @error('old_password')
                        <small class="red-text ml-7" role="alert">
                          {{ $message }}
                        </small>
                        @enderror
                      </div>
                      <div class="input-field col m4 s6">
                        <i class="material-icons prefix">lock_outline</i>
                        <input id="icon_password" type="password" class="@error('new_password') is_invalid @enderror validate" name="new_password">
                        <label for="icon_password">Nouveau mot de passe</label>
                        @error('new_password')
                        <small class="red-text ml-7" role="alert">
                          {{ $message }}
                        </small>
                        @enderror
                      </div>
                      <div class="input-field col m4 s6">
                        <i class="material-icons prefix">lock_outline</i>
                        <input id="icon_password" type="password" class="@error('new_password_confirmation') is_invalid @enderror validate" name="new_password_confirmation">
                        <label for="icon_password">Confirmation</label>
                        @error('new_password_confirmation')
                        <small class="red-text ml-7" role="alert">
                          {{ $message }}
                        </small>
                        @enderror
                      </div>
                      <div class="row">
                        <div class="input-field col s12">
                          <button class="btn cyan waves-effect waves-light right" type="submit">Enregistrer
                            <i class="material-icons right">send</i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          <!-- </div> -->
        </div>
      </div>
    </div>
    <div class="content-overlay"></div>
  </div>
</div>
@endsection
@section('js')
@endsection