<?php

namespace App\Models;

use App\Models\LikeNotify;
use App\Observers\LikeObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $table='likes';
    protected $fillable=['user_id','post_id'];

    public static function boot(){
        parent::boot();
        Like::observe(LikeObserver::class);
    }

    // public function likes(){
    //     return $this->hasOne(LikeNotify::class,'icon_id');
    // }

}
