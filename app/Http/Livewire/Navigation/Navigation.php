<?php

namespace App\Http\Livewire\Navigation;

use App\Http\Livewire\Traits\Notification;
use App\Http\Livewire\Traits\Slideover;
use App\Models\Navitem;
use Livewire\Component;

class Navigation extends Component
{
    use Slideover, Notification;

    public $items;

    protected $listeners = ['itemAdded' => 'updateDataAfterAddItem', 'deleteItem'];

    protected $rules = [
        'items.*.label' => 'required|max:20',
        'items.*.link' => 'required|max:40',
    ];

    public function mount()
    {
        $this->items = Navitem::all();
    }

    public function updateDataAfterAddItem()
    {
        $this->mount();
        $this->reset('openSlideover');
    }

    public function edit()
    {
        $this->validate();

        foreach ($this->items as $item) {
            $item->save();
        }

        $this->reset('openSlideover');
        $this->emitTo('navigation.footer-link','updatedItems');
        $this->notify(__('Menu items updated successfully!'));
    }

    public function deleteItem(Navitem $item)
    {
        $item->delete();
        $this->emitTo('navigation.footer-link','updatedItems');
        $this->mount();
        $this->notify(__('Menu item has been deleted.'), 'deleteMessage');
    }

    public function render()
    {
        return view('livewire.navigation.navigation');
    }
}
