<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Community;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ManageMembers extends Component
{
    use AuthorizesRequests;
    public $handle_name;
    public $community;
    public $search;
    public function mount($handle_name)
    {
        
        $this->handle_name = $handle_name;
        $this->community = Community::where('handle_name',$this->handle_name)->first();
    }
    public function render()
    {
        $this->authorize('update', $this->community);
        $community= $this->community;
        $members = User::with('communities')
               ->whereHas('communities', function ($query) use ($community) {
                   $query->where('communities.id', $community->id);
               })
               ->search(trim($this->search))
               ->get();
        return view('livewire.manage-members', compact('members'));
    }
    public function banUser($user)
    {
        
        User::find($user)->communities()->toggle($this->community);
        return redirect()->route('community.modMembers', ['handle_name' => $this->handle_name]);
    }
}
