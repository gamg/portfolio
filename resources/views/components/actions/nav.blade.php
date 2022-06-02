<a href="#" {{ $attributes->merge(['class' => 'font-medium text-sm']) }} wire:click.prevent="openSlide" title="Edit">
    <x-icons.edit/>
</a>
<a href="#" {{ $attributes->merge(['class' => 'font-medium text-sm']) }} wire:click.prevent="openSlide(true)" title="New">
    <x-icons.add/>
</a>
