<?php

namespace App\Models;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Community;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->whereHas('user', function($query) use ($term)
        {
            $query->where('caption','like',$term)
            ->orWhere('username','like',$term)
            ->orWhere('name','like',$term)
            ->orWhere('tags','like',$term)
            ->orWhere('bpm','like',$term);
        });
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function community()
    {
        return $this->belongsTo(Community::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'users_posts');
    }
    public function reports()
    {
        return $this->hasMany(Report::class,'post_id');
    }
}
