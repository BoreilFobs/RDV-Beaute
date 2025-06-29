<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\Offers;
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
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'special_requests' => 'nullable|string|max:500',
        ]);

        // Create the appointment logic here
        $validatedData['user_id'] = Auth::user()->id;
        $validatedData['offer_id'] = $request->route('offer');
        Appointments::create($validatedData);

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

        return redirect()->route('appointments.index')->with('success', 'Appointment cancelled successfully!');
    }
}
