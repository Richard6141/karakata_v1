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
<section class="users-list-wrapper section">
  
  <div class="users-list-filter">
    <div class="card-panel">
      <div class="row">
        <form>
          <div class="col s12 m6 l3">
            <label for="users-list-verified">Type</label>
            <div class="input-field">
              <select class="form-control" id="users-list-verified">
                <option value="">CODIV</option>
                <option value="Yes">CODIR</option>
              </select>
            </div>
          </div>
          <!-- <div class="col s12 m6 l3">
            <label for="users-list-role">date</label>
            <div class="input-field">
              <select class="form-control" id="users-list-role">
                <option value="">journalier</option>
                <option value="User">hebdomadaire</option>
                <option value="Staff">annuel</option>
              </select>
            </div>
          </div>
          <div class="col s12 m6 l3">
            <label for="users-list-status">Status</label>
            <div class="input-field">
              <select class="form-control" id="users-list-status">
                <option value="Active">valider</option>
                <option value="Close">rejeter</option>
                <option value="Banned">En attente</option>
              </select>
            </div>
          </div> -->
          <div class="col s12 m6 l3 display-flex align-items-center show-btn">
            <button type="submit" class="btn btn-block indigo waves-effect waves-light">Filtrer</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="users-list-table">
    <div class="card">
      <div class="card-content">
        <!-- datatable start -->
        <div class="responsive-table">
          <table id="users-list-datatable" class="table">
            <thead>
              <tr>
                <th></th>
                <th>Type</th>
                <th>Ordre du jour</th>
                <th>date</th>
                <th>status</th>
              </tr>
            </thead>
            @foreach ($rapports as $rapport)
            <tbody>
              <tr>
                <td></td>
                <td>{{$rapport->type_doc}}</td>
                <td>{{$rapport->ordre_jour}}
                </td>
                <td>{{$rapport->date}}</td>
                <td><span class="chip green lighten-5">
                    <span class="green-text">En attente</span>
                  </span>
                </td>
                <td>
                  <a id="deletebtn" href="#modal1" class=" modal-trigger danger" data-url="{{route('rapport.delete', $rapport->id)}}"><i class="material-icons">delete</i></a></td>
                <td><a  href="{{ url('rapport/'. $rapport->id)}}"><i class="material-icons">remove_red_eye</i></a></td>
                <td><a  href="{{ route('rapport.edit', $rapport->id)}}"><i class="material-icons">edit</i></a></td>
              </tr>
             
             </tbody>
             @endforeach
          </table>
        </div>
        <!-- datatable ends -->
      </div>
    </div>
  </div>
  @include('rapport.deletemodal')
</section>
<!-- users list ends -->
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
<script src="{{asset('vendors/data-tables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}"></script>
@endsection

{{-- page script --}}
@section('script')
<script src="{{asset('js/scripts/page-users.js')}}"></script>
<script src="{{asset('js/scripts/advance-ui-modals.js')}}"></script>
<script>
  $(document).ready(function(){
    $(document).on('click', '#deletebtn', function(){
      document.forms.deleteForm.action = $(this).attr('data-url')
    })
  })
</script>
@endsection

