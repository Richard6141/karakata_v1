<div id="modalcomposant" class="modal" >
    <div class="modal-content">
        <h5 style="color: green;" class="center">Ajout d'un client</h5>
        <form id="addForm" class="" action="{{ route('add.quota') }}" method="POST">
            @csrf
            <div>
                <p id="messageerrorfirstname" style="text-align: center; color: red; display: none;">Le champ Nom est obligatoire</p>
                <p id="messageerrorlastname" style="text-align: center; color: red; display: none;">Le champ Prénom est obligatoire</p>
                <p id="messageerrorphonenew" style="text-align: center; color: red; display: none;">Le champ Téléphone est obligatoire</p>
                <p id="messageerroremail" style="text-align: center; color: red; display: none;">Le champ Email est obligatoire</p>
                <p id="messageerrorraisonsociale" style="text-align: center; color: red; display: none;">Le champ Raison sociale est obligatoire</p>
            </div>
            <div class="row margin">
                <div>
                    <div class="input-field col s6">
                        <select name="type_customer" id="type_customer" class="browser-default">

                            <option value="Particulier">Particulier</option>
                            <option value="Entreprise">Entreprise</option>
                        </select>
                        {{-- <label style="color: black; font-size: 100%;">Choisissez le plat</label> --}}

                    </div>
                    <div class="input-field col s6">
                        <input id="raisonsociale" name="raisonsociale" value="" type="text" placeholder="Raison sociale" readonly>

                    </div>
                    <div class="input-field col s6">
                        <input id="firstname" name="firstname" value="" type="text" placeholder="Nom *">
                    </div>
                    <div class="input-field col s6">
                        <input id="lastname" name="lastname" value="" type="text" placeholder="Prénom *">
                    </div>
                    <div class="input-field col s6">
                        <input id="phonenew" name="phonenew" value="" type="number" placeholder="Téléphone">
                    </div>
                    <div class="input-field col s6">
                        <input id="email" name="email" value="" type="email" placeholder="Email">
                    </div>
                </div>
            </div>
            <div class="row">
            </div>
        </form>
    </div>
    <div class="modal-footer"
        style="display:flex; justify-content:space-between; padding-left:10%;padding-right:10%;padding-bottom:10%">
        <a href="javascript:;" id="annulermodal"
            class="modal-action modal-close waves-effect waves-red btn-flat border-round gradient-45deg-purple-deep-orange "
            style="color:white">Annuler</a>
        <button href="javascript:;" id="addNewCustomer"
            class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange "
            >Enrégistrer</button>
    </div>
</div>
