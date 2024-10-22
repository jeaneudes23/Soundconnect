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
        return view('livewire.explore-users', compact('users'));
    }
    
    public function changequery($text)
    {
        $this->search = $text;
    }
}
