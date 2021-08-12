<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThreadNotificationController extends Controller
{
    public function update($user, $notificationid)
    {
        return auth()
            ->user()
            ->unreadNotifications()
            ->find($notificationid)
            ->markAsRead();
    }
    public function index()
    {
        return auth()->user()->unreadNotifications;
    }
}
