<?php

namespace App\Http\Controllers\User;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Traits\Helpers;
use App\Http\Requests\ValidProfile;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class ProfileController extends Controller
{
    use Helpers;
    public function profile($user_id){
        $user=User::find($user_id);
        $posts_profile=Post::posts()->where('user_id',$user_id)->get();
        return view('user.profile.profile',compact('posts_profile','user'));
    }


    public function change_profile(ValidProfile $request){
        if(isset($request) && !empty($request)){
            $user=User::find($request->user_id);
            if($request->has('profile_image')){
                $image=$this->filter_image($request->profile_image,'user/images');
                $prof_img['profile_image']=$image;
                if(isset($user) && $user != null){
                    $user->update($prof_img);
                }
            }else{
                $profile_background=$this->filter_image($request->profile_background,'user/images');
                $prof_background['profile_background']=$profile_background;
                if(isset($user) && $user != null){
                    $user->update($prof_background);
                }
            }
            return back();
        }
    }
}
