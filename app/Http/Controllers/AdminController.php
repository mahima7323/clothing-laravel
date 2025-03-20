<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Show the admin login page
    public function showLogin()
    {
        return view('admin.login');
    }

    // Handle the admin login
    public function login(Request $request)
    {
        // Validate login credentials
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        // Use the 'admin' guard to attempt login
        if (Auth::guard('admin')->attempt($credentials)) {
            // Redirect to admin dashboard if successful
            return redirect()->route('admin.dashboard');
        } else {
            // Redirect back with error message if login fails
            return redirect()->back()->withErrors(['Invalid credentials']);
        }
    }

    // Show the admin dashboard
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // Admin logout
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
