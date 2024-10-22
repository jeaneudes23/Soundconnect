<?php

namespace App\Http\Livewire;

use App\Models\Tag;
use Livewire\Component;
use App\Models\Community;

class ExploreCommunities extends Component
{
    public $search;
    public function render()
    {
        $communities = Community::withCount('posts')->orderByDesc('posts_count')->search(trim($this->search))->get();
        return view('livewire.explore-communities', compact('communities'));
    }
}
