<div id="coupon" class="modal" style="width:40%; padding:1%">
    <div class="modal-content">
        <h5 style="color:green;" class="center">Générer des coupons</h5>
        <form id="addFormcoupon" action="{{ route('coupon.store') }}" method="POST">
            @csrf
            <div class="row margin">
            <div class="">
            <input type="hidden" name="customer_id" value="{{ $clients->id }}" >
            <input type="hidden" name="email" value="{{ $clients->email }}" >
            <input type="hidden" name="phone" value="{{ $clients->phone }}" >

                                                <div class="">
                                                    <div class="row">
                                                        <div class="row margin">
                                                            <div class="" >
                                                                <select name="coupon_value" id="pack" value="{{ old('coupon_value') }}">
                                                                    <option value="" class="@error('pack') is-invalid @enderror" selected>Choisissez le prix du coupon</option>
                                                                    @foreach ($prices as $price)
                                                                    @if (old('coupon_value') == $price)
                                                                    <option value="{{ $price }}" selected><span>{{ $price }}</span></option>
                                                                    @else
                                                                    <option value="{{ $price }}"><span>{{ $price }}</span></option>
                                                                    @endif
                                                                    @endforeach
                                                                </select>
                                                                <label>Prix coupon</label>
                                                                @error('pack')
                                                                <small class="red-text ml-7" role="alert">
                                                                    {{ $message }}
                                                                </small>
                                                                @enderror
                                                            </div>
                                                            <div class="">
                                                                <input id="nombre" type="number" name="nombre" value="{{ old('nombre') }}">
                                                                <label for="nombre" class="center-align" style="color:black;">Nombre :</label>
                                                                @error('nombre')
                                                                <small class="red-text ml-7" role="alert">
                                                                    {{ $message }}
                                                                </small>
                                                                @enderror
                                                            </div>
                                                            
                                                            
                                                            <div class="">
                                                                <input id="date_expiration" name="date_expiration" value="{{ old('date_expiration') }}" type="date" min="{{ $date }}" class="@error('date_expiration') is-invalid @enderror" value="{{ old('date_expiration') }}">
                                                                <label for="date_expiration" class="center-align" style="color:black;">Date d'expiration :</label>
                                                                @error('date_expiration')
                                                                <small class="red-text ml-7" role="alert">
                                                                    {{ $message }}
                                                                </small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

        
    
        </form>
    </div>
    <div class="modal-footer" style="display:flex; justify-content:space-between; padding-left:10%;padding-right:10%;padding-bottom:10%">
        <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat border-round gradient-45deg-purple-deep-orange " style="color:white">Annuler</a>
        <button type="submit"  form="addFormcoupon" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange " >Enregistrer</button>
    </div>
</div>



