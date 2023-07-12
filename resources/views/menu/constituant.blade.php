<div id="modalAddConstituant" class="modal">
    <form action="{{ route('addconstituant.store') }}" method="post">
        @csrf
        <div class="modal-content">
            <h5 style="color:green;">Ajout d'un constituant</h5>
            <div class="row margin">
                <div class="input-field col m6 s6">
                    <select class="browser-default" name="typecomposant" id="typecomposant">
                        <option value="">Type composants</option>
                        @foreach ($typecomposants as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->label }}
                            </option>
                        @endforeach
                    </select>
                    @error('typecomposant')
                        <small class="red-text ml-7" role="alert">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="input-field col m6 s6">
                    <select class="browser-default" name="constituant" id="constituant">
                        <option value="">Composants</option>
                        <option class=""
                            style="background-color: rgb(114, 200, 114); color: white; text-align: center"
                            value="" data-id="Nouveau">
                            Nouveau</option>
                        @foreach ($composants as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->label }}
                            </option>
                        @endforeach
                    </select>
                    @error('pack')
                        <small class="red-text ml-7" role="alert">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <input type="text" name="checkoption" id="checkoption" value="0" style="display: none">
                <input type="text" name="contenir_id" id="contenir_id" value="" style="display: none">
            </div>
            <div class="" style="display: none">
                <input type="text" name="packconstituant" id="packconstituant" value="{{$packselectionne->id ?? ''}}">
            </div>

            <div class="row">
                <!-- <div class="input-field col s12">
                    <button class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12" type="submit">Enregistrer</button>

                </div> -->
            </div>

        </div>
        <div class="modal-footer"
            style="display:flex; justify-content:space-between; padding-left:10%;padding-right:10%;padding-bottom:10%">
            <a id="annulermodalcontenir" href="#!"
                class="modal-action modal-close waves-effect waves-red btn-flat border-round gradient-45deg-purple-deep-orange "
                style="color:white">Annuler</a>
            <button id="" type="submit"
                class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange ">Enregistrer</button>
        </div>
    </form>
</div>
