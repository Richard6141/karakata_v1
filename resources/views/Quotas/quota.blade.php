@extends('layouts.app')

@section('content')
@if (session()->has('successMessage'))
<div class="alert alert-success" role="alert">
  {{ session('successMessage') }}
</div>
@endif
@if (session()->has('errorMessage'))
<div class="alert alert-danger" role="alert">
  {{ session('errorMessage') }}
</div>
@endif
<div class="row">
  <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Liste des quotas</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="/">Acceuil</a>
            </li>
            <li class="breadcrumb-item active">Quotas

          </ol>
        </div>
        <a href="#modalcomposant" class="btn-floating  waves-effect waves-light breadcrumbs-btn right mr-1 mb-1 modal-trigger btn-large">
          <i class="material-icons tooltipped" data-position="top" data-tooltip="Ajouter">add</i>
        </a>
        <a href="{{backUrl()}}" class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 right">RETOUR</a>

      </div>
    </div>
  </div>
  <div class="col s12">
    <div class="container">
      <div class="section">
        <div class="card">
          <div class="card-content">
            <p class="caption mb-0">

            <section class="users-list-wrapper section">
              @if (session()->has('successMessage'))
              <div class="card-alert card green lighten-5">
                <div class="card-content green-text">
                  <p style="color:#336600;">{!! session('successMessage') !!}</p>
                </div>
                <button type="button" class="close green-text" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              @endif
              @if (session()->has('alertMessage'))
              <div class="card-alert card orange lighten-5">
                <div class="card-content orange-text">
                  <p>WARNING : {!! session('alertMessage') !!}</p>
                </div>
                <button type="button" class="close orange-text" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              @endif
              @if (session()->has('errorMessage'))
              <div class="card-alert card red lighten-5">
                <div class="card-content red-text">
                  <p>{!! session('errorMessage') !!}</p>
                </div>
                <button type="button" class="close red-text" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              @endif

              <div class="users-list-table">
                <div class="card">
                  <div class="card-content">
                    <!-- datatable start -->
                    <div class="responsive-table">
                      <table id="data-table-simple" class="display" style="width: 100%;">
                        <thead>
                          <tr style="color:black">
                            <th>Plat</th>
                            <th>Quota du jour</th>
                            <th>Date</th>
                            <th style="text-align: right">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($Quota as $item)
                          <tr>
                            <td><span>{{$item->reistance->label}}</span></td>
                            <td><span>{{$item->quota}}</span></td>
                            <td><span>{{ Carbon\carbon::parse($item->date)->format('d-m-Y')}}</span></td>
                            <td style="text-align: right"><span><a id="editBtn" href="#modalcomposant" class="invoice-action-edit modal-trigger tooltipped" data-position="top" data-tooltip="Modifier" data-id="{{ $item->id }}" data-quota="{{ $item->quota }}" data-date="{{ $item->date }}" data-pack_id="{{ $item->resistance_id }}" data-url="{{ route('update.quota', $item->id) }}">
                                  <i class="material-icons" style="color:green">edit</i>
                                </a></span></td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <!-- datatable ends -->
                  </div>
                </div>
              </div>
              @include('Quotas.add_quota')
            </section>
            </p>
          </div>
        </div>
      </div>


    </div>
    <div class="content-overlay"></div>
  </div>
</div>
@endsection
@section('scripts')
<script>
  $(document).ready(function() {
    $(document).on('click', '#editBtn', function() {
      $('#quota').val($(this).attr('data-quota'));
      $('#date').val($(this).attr('data-date'));
      $('#pack').val($(this).attr('data-pack_id'));
      document.forms.addForm.action = $(this).attr('data-url');
    })

    $(document).on('click', '#supBtn', function() {
      document.forms.deleteForm.action = $(this).attr('data-url');
    })
  })
</script>
@endsection