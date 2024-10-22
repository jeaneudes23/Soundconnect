<?php

namespace App\Http\Livewire\Profile;

use App\Models\Post;
use App\Models\User;
use App\Models\Profile;
use Livewire\Component;
use App\Models\NewNotification;
use App\Models\Notification;
use App\Models\OldNotification;
use Illuminate\Support\Facades\Auth;

class ProfileShow extends Component
{
    
    public $username;
    public $profile;
    public $user;

    public $start;
    public $end;
    public $sortBy = 'created_at';
    public $timeRange = '';
    public $orderBy = 'desc';
    public $postType = null;

    public function mount($username)
    {
        $this->username = $username;
        $this->user = User::where('username', $this->username)->first();
        if (!$this->user)
        {
            abort('404');
        }
        $this->profile = $this->user->profile;
   
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

            Auth::user()->following->contains($this->profile) ? $following = true : $following = false;
            $this->user->following->contains(auth()->user()->profile) ? $follows = true : $follows = false;
            
            $posts = Post::where('user_id',$this->profile->user->id)
            ->when($this->postType, function($query){
                $query->where('type', $this->postType);
            })
            ->withCount('comments')
            ->withCount('likedByUsers')
            ->whereBetween('created_at', [$this->start, $this->end])
            ->orderBy($this->sortBy, $this->orderBy)
            ->get();
            
            return view('livewire.profile.profile-show', compact('posts','following','follows'));
    }
    public function followUnfollow()
    {
        // dd($this->profile->username,Auth::user()->profile->username);
        auth()->user()->following()->toggle($this->profile);
        if(auth()->user()->following->contains($this->profile))
        {
            Notification::create([
                'user_from' => auth()->user()->id,
                'user_to' =>$this->user->id,
                'action' => 'follow'
            ]);
        };
    }
}
