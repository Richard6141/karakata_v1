@extends('layouts.app')

@section('content')
<style>
  span{

    font-weight: bold;
  }
</style>
<div class="col s12">
        <div class="card animate fadeUp">
          <div class="card-content">
            <div class="row" id="product-four">

              <div class="col m6 s12">
                <span>
                <img class="z-depth-1 " height="295" width="" src="{{ url('public/image/' . $Commandes->pack->image) }}" alt="Image" style="max-width: 95%;">

                </span>

              </div>
              <div class="col m6 s12">
                <ul class="list-bullet">
                  <li class="list-item-bullet" >Nom du client : <span style="color: black;">
                  <h5>{{ $Commandes->Nom_client }}</h5>
                  <hr>
                 </span> </li>
                 <li class="list-item-bullet">Pack : <span style="color: black;">
                 {{ $Commandes->pack->label ?? '' }}</span>
                 </li>

                 <li class="list-item-bullet" >Date de livraison : <span style="color: black;">
                {{ $Commandes->date_livraison }}</span>
                </li>

                <li class="list-item-bullet">Description de la commande : <span  style="color: black;">
                {{ $Commandes->description }}</span>
                </li>

                <li class="list-item-bullet">Quantité commandée : <span style="color: black;">
                {{ $Commandes->nombre }}</span>
                </li>
                <li class="list-item-bullet" >Montant total : <span style="color: black;">
                {{ $Commandes->total }}</span>
                </li>

                <li class="list-item-bullet" >Source de commande : <span style="color: black;">
                {{ $Commandes->sourcecommande->labels ?? '' }}</span>
                </li>

                <a href="/list_commandes" class="waves-effect waves-light btn gradient-45deg-deep-purple-red z-depth-4 mt-2 mr-2 ">RETOUR</a>
                <a id="editBtn" href="#modalcomposant"
              class="invoice-action-edit modal-trigger"
              data-id="{{ $Commandes->id }}"
              data-Nom_client="{{ $Commandes->Nom_client }}"
              data-pack="{{ $Commandes->pack->label ?? '' }}"
              data-date_livraison="{{ $Commandes->date_livraison }}"
              data-description="{{ $Commandes->description }}"
              data-nombre="{{ $Commandes->nombre }}"
              data-total="{{ $Commandes->total }}"
              data-source_commande="{{ $Commandes->source_commande }}"
              data-url="{{ route('commande.updatecommande', $Commandes->id) }}">
              <span class="waves-effect waves-light btn gradient-45deg-deep-purple-red z-depth-4 mt-2 mr-2 ">
             MODIFIER
             </span>
              </a>

              </div>
            </div>
          </div>
        </div>
      </div>
      @include('Commandes.add_commandes')
                                @include('Commandes.sup1_message')
          @endsection


{{-- page scripts --}}
@section('scripts')
<script src="{{ asset('js/scripts/page-users.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '#editBtn', function() {
                $('#Nom_client').val($(this).attr('data-Nom_client'))
                $('#pack').val($(this).attr('data-pack'))
                $('#date_livraison').val($(this).attr('data-date_livraison'))
                $('#description').val($(this).attr('data-description'))
                $('#nombre').val($(this).attr('data-nombre'))
                $('#total').val($(this).attr('data-total'))
                $('#source_commande').val($(this).attr('data-source_commande'))

                document.forms.addForm.action = $(this).attr('data-url');
            })
        })
</script>
@endsection
