<div id="modalCarnet" class="modal">
    <div class="modal-content">
        <h5 style="color:green;">Ajout d'un pack</h5>
            <div class="row margin">
                <div class="input-field col s6">
                    <input id="addlabel" name="addlabel" value=""
                        type="text"
                        class="@error('addlabel') is-invalid @enderror">
                    <label for="entree">Libellé</label>
                </div>
                <div class="input-field col s6">
                    <input id="addprice" name="addprice" value=""
                        type="number"
                        class="@error('addprice') is-invalid @enderror">
                    <label for="addprice">Prix</label>
                </div>
                <div class="input-field col m6 s6">
                    <select class="browser-default" name="addtype_pack_id"
                        id="addtype_pack_id">
                        <option value="">Type pack</option>
                        @foreach ($typepacks as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->label }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="input-field col m6 s6">
                    <div class="switch">
                        <br>
                    </div>
                    <div class="switch">
                        <label style="font-weight: bold;">
                            <input type="checkbox" id="addcheckboxclient" name="addcheckboxclient"
                                value="1">
                            <span class="lever"></span>
                            Voulez-vous l'activer ?
                        </label>
                    </div>

                </div>
            </div>

            <div class="row">
                <!-- <div class="input-field col s12">
                    <button class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12" type="submit">Enregistrer</button>

                </div> -->
            </div>

    </div>
    <div class="modal-footer" style="display:flex; justify-content:space-between; padding-left:10%;padding-right:10%;padding-bottom:10%">
        <a id="annulermodal" href="#!" class="modal-action modal-close waves-effect waves-red btn-flat border-round gradient-45deg-purple-deep-orange " style="color:white">Annuler</a>
        <button id="Ajoutpack"  class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange ">Enregistrer</button>
    </div>
</div>



