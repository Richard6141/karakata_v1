<div id="modal1" class="modal">
    <div class="modal-content" >
      <h5>Confirmation d'une suppresion</h5>
      <form id="deleteForm" action="" method="post">
        @csrf
      </form>
      <p>Voulez-vous vraiment supprimer ce rapport ?</p>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Annuler</a>
      <button type="submit" form="deleteForm" class="btn  waves-effect waves-light btn-flat">Oui, Supprimer</button>
    </div>
  </div>