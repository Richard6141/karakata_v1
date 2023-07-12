<script>
    function reseach() {
        numero = $('input[name="phoneforsearch"]').val();
        if (numero != '') {
            $('input[name="phoneforsearch"]').css('border-bottom', '1px solid')
            $('input[name="phoneforsearch"]').attr('placeholder', '');
            var path = "{{ route('retrieve.client') }}";
            $.ajax({
                url: path,
                method: 'GET',
                data: {
                    numero: numero,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {

                    if (data.success && data.success == 1) {
                        if (data.customer.particulars_id != null && data.customer.companies_id == null) {
                            $("#nonduclient1").val(data.client_info.name);
                            $("#prenomduclient1").val(data.client_info.firstname);
                            $("#phoneduclient1").val(data.customer.phone);
                            $("#emailduclient1").val(data.customer.email);
                            $('input[name="phone"]').val(data.customer.phone)
                            $('input[name="email"]').val(data.customer.email)
                            $('input[name="customer_id"]').val(data.customer.id)
                            $('input[name="email"]').val(data.customer.email)
                        }
                        if (data.customer.particulars_id == null && data.customer.companies_id != null) {
                            $("#nonduclient1").val(data.client_info.socialreason);
                            $("#prenomduclient1").val('Null');
                            $("#phoneduclient1").val(data.customer.phone);
                            $("#emailduclient1").val(data.customer.email);
                            $('input[name="phone"]').val(data.customer.phone)
                            $('input[name="email"]').val(data.customer.email)
                            $('input[name="customer_id"]').val(data.customer.id)
                            $('input[name="email"]').val(data.customer.email)
                        }

                    } 
                    if (!data.success || data.success != 1 || data.success == 0 ) {
                        M.toast({html: 'Ce client n\'existe pas!'})
                    }
                }
            });
        } else {
            $('input[name="phoneforsearch"]').css('border-bottom', '3px solid red')
            $('input[name="phoneforsearch"]').attr('placeholder', 'Veuillez entrer un numéro de téléphone');
        }
    }
    $(document).on('click', '#supBtn', function() {
        document.forms.deleteForm.action = $(this).attr('data-url');
    })
</script>