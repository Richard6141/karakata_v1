
    <script src="{{ asset('js/scripts/app-invoice.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '#editBtn', function() {
                $('#label').val($(this).attr('data-label'))
                $('#label').click()

                document.forms.addForm.action = $(this).attr('data-url');
            })

            $(document).on('click', '#supBtn', function() {
                document.forms.deleteForm.action = $(this).attr('data-url');
            })
        })
    </script>