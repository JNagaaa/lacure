<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $admin = auth()->user();
        return view('admin/notifications', compact('admin'));
    }


    public function getUnreadNotifications()
    {
        $user = Auth::user();
        $notifications = $user->unreadNotifications->take(5);
        $unseenNotificationCount = $user->unreadNotifications->count();

        return response()->json(['notifications' => $notifications, 'numberNotif' => $unseenNotificationCount]);
    }

    public function markAsRead(Request $request, $notificationId)
    {
        $notification = auth()->user()->notifications()->find($notificationId);

        if ($notification) {
            $notification->markAsRead();
            return response()->json(['message' => 'Notification marked as read.']);
        }

        return response()->json(['message' => 'Notification not found.'], 404);
    }
}
