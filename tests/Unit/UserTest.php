<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Reply;
use App\Models\Thread;
use App\Inspections\Span;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    public function it_has_lastReply()
    {
        $user = create(User::class);
        $reply = create(Reply::class, [
            'user_id' => $user->id,
        ]);

        $this->assertEquals($reply->id, $user->lastReply->id);
    }
    /** @test */
    public function it_has_uploadtimewithin_1_minute()
    {
        $this->signIn();
        $thread = create(Thread::class);
        $reply = make(Reply::class, ['user_id' => auth()->id()]);
        $this->post(
            $thread->path() . '/replies',
            $reply->toArray()
        )->assertStatus(200);

        // dd(auth()->user()->replies);
        // $this->assertCount(1, $user->replies);
    }
}
