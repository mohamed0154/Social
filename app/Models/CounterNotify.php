<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CounterNotify extends Model
{
    use HasFactory;

    protected $table='counter_notifies';
    protected $fillable=['counter','post_id','icon'];
}
