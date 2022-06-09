<div class="w-full sm:max-w-md px-6 py-4">
    <form wire:submit.prevent="edit" >
        @forelse($items as $index => $item)
            <section class="border rounded p-2 shadow-md mb-6" wire:key="item-{{ $item->id }}">
                <h3 class="mb-2 text-gray-500 text-center">Item #{{ $index+1 }}</h3>
                <div>
                    <x-inputs.label for="label" value="Label" />

                    <x-inputs.text wire:model.defer="items.{{ $index }}.label" id="label" class="block mt-1 w-full" type="text" required />

                    @error("items.$index.label")<div class="mt-1 text-red-600 text-sm">{{ $message }}</div>@enderror
                </div>
                <div class="mt-3">
                    <x-inputs.label for="link" value="Link" />

                    <x-inputs.text wire:model.defer="items.{{ $index }}.link" id="link" class="block mt-1 w-full" type="text" required />

                    @error("items.$index.link")<div class="mt-1 text-red-600 text-sm">{{ $message }}</div>@enderror
                </div>
                <div class="mt-3 w-0">
                    <a href="#" @click.prevent="$dispatch('deleteit', { eventName: 'deleteItem', id: {{ $item->id }} })" class="font-medium text-sm text-red-600 hover:text-red-400" title="Delete">
                        <x-icons.delete/>
                    </a>
                </div>
            </section>
        @empty
            <h3>There are no items to show</h3>
        @endforelse
        
        @if($items->count())
            <div class="mt-4">
                <x-button>Update</x-button>
            </div>
        @endif
    </form>
</div>
