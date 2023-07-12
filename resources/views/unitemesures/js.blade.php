
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

            $(document).on('click', '#addunite', function(){
               $('#labels').val('')
            })
        })
    </script>