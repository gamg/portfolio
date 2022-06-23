<?php

namespace App\Http\Livewire\Navigation;

use App\Models\Navitem;
use Livewire\Component;

class FooterLink extends Component
{
    public $items;

    protected $listeners = ['updatedItems'];

    public function mount()
    {
        $this->items = Navitem::all();
    }

    public function updatedItems()
    {
        $this->mount();
    }

    public function render()
    {
        return view('livewire.navigation.footer-link');
    }
}
