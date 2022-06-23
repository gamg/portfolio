<div class="w-full sm:max-w-md px-6 py-4">
    <form wire:submit.prevent="save">
        <div>
            <x-inputs.label for="label" value="Label" />

            <x-inputs.text wire:model.defer="item.label" id="label" type="text" required />

            @error('item.label')<div class="mt-1 text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>

        <div class="mt-4">
            <x-inputs.label for="link" value="Link" />

            <x-inputs.text wire:model.defer="item.link" id="link" type="text" required />

            @error('item.link')<div class="mt-1 text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>

        <div class="mt-4">
            <x-button>Create</x-button>
        </div>
    </form>
    <div class="text-sm text-gray-500 mt-6">
        <h3>These are the static links for the 3 sections of portfolio (Home, Projects and Contact):</h3>
        <ul class="mt-4">
            <li>#hello</li>
            <li>#projects</li>
            <li>#contact-me</li>
        </ul>
    </div>
</div>


