<?php

namespace App\Http\Livewire;

use App\Models\Tag;
use App\Models\Post;
use Livewire\Component;
use App\Models\Community;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ManagePosts extends Component
{
    use AuthorizesRequests;
    public $handle_name;
    public $community;
    public $search;
    public $start;
    public $end;
    public $sortBy = 'comments_count';
    public $timeRange = '';
    public $orderBy = 'desc';
    public $postType = null;
    public function mount($handle_name)
    {
        
        $this->handle_name = $handle_name;
        $this->community = Community::where('handle_name',$this->handle_name)->first();
    }

    public function render()
    {
        if ($this->timeRange == 'hour')
        {
            $this->end = now()->endOfHour();
            $this->start = now()->startOfHour();
        }
        elseif ($this->timeRange == 'day')
        {
            $this->end = now()->endOfDay();
            $this->start = now()->startOfDay();
        }
        elseif ($this->timeRange == 'week')
        {
            $this->end = now()->endOfWeek();
            $this->start = now()->startOfWeek();
        }
        elseif ($this->timeRange == 'month')
        {
            $this->end = now()->endOfMonth();
            $this->start = now()->startOfMonth();
        }
        else{
            $this->end = now()->endOfMillennium();
            $this->start = now()->startOfMillennium();
        }

        $this->authorize('update', $this->community);
        $community= $this->community;
        $posts =Post::where('community_id', $this->community->id)
        ->when($this->postType, function($query){
            $query->where('type', $this->postType);
        })->search(trim($this->search))
        ->withCount('comments')
        ->withCount('likedByUsers')
        ->whereBetween('created_at', [$this->start, $this->end])
        ->orderBy($this->sortBy, $this->orderBy)
        ->get();
        return view('livewire.manage-posts', compact('posts'));
    }
    public function unlink($post)
    {
        Post::find($post)->update([
            "community_id" => null
        ]);
    }
}
