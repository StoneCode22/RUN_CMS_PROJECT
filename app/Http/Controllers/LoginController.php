<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle login POST
    public function login(Request $request)
    {
        $request->validate([
            'matric_no' => 'required|string',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('matric_no', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->status !== 'active') {
                Auth::logout();
                return back()->withErrors([
                    'matric_no' => 'Your account is inactive. Please contact the administrator.',
                ])->withInput($request->only('matric_no'));
            }
            $request->session()->regenerate();
            // Set a session flash message for successful login
            return redirect()->intended(route('user.dashboard'))->with('login_success', 'Login successful!');
        }
        return back()->withErrors([
            'matric_no' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('matric_no'));
    }

    // Handle registration POST
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:2'],
            'matric_no' => ['required', 'string', 'unique:users,matric_no'],
            'phone' => ['required', 'string'],
            'department' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'matric_no' => $validated['matric_no'],
            'phone' => $validated['phone'],
            'department' => $validated['department'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        return redirect()->intended(route('user.dashboard'));
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        // Redirect to login page after logout with a success message
        return redirect()->route('login')->with('logout_success', 'Logout successful!');
    }

    public function username()
    {
        return 'matric_no';
    }
}
