<?php

namespace App\Http\Controllers\User\Search;


use App\Models\User;
use App\Models\Post;
use App\Models\FriendRequest;
use App\Models\CounterNotify;
use App\Models\NotifyYourComment;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request){
        if(isset($request) && !empty($request)){
            $request->validate([
                'search'=>'required|string',
            ]);

            $our_posts=Post::whereHas('notifications')->where('user_id',Auth::id())->get();
            $all_posts=Post::whereHas('comments')->get();
            $friend_requests=FriendRequest::where('to_user_id',Auth::id())->get();
            $friend_requests_counter=FriendRequest::where('to_user_id',Auth::id())->where('seen',0)->count();
            $users=User::search($request->search)->get();
            $content=Post::search($request->search)->get();

            $counter_comment_notify=0;
            foreach ($all_posts as $post){

                if($post->comments->where('user_id',Auth::id())->first() || $post->user_id==Auth::id()){
                    foreach($post->comments->where('user_id','!=',Auth::id()) as $com){
                        $comments[]=$com;
                    }
                    $not_seen=NotifyYourComment::where('post_id',$post->id)->where('user_id','!=',Auth::id())->where('seen',false)->get();
                }else{
                    $comments=[];
                }
                if(NotifyYourComment::where('post_id',$post->id)->where('user_id',Auth::id())->first() && $not_seen->count() > 0){
                    $counter_comment_notify+=array_sum(NotifyYourComment::where('post_id',$post->id)->where('user_id','!=',Auth::id())->pluck('counter')->toArray());
                }
           }
                ///////////////////////////////////
            ///////////Your Post notifies////////////
            if(isset($our_posts) && $our_posts->count() >0){
                    return $this->our_posts_notifies(
                        $friend_requests,$comments,
                        $our_posts,$counter_comment_notify,
                        $friend_requests_counter,
                        $users,$content
                    );
            }

             return view('user.search.search_result',compact('counter_comment_notify','users','content','friend_requests','friend_requests_counter'));
        }
    }

    public function our_posts_notifies(
        $friend_requests,$comments,
        $our_posts,$counter_comment_notify,
        $friend_requests_counter,
        $users,$content){
        $notify_number=0;
        foreach ($our_posts as $post){

            foreach($post->notifications as $notif){
                $notifications[]=$notif;
            }
            $notify_number+=array_sum(CounterNotify::where('post_id',$post->id)->pluck('counter')->toArray());
        }
           $notify_number+=$counter_comment_notify+$friend_requests_counter;
           return view('user.search.search_result',compact('users','content','friend_requests','notifications','notify_number','comments'));
    }
}
