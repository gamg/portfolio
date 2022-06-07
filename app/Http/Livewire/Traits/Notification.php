<?php

namespace App\Http\Livewire\Traits;

trait Notification
{
    public function notify($message = '')
    {
        $this->dispatchBrowserEvent('notify', ['message' => $message]);
    }
}
