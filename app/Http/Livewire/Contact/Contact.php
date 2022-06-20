<?php

namespace App\Http\Livewire\Contact;

use Livewire\Component;
use App\Models\PersonalInformation;
use App\Http\Livewire\Traits\Slideover;
use App\Http\Livewire\Traits\Notification;

class Contact extends Component
{
    use Slideover, Notification;

    public PersonalInformation $contact;

    protected $rules = ['contact.email' => 'required|email:filter'];

    public function mount()
    {
        $this->contact = PersonalInformation::first() ?? new PersonalInformation();
    }

    public function edit()
    {
        $this->validate();

        $this->contact->save();

        $this->reset('openSlideover');
        $this->notify('Contact email updated successfully!');
    }

    public function render()
    {
        return view('livewire.contact.contact');
    }
}
