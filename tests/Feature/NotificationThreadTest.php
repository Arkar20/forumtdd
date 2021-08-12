<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class NotificationThreadTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    function setUp(): void
    {
        parent::setUp();
        $this->signIn();
    }
    public function do_not_notify_to_its_own_reply()
    {
        $thread = create(Thread::class);
        $thread->subscribe();

        $thread->addReply([
            'user_id' => auth()->id(),
            'body' => 'something',
        ]);
        $this->assertCount(0, auth()->user()->notifications);

        $thread->addReply([
            'user_id' => create(User::class)->id,
            'body' => 'something 2',
        ]);
        $this->assertCount(
            1,
            auth()
                ->user()
                ->fresh()->notifications
        );
    }
    /** @test */
    public function Mark_as_read_the_notifications()
    {
        //signin
        //create the thread
        //subscribe
        $thread = create(Thread::class, ['user_id' => auth()->id()]);
        $thread->subscribe();

        //add the reply
        $thread->addReply([
            'user_id' => create(User::class)->id,
            'body' => 'something 2',
        ]);
        //give unreadnotification
        $this->assertCount(1, auth()->user()->unreadNotifications);
        //read the notification
        // dd(auth()->user()->unreadNotifications);
        $notificationid = auth()
            ->user()
            ->notifications()
            ->first()->id;

        $user = auth()->user();
        // $url = '/profile/' . $user . '/notifications/' . $notificationid;
        // $user
        //     ->unreadNotifications()
        //     ->first()
        //     ->markAsRead();
        //give notificaiton to 0
        $this->delete(
            '/profile/' . $user->name . '/notifications/' . $notificationid
        );
        $this->assertCount(
            0,
            auth()
                ->user()
                ->fresh()->unreadNotifications
        );
    }
    /** @test */
    public function view_all_unread_notifications()
    {
        $thread = create(Thread::class, ['user_id' => auth()->id()]);
        $thread->subscribe();

        //add the reply
        $thread->addReply([
            'user_id' => create(User::class)->id,
            'body' => 'something 2',
        ]);
        $noti = $this->getJson(
            '/profile/' . auth()->user()->name . '/notifications'
        )->json();

        $this->assertCount(1, $noti);
    }
}
