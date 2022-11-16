<?php

namespace App\Http\Controllers\User;

use App\Models\Like;
use App\Models\Comment;
use App\Models\Post;
use App\Models\LikeNotify;
use App\Models\User;
use App\Models\FriendRequest;
use App\Models\CounterNotify;
use App\Models\NotifyYourComment;
use App\Traits\Helpers;
use App\Http\Requests\ValidIcon;
use App\Events\SocialNotify;
use App\Events\LikeNotifyEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;

class ContentController extends Controller
{
    use Helpers;
    public function store_post(Request $request){
        try{
            if(isset( $request) && !empty($request)){
                $request->validate([
                     'post'=>'required|string',
                     'user_id'=>'required|exists:users,id',
                     'image'=>'sometimes|nullable|mimes:png,jpg,jpeg'
                ]);

                  if($request->has('image') && $request->image != null){
                     $image=$this->filter_image($request->image,'user/posts/images');
                     $post=$request->except('image');
                     $post['image']=$image;
                      Post::create( $post);
                      return back()->with('success','Your post has been added');
                  }
                   Post::create($request->all());
                   return back()->with('success','Your post has been added');
            }
        }catch(\Exception $ex){
            return $ex;
            return back()->with('error','Your post has not been added');
        }
    }

    public function store_comment(ValidIcon $request){

         try{
            DB::beginTransaction();
            if(isset($request) && !empty($request)){
              $user=User::find($request->user_id);
              $this->users_notify($request->post_id,$request->user_id);
              $users_notify_id=array_values($this->users_notify($request->post_id,$request->user_id));
              $comment=Comment::create($request->all());

              $data=[
                 'post_id'=>$comment->post_id,
                 'user_id'=>$comment->user_id,
                 'comment'=>$comment->comment,
                 'image'=>$user->profile_image,
                 'user_name'=>$user->name,
                 'users_notify_id'=>$users_notify_id,
              ];
               DB::commit();
               broadcast(new SocialNotify($data));
               return response()->json([
                'status'=>true,
                'msg'=>'success',
                'comment'=>$request->comment,
                'user_name'=>User::find($request->user_id)->name,
                'user_image'=>asset('user/images/'.User::find($request->user_id)->image),
               ]);

            }
         }catch(\Exception $ex){
             DB::rollback();
             return $ex;
             return response()->json([
                'status'=>false,
                'msg'=>'Error',
           ]);
         }

    }

    public function store_like(Request $request){
        try{
          DB::beginTransaction();
            $like_icon=Like::where('user_id',$request->user_id)->where('post_id',$request->post_id)->first();
            $likes_number=Post::where('id',$request->post_id)->first()->likes->count();

            if(isset($like_icon) && $like_icon != null){
                $like_icon->delete();
                DB::commit();
                return response()->json([
                    'status'=>true,
                    'msg'=>'success',
                    'like'=>0,
                    'likes_number'=>$likes_number
                ]);
            }else{
               $like=Like::create($request->all());
               $user=User::find($request->user_id);
               $post_owner_id=Post::find($request->post_id)->user->id;
                $data=[
                    'post_id'=>$like->post_id,
                    'user_id'=>$like->user_id,
                    'image'=>$user->profile_image,
                    'user_name'=>$user->name,
                    'post_owner_id'=>$post_owner_id,
                ];
                broadcast(new LikeNotifyEvent($data));
            }
            DB::commit();
                return response()->json([
                    'status'=>true,
                    'msg'=>'success',
                    'like'=>1,
                    'likes_number'=>$likes_number
                ]);
        }catch(\Exception $ex){
            DB::rollback();
            return $ex;
        }
    }

    public function hide_counter_notify(Request $request){
        try{
            $our_posts=Post::whereHas('likes')->where('user_id',$request->id)->get();
            $all_posts=Post::whereHas('comments')->get();
            $friends_request_notifies=FriendRequest::where('to_user_id',Auth::id())->where('seen',0)->get();
            if(isset($our_posts) && $our_posts->count() > 0){
                $notify_number=0;
                foreach ($our_posts as $post){
                    CounterNotify::where('post_id',$post->id)->delete();
                }
            }
            foreach ($all_posts as $post){
                if($post->comments->where('user_id',Auth::id())->first()){
                   NotifyYourComment::where('post_id',$post->id)->where('user_id','!=',Auth::id())->update(['seen'=>true]);
                }
            }
            foreach ($friends_request_notifies as $request){
               $request->update(['seen'=>1]);
            }
            return get_response(true,'success');

        }catch(\Exception $ex){
            return $ex;
            return get_response(false,'error');
        }
    }
    public function users_notify($post_id,$user_id){
         $comments=Post::find($post_id)->comments;
         $post_user_id=Post::find($post_id)->user_id;
         if(isset($comments)  && $comments->count() > 0){
            foreach($comments as $comment){
                if($comment->user_id != Auth::id()){
                    $users_id[]=$comment->user->id;
                }
            }
            if(isset($users_id) && count($users_id) > 0){
                if($post_user_id != $user_id){
                    array_push($users_id,$post_user_id);
                    return array_unique($users_id);
                }
                    return array_unique($users_id);
            }
         }
            return  $post_user_id == $user_id?[]:[$post_user_id];
    }
}
