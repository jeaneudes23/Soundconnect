<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Message;
use Livewire\Component;
use Filament\Forms\Components\Hidden;
use App\Models\NewMessageNotification;
use App\Models\Notification;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Concerns\InteractsWithForms;

class MessageShow extends Component implements HasForms
{
    use InteractsWithForms;

    public $username;
    public $content;
    public $receiver_id;
    public $sender_id;
    public $receiver;
    public $sender;
    public $count;

    public function mount($username)
    {
        $this->count = 10;
        $this->sender = auth()->user();
        $this->sender_id = $this->sender->id;
        $this->username = $username;
        $this->receiver = User::where('username', $this->username)->first();
        $this->receiver_id = $this->receiver->id;
    }

    protected function getFormSchema(): array
    {
        return ([
            Hidden::make('sender_id'),
            Hidden::make('receiver_id'),
            RichEditor::make('content')
            ->required()

        ]);
    }
    public function render()
    {
        $sentMessages = $this->sender->sentMessages()
        ->where('receiver_id', $this->receiver_id)
        ->get();
        $receivedMessages = $this->sender->receivedMessages()
        ->where('sender_id', $this->receiver_id)
        ->get();

        $messages =  $receivedMessages->concat($sentMessages)->sortBy('created_at');
        return view('livewire.message-show', compact('messages'));
    }
    public function submit()
    {
        Notification::create([
            "user_from" => auth()->user()->id,
            "user_to" => $this->receiver_id,
            'action' => 'message'
        ]);
       
        Message::create($this->form->getState());
        $this->content = '';
    }
}
