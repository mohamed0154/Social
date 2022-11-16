<?php

namespace App\Http\Controllers\User\Messages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use Auth;

class MessagesController extends Controller
{
    public function message_user(Request $request){
        try{
            if(isset($request) && !empty($request)){
                $user=User::find($request->user_id);
               // return $user->id;
                if(isset($user) && $user != null){
                    $mess_body=view('user/messages/user_messages',compact('user'))->rendersections();
                    return response()->json([
                        'status'=>true,
                        'body'=>$mess_body['all_messages'],
                    ]);
                }
            }
        }catch(\Exception $ex){
            return $ex;
            return get_response(false,'Error');
        }
    }

    public function send_messages(Request $request){
         try{

            if($request->has('message') && !empty($request)){
                $request->validate([
                    'message'=>'required',
                ]);
                $request->merge(['user_id'=>Auth::id()]);
                Message::create($request->all());
                return get_response(true,Auth::user()->profile_image);
            }

         }catch(\Exception $ex){
            return get_response(fasel,'error');
         }
    }
}
