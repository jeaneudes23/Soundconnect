
<?php

namespace App\Http\Livewire\Post;

use App\Models\Post;
use Livewire\Component;
use App\Models\NewNotification;
use App\Models\Notification;
use App\Models\OldNotification;

class ShowPost extends Component
{
  public $post;
  public $likes;
  public $likedByUser;

  public function mount($post)
  {
    $this->post = $post;

    $this->likes = $this->post->likedByUsers->count();
    $this->likedByUser = auth()->user()
      ->likedPosts->contains($this->post);
  }

  public function render()
  {
    return view('livewire.post.show-post');
  }
  public function likePost()
  {
    auth()->user()->likedPosts()->toggle($this->post);
    $this->likedByUser = !$this->likedByUser;
    $this->likedByUser ? $this->likes++ : $this->likes--;
    if (auth()->user()->id != $this->post->user->id) {
      if (auth()->user()->likedPosts->contains($this->post)) {
        Notification::create([
          'user_from' => auth()->user()->id,
          'user_to' => $this->post->user->id,
          'action' => 'like',
          'post_id' => $this->post->id,
        ]);
      }
    }
  }
}
