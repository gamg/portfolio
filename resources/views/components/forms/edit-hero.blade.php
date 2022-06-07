@props([
    'imageFile' => null,
    'imageUrl' => null,
    'cvUrl'  => null,
])
<div class="w-full sm:max-w-md px-6 py-4">
    <form wire:submit.prevent="edit">
        <div>
            <x-inputs.label for="title" value="Title" />

            <x-inputs.text wire:model.defer="info.title" id="title" class="block mt-1 w-full" type="text" required />

            @error("info.title")<div class="mt-1 text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="mt-3">
            <x-inputs.label for="description" value="Description" />

            <x-inputs.textarea wire:model.defer="info.description" id="description" class="block mt-1 w-full" type="text" required />

            @error("info.description")<div class="mt-1 text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="mt-4">
            <x-inputs.label for="cv" value="CV"/>

            <x-inputs.file wire:model="cvFile" id="cv" class="block mt-1 w-full" type="file"/>
            <a href="{{ $cvUrl }}" class="text-gray-400 text-sm hover:text-gray-700" target="_blank">Current File</a>

            @error("cvFile")<div class="mt-1 text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="mt-4">
            <x-inputs.label for="image" value="Image" />

            <x-inputs.img wire:model="imageFile" id="image">
                <span class="w-24 rounded-lg overflow-hidden bg-gray-100">
                    <img src="{{ $imageFile ? $imageFile->temporaryUrl() : $imageUrl }}" alt="Hero Image">
                </span>
            </x-inputs.img>

            @error("imageFile")<div class="mt-1 text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="mt-4">
            <x-button>Update</x-button>
        </div>
    </form>
</div>
