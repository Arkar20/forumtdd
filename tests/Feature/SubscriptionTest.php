<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Thread;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SubscriptionTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *@test
     * @return void
     */
    public function thread_can_subscribe()
    {
        $this->signIn();
        $thread = create(Thread::class);

        //the thread subscribed by the auth user
        $thread->subscribe($user = 1);
        //see that the data in thread_subscription table
        $this->assertEquals(
            1,
            $thread
                ->subscriptions()
                ->where('user_id', $user)
                ->count()
        );
    }
    /** @test */
    public function thread_can_unsubscribe()
    {
        $this->signIn();
        $thread = create(Thread::class);
        $thread->subscribe($user = 1);
        $this->assertEquals(
            1,
            $thread
                ->subscriptions()
                ->where('user_id', $user)
                ->count()
        );
        //the thread subscribed by the auth user
        $thread->unsubscribe($user = 1);
        //see that the data in thread_subscription table
        $this->assertEquals(
            0,
            $thread
                ->subscriptions()
                ->where('user_id', $user)
                ->count()
        );
    }
    /** @test */

    public function user_can_subscribe_thread()
    {
        $this->signIn();
        $thread = create(Thread::class);

        $this->post($thread->path() . '/subscriptions');

        $this->assertCount(1, $thread->subscriptions);
    }
}
