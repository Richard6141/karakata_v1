@foreach ($clients as $item)
    <option value="{{ $item->id }}">{{ $item->nom }}</option>
@endforeach
