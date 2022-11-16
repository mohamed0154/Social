<?php

namespace App\Http\Controllers;

use App\Events\SocialNotify;
use Illuminate\Http\Request;

class notttif extends Controller
{
    public function notif(Request $request){
        $message=$request->message;
      broadcast(new SocialNotify($message));
      return get_response(true,'success');
    }
}
