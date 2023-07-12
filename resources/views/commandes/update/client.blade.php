<fieldset class="scheduler-border">
    <legend class="scheduler-border-limite">Client</legend>
    <div class="form-row">
        <div class="col-md-12">
            <div class="control-group">
                <div class="row">
                    <div class="input-field col m6 s12">
                        <input id="nom" type="text" name="nom"
                            value="{{$client->particular->name ?? $client->company->name }}" readonly>
                        <label for="nom" style="color: black">Nom</label>
                        @error('nom')
                            <small class="red-text ml-7" role="alert">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <div class="input-field col m6 s12">
                        <input id="prenom" type="text" name="prenom"
                            value="{{ $client->particular->firstname ?? $client->company->firstname }}" readonly>
                        <label style="color: black" for="prenom">Prénom</label>
                        @error('prenom')
                            <small class="red-text ml-7" role="alert">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="input-field col m6 s12">
                            <input id="phone" type="tel" name="phone"
                                value="{{ $client ? $client->phone : '' }}" readonly>
                            <label style="color: black"
                                for="phone">Téléphone</label>
                            @error('phone')
                                <small class="red-text ml-7" role="alert">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="input-field col m6 s12">
                            <input id="email" type="tel" name="email"
                                value="{{ $client ? $client->email : '' }}" readonly>
                            <label style="color: black"
                                for="email">Email</label>
                            @error('email')
                                <small class="red-text ml-7" role="alert">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <input type="text" name="idcustomer" id="idcustomer" value="{{$commande->customer_id}}" style="display: none">

                    </div>

                </div>

            </div>
        </div>
    </div>

</fieldset>
