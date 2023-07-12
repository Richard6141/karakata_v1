@extends('layouts.app')

@section('content')
<div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Coupons par client</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/">Acceuil</a>
                        </li>
                        <li class="breadcrumb-item"><a href="/list">Liste des coupons</a>
                        </li>
                        @if($customer->particulars_id != null && $customer->companies_id == null)
                        <li class="breadcrumb-item active">{{$customer_infos->name}} {{$customer_infos->firstname}}
                        </li>
                        @endif
                        @if($customer->particulars_id == null && $customer->companies_id != null)
                        <li class="breadcrumb-item active">{{$customer_infos->socialreason}}
                        </li>
                        @endif
                    </ol>
                </div>
                <a href="{{ route('coupon.add') }}" class="btn-floating  waves-effect waves-light breadcrumbs-btn right mr-1 mb-1 modal-trigger btn-large">
                    <i class="material-icons tooltipped" data-position="top" data-tooltip="Ajouter">add</i>
                </a>
                <a href="{{backUrl()}}" class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 right">RETOUR</a>

            </div>
        </div>
        <div class="row" style="margin-top: 15px;">
            <div class="col s12">
                <div class="container">
                    <div class="section">
                        <div class="card">
                            <div class="card-content">
                                <p class="caption mb-0">
                                <section class="users-list-wrapper section">
                                    <div class="users-list-table">
                                        <div class="card">
                                            <div class="card-content">
                                                <!-- datatable start -->
                                                @foreach($couponbydate as $date => $items)
                                                <div class="responsive-table">
                                                    <table id="data-table-simple" class="display">

                                                        <tr style="display: flex;">

                                                            <th><span class="new badge blue" data-badge-caption="" style="font-weight: bold;">{{$date}}</span></th>

                                                            <th><a class="waves-effect waves-light btn-small tooltipped" href="{{route('print.bydate', ['id' => $items[0]->username, 'date' => $date]) }}" target="_blank" data-tooltip="Imprimer coupons du {{$date}}"><i class=" material-icons">print</i></a></th>
                                                            <th><a id="supBtn" href="#modal2" class="waves-effect waves-light btn-small modal-trigger tooltipped" data-url="{{route('delete.bydate', ['id' => $items[0]->username, 'date' => $date]) }}" data-tooltip="Supprimer coupons du {{$date}}"><i class=" material-icons">delete</i></a></th>
                                                        </tr>
                                                        <tr style="font-weight: bold; color: black">
                                                            <th>Code</th>
                                                            <th>Prix</th>
                                                            <th>Date d'expiration</th>
                                                            <th style="text-align: center">Statut</th>
                                                            <th style="text-align: end">Actions</th>
                                                        </tr>
                                                        <tbody>
                                                            @foreach($items as $item)
                                                            <tr>
                                                                <td><span>{{ $item->coupon_unique_code }}</span></td>
                                                                <td><span>{{ $item->coupon_value ?? 0 }}</span></td>
                                                                <td><span>{{ $item->expiry_date }}</span></td>
                                                                <td style="text-align: center">

                                                                    @if ($item->coupon_status == 0)
                                                                    <span class="new badge gradient-45deg-light-blue-cyan" data-badge-caption="" style="font-weight: bold;">Non utilisé</span>
                                                                    @endif
                                                                    @if ($item->coupon_status == 1)
                                                                    <span class="new badge" data-badge-caption="">Utilisé</span>
                                                                    @endif
                                                                </td>
                                                                <td style="text-align: right">
                                                                    <div class="invoice-action">
                                                                        <a class="waves-effect waves-light btn-small tooltipped" data-position="top" data-tooltip="Imprimer" target="_blank" href="{{route('coupon.imprimer', ['id' => $item->coupon_id]) }}"><i class="material-icons">print</i></a>
                                                                        <a class="waves-effect waves-light btn-small tooltipped" data-position="top" data-tooltip="Modifier"  href="{{route('edit.coupon', ['id' => $item->coupon_id, 'customer' => $customer->id ]) }}"><i class="material-icons">edit</i></a>
                                                                        <a id="supBtn" href="#modal2" class="invoice-action-edit modal-trigger tooltipped" data-position="top" data-tooltip="Supprimer" data-id="{{ $item->coupon_id }}" data-url="{{ route('coupon.sup', $item->coupon_id) }}"><i class="material-icons" style="color:red ">delete</i>
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    @endforeach
                                                </div>
                                                <!-- datatable ends -->
                                            </div>
                                        </div>
                                    </div>

                                    @include('Coupons.sup_message')
                                </section>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-overlay"></div>
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
    $(document).ready(function() {
        $(document).on('click', '#editBtn', function() {
            $('#code').val($(this).attr('data-code'))
            $('#price').val($(this).attr('data-price'))
            $('#date_expiration').val($(this).attr('data-date_expiration'))
            $('#client_id').val($(this).attr('data-client_id'))
            $('#numero').val($(this).attr('data-numero'))
            $('#price').val($(this).attr('data-price'))

            document.forms.addForm.action = $(this).attr('data-url');
        })
    })

    $(document).on('click', '#supBtn', function() {
        document.forms.deleteForm.action = $(this).attr('data-url');
    })
</script>
@endsection