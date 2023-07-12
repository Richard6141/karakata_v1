<script>
    $(document).ready(function() {
        $(document).on('change', '#produit_id', function() {
            var produit = $(this).find(':selected').attr('data-id')
            var domaine = $('#domaine_id').attr('data-id');
            if (produit == 'ajout') {
                if (domaine == 'Cuisine') {
                    // $(location).attr('href', 'cuisine.store')
                    window.location.href = "cuisine.store"
                }
                if (domaine == 'Empaquetage') {
                    $(location).attr('href', 'empaquetage.store')
                }
            }
        })
    });
</script>