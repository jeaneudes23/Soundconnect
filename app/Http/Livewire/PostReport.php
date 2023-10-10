<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Report;
use Livewire\Component;
use App\Models\NewNotification;
use App\Models\OldNotification;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Concerns\InteractsWithForms;

class PostReport extends Component implements HasForms
{
    public $user_id;
    public $post_id;
    public  $post;
    public  $report_reason;

    use InteractsWithForms;
    public function mount($post_id)
    {
        $this->post = Post::findOrFail($post_id);

        $this->form->fill([
            'post_id' => $this->post->id,
            'user_id' => auth()->user()->id,
        ]);
        
    }
    public function getFormSchema()
    {
        return([
            Hidden::make('post_id'),
            Hidden::make('user_id'),
            RichEditor::make('report_reason')->hint('Why do you wish to report this post')->required(),
            
        ]);
    }
    public function submit()
    {
        Report::create($this->form->getState());
        NewNotification::create([
            'user_from' => auth()->user()->id,
            'user_to' =>$this->post->user->id,
            'action' => 'report',
            'post_id' => $this->post->id,
        ]);
        OldNotification::create([
            'user_from' => auth()->user()->id,
            'user_to' =>$this->post->user->id,
            'action' => 'report',
            'post_id' => $this->post->id,
        ]);
        return redirect()->route('home')->with('message', 'Report Sent');
    }
    public function render()
    {
        return view('livewire.post-report');
    }
}
