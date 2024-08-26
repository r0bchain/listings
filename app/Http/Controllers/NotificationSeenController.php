<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Gate;

class NotificationSeenController extends Controller
{
    public function __invoke(DatabaseNotification $notification)
    {
        $response = Gate::inspect('mark-as-read', $notification);
       
        if (!$response->allowed()) {
            return redirect()->back()->with('error', 'Cannot marked as read, please try a bit later!');
        }

        $notification->markAsRead();
        return redirect()->back()->with('success', 'Notification marked as read!');
    }
}
