<fieldset class="scheduler-border" id="autre" style="margin: 2%;">
    <legend class="scheduler-border-limite">Autres</legend>
    <div class="form-row">
        <div class="col-md-12">
            <div class="control-group">
                <div class="row">
                    <div class="" id="blockautre">
                        <div class="input-field col s4">
                            <select class="browser-default" name="menu_client" id="menu_client">
                                <option value="">Résistances</option>
                                @foreach ($menu as $key => $value)
                                <option value="{{ $value[0]->component_id }}">
                                    {{ infoResistance($key)->label ?? '' }}
                                </option>
                                @endforeach
                            </select>
                            @error('menu_client')
                            <small class="red-text ml-7" role="alert">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="input-field col s3">
                            <select class="browser-default" name="pack_client" id="pack_client">
                                <option value="">Veuillez choisir le pack</option>
                                @foreach ($packs as $item)
                                <option value="{{ $item->paquet_id }}" {{ infoPaquet($item->paquet_id)->label == 'Standard Pack' ? 'selected' : '' }}>
                                    {{ infoPaquet($item->paquet_id)->paquetType->label }}
                                </option>
                                @endforeach
                            </select>
                            @error('pack_client')
                            <small class="red-text ml-7" role="alert">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>

                        <div class="input-field col m2 s12">
                            <i class="material-icons prefix pt-2"></i>
                            <input id="nbr_client" type="number" name="nbr_client" value="1" >
                            <label style="color: black" for="nbr">Quantité
                                pack</label>
                            @error('nbr_client')
                            <small class="red-text ml-7" role="alert">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="input-field col m3 s12">
                            <i class="material-icons prefix pt-2"></i>
                            <input id="heur_livr_client" type="time" name="heur_livr_client" value=today>
                            <label style="color: black" for="nbr">Heure de  livraison</label>
                            @error('heur_livr_client')
                            <small class="red-text ml-7" role="alert">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s4">
                        <select class="browser-default" name="source_commande" id="source_commande">
                            <option value="">Source de la commande</option>
                            @foreach ($source_commandes as $item)
                            <option value="{{ $item->id }}" {{ $item->label == 'Whatsapp' ? 'selected' : '' }}>
                                {{ $item->label }}
                            </option>
                            @endforeach
                        </select>
                        @error('source_commande')
                        <small class="red-text ml-7" role="alert">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                    <div class="input-field col s4">
                        <select class="browser-default" name="mode_paiement" id="mode_paiement">
                            <option value="">Mode de paiement</option>
                            @foreach ($modepaiements as $item)
                            <option value="{{ $item->id }}" {{ $item->label == 'ESPECE' ? 'selected' : '' }} data-id="{{ $item->label }}">
                                {{ $item->label }}
                            </option>
                            @endforeach
                        </select>

                        @error('mode_paiement')
                        <small class="red-text ml-7" role="alert">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                    <div class="input-field col s4">
                        <select class="browser-default" name="district_client" id="district_client">
                            <option value="">Zone de livraison</option>
                            @foreach ($districts as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->label }}
                            </option>
                            @endforeach
                        </select>
                        @error('district_client')
                        <small class="red-text ml-7" role="alert">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <input type="text" name="" id="client_id" value="" style="display: none">
                </div>
            </div>
        </div>
    </div>
</fieldset><br>
