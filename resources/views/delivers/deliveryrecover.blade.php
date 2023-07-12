@extends('layouts.app')

@section('content')
<div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Liste des coupons restants</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/">Acceuil</a>
                        </li>

                        <li class="breadcrumb-item active">Coupons par client

                        </li>
                    </ol>
                </div>
                <a href="{{backUrl()}}" class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 right">RETOUR</a>
            </div>
            <div class="row" style="margin-top: 15px;">
                <div class="col s12">
                    <div class="container">
                        <div class="section">
                            <div class="card">
                                <div class="col s12 m12 l12">
                                    <div id="Form-advance" class="card card card-default scrollspy">
                                        <div class="center" style="font-size:2em; font-weight: bold ">
                                            <span>{{ $delivers->firstname}} {{ $delivers->lastname}}</span>
                                        </div>
                                        <form action="{{route('delivers.desassignorder', $delivers->id)}}" method="post">
                                            <div class="card-content">
                                                <div class="row">
                                                    <div class="col s10">
                                                        <a href="{{route('delivers.assign', $delivers->id)}}" class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 ml-2">Assigner</a>
                                                        <a href="{{route('delivers.desassign', $delivers->id)}}" class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 ml-2">Désassigner</a>
                                                        <a href="{{route('delivers.delivery', $delivers->id)}}" class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 ml-2">Livraisons en cours</a>
                                                        <a href="{{route('delivers.deliveryrecover', $delivers->id)}}" style="background-color:green" class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 ml-2 active">Livraisons effectuées</a>
                                                    </div>
                                                    <div class="col s2">
                                                        <button id="modalBtnCommande" class="btn bcyan waves-effect waves-light right" style="margin-top:5%" type="submit">Retirer
                                                            <i class="material-icons right">do_not_disturb_on</i>
                                                        </button>
                                                    </div>
                                                </div>

                                                <section class="users-list-wrapper section">
                                                    <div class="users-list-table">
                                                        <div class="card">
                                                            <div class="card-content">
                                                                <!-- datatable start -->
                                                                @csrf
                                                                <input type="hidden" name="deliver_id" value="{{$delivers->id}}">
                                                                <div class="responsive-table">
                                                                    <table id="data-table-simple" class="display" style="width:100%">
                                                                        <thead>
                                                                            <tr style="color:black">
                                                                                <th style="text-align: left;">Nom</th>
                                                                                <th style="text-align: right">Prénoms</th>
                                                                                <th style="text-align: right">Zone</th>
                                                                                <th> </th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($orders as $item)
                                                                            <tr>
                                                                                <td style="text-align: left"><span>{{ $item->name}} </span></td>
                                                                                <td style="text-align: right"><span>{{ $item->firstname  }} </span></td>
                                                                                <td style="text-align: right"><span>{{ $item->label  }} </span></td>

                                                                                <td style="text-align: right">
                                                                                    <span>
                                                                                        <div class="invoice-action">
                                                                                            <div class="switch">
                                                                                                <label>
                                                                                                    <input class="filled-in" id="commande" name="commande[]" value="{{ $item->order_id}}" type="checkbox">
                                                                                                    <span></span>
                                                                                                </label>

                                                                                            </div>
                                                                                        </div>
                                                                                    </span>
                                                                                </td>
                                                                            </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-overlay"></div>
            </div>
        </div>
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