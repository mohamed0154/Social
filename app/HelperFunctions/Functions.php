<?php
use App\Models\User;
use App\Models\FriendRequest;
use App\Models\Friend;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

function get_response($status,$msg){

  return response()->json([
    'status'=>$status,
    'msg'=>$msg
  ]);
}


function response_content($status,$msg,$content){
    return response()->json([
      'status'=>$status,
      'msg'=>$msg,
      'content'=>$content
    ]);
}


function get_users_active(){
    $friends=Auth::user()->friends;
    foreach($friends as $friend){
        $user_acive=User::where('id',$friend->friend_id)->where('status',1)->first();
        if($user_acive != null){
           $users[]=$user_acive;
        }
    }
    if(isset( $users)){
        return  $users;
    }else{
        return [];
    }
}


function user_none_active(){
    User::where('id',Auth::id())->first();
}

function friend_status($user_id){
    if (Friend::where('user_id',$user_id)->where('friend_id',Auth::id())->first()){
       return 'Friends';
    }elseif(FriendRequest::where('user_id',Auth::id())->where('to_user_id',$user_id)->first()){
       return 'Sended';
    }else{
       return 'Add Friend';
    }
}


 function my_messages(){
    return Message::where('user_id',Auth::id())->get();
 }


 function messages_for_me(){
    return Message::where('to_user_id',Auth::id())->get();
 }
