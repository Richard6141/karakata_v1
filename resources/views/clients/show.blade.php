@extends('layouts.app')

@section('content')
<div class="col s12">
        <div class="card animate fadeUp">
          <div class="card-content">
            <div class="row" id="product-four">

              <div class="col m6 s12">
        
                <h5 style="color: black;">{{ $Client->nom }}</h5>
                
                <ul class="list-bullet">
                  <li class="list-item-bullet" >Prénom : <span style="color: black;">
                  {{ $Client->prenom }}
                 </span> </li>

                 <li class="list-item-bullet" >Username : <span style="color: black;">
                  {{ $Client->username }}
                 </span> </li>

                 <li class="list-item-bullet">Statut : <span style="color: black;">
                 {{ $Client->status }}
                 </span> </li>


                  <li class="list-item-bullet">Téléphone : <span style="color: black;">{{ $Client->phone }}</span></li>
                  <li class="list-item-bullet">Email : <span style="color: black;">{{ $Client->email }}</span></li>
                  <li class="list-item-bullet">Mot de passe : <span style="color: black;">{{ $Client->phone }}</span></li>

                <a href="/list_clients" class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 ">RETOUR</a>
                <a id="editBtn" href="#modalclient"
                   class="invoice-action-edit modal-trigger"
                    data-id="{{ $Client->id }}"
                    data-nom="{{ $Client->nom }}"
                    data-prenom="{{ $Client->prenom }}"
                    data-username="{{ $Client->username }}"
                    data-status="{{ $Client->status }}"
                    data-phone="{{ $Client->phone }}"
                    data-email="{{ $Client->email }}"
                    data-password="{{ $Client->password }}"
                    data-url="{{ route('client.updateclient', $Client->id) }}">
                   <span class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 ">
                     MODIFIER
                   </span>
              </a>

              </div>
            </div>
          </div>
        </div>
      </div>
  @include('clients.add')

          @endsection

{{-- page scripts --}}
@section('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '#editBtn', function() {
               $('#nom').val($(this).attr('data-nom'))
                $('#prenom').val($(this).attr('data-prenom'))
                $('#username').val($(this).attr('data-username'))
                $('#status').val($(this).attr('data-status'))
                $('#phone').val($(this).attr('data-phone'))
                $('#email').val($(this).attr('data-email'))
                $('#password').val($(this).attr('data-password'))
                

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
            $('#status').val('')
            $('#phone').val('')
            $('#email').val('')
            $('#password').val('')


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
@endsection
