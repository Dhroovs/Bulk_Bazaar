<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // MARK ALL NOTIFICATIONS AS READ
    public function readAll()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back()->with('success', 'All alerts marked as read.');
    }

    // MARK SINGLE NOTIFICATION AS READ AND REDIRECT
    public function read($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();
        
        $url = $notification->data['url'] ?? '/dashboard';
        return redirect($url);
    }
}
