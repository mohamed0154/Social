<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
   public function logout(){
       $user=Auth::user();
         if(isset($user) && $user != null){
             Auth::user()->update(['status'=>0]);
             Auth::logout( $user);
             return redirect(route('login'));
         }
         return back();
   }
}
