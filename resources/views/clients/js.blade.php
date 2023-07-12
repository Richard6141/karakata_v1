<script>
    $(document).ready(function() {
        $(document).on('click', '#resetPassword', function() {

            document.forms.resetForm.action = $(this).attr('data-url');
            swal({
                title: "Êtes-vous sûr ?",
                text: "Voulez-vous vraiment générer le mot de passe ?",
                icon: 'warning',
                buttons: {
                    Annuler: true,
                    reset: 'Oui, Générer'
                }
            }).then((result) => {
                console.log(result);
                if (result == 'reset') {
                    $('#resetForm').submit();
                }
            });
        });

        $(document).on('click', '#editBtn', function() {
            $('#nom').val($(this).attr('data-nom'))
            $('#prenom').val($(this).attr('data-prenom'))
            $('#username').val($(this).attr('data-username'))

            $('#phone').val($(this).attr('data-phone'))
            $('#email').val($(this).attr('data-email'))



            document.forms.addForm.action = $(this).attr('data-url');
        })
    })

    $(document).on('click', '#supBtn', function() {
        document.forms.deleteForm.action = $(this).attr('data-url');
    })

    $(document).on('click', '#addclientmodal', function() {
        $('#nom').val('')
        $('#prenom').val('')
        $('#username').val('')
        $('#phone').val('')
        $('#email').val('')



    })


    $(document).ready(function() {
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

    $(document).on('change', '#categorie', function() {
        var categorie = $(this).find(':selected').attr('data-id')
        console.log(categorie)

        if (categorie == 'Particulier') {
            $('#raison_social_div').css('display', 'none');
            $('#nom_div').css('display', 'block');
            $('#prenom_div').css('display', 'block');
        }
        if (categorie == 'Entreprise') {
            $('#nom_div').css('display', 'none');
            $('#prenom_div').css('display', 'none');
            $('#raison_social_div').css('display', 'block');
        }

    });
            $(document).on('click', '#depot', function() {
                $('#customer_id').val($(this).attr('data-id'))
                $('#amount').val($(this).attr('data-amount'))
                $('#date').val($(this).attr('data-date'))

                document.forms.addForm.action = $(this).attr('data-url');
            })
            $(document).on('click', '#editdepotBtn', function() {
                $('#amount').val($(this).attr('data-amount'))
                $('#date').val($(this).attr('data-date'))
                $('#label').click()

                document.forms.addFormDepot.action = $(this).attr('data-url');
            })
            $(document).on('click', '#editBtn', function() {
                $('#preference').val($(this).attr('data-preference'))
                $('#date').val($(this).attr('data-date'))
                $('#sources').val($(this).attr('data-label'))
                $('#preference').click()

                document.forms.addForm.action = $(this).attr('data-url');
            })
</script>
