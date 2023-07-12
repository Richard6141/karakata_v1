<!-- <link rel="contents" type="application/json" href="{{asset('cdn.datatables.net/plug-ins/1.12.1/i18n/fr-FR.json')}}"> -->
 
 <table id="data-table-simple1" class="display" style="width: 100%;">
    <thead>
    <th style="text-align: left; color:black">Montant</th>
    <th style="text-align: left; color:black">Date</th>
    <th>Actions </th>
    </tr>
    </thead>
    <tbody>
    @foreach ($customer_depots as $item)
    <tr>
    <td style="text-align: left"><span>{{ $item->amount }} F CFA</span></td>
    <td style="text-align: left"><span> {{ $item->date }} </span></td>
    <td style="text-align: left"><span>
    <div class="invoice-action">

    <a id="" href="{{route('customerdepot.edit', $item->id)}}" class="invoice-action-edit modal-trigger tooltipped" data-position="top" data-tooltip="Modifier" >
    <i class="material-icons" style="color:green ;">edit</i>
    </a>
    <a id="supBtn" href="#modal11" class="invoice-action-edit modal-trigger tooltipped" data-position="top" data-tooltip="Supprimer" data-id="{{ $item->id }}" data-url="{{ route('customerdepot.sup', $item->id) }}">
    <i class="material-icons" style="color:red ">delete</i>
    </a>
    </div>
    </span></td>
    </tr>
    @endforeach
    </tbody>
    </table>
@section('scripts')
@include('Suggestion.js')
@endsection
