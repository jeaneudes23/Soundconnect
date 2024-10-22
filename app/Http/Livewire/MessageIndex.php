<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Message;
use Livewire\Component;

class MessageIndex extends Component
{
  public $sender;
  public function render()
  {

    $unsortedUsersInContact = collect();
    auth()->user()->sentMessages->each(function ($message) use ($unsortedUsersInContact) {
      $unsortedUsersInContact->push([
        'user_id' => $message->receiver,
        'timestamp' => $message->created_at,
      ]);
    });
    auth()->user()->receivedMessages->each(function ($message) use ($unsortedUsersInContact) {
      $unsortedUsersInContact->push([
        'user_id' => $message->sender,
        'timestamp' => $message->created_at,
      ]);
    });

    $sortedUsersInContact = $unsortedUsersInContact->sortByDesc('timestamp')->pluck('user_id')->unique();

    foreach (auth()->user()->unreadNotifications()->where('action', 'message')->get() as $notification) {
      $notification->update([
        'read_at' => now()
      ]);
    }
    return view('livewire.message-index', compact('sortedUsersInContact'));
  }
}
