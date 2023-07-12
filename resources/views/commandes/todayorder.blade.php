@extends('layouts.app')

@section('content')





    <!-- BEGIN: Page Main-->
    <div >
      <div class="row">
        <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="col s12">
          <div class="container">
            <!-- invoice list -->
<section class="invoice-list-wrapper section">
  <div class="filter-btn">
    <!-- Dropdown Trigger -->
    <!-- <a class='dropdown-trigger btn waves-effect waves-light purple darken-1 border-round' href='#'
     > Rechercher
      <i class="material-icons">search</i>
    </a> -->
  </div>
  <div class="responsive-table">
    <table class="table invoice-data-table white border-radius-4 pt-1">
      <thead>
        <tr>
          <!-- data table responsive icons -->
          <th></th>
          <!-- data table checkbox -->
          <th></th>
          <th>
          </th>
          <th>Nom du client</th>
          <th>Bénéficiaire</th>
          <th>Pack</th>
          <th>Status</th>
          <th>Quantité</th>
          <th>Montant</th>
          <th>Paiement</th>
        </tr>
      </thead>

      <tbody>
        @foreach($orders as $item)
        <tr>
          <td></td>
          <td></td>
          <td>
          </td>
          <td><span class="invoice-amount">
            {{ $item->customer->particular->name ?? $item->customer->company->name }}
            {{ $item->customer->particular->firstname ?? $item->customer->company->firstname }}
          </span></td>
          <td><small>{{ $item->receiver->firstname ?? 'N/A' }}{{ $item->receiver->lastname ?? '' }}</small></td>
          <td><span class="invoice-customer">{{ $item->paquet->paquetType->label ?? '' }}</span></td>
          <td>
            @if ($item->status_order == true)
            <span class="bullet green"></span>
            <small>Validée</small>
            @else
            <span class="bullet red"></span>
            <small>En cours</small>
            @endif
          </td>
          <td>
            <span>{{ $item->number }}</span>
          </td>
          <td>
            <span>{{ $item->total }}</span>
          </td>
          <td>
            @if ($item->finished == true)
            <span class="chip lighten-5 green green-text">Payée</span>
            @else
            <span class="chip lighten-5 red red-text">En cours</span>
            @endif
          </td>
          <!-- <td>
            <div class="invoice-action">
              <a href="app-invoice-view.html" class="invoice-action-view mr-4">
                <i class="material-icons">remove_red_eye</i>
              </a>
              <a href="app-invoice-edit.html" class="invoice-action-edit">
                <i class="material-icons">edit</i>
              </a>
            </div>
          </td> -->
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</section><!-- START RIGHT SIDEBAR NAV -->

<!-- END RIGHT SIDEBAR NAV -->
          </div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->

    <!-- Theme Customizer -->

<!--/ Theme Customizer -->



@endsection