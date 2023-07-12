<div id="entreprisemodal" class="contact-compose-sidebar modal">
  <div class="card quill-wrapper">
    <div class="card-content pt-0">
      <div class="card-header display-flex pb-2">
        <h3 class="card-title contact-title-label">Ajouter un client</h3>
        <div class="close close-icon">
          <i class="material-icons modal-action modal-close">close</i>
        </div>
      </div>
      <div class="divider"></div>
      <!-- form start -->
      <form id="EntrepriseAdd" class="edit-contact-item mb-5 mt-5" action="{{ route('company.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix"> perm_identity </i>
            <input id="name" name="name" value="{{old('name')}}" type="text" class="validate @error('name') is-invalid @enderror" required>
            <label for="name">Nom</label>
            @error('name')
            <small class="red-text ml-7" role="alert">
                {{ $message }}
            </small>
            @enderror
          </div>
          <div class="input-field col s12">
            <i class="material-icons prefix"> perm_identity </i>
            <input id="firstname" name="firstname" value="{{old('firstname')}}" type="text" class="validate @error('firstname') is-invalid @enderror" required>
            <label for="last_name">Prénoms</label>
            @error('firstname')
            <small class="red-text ml-7" role="alert">
                {{ $message }}
            </small>
            @enderror
          </div>
          <div class="input-field col s12">
            <i class="material-icons prefix"> business </i>
            <input id="socialreason" name="socialreason" value="{{old('socialreason')}}" type="text" class="validate @error('socialreason') is-invalid @enderror" required>
            <label for="socialreason">Entreprise</label>
            @error('socialreason')
            <small class="red-text ml-7" role="alert">
                {{ $message }}
            </small>
            @enderror
          </div>

        </div>
        <div class="row">
            <div class="input-field col s12">
              <i class="material-icons prefix"> call </i>
              <input id="phone" name="phone" value="{{old('phone')}}" type="text" class="validate @error('phone') is-invalid @enderror">
              <label for="phone">Téléphone</label>
              @error('phone')
              <small class="red-text ml-7" role="alert">
                  {{ $message }}
              </small>
              @enderror
            </div>

          <div class="input-field col s12">
            <i class="material-icons prefix"> email </i>
            <input id="email" name="email" value="{{old('email')}}" type="email" class="validate @error('email') is-invalid @enderror">
            <label for="email">Email</label>
            @error('email')
            <small class="red-text ml-7" role="alert">
                {{ $message }}
            </small>
            @enderror
          </div>
        </div>
      </form>
      <div class="card-action pl-0 pr-0 right-align">
        <button type="submit" form="EntrepriseAdd" class="btn-small waves-effect waves-light ">
          <span>Ajouter</span>
        </button>
        <button class="btn-small waves-effect waves-light update-contact display-none">
          <span>Modifier</span>
        </button>
      </div>
      <!-- form start end-->
    </div>
  </div>
</div><!-- START RIGHT SIDEBAR NAV -->
