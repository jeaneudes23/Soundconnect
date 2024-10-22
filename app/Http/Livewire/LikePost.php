<?php

namespace App\Http\Livewire;

use App\Models\Notification;
use App\Models\Post;
use App\Models\User;
use Livewire\Component;

class LikePost extends Component
{
  public $post;
  public $likes;
  public $liked;

  public function mount($post)
  {
    $this->post = $post;
    $this->likes = $post->likedByUsers->count();
    $this->liked = $post->likedByUsers->contains(auth()->user());
  }

  public function likePost()
  {
    /** @var User $user */
    $user = auth()->user();
    $result = $this->post->likedByUsers()->toggle($user);
    if (filled($result['detached'])) {
      $this->likes--;
    }
    if (filled($result['attached'])) {
      $this->likes++;
      if ($user->id !== $this->post->user->id) {
        Notification::create([
          'user_from' => $user->id,
          'user_to'   => $this->post->user->id,
          'action'    => 'like',
          'post_id'   => $this->post->id,
        ]);
      }
    }
    $this->liked = !$this->liked;
  }

  public function render()
  {
    return view('livewire.like-post');
  }
}
