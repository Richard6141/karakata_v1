
    <script src="{{ asset('js/scripts/app-invoice.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '#editBtn', function() {
                $('#labels').val($(this).attr('data-labels'))
                $('#labels').click()

                document.forms.addForm.action = $(this).attr('data-url');
            })

            $(document).on('click', '#supBtn', function() {
                document.forms.deleteForm.action = $(this).attr('data-url');
            })
        });
        $(document).on('click', '#modalBtnpreference', function() {

            swal({
                title: "Êtes-vous sûr ?",
                text: "Voulez-vous vraiment confirmer la Suggestion ?",
                icon: 'warning',
                buttons: {
                    Annuler: true,
                    reset: 'Oui, Valider'
                }
            }).then((result) => {
                console.log(result);
                if (result == 'reset') {
                    $('#formpreference').submit();
                }
            });
            });

            $(document).on('click', '#editBtnpreference', function() {

                swal({
                    title: "Êtes-vous sûr ?",
                    text: "Voulez-vous vraiment confirmer la modification ?",
                    icon: 'warning',
                    buttons: {
                        Annuler: true,
                        reset: 'Oui, Valider'
                    }
                }).then((result) => {
                    console.log(result);
                    if (result == 'reset') {
                        $('#formpreference').submit();
                    }
                });
             });
    </script>