<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\Notification;
use App\Notifications\SendNotification;
use App\Models\Offers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AppointmentsController extends Controller
{
    public function index()
    {
        // Logic to retrieve and display appointments
        $appointments = Appointments::where('user_id', Auth::user()->id)
            ->orderByRaw("FIELD(status, 'confirmed', 'pending', 'completed',  'cancelled','rejected')")
            ->orderBy('date')
            ->orderBy('time', 'asc')
            ->get();
        return view('appointments.index', compact("appointments"));
    }
    public function create(Request $request, $id)
    {
        // Logic to show the form for creating a new appointment
        $offer = Offers::findOrFail($id);
        return view('appointments.create', compact("offer"));
    }
    public function store(Request $request)
    {
        // Logic to store a new appointment
        $validatedData = $request->validate([
            'date' => 'required|date',
            'time' => 'required',
            'special_requests' => 'nullable|string|max:500',
        ]);

        // Create the appointment logic here
        $validatedData['user_id'] = Auth::user()->id;
        $validatedData['name'] = Auth::user()->name;
        $validatedData['phone'] = Auth::user()->phone;
        $validatedData['offer_id'] = $request->route('offer');
        Appointments::create($validatedData);

        // notify
        $user = User::find(1);
         if ($user->fcm_token) {    
            $user->notify(new SendNotification(
                name: $user->name,
                title: 'Nouveau Rendez-vous!',
                body: Auth::user()->name . ' vien de passer un rendez-vous pour ' . $validatedData['date'] . ' à ' . $validatedData['time'] . '!',
                url: '/dashboard/appointment' // optional click action
            ));
         }
        // store notif in database
        Notification::create([
            'content' => Auth::user()->name . ' a pris un rendez-vous pour ' . $validatedData['date'] . ' à ' . $validatedData['time'] . '.',
        ]);
        

        return redirect()->route('appointments.index')->with('success', 'Appointment created successfully!');
    }
    public function reschedule(Request $request, $id)
    {
        $appointment = Appointments::findOrFail($id);

        $validatedData = $request->validate([
            'new_date' => 'required|date',
            'new_time' => 'required',
        ]);

        $appointment->date = $validatedData['new_date'];
        $appointment->time = $validatedData['new_time'];
        $appointment->save();

        // notify
        $user = User::find(1);
         if ($user->fcm_token) {    
            $user->notify(new SendNotification(
                name: $user->name,
                title: 'Rendez-vous Reprogrammer!',
                body: Auth::user()->name . ' vien de reprogrammer son rendez-vous du ' . $appointment->date . ' à ' . $appointment->time . ' pour ' . $validatedData['new_date'] . ' à ' . $validatedData['new_time'] . '!',
                url: '/dashboard/appointment' // optional click action
            ));
         }
        // store notif in database
        Notification::create([
            'content' => Auth::user()->name . ' a reprogrammer son rendez-vous du ' . $appointment->date . ' à ' . $appointment->time . ' pour ' . $validatedData['new_date'] . ' à ' . $validatedData['new_time'] . '.',
        ]);

         

        return redirect()->route('appointments.index')->with('success', 'Appointment rescheduled successfully!');
    }
    public function destroy($id)
    {
        $appointment = Appointments::findOrFail($id);
        $appointment->delete();

        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully!');
    }

    public function cancel($id)
    {
        $appointment = Appointments::findOrFail($id);
        $appointment->status = 'cancelled';
        $appointment->save();

        // notify
        $user = User::find(1);
         if ($user->fcm_token) {    
            $user->notify(new SendNotification(
                name: $user->name,
                title: 'Rendez-vous annulee!',
                body: Auth::user()->name . ' vien d\'annuler son rendez-vous du ' . $appointment->date . ' à ' . $appointment->time  . '!',
                url: '/dashboard/appointment' // optional click action
            ));
         }
        // store notif in database
        Notification::create([
            'content' => Auth::user()->name . ' a annuler son rendez-vous du ' . $appointment->date . ' à ' . $appointment->time . '.',
        ]);
        return redirect()->route('appointments.index')->with('success', 'Appointment cancelled successfully!');
    }
}
