<script>
    $(document).ready(function() {
        $(document).on('change', '#pack', function() {
            var id = $(this).find(':selected').attr('data-id');

            if (id == "Nouveau") {
                document.getElementById('btnCarnetAdresse').click()
            }

            // var label = $(this).find(':selected').attr('data-label');

            // if (label == "Small Pack" || label == "Interne Pack") {
            //     $('#blockcomposant').attr('style', 'display:block')
            //     $('#blockentree').attr('style', 'display:none')
            //     $('#dessertblock').attr('style', 'display:none')
            //     $('#boissonblock').attr('style', 'display:none')
            // } else {
            //     $('#blockcomposant').attr('style', 'display:block')
            //     $('#blockentree').attr('style', 'display:block')
            //     $('#dessertblock').attr('style', 'display:block')
            //     $('#boissonblock').attr('style', 'display:block')

            // }
        })
    });

    function infopack($param) {
        var param = $param

        var path = "{{ route('searchpack.store') }}";
        $.ajax({
            url: path,
            method: 'GET',
            data: {
                param: param,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {

                if (data.success == 1) {
                    var pack = data.pack;
                }
            }
        });
        return pack.label;
    }

    $(document).on('click', '#Ajoutpack', function(e) {

        var addlabel = $('#addlabel').val()
        var addprice = $('#addprice').val()
        var addtype_pack_id = $('#addtype_pack_id').val()

        if ($('#addcheckboxclient').is(':checked', true)) {
            var addcheckboxclient = 1;
        } else {
            var addcheckboxclient = 0;
        }

        e.preventDefault();
        var path = "{{ route('addpack.store') }}";
        $.ajax({
            url: path,
            method: 'GET',
            data: {
                addlabel: addlabel,
                addprice: addprice,
                addtype_pack_id: addtype_pack_id,
                addcheckboxclient: addcheckboxclient,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {

                if (data.success == 1) {

                    var content = "";
                    var sel = "selected"
                    $.each(data.packs, function(i, item) {
                        if (item.id == data.pack.id) {
                            content += '<option value="' + item.id + '" data-price="' + item
                                .price + '" data-typepack="' + item.paquet_type_id + '"' +
                                sel +
                                '>' + item
                                .label + '</option>';
                            $('#price').val(data.pack.price)
                            $('#type_pack_id').val(data.pack.paquet_type_id)
                            $('#blockdetailpack').attr('style', 'display:block')
                            $('#addConstituant').attr('style', 'display:block')
                            $('#packconstituant').val(data.pack.id)
                        } else {
                            content += '<option value="' + item.id + '"data-price="' + item
                                .price + '" data-typepack="' + item.paquet_type_id + '">' +
                                item.label + '| ' + item.price + '</option>';
                            $('#blockdetailpack').attr('style', 'display:none')
                            $('#addConstituant').attr('style', 'display:none')
                        }

                    });

                    $('#pack').html(content);
                    document.getElementById('annulermodal').click()

                }
            }
        });
    })



    $(document).on('click', '#Ajoutconstituantbtn', function(e) {
        var constituant = $('#constituant').val()
        var packconstituant = $('#packconstituant').val()
        var contenir_id = $('#contenir_id').val()
        var checkoption = $('#checkoption').val()

        e.preventDefault();
        var path = "{{ route('addconstituant.store') }}";
        $.ajax({
            url: path,
            method: 'GET',
            data: {
                constituant: constituant,
                packconstituant: packconstituant,
                contenir_id: contenir_id,
                checkoption: checkoption,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                console.log(data);
                if (data.success == 1) {
                    var content = "";
                    $.each(data.contenirs, function(i, item) {
                        content += `<tr>
                                                                                    <td> <span>` + item.label +
                            `</span></td>
                                                                                    <td style="text-align: right">
                                                                                        <div class="invoice-action">
                                                                                            <a id="editBtn" href="#modalAddConstituant" class="invoice-action-edit modal-trigger tooltipped" data-position="top" data-tooltip="Modifier" data-contenir="` +
                            item.contenir_id + `" data-composant="` + item.component_id +
                            `" data-pack="` + item.pack_id + `" data-typecomposant="` + item
                            .component_type_id +
                            `" data-description="" data-nombre="" data-total="" data-source_commande="" data-url="">
                                                                                                <i class="material-icons" style="color:green ;">edit</i>
                                                                                            </a>
                                                                                            <a id="supBtn" href="#" class="invoice-action-edit tooltipped" data-position="top" data-tooltip="Supprimer" data-id="" data-contenir="` +
                            item.contenir_id + `"  data-pack="` + item.pack_id + `" data-url="">
                                                                                                <i class="material-icons" style="color:red ">delete</i>
                                                                                            </a>

                                                                                        </div>
                                                                                    </td></tr>`;


                    });

                    $('#trblock').html(content);
                    document.getElementById('annulermodalcontenir').click()

                } else {
                    document.getElementById('annulermodalcontenir').click()
                    document.getElementById('alerterror').click()
                }
            }
        });
    })

    $(document).on('click', '#alerterror', function() {

        swal({
            title: "Attention",
            text: "Composant déjà enregistré pour ce jour",
            icon: 'warning',
            buttons: {
                Annuler: true,
            }
        });
    });
    $(document).on('click', '#constituants', function() {

        $('#typecomposant').val($(this).attr('data-typecomposant'))
        $('#constituant').val($(this).attr('data-composant'))
        $('#contenir_id').val($(this).attr('data-contenir'))
        $('#checkoption').val(1)

    });

    $(document).on('click', '#editBtn', function() {
        $('#typecomposant').val($(this).attr('data-typecomposant'))
        $('#constituant').val($(this).attr('data-composant'))
        $('#packconstituant').val($(this).attr('data-pack'))
        $('#contenir_id').val($(this).attr('data-contenir'))
        $('#checkoption').val(1)

    })

    $(document).on('click', '#supBtn', function(e) {

        var contenir = $(this).attr('data-contenir')
        var pack = $(this).attr('data-pack')
        console.log(contenir);
        console.log('contenir');
        console.log(pack);

        e.preventDefault();
        var path = "{{ route('deletecomposant.delete') }}";
        $.ajax({
            url: path,
            method: 'GET',
            data: {
                contenir: contenir,
                pack: pack,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {

                if (data.success == 1) {
                    console.log(data);
                    var content = "";
                    $.each(data.contenirs, function(i, item) {
                        content += `<tr>
                                                                                    <td> <span>` + item.labels +
                            `</span></td>
                                                                                    <td style="text-align: right">
                                                                                        <div class="invoice-action">
                                                                                            <a id="editBtn" href="#modalAddConstituant" class="invoice-action-edit modal-trigger tooltipped" data-position="top" data-tooltip="Modifier" data-contenir="` +
                            item.contenir_id + `" data-composant="` + item.composant_id +
                            `" data-pack="` + item.pack_id + `" data-typecomposant="` + item
                            .type_composant_id +
                            `" data-description="" data-nombre="" data-total="" data-source_commande="" data-url="">
                                                                                                <i class="material-icons" style="color:green ;">edit</i>
                                                                                            </a>
                                                                                            <a id="supBtn" href="#" class="invoice-action-edit tooltipped" data-position="top" data-tooltip="Supprimer" data-id="" data-contenir="` +
                            item.contenir_id + `"  data-pack="` + item.pack_id + `" data-url="">
                                                                                                <i class="material-icons" style="color:red ">delete</i>
                                                                                            </a>

                                                                                        </div>
                                                                                    </td></tr>`;


                    });

                    $('#trblock').html(content);

                }
            }
        });

    })

    $(document).on('change', '#typecomposant', function(e) {
        var typecomposant = $('#typecomposant').val()

        e.preventDefault();
        var path = "{{ route('filtrecomposant.store') }}";
        $.ajax({
            url: path,
            method: 'GET',
            data: {
                typecomposant: typecomposant,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {

                if (data.success == 1) {

                    var content = "";
                    $.each(data.composants, function(i, item) {
                        content += '<option value="' + item.id +
                            '" data-price="" data-typepack="">' + item
                            .label + '</option>';


                    });

                    $('#constituant').html(content);

                }
            }
        });
    })

    $(document).on('click', '#supBtn1', function() {
        $('#packformdelete').val($(this).attr('data-pack'))
        $('#dateformdelete').val($(this).attr('data-date'))
        swal({
            title: "Êtes-vous sûr ?",
            text: "Voulez-vous vraiment supprimer le menu ?",
            icon: 'warning',
            buttons: {
                Annuler: true,
                reset: 'Oui, Valider'
            }
        }).then((result) => {

            if (result == 'reset') {
                $('#deletemenu').submit();
            }
        });
    });

    $(document).on('click', '#reconduit', function() {
        $('#packformreconduit').val($(this).attr('data-pack'))
        $('#dateformreconduit').val($(this).attr('data-date'))
        swal({
            title: "Êtes-vous sûr ?",
            text: "Voulez-vous vraiment reconduire le menu ?",
            icon: 'warning',
            buttons: {
                Annuler: true,
                reset: 'Oui, Valider'
            }
        }).then((result) => {

            if (result == 'reset') {
                $('#reconduitmenu').submit();
            }
        });
    });

    $(document).on('change', '#activemenutoday', function() {

        if ($(this).is(':checked')) {
            valueCheckBox = 1;
        } else {
            valueCheckBox = 0;
        }

        $('#packformactive').val($(this).attr('data-pack'))
        $('#dateformactive').val($(this).attr('data-date'))
        $('#checkformactive').val(valueCheckBox)

        swal({
            title: "Êtes-vous sûr ?",
            text: "Voulez-vous vraiment executé cette opération ?",
            icon: 'warning',
            buttons: {
                Annuler: true,
                active: 'Oui, Valider'
            }
        }).then((result) => {
            if (result == 'active') {
                $('#activemenutoday11').submit();
            }
        });

    });

    $(document).on('click', '#showmenubyperiod', function() {

        var menu = $(this).attr('data-menu');
        console.log(JSON.parse(menu));
        $('#titlepackshwo').html($(this).attr('data-pack'))

        var content = "";
        $.each(JSON.parse(menu), function(i, item) {
            content += `<fieldset class="scheduler-border">
                <legend class="scheduler-border-limite">` + item.type_composants + `</legend>
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="control-group">
                            <div class="row">
                                <span>` + item.composants + `</span>
                            </div>
                        </div>
                    </div>
                </div>

            </fieldset>`;


        });
        $('#cardshowmenu').html(content);



    });

    //end addDoc Activité
</script>

<script>
    $('#ajouterDoc').click(function() {
        //console.log('hhjjh')
        var ligne = $('#lesDoc').children('div');
        var index = ligne.length;
        // alert(index);
        var contenu = `<div class="form-group form-row" id="doc`+ (index+1) +`">
                                                                <div class="col-sm-2" style="float: right">
                                                                    <a id="supprimer`+ (index+1) +`" type="button" href="javascript:;" class="btn-floating">
                                                                        <i class="material-icons">delete</i>
                                                                    </a>

                                                                </div>
                                                                <div class="col-sm-10">
                                                                    <fieldset class="scheduler-border">

<div class="form-row">
    <div class="input-field col m6 s6">
        <select class="browser-default" name="pack[]" id="pack" required>
            <option value="">Pack</option>
            <option class=""
                style="background-color: rgb(114, 200, 114); color: white; text-align: center"
                value="" data-id="Nouveau">
                Nouveau</option>
            @foreach ($packs as $item)
                <option {{ old('pack') == $item->id ? "selected" : "" }} value="{{ $item->id }}"
                    @if ($packselectionne) {{ $item->id == $packselectionne->id ? 'selected' : '' }} @endif
                    data-price="{{ $item->price }}"
                    data-label="{{ $item->paquetType->label }}"
                    data-typepack="{{ $item->paquet_type_id }}">
                    {{ $item->paquetType->label }} | {{ $item->price }}
                </option>
            @endforeach
        </select>
        @error('pack')
            <small class="red-text ml-7" role="alert">
                {{ $message }}
            </small>
        @enderror
    </div>
    <div class="col-md-12"
        style=""
        id="blockdetailpack">
        <div class="control-group">

            <div class="input-field col s6">
                <input id="price" name="price[]"
                    value=""
                     placeholder="Prix" type="number"
                    class="@error('price') is-invalid @enderror">
                {{-- <label for="price">Prix</label> --}}
                @error('price')
                    <small class="red-text ml-7" role="alert">
                        {{ $message }}
                    </small>
                @enderror

            </div>
        </div>
    </div>
</div>
</fieldset>
                                                                </div>

                                                            </div><br id="ordre_br`+ (index+1) +`">`

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
