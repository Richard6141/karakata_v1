<fieldset class="scheduler-border" style="display: block" id="cardrecep">
    <legend class="scheduler-border-limite">Receptionnaire</legend>
    <div class="form-row">
        <div class="col-md-12">
            <div class="control-group">
                <section id="lesDoc1">
                    <div class="form-group form-row" id="doc11">

                        <div class="row">
                            <div class="input-field col m4 s12">
                                <input id="nomrecep" type="text" name="nomrecep" value="{{ $commande->receiver->firstname }}">
                                <label for="nomrecep" style="color: black">Nom</label>
                                @error('nomrecep')
                                    <small class="red-text ml-7" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="input-field col m4 s12">
                                <input id="prenomrecep" type="text" name="prenomrecep" value="{{ $commande->receiver->lastname }}">
                                <label style="color: black" for="prenomrecep">Prénom</label>
                                @error('prenomrecep')
                                    <small class="red-text ml-7" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="input-field col m4 s12">
                                <input id="phonerecep" type="text" name="phonerecep" value="{{ $commande->receiver->phone }}">
                                <label style="color: black" for="email">Téléphone</label>
                                @error('phonerecep')
                                    <small class="red-text ml-7" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col m4 s6">
                                <input id="carnet_adresse" type="text" name="carnet_adresse" value="{{ infoReceiver($commande->address_book_id)->address ?? '' }}">
                                <label style="color: black" for="carnet_adresse">Adresse
                                    de livraison</label>
                                @error('carnet_adresse')
                                    <small class="red-text ml-7" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="input-field col m4 s12">
                                <input id="adresse_sup" type="text" name="adresse_sup" value="{{ $commande->more_information ?? '' }}">
                                <label style="color: black" for="adresse">Informations
                                    supplementaires</label>
                                @error('phone')
                                    <small class="red-text ml-7" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="input-field col s4">
                                <select class="browser-default" name="district_client" id="district_client">
                                    <option value="">Zone de livraison</option>
                                    @foreach ($districts as $item)
                                    <option value="{{ $item->id }}" {{$commande->district_id == $item->id ? 'selected' : ''}}>
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
                        </div>
                        <input type="text" name="inforeceptionnaire" id="inforeceptionnaire" value="receptionnaire">
                        <div class="row">
                            <div class="input-field col s4">
                                <select class="browser-default" name="menu" id="menu">
                                    <option value="">Résistances</option>
                                    @foreach ($menu as $key => $value)
                                    <option value="{{ $value[0]->component_id }}" {{$value[0]->component_id == infoResistances($commande->contain_id)->component_id ? 'selected' : ''}}>
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
                            <div class="input-field col s4">
                                <select class="browser-default" name="pack" id="pack">
                                    <option value="">Pack</option>
                                    @foreach ($packs as $item)
                                    <option value="{{ $item->paquet_id }}" {{$commande->paquet_id == $item->paquet_id ? 'selected' : ''}}>
                                        {{ infoPaquet($item->paquet_id)->label }}
                                    </option>
                                @endforeach
                                </select>
                                @error('pack')
                                    <small class="red-text ml-7" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="input-field col m4 s12">
                                <i class="material-icons prefix pt-2"></i>
                                <input id="nbr" type="number" name="nbr" value="{{$commande->number}}">
                                <label style="color: black" for="nbr">Nombre de
                                    pack</label>
                                @error('nbr')
                                    <small class="red-text ml-7" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <input type="text" name="idreceptionnaire" value="{{$commande->receiver_id}}" id="idreceptionnaire" style="display: none">
                        </div>
                        <br>
                </section>
            </div>
        </div>
    </div>
</fieldset><br>
