<div id="modal5" class="modal" style="width:40%; padding:1%">
    <div class="modal-content">
        <h5 style="color:green;" class="center">Ajout de source </h5>
        <form id="addForm" class="" action="{{route('sources.store', $sources->id ?? 0)}}" method="POST">
            @csrf
            <div class="row margin">
                <div class="">
                    <label for="label" class="center-align" style="color:#F7350C;">Libellé :</label>
                    <input id="label" name="label" value="" type="text" class="@error('label') is-invalid @enderror" required>
                    @error('label')
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
    <div class="modal-footer" style="display:flex; justify-content:space-between; padding-left:10%;padding-right:10%;padding-bottom:10%">
        <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat border-round gradient-45deg-purple-deep-orange " style="color:white">Annuler</a>
        <button  form="addForm" href="#!" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange " type="submit">Enregistrer</button>
    </div>
</div>



