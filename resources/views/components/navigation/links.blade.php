@props(['items' => null])

@foreach($items as $item)
    <a href="{{ $item->link }}" {{ $attributes->merge(['class' =>'font-medium']) }} wire:key="{{ $item->id }}">{{ $item->label }}</a>
@endforeach

