<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class EditPost extends Component implements HasForms
{
    use InteractsWithForms;
    public $post;

    public function mount($post_id)
    {
        $this->post = Post::findOrFail($post_id);
    }
    public function render()
    {
        return view('livewire.edit-post');
    }
}
