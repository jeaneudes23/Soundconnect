<?php

namespace App\Http\Livewire;

use App\Models\Tag;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class ExplorePosts extends Component
{
    use WithPagination;
    public $sortBy = 'comments_count';
    public $genre = null;
    public $orderBy = 'desc';
    public $postType = null;
    public $search;
    public $count=10;
    public function render()
    {

        $posts =Post::when($this->postType, function($query){
            $query->where('type', $this->postType);
        })
        ->when($this->genre, function($query){
            $query->where('genre', $this->genre);
        })
        ->search(trim($this->search))
        ->withCount('comments')
        ->withCount('likedByUsers')
        ->orderBy($this->sortBy, $this->orderBy)
        ->take($this->count)
        ->get();
        $tags = Tag::where('type','post')->get()->unique('text');
        return view('livewire.explore-posts', compact('posts','tags'));
    }
    public function showMore()
    {
        $this->count+=10;
    }
    public function changequery($text)
    {
        $this->search = $text;
    }
}
