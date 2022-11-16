<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FriendRequest extends Model
{
    use HasFactory;

    protected $table='friend_requests';
    protected $fillable=['user_id','to_user_id','seen'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
