<fieldset class="scheduler-border" style="" id="autre">
    <legend class="scheduler-border-limite">Autres</legend>
    <div class="form-row">
        <div class="col-md-12">
            <div class="control-group">
                <div class="row">
                    @if (is_null($commande->receptionnaire_id))

                    <div class="" id="blockautre">
                        <div class="input-field col s4">
                            <select class="browser-default" name="menu" id="menu">
                                <option value="">Résistances</option>
                                @foreach ($menu as $key => $value)
                                <option value="{{ $value[0]->component_id }}" {{infoResistances($commande->contain_id)->component_id == $value[0]->component_id ? 'selected' : ''}}>
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
                        @if (is_null($commande->receiver_id))

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
                        @endif
                    </div>
                    @else

                    @endif
                </div>
                <div class="row">
                    <div class="input-field col s4">
                        <select class="browser-default" name="source_commande" id="source_commande">
                            <option value="">Source commande</option>
                            @foreach ($source_commandes as $item)
                                <option value="{{ $item->id }}" {{$commande->source_id == $item->id ? 'selected' : ''}}>
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
                                <option value="{{ $item->id }}" data-id="{{ $item->label }}" {{$commande->payement_mode_id == $item->id ? 'selected' : ''}}>
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
                    @if (is_null($commande->receiver_id))
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
                    @endif
                    <div class="input-field col m4 s12" style="display: none">
                        <input id="price" type="number" name="price" value="{{ $commande->unit_price }}">
                        <label style="color: black" for="price">Prix</label>
                        @error('price')
                            <small class="red-text ml-7" role="alert">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>




                    <input type="text" name="" id="client_id" value="{{ $client ? $client->id : '' }}"
                        style="display: none">
                </div>
            </div>
        </div>
    </div>
</fieldset><br>
