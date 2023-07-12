<div id="modal1" class="modal" style="width:40%; padding:1%">
    <div class="modal-content">
        <h5 style="color:green;" class="center">Ajouter une suggestion/plainte</h5>
        <form id="addForm" class="" action="{{route('suggestion1.store', $clients->id ?? 0)}}" method="POST">
            @csrf
            <div class="row margin">
                <input id="customer_id" type="hidden" name="customer_id" value="{{$clients->id}}">
                <div style="display:flex">
                    <p style="margin:1%; color:black">
                        <label>
                            <input class="with-gap" name="type" type="radio" value="plainte"/>
                            <span>Plainte</span>
                        </label>
                    </p>
                    <p style="margin:1%">
                        <label>
                            <input class="with-gap" name="type" type="radio" value="suggestion"/>
                            <span>Suggestion</span>
                        </label>
                    </p>
                    @error('type')
                    <small class="red-text ml-7" role="alert">
                        {{ $message }}
                    </small>
                    @enderror
                </div>

                <div class="">
                    <label style="color: black" for="firstname">Contenu</label>
                    <input id="preference" type="text" name="preference" value="{{ old('preference') }}">
                    @error('preference')
                    <small class="red-text ml-7" role="alert">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="">
                    <label style="color: black" for="date">Date</label>
                    <input id="date" type="date" name="date" value="{{ old('date') }}">
                    @error('date')
                    <small class="red-text ml-7" role="alert">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="">
                    <select class="browser-default" name="sources" id="sourcess">
                        <option value="{{ old('sources') }}">Source de la demande</option>
                        @foreach ($sources as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->label }}
                        </option>
                        @endforeach
                    </select>
                    @error('sources')
                    <small class="red-text ml-7" role="alert">
                        {{ $message }}
                    </small>
                    @enderror
                </div>

            </div>

        </form>
    </div>
    <div class="modal-footer" style="display:flex; justify-content:space-between; padding-left:10%;padding-right:10%;padding-bottom:10%">
        <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat border-round gradient-45deg-purple-deep-orange " style="color:white">Annuler</a>
        <button form="addForm" href="#!" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange " type="submit">Enregistrer</button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.modal');
    var instances = M.Modal.init(elems, dismissible = false);
</script>



