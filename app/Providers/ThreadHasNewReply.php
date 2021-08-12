<?php

namespace App\Providers;

use Illuminate\Queue\SerializesModels;

class ThreadHasNewReply
{
    use SerializesModels;

    public $thread;
    public $reply;
    public function __construct($thread, $reply)
    {
        $this->thread = $thread;
        $this->reply = $reply;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     */
}
