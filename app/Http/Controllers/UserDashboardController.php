<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Appointments;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $upcomingAppointments = Appointments::where('user_id', $user->id)
            ->where('status', 'confirmed')
            ->count();

        $completedAppointments = Appointments::where('user_id', $user->id)
            ->where('status', 'completed')
            ->count();

        $canceledAppointments = Appointments::where('user_id', $user->id)
            ->where('status', 'canceled')
            ->count();

        $totalAppointments = Appointments::where('user_id', $user->id)->count();

        $pendingAppointment = Appointments::where('user_id', $user->id)
            ->where('status', 'pending')
            ->count();

        return view('userDashboard', [
            'upcomingAppointments' => $upcomingAppointments,
            'completedAppointments' => $completedAppointments,
            'canceledAppointments' => $canceledAppointments,
            'pendingAppointment' => $pendingAppointment,
        ]);
        return view('userDashboard');
    }
}
