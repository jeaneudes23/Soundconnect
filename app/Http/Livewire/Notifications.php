<?php

namespace App\Http\Livewire;

use App\Models\NewNotification;
use App\Models\OldNotification;
use Livewire\Component;

class Notifications extends Component
{
    
    public function render()
    {
        foreach(auth()->user()->unreadNotifications()->where('action','!=','message')->get() as $notification)
        {
            $notification->update([
              'read_at' => now()
            ]);
        }
       
        $notifications = auth()->user()->notifications()->where('action','!=','message')->get()->sortByDesc('created_at');
        return view('livewire.notifications', compact('notifications'));
    }
}
