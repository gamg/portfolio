<div class="w-full sm:max-w-md px-6 py-4">
    <x-inputs.select wire:model="socialLinkSelected" placeholder="Select a social link to edit">
        @foreach ($socialLinks as $socialLink)
            <option value="{{ $socialLink->id }}">{{ $socialLink->name }}</option>
        @endforeach
    </x-inputs.select>

    @if($socialLinkSelected)
        <x-forms.create-or-edit-social-link-form>
            <x-actions.action @click.prevent="$dispatch('deleteit', { eventName: 'deleteSocialLink' })" title="Delete" class="text-red-600 hover:text-red-400">
                <x-icons.delete/>
            </x-actions.action>
        </x-forms.create-or-edit-social-link-form>
    @endif
</div>


