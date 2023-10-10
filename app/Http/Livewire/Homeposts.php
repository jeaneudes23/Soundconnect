<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use App\Models\Community;

class Homeposts extends Component
{
    public $value = 0;
    public function increment()
    {
        $this->value++;
    }
    public function render()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');
        $communities = auth()->user()->communities()->pluck('community_id');
       
        $posts = Post::whereIn('user_id', $users)
                    ->orWhereIn('community_id',$communities)
                    ->with('user')->latest()->take(5)->get();
        return view('livewire.home-posts',['posts'=>$posts, 'communities' => Community::all()])
        ;
    }
}
