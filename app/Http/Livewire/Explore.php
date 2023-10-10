<?php

namespace App\Http\Livewire;

use App\Models\Community;
use App\Models\Post;
use App\Models\User;
use Livewire\Component;

class Explore extends Component
{
    public function render()
    {
        $posts = Post::withCount('comments')->orderByDesc('comments_count')->take(5)->get();
        $users = User::withCount('posts')->orderByDesc('posts_count')->take(5)->get();
        $communities = Community::withCount('posts')->orderByDesc('posts_count')->take(5)->get();
        return view('livewire.explore', compact("users","posts","communities"));
    }
}
