<div class="" style="color: red; display: none" id="infocustomerexist">Les informations de ce client existe déjà</div>
<fieldset class="scheduler-border" @if (session()->get('searchCustomer') !== null) @if (checkDateCustomer(session()->get('searchCustomer')->birthdate) == true) style="padding: 0 !important; background-color:#ffe4e1;" @else style="padding: 0 !important;" @endif @endif>
    <legend class="scheduler-border-limite">
        <div class="" id="titleCustomer" style="color: black">Client</div>
    </legend>
    @if (session()->get('searchCustomer') !== null)
    @if (checkDateCustomer(session()->get('searchCustomer')->birthdate) == true)
    <div style="flex-direction:row; text-align:end; margin-top: -10px" id="cardhappybirthday">
        <a>
            <div style="height: 100%; width: 20%; border-radius: 0 10px 0 20px; background-color: #409705; text-align: center; color: #fff; font-weight: bold; font-size:11px" class="waves-effect waves-light btn" style="color: white">Joyeux anniverssaire</div>
        </a>
    </div>
    @endif
    @endif
    <div class="form-row">
        <div class="col-md-12">
            <div class="control-group">
                <div class="row">
                    <div class="input-field col m6 s12">
                        <input id="nom" type="text" name="nom" @if (session()->get('searchCustomer') !== null) value="{{ session()->get('searchCustomer')->particular->name ?? session()->get('searchCustomer')->company->name }}" @endif placeholder="Nom" readonly>
                        {{-- <label for="nom" style="color: black">Nom</label> --}}
                        @error('nom')
                        <small class="red-text ml-7" role="alert">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                    <div class="input-field col m6 s12">
                        <input id="prenom" type="text" name="prenom" @if (session()->get('searchCustomer') !== null) value="{{session()->get('searchCustomer')->particular->firstname ?? session()->get('searchCustomer')->company->firstname}}" @endif placeholder="Prénom" readonly>
                        {{-- <label style="color: black" for="prenom">Prénom</label> --}}
                        @error('prenom')
                        <small class="red-text ml-7" role="alert">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="input-field col m6 s12" style="padding: 27px">
                            <input id="phone1" type="tel" name="phone" placeholder="Téléphone" value="{{session()->get('searchCustomer')->phone ?? ''}}" readonly>
                            @error('phone')
                            <small class="red-text ml-7" role="alert">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>

                        <div class="input-field col m6 s12" style="padding: 27px">
                            <input id="email11" type="email" name="email11" placeholder="Email" value="{{session()->get('searchCustomer')->email ?? ''}}" readonly>
                            @error('email')
                            <small class="red-text ml-7" role="alert">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <input type="text" name="idcustomersearch" id="idcustomersearch" value="{{session()->get('searchCustomer')->id ?? ''}}" hidden>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (session()->get('searchCustomer') !== null)
    @if (session()->get('searchCustomer')->solde > 0)
    <div style="flex-direction:row; text-align:end; margin-top: -10px" id="solddiv">
        <div style = "text-align:end; height: 100%; width: 20%; border-radius: 20px 0 10px 0 ; background-color: #409705; text-align: center; color: #fff; font-weight: bold; font-size:18px" class="waves-effect waves-light btn">Solde : <span>{{session()->get('searchCustomer')->solde}}</span>FCFA</div>
    </div>
    @endif
    @endif
    </div>
</fieldset>