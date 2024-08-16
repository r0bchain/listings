<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        return inertia('Notification/Index', [
            'notifications' => $request->user()->notifications()->paginate(10),
        ]);
    }

    public function markAsRead(Request $request)
    {
        $request->user()->notifications()->find($request->id)->markAsRead();
        return redirect()->back();
    }   
}
