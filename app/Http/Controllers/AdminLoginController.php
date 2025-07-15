<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    // Show the admin login form
    public function showLoginForm()
    {
        return view('auth.login'); // Shows the same login view, but your JS toggles the admin form
    }

    // Handle admin login
    public function login(Request $request)
    {
        $request->validate([
            'admin_id' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::guard('admin')->attempt(['admin_id' => $request->admin_id, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')->with('login_success', 'Login successful!');
        }

        return back()->withErrors([
            'admin_id' => 'Invalid Admin ID or password.',
        ])->withInput($request->only('admin_id'));
    }
}
