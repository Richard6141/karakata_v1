<div id="modal2" class="modal" style="width:40%; padding:1%">
    <div class="modal-content">
        <h5 style="color:green;" class="center">Faire un dépôt</h5>
        <form id="addFormDepot" action="{{ route('sauvegarderdepot11.store', $clients->id) }}" method="POST">
            @csrf
            <div class="row margin">
            <input id="customer_id" type="hidden" name="customer_id" value="{{$clients->id}}">

                <div class="">
                <label style="color: black" for="firstname">Montant</label>
                <input id="amount" type="number" name="amount" value="{{ old('amount') }}" class="@error('amount') is-invalid @enderror">
                    @error('amount')
                    <small class="red-text ml-7" role="alert">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
            </div>

            <div class="row">
            <div class="">
            <label style="color: black" for="date">Date</label>
            <input id="date" type="date" name="date"  value="{{ old('date') }}" class="@error('date') is-invalid @enderror">
            @error('date')
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
        <button type="submit"  form="addFormDepot" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange " >Enregistrer</button>
    </div>
</div>



