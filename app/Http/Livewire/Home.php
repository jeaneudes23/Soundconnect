<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use App\Models\Community;
use Livewire\WithPagination;

class Home extends Component
{
    use WithPagination;
    public $start;
    public $end;
    public $sortBy = 'created_at';
    public $timeRange = '';
    public $orderBy = 'desc';
    public $postType = null;
    public $count=10;
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
        
        $users = auth()->user()->following()->pluck('profiles.user_id');
        $users->push(auth()->user()->id);
        $communities = auth()->user()->communities()->pluck('community_id');
        $totalPosts = Post::whereIn('user_id', $users)
        ->orWhereIn('community_id', $communities)->get();

        $unsortedPosts = Post::whereIn('user_id', $users)
            ->orWhereIn('community_id', $communities)
            ->withCount('comments')
            ->withCount('likedByUsers')
            ->orderBy($this->sortBy, $this->orderBy)
            ->take($this->count)
            ->get();
        $max = count($totalPosts);
        $timedPosts = $unsortedPosts->whereBetween('created_at', [$this->start, $this->end]);
        if($this->postType)
        {
            $posts = $timedPosts->where('type', $this->postType);
        }
        else{
            $posts = $timedPosts;   
        }
        
        return view('livewire.home', compact('posts','max'));
    }
    public function showMore()
    {
        $this->count+=10;
    }
}
