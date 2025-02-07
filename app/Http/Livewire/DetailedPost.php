<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;

class DetailedPost extends Component implements HasForms
{
    use InteractsWithForms;

    public $comment;

    public $post;
    public function mount($id)
    {
        $this->post = Post::findOrFail($id);
    }
    protected function getFormSchema()
    {
        return [
            Textarea::make('comment')
                ->label("Comment")
                ->placeholder("write your comment here")
                ->required()
                ->rules(['string','max: 255']),
        ];
    }
    public function submit()
    {
        Comment::create([
            'user_id' => Auth::user()->id,
            'post_id' => $this->post->id,
            'comment' => $this->comment,
        ]);
        if (auth()->user()->id != $this->post->user->id)
        {


            Notification::create([
              'user_from' => auth()->user()->id,
              'user_to' => $this->post->user->id,
              'action' => 'comment',
              'post_id' => $this->post->id,
            ]);
        }
        
    }
    public function render()
    {
        $comments = Comment::where('post_id',$this->post->id)->get();
        return view('livewire.detailed-post',compact('comments'));
    }
}
