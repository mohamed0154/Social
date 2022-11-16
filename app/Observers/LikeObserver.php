<?php

namespace App\Observers;

use App\Models\Like;
use App\Models\LikeNotify;
use App\Models\Notific;
use App\Models\CounterNotify;

class LikeObserver
{
    /**
     * Handle the Like "created" event.
     *
     * @param  \App\Models\Like  $like
     * @return void
     */
    public function created(Like $like)
    {
        LikeNotify::create([
            'user_id'=>$like->user_id,
            'post_id'=>$like->post_id,
            'type'=>'like',
        ]);

        Notific::create([
            'type'=>'like',
            'icon_id'=>$like->id,
        ]);

         $counter=CounterNotify::where('post_id',$like->post_id)->where('icon','like')->first();
         if(isset($counter) && $counter != null){
             $counter->update([
                 'counter'=>$counter->counter +1
             ]);
         }else{
              CounterNotify::create([
                 'post_id'=>$like->post_id,
                 'icon'=>'like',
                 'counter'=> 1
              ]);
         }
    }

    /**
     * Handle the Like "updated" event.
     *
     * @param  \App\Models\Like  $like
     * @return void
     */
    public function updated(Like $like)
    {
        //
    }

    /**
     * Handle the Like "deleted" event.
     *
     * @param  \App\Models\Like  $like
     * @return void
     */
    public function deleted(Like $like)
    {
        isset($like->likes)?$like->likes()->delete():'';
    }

    /**
     * Handle the Like "restored" event.
     *
     * @param  \App\Models\Like  $like
     * @return void
     */
    public function restored(Like $like)
    {
        //
    }

    /**
     * Handle the Like "force deleted" event.
     *
     * @param  \App\Models\Like  $like
     * @return void
     */
    public function forceDeleted(Like $like)
    {
        //
    }
}
