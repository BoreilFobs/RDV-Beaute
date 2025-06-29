<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::withCount(['appointments as appointments_count' => function($q) {
            $q->where('status', 'completed');
        }]);

        if ($search) {
            $users = $users->where('name', 'like', "%$search%");
        }

        $users = $users->paginate(15);

        return view('admin.user.index', compact('users'));
    }
}
