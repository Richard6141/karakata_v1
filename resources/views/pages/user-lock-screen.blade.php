

{{-- page title --}}
@section('title','User Lock Screen')

{{-- page style --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/lock.css')}}">
@endsection

{{-- page content --}}
@section('content')
<div id="login-page" class="row">
  <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 login-card">
    <form class="login-form" method="POST" action="{{ route('login') }}">
      @csrf
      <div class="row">
        <div class="input-field col s12">
          <img src="	https://web.topfood.bj/images/LogotTF.png" alt="logo top food" style="width:100%;">
          <h5 class="ml-4">Connexion</h5>
        </div>
      </div>

      @if($errors->any())
      <small class="red-text ml-7" role="alert">
        {{$errors->first()}}
      </small>
      @endif
      <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">person_outline</i>
          <input id="email" type="email" name="email">
          <label for="email" class="center-align">Email</label>
        </div>
        @error('email')
        <small class="red-text ml-7" role="alert">
          {{ $message }}
        </small>
        @enderror
      </div>

      <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">lock_outline</i>
          <input id="password" type="password" name="password">
          <label for="password">Mot de passe</label>
        </div>
        @error('password')
        <small class="red-text ml-7" role="alert">
          {{ $message }}
        </small>
        @enderror
      </div>
      <div class="row">
        <div class="col s12 m12 l12 ml-2 mt-1">
          <p>
            <label>
              <input name="remember" value="1" type="checkbox" />
              <span>Se rappeler de moi</span>
            </label>
          </p>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s12">
          <button type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Login</button>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6 m6 l6">
          <!-- <p class="margin medium-small"><a href="{{asset('user-register')}}">Register Now!</a></p> -->
        </div>
        <div class="input-field col s6 m6 l6">
          <!-- <p class="margin right-align medium-small"><a href="{{asset('user-forgot-password')}}">Forgot password ?</a> -->
          </p>
        </div>
      </div>

    </form>
  </div>
</div>
@endsection
