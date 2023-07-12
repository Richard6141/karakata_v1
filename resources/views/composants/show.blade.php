@extends('layouts.app')

@section('content')
<div class="col s12">
        <div class="card animate fadeUp">
          <div class="card-content">
            <div class="row" id="product-four">

              <div class="col m6 s12">
                @if (is_null($Composants->image))
                <img height="300" width="400" src="{{ 'https://ui-avatars.com/api/?background=8EC741&color=ffff/?uppercase=true&name=' . $Composants->label }}"
                alt="Photo de profil" class="">
                @else

                <img height="300" width="400" class="" 
                src="{{ asset('image/' . $Composants->image) }}" alt="Image">
                @endif
              </div>
              <div class="col m6 s12">
        
                <h5 style="color: black;">{{ $Composants->label }}</h5>
                <!-- <span class="new badge left ml-0 mr-2" data-badge-caption="">4.2 Star</span>
                <p>Availability: <span class="green-text">Available</span></p>
                <hr class="mb-5">
                <span class="vertical-align-top mr-4"><i class="material-icons mr-3">favorite_border</i>Wishlist</span> -->
                <ul class="list-bullet">
                  <li class="list-item-bullet" >Type composant : <span style="color: black;">
                  {{ $Composants->componentType->label ?? ''}}
                 </span> </li>

                

                 <li class="list-item-bullet">Description : <span style="color: black;">
                 {{ $Composants->description }}
              </div>
              <a href="/liste-composants" class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 ">RETOUR</a>
              <a id="editBtn" href="{{route('composant.update', $Composants->id)}}">
           <span class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 ">
              MODIFIER
            </span>
            </a>
            </div>
          </div>
        </div>
      </div>

          @endsection

{{-- page scripts --}}
@section('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '#editBtn', function() {
                $('#label').val($(this).attr('data-label'))
                $('#description').val($(this).attr('data-description'))
                $('#typecomposant').val($(this).attr('data-typecomposant'))

                $('#publish_date').val($(this).attr('data-publish_date'))
                $('#file1').val($(this).attr('data-image'))

                document.forms.addForm.action = $(this).attr('data-url');
            })
        })

        $(document).on('click', '#supBtn', function() {
            document.forms.deleteForm.action = $(this).attr('data-url');
        })

        $(document).on('click', '#addcomposantmodal', function() {
            $('#label').val('')
            $('#description').val('')
            $('#publish_date').val('')
            $('#publish_date').val('')


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
