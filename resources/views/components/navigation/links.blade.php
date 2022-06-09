@props(['items' => null, 'extraStyles' => ''])

@foreach($items as $item)
    <a href="{{ $item->link }}" {{ $attributes->merge(['class' =>'font-medium']) }}>{{ $item->label }}</a>
@endforeach
{{--<a href="#" class="font-medium text-red-400 hover:text-red-300 {{ $extraStyles }} ">Es/En</a>--}}

