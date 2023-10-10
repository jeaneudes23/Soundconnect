<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use App\Models\Community;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class ShowCommunity extends Component
{
    use WithPagination;
    public $handle_name;
    public $community;

    public $start;
    public $end;
    public $sortBy = 'created_at';
    public $timeRange = '';
    public $orderBy = 'desc';
    public $postType = null;
 
    public function mount($handle_name)
    {
        
        $this->handle_name = $handle_name;
        $this->community = Community::where('handle_name',$this->handle_name)->first();
    }
    public function joinLeave()
    {
        auth()->user()->communities()->toggle($this->community);
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
        auth()->user()->communities->contains($this->community) ? $joined = true : $joined =false;
        $posts = Post::where('community_id',$this->community->id)
        ->when($this->postType, function($query){
            $query->where('type', $this->postType);
        })
        ->withCount('comments')
        ->withCount('likedByUsers')
        ->whereBetween('created_at', [$this->start, $this->end])
        ->orderBy($this->sortBy, $this->orderBy)
        ->get();

        return view('livewire.show-community',['posts' => $posts,'joined'=>$joined])
        ;
    }
}
