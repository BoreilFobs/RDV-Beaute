<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\User;
use App\Notifications\SendNotification;
use Illuminate\Http\Request;

class DashAppointmentController extends Controller
{
    public function index(Request $request){
        $query = Appointments::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $appointments = $query
            ->orderByRaw("FIELD(status, 'confirmed', 'pending', 'completed', 'cancelled', 'rejected')")
            ->orderByDesc('date')
            ->orderBy('time', 'asc')
            ->paginate(15);

        return view('admin.appointment.index', compact('appointments'));
    }
    public function show($id)
    {
        $appointment = Appointments::findOrFail($id);
        return view("admin.appointment.show", compact("appointment"));
    }
    public function accept($id)
    {
        $appointment = Appointments::findOrFail($id);
        $appointment->status = 'confirmed';
        $appointment->save();

        // notify 
        $user = User::find($appointment->user_id);
         if ($user->fcm_token) {    
            $user->notify(new SendNotification(
                name: $user->name,
                title: 'Rendez-vous confirmer!',
                body: ' Votre rendez-vous du ' . $appointment->date . ' à ' . $appointment->time . ' a ete confirmer!',
                url: '/appointment' // optional click action
            ));
         }

        return redirect()->route('DashAppointment.index')->with('success', 'Appointment accepted successfully.');
    }

    public function reject($id)
    {
        $appointment = Appointments::findOrFail($id);
        $appointment->status = 'rejected';
        $appointment->save();

        // notify 
        $user = User::find($appointment->user_id);
         if ($user->fcm_token) {    
            $user->notify(new SendNotification(
                name: $user->name,
                title: 'Rendez-vous rejeter!',
                body: ' Votre rendez-vous du ' . $appointment->date . ' à ' . $appointment->time . ' a ete rejeter!',
                url: '/appointment' // optional click action
            ));
         }

        return redirect()->route('DashAppointment.index')->with('success', 'Appointment rejected successfully.');
    }public function complete($id)
    {
        $appointment = Appointments::findOrFail($id);
        $appointment->status = 'completed';
        $appointment->save();

        // notify 
        $user = User::find($appointment->user_id);
         if ($user->fcm_token) {    
            $user->notify(new SendNotification(
                name: $user->name,
                title: 'Rendez-vous terminer!',
                body: ' Votre rendez-vous du ' . $appointment->date . ' à ' . $appointment->time . ' a ete terminer!',
                url: '/appointment' // optional click action
            ));
         }
        return redirect()->route('DashAppointment.index')->with('success', 'Appointment completed successfully.');
    }
}
