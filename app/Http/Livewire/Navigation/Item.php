<?php

namespace App\Http\Livewire\Navigation;

use App\Models\Navitem;
use Livewire\Component;

class Item extends Component
{
    public Navitem $item;

    protected $rules = [
        'item.label' => 'required|max:20',
        'item.link' => 'required|max:40',
    ];

    public function mount()
    {
        $this->item = new Navitem();
    }

    public function save()
    {
        $this->validate();
        $this->item->save();
        $this->emitTo('navigation.navigation','itemAdded');
        $this->mount();
    }

    public function render()
    {
        return view('livewire.navigation.item');
    }
}
