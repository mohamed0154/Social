<?php
namespace App\Traits;

use Auth;
use App\Models\Post;
use App\Models\User;
use App\Models\Icon;
use App\Models\LikeNotify;
use App\Models\Comment;
use App\Models\FriendRequest;
use App\Models\NotifyYourComment;
use App\Models\CounterNotify;

trait Helpers{

    public function filter_image($photo,$path){
         $extenction=$photo->getClientOriginalExtension();
         $image=uniqid() . '.' . $extenction;
         $photo->move($path,$image);
         return $image;
    }

    public function home_content(){

           $this->active();
           $friends=Auth::user()->friends;
           $posts=$this->posts($friends);
           $all_likes_posts=Post::whereHas('likes')->where('user_id',Auth::id())->get();
           $all_posts=Post::whereHas('comments')->get();
           $friend_requests=FriendRequest::where('to_user_id',Auth::id())->get();
           $friend_requests_counter=FriendRequest::where('to_user_id',Auth::id())->where('seen',0)->count();

        ////////////comment Notifies/////////
           $counter_comment_notify=0;
           $comments=[];
           foreach ($all_posts as $post){
               if($post->comments->where('user_id',Auth::id())->first() || $post->user_id==Auth::id()){
                   foreach($post->comments->where('user_id','!=',Auth::id()) as $com){
                       $comments[]=$com;
                   }
                   $not_seen=NotifyYourComment::where('post_id',$post->id)->where('user_id','!=',Auth::id())->where('seen',false)->get();
               }
               if(NotifyYourComment::where('post_id',$post->id)->where('user_id',Auth::id())->first() && $not_seen->count() > 0){
                   $counter_comment_notify+=array_sum(NotifyYourComment::where('post_id',$post->id)->where('user_id','!=',Auth::id())->pluck('counter')->toArray());
               }
          }
               ///////////////////////////////////
           ///////////Your Post notifies////////////
           if(isset($all_likes_posts) && $all_likes_posts->count() >0){
               $notify_number=0;
               foreach ($all_likes_posts as $post){
                   foreach($post->likes as $like){
                       $likes[]=$like;
                   }
                   $notify_number+=array_sum(CounterNotify::where('post_id',$post->id)->pluck('counter')->toArray());
               }
                  $notify_number+=$counter_comment_notify+$friend_requests_counter;
                  return view('home',compact('posts','likes','all_likes_posts','friend_requests','notify_number','comments'));
           }
                  return view('home',compact('posts','counter_comment_notify','comments','friend_requests','friend_requests_counter'));
    }

    function active(){
        User::where('id',Auth::id())->first()->update(['status'=>1]);
    }
    public function posts($friends){

        foreach($friends as $friend){
            foreach(User::find($friend->friend_id)->posts as $post){
                $posts[]=$post;
            }
        }
        if(isset($posts)  && count($posts) > 0){
          return $posts;
        }
       return [];
    }
}
