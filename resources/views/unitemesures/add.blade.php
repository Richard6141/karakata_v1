<div id="modal1" class="modal" style="width: 35%;">
    <div class="modal-content">
        <h5 style="color:green;" class="center">Ajout d'une unité de mesure</h5>
        <form id="addForm" class="" action="{{route('unites.store')}}" method="POST">
            @csrf
            <div class="row margin">
                <div class="">
                    <label for="labels" class="center-align" style="color:#F7350C;">Libellé :</label>
                    <input id="labels" name="labels" value="" type="text" class="@error('labels') is-invalid @enderror">
                    @error('labels')
                    <small class="red-text ml-7" role="alert">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
            </div>

            <div class="row">
                <!-- <div class="input-field col s12">
                    <button class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12" type="submit">Enregistrer</button>

                </div> -->
            </div>

        </form>
    </div>
    <div class="modal-footer btn-floating" style="display:flex; justify-content:space-between; padding-left:10%;padding-right:10%;padding-top:0%">
        <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat border-round gradient-45deg-purple-deep-orange " style="color:white">Annuler</a>
        <button  form="addForm" href="#!" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange " type="submit">Enregistrer</button>
    </div>
</div>



