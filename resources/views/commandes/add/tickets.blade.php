<fieldset class="scheduler-border" style="display: none" id="ticketscard">
    <legend class="scheduler-border-limite">Tickets</legend>
    <div class="form-row">
        <div class="col-md-12">
            <div class="control-group">
                <section id="lesDoc">
                    <div class="form-group form-row" id="doc1">
                        <div class="col-sm-2" style="float: right">
                            <a id="ajouterDoc" type="button" href="javascript:;"
                                class="btn-floating"
                                style="background-color: blue">
                                <i class="material-icons tooltipped"
                                    data-position="top"
                                    data-tooltip="Ajouter">add</i>
                            </a>

                        </div>
                        <div class="col-sm-10">
                            <fieldset class="scheduler-border">
                                {{-- <legend class="scheduler-border">Document</legend> --}}
                                <div class="form-row">
                                    <div class="input-field col m6 s12"
                                        style="" id="showNumberTicket">
                                        <i class="material-icons prefix pt-2"></i>
                                        <input id="numberticket" type="text"
                                            name="numberticket[]" value="">
                                        <label style="color: black"
                                            for="ticket1">Numéro du ticket</label>
                                        @error('numberticket')
                                            <small class="red-text ml-7"
                                                role="alert">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                    <div class="input-field col m6 s12"
                                        style="" id="showNumberTicket">
                                        <i class="material-icons prefix pt-2"></i>
                                        <input id="numberticket" type="text"
                                            name="numberticket[]" value="">
                                        <label style="color: black"
                                            for="ticket2">Numéro du ticket</label>
                                        @error('numberticket')
                                            <small class="red-text ml-7"
                                                role="alert">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                    </div>
                    @error('documentAcivite')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                    @if (session()->has('error'))
                        <div class="error">
                            {{ session('error') }}
                        </div>
                    @endif
                    <br>
                </section>
            </div>
        </div>
    </div>
</fieldset><br>
