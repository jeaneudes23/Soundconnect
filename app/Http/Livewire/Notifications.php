<?php

namespace App\Http\Livewire;

use App\Models\NewNotification;
use App\Models\OldNotification;
use Livewire\Component;

class Notifications extends Component
{
    
    public function render()
    {
        foreach(auth()->user()->newNotifications as $newNotification)
        {
            $newNotification->delete();
        }
       
        $notifications = auth()->user()->oldNotifications()->get()->sortByDesc('created_at');
        return view('livewire.notifications', compact('notifications'));
    }
}
