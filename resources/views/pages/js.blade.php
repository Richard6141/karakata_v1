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
</script>