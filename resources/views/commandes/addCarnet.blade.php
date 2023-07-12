<div id="modalCarnet" class="modal">
    <div class="modal-content">
        <h5 style="color:green; text-align: center">Ajout d'une adresse</h5>
            <div class="row margin">
                <div class="">
                    <label for="addadresse" class="center-align" style="color:black;">Libellé :</label>
                    <input id="addadresse" name="addadresse" value="" type="text" class="@error('addadresse') is-invalid @enderror">
                    <input type="text" name="idclient" id="idclient" hidden>
                    <p id="messageerroraddadresse" style="text-align: center; color: red; display: none;">L'adresse est obligatoire</p>

                </div>
            </div>

            <div class="row">
                <!-- <div class="input-field col s12">
                    <button class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12" type="submit">Enregistrer</button>

                </div> -->
            </div>

    </div>
    <div class="modal-footer" style="display:flex; justify-content:space-between; padding-left:10%;padding-right:10%;padding-bottom:10%">
        <a id="annulermodaladdress" href="#!" class="modal-action modal-close waves-effect waves-red btn-flat border-round gradient-45deg-purple-deep-orange " style="color:white">Annuler</a>
        <button id="Ajoutcarnet"  class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange ">Enregistrer</button>
    </div>
</div>



