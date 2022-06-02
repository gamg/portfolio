<div class="w-full sm:max-w-md px-6 py-4">
    <form wire:submit.prevent="edit" >
        @foreach($items as $index => $item)
            <section class="border rounded p-2 shadow-md mb-6">
                <h3 class="mb-2 text-gray-500 text-center">Item #{{ $index+1 }}</h3>
                <div wire:key="item-{{ $item->id }}">
                    <x-inputs.label for="label" value="Label" />

                    <x-inputs.text wire:model.defer="items.{{ $index }}.label" id="label" class="block mt-1 w-full" type="text" required />

                    @error("items.$index.label")<div class="mt-1 text-red-600 text-sm">{{ $message }}</div>@enderror

                </div>
                <div class="mt-3">
                    <x-inputs.label for="link" value="Link" />

                    <x-inputs.text wire:model.defer="items.{{ $index }}.link" id="link" class="block mt-1 w-full" type="text" required />

                    @error("items.$index.link")<div class="mt-1 text-red-600 text-sm">{{ $message }}</div>@enderror
                </div>
            </section>
        @endforeach

        <div class="mt-4">
            <x-button>Update</x-button>
        </div>
    </form>
</div>
