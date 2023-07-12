@extends('layouts.app')
@section('content')
<div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Liste des coupons</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/">Acceuil</a>
                        </li>
                        <li class="breadcrumb-item active">Coupons non valides
                        </li>
                    </ol>
                </div>
                <a href="{{route('coupon.add')}}" class="btn-floating  waves-effect waves-lig ht breadcrumbs-btn right mr-1 mb-1 modal-trigger btn-large">
                    <i class="material-icons tooltipped" data-position="top" data-tooltip="Ajouter">add</i>
                </a>
                <a href="{{backUrl()}}" class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 right tooltipped" data-tooltip="Retour">RETOUR</a>
            </div>
            <div class="row" style="margin-top: 15px;">
                <div class="col s12">
                    <div class="container">
                        <div class="section">
                            <div class="card">
                                <div class="card-content">
                                    <div class="responsive-table">
                                        <table id="data-table-simple1" class="display" style="width: 100%;">
                                            <div>
                                                <thead>
                                                    <tr style="color:black">
                                                        <th style="text-align: left; width: 150px">Code coupons</th>
                                                        <th style="width: 100px; text-align: right;">Date d'expiration</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($couponsNovalid as $item)
                                                    <tr>
                                                        <td style="text-align: left">{{$item->coupon_unique_code}}</td>
                                                        @if($item->date_of_use)
                                                        <td style="width: 100px; text-align: right;">{{$item->date_of_use}}</td>
                                                        @else 
                                                        <td style="width: 100px; text-align: right;">Coupon expiré le {{$item->expiry_date}}</td>
                                                        @endif
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </div>
                                        </table>
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