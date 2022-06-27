<div class="w-full sm:max-w-md px-6 py-4">
    <form wire:submit.prevent="save">
        <div>
            <x-inputs.label for="name" value="{{ __('Name') }}" />

            <x-inputs.text wire:model.defer="currentProject.name" id="name" type="text" required />

            @error("currentProject.name")<div class="mt-1 text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="mt-3">
            <x-inputs.label for="projectDescription" value="{{ __('Description') }}" />

            <x-inputs.textarea wire:model.defer="currentProject.description" id="projectDescription" required />

            @error("currentProject.description")<div class="mt-1 text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="mt-4">
            <x-inputs.label for="projectImage" value="{{ __('Image') }}" />

            <x-inputs.img wire:model="imageFile" id="projectImage">
                <span class="w-24 rounded-lg overflow-hidden bg-gray-100">
                    <img src="{{ $imageFile ? $imageFile->temporaryUrl() : $currentProject->image_url }}" alt="{{ __('Project image') }}">
                </span>
            </x-inputs.img>

            @error("imageFile")<div class="mt-1 text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="mt-4">
            <x-inputs.label for="video_link" value="{{ __('Video Link') }} (Youtube)" />

            <x-inputs.text wire:model.defer="currentProject.video_link" id="video_link" type="text" />

            @error("currentProject.video_link")<div class="mt-1 text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="mt-3">
            <x-inputs.label for="url" value="{{ __('Url') }}" />

            <x-inputs.text wire:model.defer="currentProject.url" id="url" type="text" />

            @error("currentProject.url")<div class="mt-1 text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="mt-4">
            <x-button>{{ __('Save') }}</x-button>
        </div>
    </form>
</div>
