<?php

namespace App\Observers;

use App\Models\Comment;
use App\Models\Notify;
use App\Models\Notific;
use App\Models\CounterNotify;
use App\Models\NotifyYourComment;

class CommentObserver
{
    /**
     * Handle the Icon "created" event.
     *
     * @param  \App\Models\Icon  $icon
     * @return void
     */
    public function created(Comment $comment)
    {
     // $notify= Notify::where('icon_id',$comment)->first();

            // Notify::create([
            //     'post_id'=>$comment->post_id,
            //     'user_id'=>$comment->user_id,
            //     'icon_id'=>$comment->id,
            //     'type'=>'comment',
            // ]);

            Notific::create([
                'type'=>'comment',
                'icon_id'=>$like->id,
            ]);

            $counter=CounterNotify::where('post_id',$comment->post_id)->where('icon','comment')->first();
            if(isset($counter) && $counter != null){
                $counter->update([
                    'counter'=>$counter->counter + 1
                ]);
            }else{
                 CounterNotify::create([
                     'post_id'=>$comment->post_id,
                     'icon'=>'comment',
                     'counter'=> 1
                 ]);
            }

            $comment_counter=NotifyYourComment::where('user_id',$comment->user_id)->where('post_id',$comment->post_id)->where('icon','comment')->first();
            if(isset($comment_counter) && $comment_counter != null){
                $comment_counter->update([
                    'counter'=>$comment_counter->counter + 1,
                    'seen'=>false
                ]);
            }else{
                NotifyYourComment::create([
                     'post_id'=>$comment->post_id,
                     'user_id'=>$comment->user_id,
                     'icon'=>'comment',
                     'counter'=> 1,
                     'seen'=>false
                 ]);
            }

    }

    /**
     * Handle the Icon "updated" event.
     *
     * @param  \App\Models\Comment  $icon
     * @return void
     */
    public function updated(Comment $comment)
    {
        //
    }

    /**
     * Handle the Icon "deleted" event.
     *
     * @param  \App\Models\Comment  $icon
     * @return void
     */
    public function deleted(Icon $icon)
    {
        //
    }

    /**
     * Handle the Icon "restored" event.
     *
     * @param  \App\Models\Icon  $icon
     * @return void
     */
    public function restored(Comment $comment)
    {
        //
    }

    /**
     * Handle the Icon "force deleted" event.
     *
     * @param  \App\Models\Comment  $icon
     * @return void
     */
    public function forceDeleted(Comment $comment)
    {
        //
    }
}
