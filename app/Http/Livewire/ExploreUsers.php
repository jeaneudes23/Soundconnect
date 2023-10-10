<?php

namespace App\Http\Livewire;

use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use Livewire\Component;

class ExploreUsers extends Component
{
   public $search;
    public function render()
    {
        $users = User::withCount('posts')->orderByDesc('posts_count')->search(trim($this->search))->get();
        $tags = Tag::where('type','user')->get()->unique('text');
        return view('livewire.explore-users', compact('users','tags'));
    }
    
    public function changequery($text)
    {
        $this->search = $text;
    }
}
