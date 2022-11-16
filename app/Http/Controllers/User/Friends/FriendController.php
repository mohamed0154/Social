<?php

namespace App\Http\Controllers\User\Friends;

use App\Models\User;
use App\Models\FriendRequest;
use App\Models\Friend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class FriendController extends Controller
{
    public function add_friend(Request  $request){
        try{
            $user=User::find($request->to_user_id);
            $friends=FriendRequest::where('user_id',Auth::id())->where('to_user_id',$request->to_user_id)->first();

            if(isset($friends) && $friends != null){
                $friends->delete();
                return response_content(true,'success','remove');
            }
            if(isset($user) && $user != null){
                $request->merge(['user_id'=>Auth::id()]);
                FriendRequest::create($request->all());
                return response_content(true,'success','added');
            }
        }catch(\Exception $ex){
            return $ex;
            return get_response(false,'error');
        }
    }

    public function accept_or_refuse(Request $request){
        try{
            if(isset($request) && !empty($request)){
                $friend_request=FriendRequest::find($request->id);
                 if($request->status == 'refuse' && $friend_request != null){
                    $friend_request->delete();
                 }elseif($request->status == 'accept' && $friend_request != null){
                     Friend::create([
                         'user_id'=>$friend_request->to_user_id,
                         'friend_id'=>$friend_request->user_id
                     ]);
                     Friend::create([
                        'user_id'=>$friend_request->user_id,
                        'friend_id'=>$friend_request->to_user_id
                    ]);
                     $friend_request->delete();
                 }
                 return get_response(true,'success');
            }
        }catch(\Exception $ex){
            return $ex;
            return get_response(false,'failed');
        }

    }
}
