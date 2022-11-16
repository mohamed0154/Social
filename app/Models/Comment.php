<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\User;
use App\Observers\CommentObserver;

class Comment extends Model
{
    use HasFactory;

    protected $fillable=['id','user_id','post_id','comment'];
    protected $table='comments';

    public static function boot(){
       parent::boot();
       Comment::observe(CommentObserver::class);
    }

    public function scopecomments($q){
        return $q->select('id','user_id','post_id','comment');
    }

    public function get_comment($comment,$id){
        if($comment->post_id == $id){
            return $comment;
        }
    }

    public function post(){
        return $this->belongsTo(Post::class,'post_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
