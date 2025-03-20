<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UsersController extends Controller
{
    // Show the login page
    public function showLoginForm()
    {
        return view('login');
    }

    // Handle the login
    public function login(Request $request)
    {
        // Validate the credentials
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('welcome')->with('success', 'Login successful!');
        }

        // If authentication fails, redirect back with error
        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }

    // Show the registration page
    public function showRegistrationForm()
    {
        return view('register');  // Changed to match correct path
    }

    // Handle the registration
    public function register(Request $request)
    {
        // Validate the registration form
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        try {
            // Create a new user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            // Log in the user after registration
            Auth::login($user);

            return redirect()->route('welcome')->with('success', 'Registration successful!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Registration failed: ' . $e->getMessage()]);
        }
    }


    public function showUsers()
{
    $users = User::all(); // Badha users fetch karva
    return view('admin.users', compact('users'));
}
    // Handle logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logged out successfully!');
    }
}
