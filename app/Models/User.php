<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * 
     * @TODO Add attributes for username, first name, last name
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['profileLink'];

    public function getUserId() {
        return $this->id;
    }

    public function getProfileLinkAttribute() {
        return route('user.show', $this);
    }

    public function posts() {
        return $this->hasMany(Post::class);
    }

    // Following validations for users
    public function following() {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id');
    }

    public function isNot($user) {
        return $this->id !== $user->id;
    }

    public function isFollowing($user) {
        return (bool) $this->following->where('id', $user->id)->count();
    }

    public function canFollow($user) {
        if(!$this->isNot($user)) {
            return false;
        }
        
        return !$this->isFollowing($user);
    }

    public function canUnFollow($user) {
        return $this->isFollowing($user);
    }
}
