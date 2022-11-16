<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use App\Models\User;
use App\Models\Comment;
use App\Models\LikeNotify;

class Post extends Model
{
    use HasFactory , Searchable;

    protected $fillable=['id','post','user_id','image'];

    public function scopeposts($q){
        $q->select('id','post','user_id','image','created_at');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function comments(){
        return $this->hasMany(Comment::class,'post_id');
    }

    public function likes(){
        return $this->hasMany(LikeNotify::class,'post_id');
    }
}
