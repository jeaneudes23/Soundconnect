<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Profile;
use App\Models\Community;
use Filament\Models\Contracts\FilamentUser;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements FilamentUser
{

    public function canAccessFilament(): bool
    {   
        return $this->role == "admin";
    }
    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->whereHas('profile', function($query) use ($term)
        {
            $query->where('name','like',$term)
            ->orWhere('tags','like', $term)
            ->orWhere('username','like', $term);
        });
    }
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function boot()
    {
        parent::boot();

        static::created(function ($user){
            $user->profile()->create([
                'bio' => $user->name,
            ]);
        });  
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    public function following()
    {
        return $this->belongsToMany(Profile::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function communities()
    {
        return $this->belongsToMany(Community::class);
    }
    public function ownedCommunities()
    {
        return $this->hasMany(Community::class);
    }
    public function likedPosts()
    {
        return $this->belongsToMany(Post::class, 'users_posts' );
    }
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }
    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_to');
    }
    public function unreadNotifications()
    {
        return $this->notifications()->whereNull('read_at');
    }

}
