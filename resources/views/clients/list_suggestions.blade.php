

    
                                                    <table id="data-table-simple" style="width: 100%;">
                                                        <thead>
                                                            <tr style="color:black">
                                                                <th style="text-align: left">Type</th>
                                                                <th style="text-align: left">Contenu</th>
                                                                <th style="text-align: left">Sources</th>
                                                                <th style="text-align: left">Date</th>
                                                                <th>Actions </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($Suggestion as $item)
                                                            <tr>
                                                               <td style="text-align: left"><span>{{ $item->type }}</span></td>
                                                               <td style="text-align: left"><span>{{ $item->preference }}</span></td>
                                                                <td style="text-align: left"><span>{{$item ->label ?? '' }}</span></td>
                                                                <td style="text-align: left"><span>{{ $item->date }}</span></td>
                                                                <td style="text-align: left"><span>
                                                                <div class="invoice-action">
                                                            
                                                                <a id="#editsuggestionBtn" href="{{route('suggestion.edit', $item->id)}}" class="invoice-action-edit modal-trigger tooltipped" data-position="top" data-tooltip="Modifier"
                                                                data-id="{{ $item->id }}" data-preference="{{ $item->preference }}" data-label="{{ $item->label }}" data-url="{{ route('suggestion.update', $item->id) }}">
                                                                    <i class="material-icons" style="color:green ;">edit</i>
                                                                </a>
                                                                <a id="supBtn" href="#modal11" class="invoice-action-edit modal-trigger tooltipped" data-position="top" data-tooltip="Supprimer" data-id="{{ $item->id }}" data-url="{{ route('suggestion.sup', $item->id) }}">
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
