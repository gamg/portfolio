<?php

namespace App\Http\Livewire\Navigation;

use App\Models\Navitem;
use Livewire\Component;

class Navigation extends Component
{
    public $items;
    public $openSlideover = false;
    public $addNewItem = false;

    protected $listeners = ['itemAdded' => 'updateDataAfterAddItem'];

    protected $rules = [
        'items.*.label' => 'required|max:20',
        'items.*.link' => 'required|max:40',
    ];

    public function mount()
    {
        $this->items = Navitem::all();
    }

    public function edit()
    {
        $this->validate();

        foreach ($this->items as $item) {
            $item->save();
        }

        $this->reset('openSlideover');
    }

    public function openSlide($addNewItem = false)
    {
        $this->addNewItem = $addNewItem;
        $this->openSlideover = true;
    }

    public function updateDataAfterAddItem()
    {
        $this->mount();
        $this->reset('openSlideover');
    }

    public function render()
    {
        return view('livewire.navigation.navigation');
    }
}
