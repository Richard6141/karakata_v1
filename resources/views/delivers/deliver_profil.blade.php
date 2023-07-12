@extends('layouts.app')

@section('content')
<div class="row">
  <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Profil du livreur</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="/">Acceuil</a>
            </li>
            <li class="breadcrumb-item"><a href="{{route('delivers.index')}}">Livreurs</a>
            </li>
            <li class="breadcrumb-item active">Profil
            </li>
          </ol>
        </div>
        <a href="{{backUrl()}}" class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 right">RETOUR</a>
      </div>
    </div>
  </div>
  <div class="col s12">
    <div class="" id="user-profile">
      <div class="row">
        <!-- User Profile Feed -->
        <div class="card left col s12 m8 xl4" style="width:30%; margin-top:4%">
          <div class="col s12 m15 ">
            <div id="profile-card" class="card">
              <div class="card-image waves-effect waves-block waves-light">
                <img class="activator" src="../../../app-assets/images/gallery/28.png" alt="user bg" />
              </div>
              <div class="card-content">
                <span>
                  <!-- <span>
                        <img src="{{ 'https://ui-avatars.com/api/?background=8EC741&color=ffff/?uppercase=true&name=' . $deliver->firstname }}" alt="Photo de profil" class="circle responsive-img activator card-profile-image cyan lighten-1 padding-2">

                      </span> -->

                  <!-- <a class="btn-floating activator btn-move-up waves-effect waves-light red accent-2 z-depth-4 right">
                        <i class="material-icons">edit</i>
                      </a> -->

                  <h5 class="card-title activator grey-text text-darken-4"><span>
                      {{$deliver->firstname}}</span>
                    <span>
                      {{$deliver->lastname}}</span>
                  </h5>
              </div>
              <div class="card-reveal">
                <span class="card-title grey-text text-darken-4">
                  <span>
                    {{$deliver->firstname}}</span>
                  <span>
                    {{$deliver->lastname}}</span>
                  <p>Informations complete</p>
                  <p><i class="material-icons">perm_phone_msg</i> {{$deliver->nameé}}</p>
                  <p><i class="material-icons">email</i> {{$deliver->firstname}}</p>
                  <p><i class="material-icons">email</i> {{$deliver->phone}}</p>
                  <p><i class="material-icons">arrow_forward</i> {{$deliver->created_at->format('d M Y')}}</p>
                  <p>

                  </p>
                  <p></p>
              </div>
            </div>

          </div>
          <div class="col s12 m15 ">
            <div class="card">
              <div class="card-content green lighten-1 white-text">
                <!-- <p class="card-stats-title"><i class="material-icons">content_copy</i> Solde</p> -->
                <h4 class="card-stats-number white-text">

                  <span>{{$number}}</span>

                  @if($number<=1) <span>commande livrée</span>
                    @else
                    <span>commandes livrées</span>
                    @endif

                </h4>

              </div>

            </div>
          </div>
        </div>

        <!-- User Post Feed -->
        <div class="col s12 m8 ">
          <div class="col m10 s14 right" style="width:100%; margin-top:5%">
            <!-- <div class="card-panel center"> -->
            <!-- <div class="">

                    <a href="" style="margin:1%" class="btn-small indigo">Commande</a>
                    <a href="#coupon" style="margin:1%" class="btn-small indigo modal-trigger">Coupon</a>
                    <a href="#modal1" style="margin:1%" class="btn-small indigo modal-trigger">Suggestion</a>
                    <a id="#depot" href="#modal2" style="margin:1%" class="btn-small indigo modal-trigger">Dépôt</a>

                  </div> -->
            <!-- </div> -->

            <div class="card">
              <div class="card-content center">
                <!-- <h4>Opérations du client</h4> -->
              </div>
              <div class="card-tabs">
                <ul class="tabs tabs-fixed-width">
                  <li class="tab"><a href="#test4" style="color:black">NOMBRE DE COMMANDES</a></li>
                  <li class="tab"><a class="active" href="#test5" style="color:black">LISTE COMMANDES</a></li>
                  <!-- <li class="tab"><a href="#test6" style="color:black">COMMANDES TOTAL</a></li> -->
                </ul>
              </div>
              <div class="card-content grey lighten-4">
                <div id="test4">
                  <div class="content-area " style="width:100%">
                    <div class="app-wrapper">
                      <div class="datatable-search">
                        <i class="material-icons mr-2 search-icon">search</i>
                        <input type="text" placeholder="Search Contact" class="app-filter" id="global_filter">
                      </div>
                      <div id="button-trigger" class="card card card-default scrollspy border-radius-6 fixed-width">
                        <div class="card-content p-0">
                          <table id="data-table-contact" class="display" style="width:100%">
                            <thead>
                              <tr>

                                <th>Date</th>
                                <th>Nombres</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($orders as $item)
                              <tr>
                                <td>{{$item->date}}</td>
                                <td>{{$item->total}}</td>
                            </tbody>
                            @endforeach
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="test5">
                  <div class="responsive-table">
                    <div class="content-area " style="width:100%">
                      <div class="app-wrapper">
                        <div class="datatable-search">
                          <i class="material-icons mr-2 search-icon">search</i>
                          <input type="text" placeholder="Search Contact" class="app-filter" id="global_filter">
                        </div>
                        <div id="button-trigger" class="card card card-default scrollspy border-radius-6 fixed-width">
                          <div class="card-content p-0">
                            <table id="data-table-contact" class="display" style="width:100%">
                              <thead>
                                <tr>
                                  <th class="background-image-none center-align">
                                    <label>
                                      <input type="checkbox" onClick="toggle(this)" />
                                      <span></span>
                                    </label>
                                  </th>
                                  <th>Date</th>
                                  <th>Nom</th>
                                  <th>Prénom</th>
                                  <th>Phone</th>
                                  <th>Status</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach ($allorders as $item)
                                <tr>
                                  <td class="center-align contact-checkbox">
                                    <label class="checkbox-label">
                                      <input type="checkbox" name="foo" />
                                      <span></span>
                                    </label>
                                  </td>
                                  <td>{{$item->date}}</td>
                                  <td>{{$item->name}}</td>
                                  <td>{{$item->firstname}}</td>
                                  <td>{{$item->phone}}</td>
                                  @if($item->status_delivery == false)
                                  <td style="color: red">Non livrée</td>
                                  @else
                                  <td style="color: green">Livrée</td>
                                  @endif
                                </tr>
                              </tbody>
                              @endforeach
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- <div id="test6">
                      salut2
                    </div> -->
            </div>
          </div>
          <!-- Today Highlight -->

        </div>





      </div>
    </div>
  </div>
  <div class="content-overlay"></div>
</div>
</div>
<!-- users list start -->

<!-- users list ends -->
@endsection


{{-- page script --}}
@section('scripts')
<script src="{{ asset('js/scripts/page-users.js') }}"></script>
<script>
  $(document).on('click', '#supBtn', function() {
    document.forms.deleteForm.action = $(this).attr('data-url');
  })
</script>
@endsection
