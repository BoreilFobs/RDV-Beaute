<?php

namespace App\Http\Controllers;
use App\Notifications\SendNotification;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::orderBy('created_at', 'desc')->paginate(10);
        $unreadCount = Message::whereNull('read_at')->count();
        
        return view('admin.messages.index', compact('messages', 'unreadCount'));
    }

    public function markAsRead($id)
    {
        $message = Message::findOrFail($id);
        if (!$message->read_at) {
            $message->update(['read_at' => now()]);
            return back()->with('success', 'Message marked as read');
        }
        return back();
    }

    public function store(Request $request){
       $validated = $request->validate([
            'name' => 'required|string',
            'phone' => [
                'required',
                'regex:/^(\+237|00237)?6[0-9]{8}$/'
            ],
            'message' => 'required|string',
        ]);

        Message::create($validated);

        // notify
        $user = User::find(1);
         if ($user->fcm_token) {    
            $user->notify(new SendNotification(
                name: $user->name,
                title: 'Nouveau Message!',
                body: 'Vous avez recu un message de '. Auth::user()->name . '!',
                url: '/messages' // optional click action
            ));
         }

        return redirect()
            ->route('home')
            ->with('success', 'Votre message a ete envoye. ons vous revien bientot.');

    }

    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();
        
        return back()->with('success', 'Message deleted successfully');
    }
}