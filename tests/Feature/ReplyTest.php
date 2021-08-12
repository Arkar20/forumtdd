<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Reply;
use App\Models\Thread;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReplyTest extends TestCase
{
    use DatabaseMigrations;
    /**
     *
     * A basic feature test example.
     * @test
     * @return void
     */
    public $thread;
    public $reply;

    function setUp(): void
    {
        parent::setUp();
        $this->signIn();
        $this->thread = create(Thread::class);
        $this->reply = create(Reply::class, ['thread_id' => $this->thread->id]);
    }
    public function user_can_view_comments()
    {
        $this->get($this->thread->path())->assertSee($this->reply->body);
    }
    /**  @test*/
    public function unauthenticated_user_cannot_reply()
    {
        $reply = make(Reply::class);
        Auth::logout();
        $this->post(
            $this->thread->path() . '/replies',
            $reply->toArray()
        )->assertRedirect('/login');
    }
    public function test_authenticated_user_can_reply_thread()
    {
        $reply = make(Reply::class);

        $this->post($this->thread->path() . '/replies', $reply->toArray());
        $this->assertDatabaseHas('replies', ['body' => $reply->body]);
        $reply->thread()->increment('replies_count');

        $this->assertEquals(2, $reply->thread->replies_count);
    }
    /** @test */
    public function reply_that_contains_the_span_does_not_create()
    {
        $reply = make(Reply::class, [
            'body' => 'nnn',
        ]);

        $this->post($this->thread->path() . '/replies', $reply->toArray());
    }
    public function it_cannot_reply_frequently()
    {
        $reply = make(Reply::class);
        $this->post(
            $this->thread->path() . '/replies',
            $reply->toArray()
        )->assertStatus(200);

        $this->post(
            $this->thread->path() . '/replies',
            $reply->toArray()
        )->assertStatus(422);
    }
}
