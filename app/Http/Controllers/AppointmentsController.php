<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppointmentsController extends Controller
{
    public function index()
    {
        // Logic to retrieve and display appointments
        return view('appointments.index');
    }
    public function create()
    {
        // Logic to show the form for creating a new appointment
        return view('appointments.create');
    }
    public function show()
    {
        return view('appointments.view');
    }
}
