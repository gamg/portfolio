<div class="w-full sm:max-w-md px-6 py-4">
    <form wire:submit.prevent="save">
        <div>
            <x-inputs.label for="label" value="Label" />

            <x-inputs.text wire:model.defer="item.label" id="label" class="block mt-1 w-full" type="text" required />

            @error('item.label')<div class="mt-1 text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>

        <div class="mt-4">
            <x-inputs.label for="link" value="Link" />

            <x-inputs.text wire:model.defer="item.link" id="link" class="block mt-1 w-full" type="text" required />

            @error('item.link')<div class="mt-1 text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>

        <div class="mt-4">
            <x-button>Create</x-button>
        </div>
    </form>
</div>


