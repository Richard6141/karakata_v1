<div id="modal1" class="modal">
    <div class="modal-content">
        <h5 style="color:green;">Ajout un pack</h5>
        <form id="addForm" class="" action="{{route('pack.store', $pack->id ?? 0)}}" method="Post" enctype="multipart/form-data">
            @csrf
            <div class="row margin">
                {{-- <div class="">
                    <label for="label" class="center-align" style="color:#F7350C;">Libellé :</label>
                    <input id="label" name="label" value="" type="text" class="@error('label') is-invalid @enderror">

                    @error('label')
                    <small class="red-text ml-7" role="alert">
                        {{ $message }}
                    </small>
                    @enderror
                </div> --}}
                <div class="row">
                    <div class="input-field col s12">
                      <select name="nbr_composant[]" class="@error('nbr_composant') is-invalid @enderror" multiple>
                     
                        <option value="1">Résistance</option>
                        <option value="2">Accompagnement</option>
                        <option value="3">Boisson</option>
                        <option value="4">Dessert</option>
                        <option value="5">Entrée</option> 
                      </select>
                      <label>Les composants  pour ce pack</label>
                      @error('nbr_composant')
                      <small class="red-text ml-7" role="alert">
                        {{ $message }}
                      </small>
                      @enderror
                    </div>
                  </div>
                <div class="">
                    <label for="price" class="center-align" style="color:#F7350C;">Prix :</label>
                    <input id="price" name="price" value=""  type="number" class="@error('price') is-invalid @enderror">
                    @error('price')
                    <small class="red-text ml-7" role="alert">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
                <div class="">
                    <label for="image" class="center-align" style="color:#F7350C;">Image:</label>
                    <input id="image" name="image" value="" type="file" class="@error('image') is-invalid @enderror">
                    @error('image')
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
        <button  form="addForm" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange " type="submit">Enregistrer</button>
    </div>
</div>



