@extends('layouts.app')

@section('content')
<div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Ajout d'une Suggestion</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/">Acceuil</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('preference.index')}}">Suggestions</a>
                        </li>
                        <li class="breadcrumb-item active">Ajout
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
<div class="section">
  <!-- Snow Editor start -->
  <section class="snow-editor">
    <div class="row">
      <div class="col s12">
        <div class="card">
        <div class="col s12 m12 l12">
      <div id="Form-advance" class="card card card-default scrollspy">
        <div class="card-content">
        <h4 class="card-title">Formulaire de modification de rapport de séance</h4>
                @if (session()->has('successMessage'))
                <div class="card-panel teal lighten-2 text-white" role="alert">
                  {!! session('successMessage') !!}
                </div>
                @endif
                @if (session()->has('alertMessage'))
                <div class="card-panel teal lighten-2 text-white" role="alert">
                  {!! session('alertMessage') !!}
                </div>
                @endif
                @if (session()->has('errorMessage'))
                <div class="card-panel teal lighten-2 text-white" role="alert">
                  {!! session('errorMessage') !!}
                </div>
                @endif
                <form action="{{route('rapport.update', $rapports->id)}}" method="POST">
                  @csrf
                  <div class="row">
                  
                    <div class="input-field col m6 s12">
                   
                      <input type="text" class="datepicker @error('date') is-invalid @enderror" value = "{{ $rapports->date}}" id="dob" name="date">
                      <label for="dob">Date</label>
                     
                      @error('date')
                      <small class="red-text ml-7" role="alert">
                        {{ $message }}
                      </small>
                      @enderror
                    </div>
                   
                    <div class="input-field col m6 s12">
                      <select name="type_doc" class="@error('date') is-invalid @enderror">
                        <option value="{{ $rapports->type_doc}}" disabled selected>{{ $rapports->type_doc}}</option>
                        @foreach($documents as $document)
                        <option value="{{ $document->designation }}">{{ $document->designation }}</option>
                        @endforeach
                      </select>
                      <label>Type de document</label>
                      @error('type_doc')
                      <small class="red-text ml-7" role="alert">
                        {{ $message }}
                      </small>
                      @enderror
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col m6 s12">
                      <input id="heure_debut" value="{{ $rapports->heure_debut}}" type="time" name="heure_debut" class="@error('heure_debut') is-invalid @enderror">
                      <label for="heure_debut">Heure de début</label>
                      @error('heure_debut')
                      <small class="red-text ml-7" role="alert">
                        {{ $message }}
                      </small>
                      @enderror
                    </div>
                    <div class="input-field col m6 s12">
                      <input id="heure_fin" value="{{ $rapports->heure_fin}}" type="time" name="heure_fin" class="@error('heure_fin') is-invalid @enderror">
                      <label for="heure_fin">Heure de fin</label>
                      @error('heure_fin')
                      <small class="red-text ml-7" role="alert">
                        {{ $message }}
                      </small>
                      @enderror
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <input id="emplacement" value="{{ $rapports->emplacement}}" type="text" name="emplacement" class="@error('emplacement') is-invalid @enderror">
                      <label for="emplacement">Emplacement</label>
                      @error('emplacement')
                      <small class="red-text ml-7" role="alert">
                        {{ $message }}
                      </small>
                      @enderror
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <input id="ordre_jour" value="{{ $rapports->ordre_jour}}" type="text" name="ordre_jour" class="@error('ordre_jour') is-invalid @enderror">
                      <label for="ordre_jour">Ordre du jour</label>
                      @error('ordre_jour')
                      <small class="red-text ml-7" role="alert">
                        {{ $message }}
                      </small>
                      @enderror
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <select name="participant[]" value="{{ $rapports->participant}}" class="@error('participant') is-invalid @enderror" multiple>
                        @foreach($users as $user)
                        <option value="{{$user->nom}}   {{$user->prenoms}}">{{ $rapports->participant}}</option>
                        @endforeach
                      </select>
                      <label>Participants</label>
                      @error('participant')
                      <small class="red-text ml-7" role="alert">
                        {{ $message }}
                      </small>
                      @enderror
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col m6 s12">
                      <select name="redacteur" class="@error('redacteur') is-invalid @enderror">
                        <option value="" disabled selected>{{ $rapports->redacteur}}</option>
                        @foreach($users as $user)
                        <option value="{{$user->nom}}   {{$user->prenoms}}">{{$user->nom}} {{$user->prenoms}}</option>
                        @endforeach
                      </select>
                      <label>Rédacteur</label>
                      @error('redacteur')
                      <small class="red-text ml-7" role="alert">
                        {{ $message }}
                      </small>
                      @enderror
                    </div>
                    <div class="row">
                      <div class="input-field col m6 s12">
                        <select name="approbateur" class="@error('approbateur') is-invalid @enderror">
                          <option value="" disabled selected>{{ $rapports->approbateur}}</option>
                          @foreach($users as $user)
                          <option value="{{$user->nom . ' ' . $user->prenoms}}">{{$user->nom}} {{$user->prenoms}}</option>
                          @endforeach
                        </select>
                        <label>Approbateur</label>
                        @error('approbateur')
                        <small class="red-text ml-7" role="alert">
                          {{ $message }}
                        </small>
                        @enderror
                      </div>
                    </div>
                    <div class="row">
                    <textarea class="" id="editor" name="contenu" name="contenu" class=" form-control @error('contenu') is-invalid @enderror">{{!! $rapports->contenu !!}}</textarea>
                      @error('contenu')
                      <small class="red-text ml-7" role="alert">
                        {{ $message }}
                      </small>
                      @enderror
                    </div>

        <div class="row">
              <div class="input-field col m6 s12">
                <button class="btn  waves-effect waves-light right" type="submit" name="action">Sauvegarder
                    <i class="material-icons left">save</i>
                </button>
              </div>
             <!--  <div class="input-field col m6 s12">
                  <button class="btn cyan waves-effect waves-light right" type="submit" name="submit">Générer PDF
                    <i class="material-icons right">local_printshop</i>
                </button>
              </div>-->
            </div>
            </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <!-- Bubble Editor end -->

  <!-- full Editor start -->

  <!-- full Editor end -->
</div>
<x-head.tinymce-config/>
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
<script src="{{asset('vendors/quill/katex.min.js')}}"></script>
<script src="{{asset('vendors/quill/highlight.min.js')}}"></script>
<script src="{{asset('vendors/quill/quill.min.js')}}"></script>
<script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
<!-- <script src="https://cdn.tiny.cloud/1/g6psghhxaw7sxdad96ehxue3qvw9lv4ze311r60lghsd12md/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> -->
<!-- <script>
  apiKey="g6psghhxaw7sxdad96ehxue3qvw9lv4ze311r60lghsd12md"
  tinymce.init({
    selector: '#myeditorinstance',
    plugins: 'code table lists',
    toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
  });
</script> -->
<script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
<script>
ClassicEditor
    .create( document.querySelector( '#editor' ) )
    .catch( error => {
        console.error( error );
    } );
</script>

@endsection

{{-- page script --}}
@section('page-script')
<script src="{{asset('js/scripts/form-editor.js')}}"></script>
@endsection