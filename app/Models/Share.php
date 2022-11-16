<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Observers\ShareObserver;

class Share extends Model
{
    use HasFactory;

    protected $table='shares';


    public static function boot(){
        parent::boot();
        Share::observe(ShareObserver::class);
    }
}
