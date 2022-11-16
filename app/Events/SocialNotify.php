<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SocialNotify implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $comment;
    public $user_id;
    public $post_id;
    public $image;
    public $user_name;
    public $users_notify_id;
    public function __construct($data)
    {

        $this->user_id=$data['user_id'];
        $this->comment=$data['comment'];
        $this->post_id=$data['post_id'];
        $this->image=$data['image'];
        $this->user_name=$data['user_name'];
        $this->users_notify_id=$data['users_notify_id'];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
      return ['mf-social-notify'];
    }
}
