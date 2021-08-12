<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class MetionUserTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function user_mentions_and_notify()
    {
        $this->signIn();
        $anotheruser = create(User::class, ['name' => 'JaneDoe']);
        $thread = create(Thread::class);

        $reply = make(Reply::class, [
            'user_id' => auth()->id(),
            'thread_id' => $thread->id,
            'body' => 'mention user @JaneDoe',
        ]);
        $this->post($thread->path() . '/replies', $reply->toArray());

        $this->assertCount(1, $anotheruser->notifications);
    }
}
