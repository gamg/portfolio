<?php

namespace App\Http\Livewire\Traits;

use App\Models\Navitem;
use App\Models\SocialLink as SocialLinkModel;

trait Slideover
{
    public $openSlideover = false;
    public $addNewItem = false;

    public function openSlide($addNewItem = false)
    {
        $this->addNewItem = $addNewItem;
        $this->openSlideover = true;
    }
}
