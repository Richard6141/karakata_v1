
<h6>
  Liste des commandes en attente
</h6>
<table id="data-table-simple1" class="display" style="width: 100%;">
    <thead>
    <th style="text-align: left; color:black">Pack</th>
    <th style="text-align: left; color:black">Quantité</th>
    <th style="text-align: left; color:black">Total</th>
    <th style="text-align: left; color:black">Mode de paiement</th>
    <th>Actions </th>
    </tr>
    </thead>
    <tbody>
    @foreach ($commandes as $item)
    <tr>
    <td style="text-align: left"><span>{{$item ->label ?? ''  }}</span></td>
    <td style="text-align: left"><span> {{ $item->number }} </span></td>
    <td style="text-align: left"><span> {{ $item->total }} F CFA</span></td>
    <td style="text-align: left"><span> {{ $item->payement_modes->label ?? '' }} </span></td>
    <td style="text-align: left"><span>
    <div class="invoice-action">

    <a id="" href="" class="invoice-action-edit modal-trigger tooltipped" data-position="top" data-tooltip="Modifier" >
    <i class="material-icons" style="color:green ;">edit</i>
    </a>
    <a id="supBtn" href="#modal11" class="invoice-action-edit modal-trigger tooltipped" data-position="top" data-tooltip="Supprimer" data-id="" data-url="">
    <i class="material-icons" style="color:red ">delete</i>
    </a>
    </div>
    </span></td>
    </tr>
    @endforeach
    </tbody>
    </table>

   