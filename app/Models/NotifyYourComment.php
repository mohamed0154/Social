<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotifyYourComment extends Model
{
    use HasFactory;

    protected $table='notify_your_comments';
    protected $fillable=['post_id','user_id','icon','counter','seen'];
}
