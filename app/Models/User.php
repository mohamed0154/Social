<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Scout\Searchable;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Notify;
use App\Models\FriendRequest;
use App\Models\Friend;
class User extends Authenticatable
{
    use HasFactory, Notifiable,Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'profile_image',
        'profile_background',
        'password',
        'confirmation_password',
        'status'
    ];


    public function setpasswordAttribute($q){
        return $this->attributes['password']=bcrypt($q);
    }

    public function setCONFIRMATIONPASSWORDAttribute($q){
        return $this->attributes['confirmation_password']=bcrypt($q);
    }

    public function posts(){
        return $this->hasMany(Post::class,'user_id');
    }

    public function comments(){
        return $this->hasMany(Comment::class,'user_id');
    }

    public function notifications(){
        return $this->hasMany(Notify::class,'user_id');
    }

    public function friend_requests(){
        return $this->hasMany(FriendRequest::class,'user_id');
    }

    public function friends(){
        return $this->hasMany(Friend::class,'user_id');
    }



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
}
