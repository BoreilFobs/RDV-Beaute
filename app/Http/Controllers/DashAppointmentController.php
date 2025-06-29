<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
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

        return redirect()->route('DashAppointment.index')->with('success', 'Appointment accepted successfully.');
    }
    public function reject($id)
    {
        $appointment = Appointments::findOrFail($id);
        $appointment->status = 'rejected';
        $appointment->save();

        return redirect()->route('DashAppointment.index')->with('success', 'Appointment rejected successfully.');
    }public function complete($id)
    {
        $appointment = Appointments::findOrFail($id);
        $appointment->status = 'completed';
        $appointment->save();

        return redirect()->route('DashAppointment.index')->with('success', 'Appointment completed successfully.');
    }
}
