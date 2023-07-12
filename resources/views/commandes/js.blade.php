<script>
    $(document).ready(function() {




        $(document).on('click', '#NewCustomerBtn', function() {
            $('#firstname').val('');
            $('#lastname').val('');
            $('#phonenew').val('');
            $('#email').val('');
            $('#raisonsociale').val('');

        })



        $(document).on('click', '#type_customer', function() {
            var id = $('#type_customer').val()
            console.log(id);
            if (id == "Particulier") {
                $('#raisonsociale').attr('readonly', true);
                $('#raisonsociale').val('')
            } else {
                $('#raisonsociale').attr('readonly', false);
            }
        });

        $(document).on('click', '#addNewCustomer', function(e) {
            var typecustomer = $('#type_customer').val()
            var raisonsociale = $('#raisonsociale').val()
            var firstname = $('#firstname').val()
            var lastname = $('#lastname').val()
            var phone = $('#phonenew').val()
            var email = $('#email').val()

            if (typecustomer == '') {
                return false
            }

            if (typecustomer == 'Particulier') {
                if (firstname == '') {
                    $('#messageerrorfirstname').attr('style', 'text-align: center; color: red; display: block;');
                    return false
                } else {
                    $('#messageerrorfirstname').attr('style', 'text-align: center; color: red; display: none;');
                }
                if (lastname == '') {
                    $('#messageerrorlastname').attr('style', 'text-align: center; color: red; display: block;');
                    return false
                } else {
                    $('#messageerrorlastname').attr('style', 'text-align: center; color: red; display: none;');
                }
                if (phone == '') {
                    $('#messageerrorphonenew').attr('style', 'text-align: center; color: red; display: block;');
                    return false
                } else {
                    $('#messageerrorphonenew').attr('style', 'text-align: center; color: red; display: none;');
                }

                if (email == '') {
                    $('#messageerroremail').attr('style', 'text-align: center; color: red; display: block;');
                    return false
                } else {
                    $('#messageerroremail').attr('style', 'text-align: center; color: red; display: none;');
                }

            }

            if (typecustomer == 'Entreprise') {
                if (firstname == '') {
                    $('#messageerrorfirstname').attr('style', 'text-align: center; color: red; display: block;');
                    return false
                } else {
                    $('#messageerrorfirstname').attr('style', 'text-align: center; color: red; display: none;');
                }

                if (lastname == '') {
                    $('#messageerrorlastname').attr('style', 'text-align: center; color: red; display: block;');
                    return false
                } else {
                    $('#messageerrorlastname').attr('style', 'text-align: center; color: red; display: none;');
                }

                if (phone == '') {
                    $('#messageerrorphonenew').attr('style', 'text-align: center; color: red; display: block;');
                    return false
                } else {
                    $('#messageerrorphonenew').attr('style', 'text-align: center; color: red; display: none;');
                }

                if (email == '') {
                    $('#messageerroremail').attr('style', 'text-align: center; color: red; display: block;');
                    return false
                } else {
                    $('#messageerroremail').attr('style', 'text-align: center; color: red; display: none;');
                }

                if (raisonsociale == '') {
                    $('#messageerrorraisonsociale').attr('style', 'text-align: center; color: red; display: block;');
                    return false
                } else {
                    $('#messageerrorraisonsociale').attr('style', 'text-align: center; color: red; display: none;');
                }

            }


            e.preventDefault();
            var path = "{{ route('addNewCustomer.store') }}";
            $.ajax({
                url: path,
                method: 'GET',
                data: {
                    typecustomer: typecustomer,
                    raisonsociale: raisonsociale,
                    firstname: firstname,
                    lastname: lastname,
                    phone: phone,
                    email: email,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {

                    console.log(data);
                    if (data.success == true) {
                        if (data.type == 'Particulier') {
                            console.log(data.type)
                            $('#titleCustomer').html('Particulier')
                            $('#nom').val(data.company.name)
                            $('#prenom').val(data.company.firstname)
                            $('#phone1').val(data.customer.phone)
                            $('#email11').val(data.customer.email)
                            $('#idcustomersearch').val(data.customer.id)
                        }

                        if (data.type == 'Entreprise') {
                            console.log(data.company.socialreason);
                            $('#titleCustomer').html(data.company.socialreason)
                            $('#nom').val(data.company.name)
                            $('#prenom').val(data.company.firstname)
                            $('#phone1').val(data.customer.phone)
                            $('#email11').val(data.customer.email)
                            $('#idcustomersearch').val(data.customer.id)

                        }

                        if (data.exist == true) {
                            $('#infocustomerexist').attr('style', 'color: red; display:block')
                        } else {
                            $('#infocustomerexist').attr('style', 'color: red; display:none')
                        }

                        document.getElementById('annulermodal').click()

                    } else {
                        $('#infocustomerexist').attr('style', 'color: red; display:block')
                        document.getElementById('annulermodal').click()
                    }
                }
            });
        })

        $(document).on('click', '#modalBtnCommande', function() {

            swal({
                title: "Êtes-vous sûr ?",
                text: "Voulez-vous vraiment confirmer la commande ?",
                icon: 'warning',
                buttons: {
                    Annuler: true,
                    reset: 'Oui, Valider'
                }
            }).then((result) => {
                console.log(result);
                if (result == 'reset') {
                    $('#formcommande').submit();
                }
            });
        });

        $(document).on('click', '#checkboxclient', function() {
            if ($('#checkboxclient').is(':checked', true)) {
                $('#cardrecep').attr('style', 'display:block');
                $('#cardadresselivraison').attr('style', 'display:none');
                $('#blockautre').attr('style', 'display:none');
            } else {
                $('#cardrecep').attr('style', 'display:none');
                $('#cardadresselivraison').attr('style', 'display:block');
                $('#blockautre').attr('style', 'display:block');
            }
        })

        $(document).on('change', '#mode_paiement', function() {
            var mode = $(this).find(':selected').attr('data-id')
            if (mode == 'Ticket') {
                $('#ticketscard').attr('style', 'display:none');
            } else {
                $('#ticketscard').attr('style', 'display:none');
            }
        })

        $(document).on('change', '#carnet_adresse_client', function() {
            console.log('yh');
            var id = $(this).find(':selected').attr('data-id');
            var client = $(this).find(':selected').attr('data-client');
            console.log(id);
            console.log(client);
            if (client == '') {
                return false;
            }

            $('#idclient').val(client)
            if (id == "Nouveau") {
                document.getElementById('btnCarnetAdresse').click()
            }
        })

        $(document).on('click', '#Ajoutcarnet', function(e) {
            var addadresse = $('#addadresse').val()
            var idclient = $('#idclient').val()
            if (addadresse == '') {
                $('#messageerroraddadresse').attr('style', 'text-align: center; color: red; display: block;');
                return false
            } else {
                $('#messageerroraddadresse').attr('style', 'text-align: center; color: red; display: none;');
            }
            e.preventDefault();
            var path = "{{ route('carnetadresse.store') }}";
            $.ajax({
                url: path,
                method: 'GET',
                data: {
                    addadresse: addadresse,
                    idclient: idclient,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {

                    if (data.success == true) {

                        var content = "";
                        var sel = "selected"
                        $.each(data.carnetadresse, function(i, item) {
                            if (item.id == data.adresse) {
                                content += '<option value="' + item.id + '"' + sel +
                                    '>' + item
                                    .address + '</option>'
                            } else {
                                content += '<option value="' + item.id + '">' + item
                                    .address + '</option>'
                            }

                        });

                        $('#carnet_adresse_client').html(content);
                        document.getElementById('annulermodaladdress').click()

                    }
                }
            });
        })
    })
</script>
<script>
    $('#ajouterDoc').click(function() {
        //console.log('hhjjh')
        var ligne = $('#lesDoc').children('div');
        var index = ligne.length;
        // alert(index);
        var contenu = `<div class="form-group form-row" id="doc` + (index + 1) + `">
                                                                <div class="col-sm-2" style="float: right">
                                                                    <a id="supprimer` + (index + 1) + `" type="button" href="javascript:;" class="btn-floating">
                                                                        <i class="material-icons">delete</i>
                                                                    </a>

                                                                </div>
                                                                <div class="col-sm-10">
                                                                    <fieldset class="scheduler-border">
                                                                        {{-- <legend class="scheduler-border">Document</legend> --}}
                                                                        <div class="form-row">
                                                                            <div class="input-field col m6 s12"
                                                                                style=""
                                                                                id="showNumberTicket">
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
                                                                                style=""
                                                                                id="showNumberTicket">
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

                                                            </div><br id="ordre_br` + (index + 1) + `">`

        var codeHtml = $('#lesDoc').html();
        //var codeHtml= $('#ordre1').html();
        //alert(codeHtml);
        $('#lesDoc').append(contenu);

        $('#supprimer' + (index + 1)).click(function() {
            //console.log('lala')
            $('#doc' + (index + 1)).remove();
            $('#ordre_br' + (index + 1)).remove();

            return false;
        });
    });

    //end addDoc Activité
</script>
<script>
    $('#ajouterDoc1').click(function() {
        //console.log('hhjjh')
        var ligne = $('#lesDoc1').children('div');
        var index = ligne.length;
        // alert(index);
        var contenu = `<div class="form-group form-row" id="doc1` + (index + 1) + `">
                                                                <div class="col-sm-2" style="float: right">
                                                                    <a id="supprimer1` + (index + 1) + `" type="button" href="javascript:;" class="btn-floating">
                                                                        <i class="material-icons">delete</i>
                                                                    </a>

                                                                </div>
                                                                <fieldset class="scheduler-border">

                                                                    <div class="row">
                                <div class="input-field col m4 s12">
                                    <input id="phonerecep" type="text" name="phonerecep[]"
                                        value="">
                                    <label style="color: black"
                                        for="email">Téléphone</label>
                                    @error('phonerecep')
                                        <small class="red-text ml-7" role="alert">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="input-field col m4 s12">
                                    <input id="nomrecep" type="text" name="nomrecep[]"
                                        value="">
                                    <label for="nomrecep" style="color: black">Nom</label>
                                    @error('nomrecep')
                                        <small class="red-text ml-7" role="alert">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="input-field col m4 s12">
                                    <input id="prenomrecep" type="text" name="prenomrecep[]"
                                        value="">
                                    <label style="color: black"
                                        for="prenomrecep">Prénom</label>
                                    @error('prenomrecep')
                                        <small class="red-text ml-7" role="alert">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>

                            </div>
                            <div class="row">
                                <div class="input-field col m4 s6">
                                    <input id="carnet_adresse" type="text"
                                        name="carnet_adresse[]" value="">
                                    <label style="color: black" for="carnet_adresse">Adresse
                                        de livraison</label>
                                    @error('carnet_adresse')
                                        <small class="red-text ml-7" role="alert">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="input-field col m4 s12">
                                    <input id="adresse_sup" type="text" name="adresse_sup[]"
                                        value="">
                                    <label style="color: black" for="adresse">Informations
                                        supplementaires</label>
                                    @error('phone')
                                        <small class="red-text ml-7" role="alert">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="input-field col s4">
                                    <select class="browser-default" name="district[]"
                                        id="district">
                                        <option value="">Zone de livraison</option>
                                        @foreach ($districts as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->label }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('district')
                                        <small class="red-text ml-7" role="alert">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s4">
                                    <select class="browser-default" name="menu[]"
                                        id="menu">
                                        <option value="">Résistances</option>
                                        @foreach ($menu as $key => $value)
                                        <option value="{{ $value[0]->component_id }}">
                                    {{ infoResistance($key)->label ?? '' }}
                                </option>
                                @endforeach
                                    </select>
                                    @error('pack')
                                        <small class="red-text ml-7" role="alert">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="input-field col s3">
                                    <select class="browser-default" name="pack[]"
                                        id="pack">
                                        <option value="">Pack</option>
                                        @foreach ($packs as $item)
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
                                <div class="input-field col m2 s12">
                                    <i class="material-icons prefix pt-2"></i>
                                    <input id="nbr" type="number" name="nbr[]"
                                        value="1">
                                    <label style="color: black" for="nbr">Quantité
                                        pack</label>
                                    @error('nbr')
                                        <small class="red-text ml-7" role="alert">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>

                                <div class="input-field col m3 s12">
                                    <i class="material-icons prefix pt-2"></i>
                                    <input id="heur_livr" type="time" name="heur_livr[]" value="">
                                    <label style="color: black" for="nbr">Heure de  livraison</label>
                                    @error('heur_livr')
                                    <small class="red-text ml-7" role="alert">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                            </div>
                            </fieldset>

                                                            </div><br id="ordre_br1` + (index + 1) + `">`

        var codeHtml = $('#lesDoc1').html();
        //var codeHtml= $('#ordre1').html();
        //alert(codeHtml);
        $('#lesDoc1').append(contenu);

        $('#supprimer1' + (index + 1)).click(function() {
            //console.log('lala')
            $('#doc1' + (index + 1)).remove();
            $('#ordre_br1' + (index + 1)).remove();

            return false;
        });
    });



    //end addDoc Activité
</script>
