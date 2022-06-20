<div class="w-full sm:max-w-md px-6 py-4">
    <form wire:submit.prevent="save">
        <div>
            <x-inputs.label for="name" value="Name" />

            <x-inputs.text wire:model.defer="currentProject.name" id="name" class="block mt-1 w-full" type="text" required />

            @error("currentProject.name")<div class="mt-1 text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="mt-3">
            <x-inputs.label for="projectDescription" value="Description" />

            <x-inputs.textarea wire:model.defer="currentProject.description" id="projectDescription" class="block mt-1 w-full" type="text" required />

            @error("currentProject.description")<div class="mt-1 text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="mt-4">
            <x-inputs.label for="projectImage" value="Image" />

            <x-inputs.img wire:model="imageFile" id="projectImage">
                <span class="w-24 rounded-lg overflow-hidden bg-gray-100">
                    <img src="{{ $imageFile ? $imageFile->temporaryUrl() : $currentProject->image_url }}" alt="Project Image">
                </span>
            </x-inputs.img>

            @error("imageFile")<div class="mt-1 text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="mt-4">
            <x-inputs.label for="video_link" value="Video Link" />

            <x-inputs.text wire:model.defer="currentProject.video_link" id="video_link" class="block mt-1 w-full" type="text" />

            @error("currentProject.video_link")<div class="mt-1 text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="mt-3">
            <x-inputs.label for="url" value="Url" />

            <x-inputs.text wire:model.defer="currentProject.url" id="url" class="block mt-1 w-full" type="text" />

            @error("currentProject.url")<div class="mt-1 text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="mt-4">
            <x-button>Save</x-button>
        </div>
    </form>
</div>
