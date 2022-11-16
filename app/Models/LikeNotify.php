<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\User;
use App\Models\Like;

class LikeNotify extends Model
{
    use HasFactory;

    protected $table='like_notify';
    protected $fillable=['id','user_id','post_id','type'];

    public function post(){
        return $this->belongsTo(Post::class,'post_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    // public function like(){
    //     return $this->belongsTo(Like::class,'icon_id');
    // }
}
