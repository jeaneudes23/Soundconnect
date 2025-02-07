<?php

namespace App\Models;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Community extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function($query) use ($term)
        {
            $query->where('name','like',$term)
            ->orWhere('handle_name','like', $term)
            ->orWhere('bio','like', $term)
            ->orWhere('tags','like', $term);
        });
    }
    public static function boot(){
        parent::boot();
        static::created(function ($community)
        {
            $community->members()->attach(auth()->user());
        });
    }
    public function headerImage()
    {
        return $this->header_image ? 'storage/'.$this->header_image : '';
    }
    public function coverImage()
    {
        return $this->cover_image ?  'storage/'.$this->cover_image : '';
    }
    public function members()
    {
        return $this->belongsToMany(User::class);
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
