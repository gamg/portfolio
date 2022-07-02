<div class="w-full sm:max-w-md px-6 py-4">
    <form wire:submit.prevent="edit">
        <div>
            <x-inputs.label for="title" value="{{__('Title')}}" />

            <x-inputs.text wire:model.defer="info.title" id="title" type="text" required />

            @error("info.title")<div class="mt-1 text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="mt-3">
            <x-inputs.label for="description" value="{{__('Description')}}" />

            <x-inputs.textarea wire:model.defer="info.description" id="description" type="text" required />

            @error("info.description")<div class="mt-1 text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="mt-4">
            <x-inputs.label for="cv" value="{{__('CV')}}"/>

            <x-inputs.file wire:model="cvFile" id="cv" class="block mt-1 w-full" type="file"/>
            <a href="{{ $info->cvUrl }}" class="text-gray-400 text-sm hover:text-gray-700" target="_blank">{{__('Open Current File')}}</a>

            <div wire:loading wire:target="cvFile" class="mt-1 w-full text-indigo-700">
                {{__('Verifying file...')}}
            </div>

            @error("cvFile")<div class="mt-1 text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="mt-4">
            <x-inputs.label for="image" value="{{__('Image')}}" />

            <x-inputs.file wire:model="imageFile" id="image" class="block mt-1 w-full" type="file"/>

            <div wire:loading wire:target="imageFile" class="mt-1 w-full text-indigo-700">
                {{__('Verifying file...')}}
            </div>

            @error("imageFile")<div class="mt-1 text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="mt-4">
            <x-button>{{__('Update')}}</x-button>
        </div>
    </form>
</div>
