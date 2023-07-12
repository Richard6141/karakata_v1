<div id="modal111" class="col s12 m12 l4 modal" style="width: 35%; ">
    <div class="modal-content">
        <form id="deleteForm" action="" method="post" style="text-align: center;">
            @csrf
            <h5 style="color:green;">AVERTISSEMENT !!!</h5>
            <p>effectuer cette suppression ?</p>

            <div class="modal-footer" style="display:flex; justify-content:space-between; padding-left:0%;padding-right:0%;padding-bottom:10%">
                <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat border-round gradient-45deg-purple-deep-orange " style="color:white">NON</a>
                <button form="deleteForm" class="modal-action modal-close waves-effect waves-red btn-flat border-round gradient-45deg-purple-deep-orange " style="color:white">OUI</button>
        </form>

    </div>
</div>