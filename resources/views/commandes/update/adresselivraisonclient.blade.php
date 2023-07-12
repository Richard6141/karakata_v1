<fieldset class="scheduler-border" style="display: block" id="cardadresselivraison">
    <legend class="scheduler-border-limite">Adresse livraison</legend>
    <div class="form-row">
        <div class="col-md-12">
            <div class="control-group">
                <div class="row">
                    @if (is_null($client))
                        <div class="input-field col m6 s6">
                            <input id="carnet_adresse" type="text"
                                name="carnet_adresse" value="">
                            <label style="color: black" for="carnet_adresse">Adresse
                                de livraison</label>
                            @error('carnet_adresse')
                                <small class="red-text ml-7" role="alert">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    @else
                        <div class="input-field col m6 s6">
                            <select class="browser-default" name="carnet_adresse"
                                id="carnet_adresse">
                                <option value="">Adresse</option>
                                <option class=""
                                    style="background-color: rgb(114, 200, 114); color: white; text-align: center"
                                    value="" data-id="Nouveau"
                                    data-client="{{ $client ? $client->id : '' }}">
                                    Nouveau</option>
                                @foreach ($carnet_adresses as $item)
                                    <option value="{{ $item->id }}" {{$commande->address_book_id == $item->id ? 'selected' : ''}}>
                                        {{ $item->address }}
                                    </option>
                                @endforeach
                            </select>
                            @error('carnet_adresse')
                                <small class="red-text ml-7" role="alert">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    @endif
                    <div class="input-field col m6 s12">
                        <input id="adresse_sup" type="text" name="adresse_sup"
                            value="">
                        <label style="color: black" for="adresse">Informations
                            supplementaires</label>
                        @error('phone')
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
