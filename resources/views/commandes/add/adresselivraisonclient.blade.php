<fieldset class="scheduler-border" style="display: block; margin: 2%;" id="cardadresselivraison">
    <legend class="scheduler-border-limite">Adresse livraison</legend>
    <div class="form-row">

        <div class="col-md-12">

            <div class="control-group">

                <div class="row">
                    @if (session()->get('searchCustomer') == null)

                    <div class="input-field col m6 s6">
                        <input id="carnet_adresse_client" type="text"
                            name="carnet_adresse_client" value="">
                        <label style="color: black" for="carnet_adresse_client">Adresse
                            de livraison</label>
                        @error('carnet_adresse_client')
                            <small class="red-text ml-7" role="alert">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    @else

                    <div class="input-field col m6 s6">
                        <select class="browser-default" name="carnet_adresse_client"
                            id="carnet_adresse_client">
                            <option value="">Adresse</option>
                            <option class=""
                                style="background-color: rgb(114, 200, 114); color: white; text-align: center"
                                value="" data-id="Nouveau"
                                data-client="{{session()->get('searchCustomer')->id}}">
                                Nouveau</option>
                                @foreach (listAddressCustomer(session()->get('searchCustomer')->id) as $item)
                                <option value="{{ $item->id }}">{{ $item->address }}</option>
                                @endforeach

                        </select>
                        @error('carnet_adresse_client')
                            <small class="red-text ml-7" role="alert">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    @endif
                    <div class="input-field col m6 s12">
                        <input id="adresse_sup_client" type="text" name="adresse_sup_client"
                            value="">
                        <label style="color: black" for="adresse">Informations
                            supplementaires</label>
                        @error('adresse_sup_client')
                            <small class="red-text ml-7" role="alert">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</fieldset><br>
