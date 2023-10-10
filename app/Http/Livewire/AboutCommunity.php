<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Community;

class AboutCommunity extends Component
{
    public $handle_name;
    public $community;
    public $perPage = 2;


    public function mount($handle_name)
    {
        
        $this->handle_name = $handle_name;
        $this->community = Community::where('handle_name',$this->handle_name)->first();
    }
    public function loadMore()
    {
        
        $this->perPage++;
    }
    public function joinLeave()
    {
        auth()->user()->communities()->toggle($this->community);
    }
    public function render()
    {
        auth()->user()->communities->contains($this->community) ? $joined = true : $joined =false;
        return view('livewire.about-community', compact('joined'));
    }
}
