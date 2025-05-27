<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        // Logic to retrieve and display user dashboard data
        return view('userDashboard');
    }
}
