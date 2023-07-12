<fieldset class="scheduler-border" style="display: none"style="margin: 2%;" id="cardrecep">
    <legend class="scheduler-border-limite">Receptionnaire</legend>
    <div class="form-row">
        <div class="col-md-12">
            <div class="control-group">
                <section id="lesDoc1">
                    <div class="form-group form-row" id="doc11">
                        <div class="col-sm-2" style="float: right">
                            <a id="ajouterDoc1" type="button" href="javascript:;" class="btn-floating" style="background-color: blue">
                                <i class="material-icons tooltipped" data-position="top" data-tooltip="Ajouter">add</i>
                            </a>
                        </div>
                        <fieldset class="scheduler-border">

                            <div class="row">
                                <div class="input-field col m4 s12">
                                    <input id="phonerecep" type="text" name="phonerecep[]" data-number="0" value="">
                                    <label style="color: black" for="email">Téléphone</label>
                                    @error('phonerecep')
                                    <small class="red-text ml-7" role="alert">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                                <div class="input-field col m4 s12">
                                    <input id="nomrecep" type="text" name="nomrecep[]" value="">
                                    <label for="nomrecep" style="color: black">Nom</label>
                                    @error('nomrecep')
                                    <small class="red-text ml-7" role="alert">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                                <div class="input-field col m4 s12">
                                    <input id="prenomrecep" type="text" name="prenomrecep[]" value="">
                                    <label style="color: black" for="prenomrecep">Prénom</label>
                                    @error('prenomrecep')
                                    <small class="red-text ml-7" role="alert">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>

                            </div>
                            <div class="row">
                                <div class="input-field col m4 s6">
                                    <input id="carnet_adresse" type="text" name="carnet_adresse[]" value="">
                                    <label style="color: black" for="carnet_adresse">Adresse
                                        de livraison</label>
                                    @error('carnet_adresse')
                                    <small class="red-text ml-7" role="alert">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                                <div class="input-field col m4 s12">
                                    <input id="adresse_sup" type="text" name="adresse_sup[]" value="">
                                    <label style="color: black" for="adresse">Informations
                                        supplementaires</label>
                                    @error('adresse_sup')
                                    <small class="red-text ml-7" role="alert">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                                <div class="input-field col s4">
                                    <select class="browser-default" name="district[]" id="district">
                                        <option value="">Zone de livraison</option>
                                        @foreach ($districts as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->label }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('district')
                                    <small class="red-text ml-7" role="alert">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s4">
                                    <select class="browser-default" name="menu[]" id="menu">
                                        <option value="">Résistances</option>
                                        @foreach ($menu as $key => $value)
                                        <option value="{{ $value[0]->component_id }}">
                                            {{ infoResistance($key)->label ?? '' }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('pack')
                                    <small class="red-text ml-7" role="alert">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                                <div class="input-field col s3">
                                    <select class="browser-default" name="pack[]" id="pack">
                                        <option value="">Pack</option>
                                        @foreach ($packs as $item)
                                        <option value="{{ $item->paquet_id }}" {{ (infoPaquet($item->paquet_id)->label == "Standard Pack") ? 'selected' : ''}}>
                                            {{ infoPaquet($item->paquet_id)->paquetType->label }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('pack')
                                    <small class="red-text ml-7" role="alert">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                                <div class="input-field col m2 s12">
                                    <i class="material-icons prefix pt-2"></i>
                                    <input id="nbr" type="number" name="nbr[]" value="1" value="">
                                    <label style="color: black" for="nbr">Quantité
                                        pack</label>
                                    @error('nbr')
                                    <small class="red-text ml-7" role="alert">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                                <div class="input-field col m3 s12">
                                    <i class="material-icons prefix pt-2"></i>
                                    <input id="heur_livr" type="time" name="heur_livr[]">
                                    <label style="color: black" for="nbr">Heure de  livraison</label>
                                    @error('heur_livr')
                                    <small class="red-text ml-7" role="alert">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>
                        <br>
                </section>
            </div>
        </div>
    </div>
</fieldset><br>
