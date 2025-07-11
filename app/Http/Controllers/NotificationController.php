<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::orderByRaw("status = 'unread' DESC")
                                  ->orderBy('created_at', 'desc')
                                  ->get();
        return view('admin.notifications.index', compact('notifications'));
    }

    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();

        return redirect()->back()->with('success', 'Notification supprimée avec succès.');
    }

}
