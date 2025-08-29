<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Photographers;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function dashboard()
    {
        // Fetch all bookings and photographers
        $bookings = Booking::all();
        $photographers = Photographers::all();

        // Return dashboard view with data
        return view('admin.dashboard', compact('bookings', 'photographers'));
    }

    /**
     * Handle admin login.
     */
    public function login(Request $request)
    {
        // Validate the form data
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt to authenticate the admin
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect to the intended page or admin dashboard
            return redirect()->intended('admin/dashboard');
        }

        // Authentication failed
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
            'password' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Logout the admin.
     */
    public function logout(Request $request)
    {
        Auth::logout(); // Logs out the admin
        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate CSRF token

        return redirect('/'); // Redirect to home page
    }
}