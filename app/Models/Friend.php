<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Friend extends Model
{
    use HasFactory;

    protected $table='friends';
    protected $fillable=['user_id','friend_id'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
