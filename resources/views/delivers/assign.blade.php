@extends('layouts.app')

@section('content')
<div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Commandes en attente de livraison</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/">Acceuil</a></li>
                        <li class="breadcrumb-item"><a href="/commandes">Commandes</a></li>
                        <li class="breadcrumb-item active">Commandes en attente</li>
                    </ol>
                </div>
                <a href="{{backUrl()}}" class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 right">RETOUR</a>
            </div>
            <div class="row" style="margin-top: 15px;">
                <div class="col s12">
                    <div class="container">
                        <div class="section">
                            <div class="card">
                                <div class="card-content">
                                    <form action="{{route('delivers.assignorder')}}" method="post">
                                        @csrf
                                        <div class="row" style="margin-bottom: 50px;">
                                            <div class="col s10" style="display:none;" id="selectform"><select name="deliver_id" class="@error('deliver_id') is-invalid @enderror">
                                                    assign <option value="" selected>Choisissez le livreur</option>
                                                    @foreach ($delivers as $item)
                                                    <option value="{{ $item->deliver_id }}"><span>{{ $item->deliver->firstname}} {{ $item->deliver->lastname}}</span></option>
                                                    @endforeach
                                                </select>
                                                @error('deliver_id')
                                                <small class="red-text ml-7" role="alert">
                                                    {{ $message }}
                                                </small>
                                                @enderror
                                            </div>
                                            <div class="col s2" id="assignation" style="display:none;">
                                                <button class="btn bcyan waves-effect waves-light right fixed" style="margin-top:5%" id="assignbutton" disabled=true type="submit">Assigner</a>
                                                    <i class="material-icons right">check</i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="responsive-table">
                                            <table id="data-table-simple" style="width:100%" class="display">
                                                <thead>
                                                    <tr style="color:black">
                                                        <th style="text-align: left;">Nom</th>
                                                        <th style="text-align: right">Prénoms</th>
                                                        <th style="text-align: right">Heure de livraison</th>
                                                        <th style="text-align: right">Zone</th>
                                                        <th style="text-align: right"> Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($orders as $item)
                                                    <tr>
                                                        <td style="text-align: left"><span>{{ $item->name}} </span></td>
                                                        <td style="text-align: right"><span>{{ $item->firstname  }} </span></td>
                                                        <td style="text-align: right"><span>{{ $item->customer_delivery_time  }} </span></td>
                                                        <td style="text-align: right"><span>{{ $item->label  }} </span></td>

                                                        <td style="text-align: right">
                                                            <span>
                                                                <div class="invoice-action">
                                                                    <div class="switch">
                                                                        <label>
                                                                            <input class="filled-in" id="checkme" name="commande[]" value="{{ $item->order_id}}" type="checkbox">
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
                                    </form>
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
@include('Suggestion.js')
@include('delivers.js')
<script src="{{ asset('js/scripts/page-users.js') }}"></script>
<script>
    var checker = document.getElementById('checkme');
    var button = document.getElementById('assignbutton');
    const disableButton = () => {
        button.disabled = true;
        console.log("created")
    };
    button.addEventListener('onchange', disableButton);
</script>
@endsection