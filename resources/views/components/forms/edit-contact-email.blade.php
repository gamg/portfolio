<div class="w-full sm:max-w-md px-6 py-4">
    <form wire:submit.prevent="edit">
        <div>
            <x-inputs.label for="email" value="Email Address" />

            <x-inputs.text wire:model.defer="contact.email" id="email" class="block mt-1 w-full" type="email" required/>

            @error("contact.email")<div class="mt-1 text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="mt-4">
            <x-button>Update Email</x-button>
        </div>
    </form>
</div>
