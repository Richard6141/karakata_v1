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
                <a href="{{route('coupon.add')}}" class="btn-floating  waves-effect waves-lig ht breadcrumbs-btn right mr-1 mb-1 modal-trigger btn-large">
                    <i class="material-icons tooltipped" data-position="top" data-tooltip="Ajouter">add</i>
                </a>
                <a href="{{backUrl()}}" class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 right">RETOUR</a>
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
                                                        <th>Nom du client</th>
                                                        <th style="text-align: center;">Coupons restant(s)</th>
                                                        <th style="text-align: right;">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($particularsCoupons as $username => $coupons)
                                                    <tr>
                                                        @if($coupons[0]->particulars_id == null)
                                                        <td><span>{{$coupons[0]->socialreason}}</span></td>
                                                        @endif
                                                        @if($coupons[0]->companies_id == null)
                                                        <td><span>{{$coupons[0]->name}} {{$coupons[0]->firstname}}</span></td>
                                                        @endif
                                                        <td style="text-align: center;"><span>{{count($coupons)}}</span></td>
                                                        <td style="text-align: right;">
                                                            <div class="invoice-action">
                                                                <a href="{{ route('coupon.customers', $username) }}" class="invoice-action-view mr-4 tooltipped" data-position="top" data-tooltip="Voir">
                                                                    <i class="material-icons" style="color: blue;">remove_red_eye</i>
                                                                </a>

                                                                <a id="supBtn" href="{{ route('coupon.multiple', $username) }}" class="invoice-action-edit modal-trigger tooltipped" data-position="top" data-tooltip="Imprimer">
                                                                    <i class="material-icons" style="color:red ">print</i>
                                                                </a>

                                                                <a id="supBtn" href="{{ route('send.coupon', $username) }}" class="invoice-action-edit modal-trigger tooltipped" data-position="top" data-tooltip="Envoyer">
                                                                    <i class="material-icons" style="color:green ">send</i>
                                                                </a>
                                                            </div>
                                                        </td>

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
</div>
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
