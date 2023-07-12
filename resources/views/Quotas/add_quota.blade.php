<div id="modalcomposant" class="modal">
    <div class="modal-content">
        <h5 style="color: green;" class="center">Renseigner le quota</h5>
        <form id="addForm" class="" action="{{ route('add.quota') }}" method="POST">
            @csrf
            <div class="row margin">
                <div>

                    <div class="input-field col s12">
                        <select name="pack_id" id="pack" class="browser-default" required>
                            <option value="">Choisissez le plat</option>
                            @foreach ($packs as $pack)
                            <option value="{{ $pack->id }}">{{ $pack->label }}</option>
                            @endforeach
                        </select>
                        {{-- <label style="color: black; font-size: 100%;">Choisissez le plat<m/label> --}}
                    </div>
                    <div class="input-field col s12">
                        {{-- <label for=" nombre" class="center-align" style="color:black;">Quota :</label> --}}
                        <input id="quota" name="quota" value="" type="number" placeholder="Quota" required>
                    </div>
                    <div class="input-field col s12">
                        <label for=" date" class="center-align" style="color:black;"></label>
                        <input id="date" name="date" value="" type="date" required>
                    </div>

                </div>
            </div>
            <div class="row">
            </div>
        </form>
    </div>
    <div class="modal-footer" style="display:flex; justify-content:space-between; padding-left:10%;padding-right:10%;padding-bottom:10%">
        <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat border-round gradient-45deg-purple-deep-orange " style="color:white">Annuler</a>
        <button form="addForm" href="#!" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange " type="submit">Enrégistrer</button>
    </div>
</div>