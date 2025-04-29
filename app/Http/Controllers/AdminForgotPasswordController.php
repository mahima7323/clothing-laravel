<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class AdminForgotPasswordController extends Controller
{
    // Show form to request reset link
    public function showLinkRequestForm()
    {
        return view('admin.passwords.email'); // Points to the correct custom view
    }
    

    // Handle email submission and send reset link
    // public function sendResetLinkEmail(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //     ]);

    //     $status = Password::sendResetLink(
    //         $request->only('email')
    //     );

    //     return $status === Password::RESET_LINK_SENT
    //         ? back()->with('status', __($status))
    //         : back()->withErrors(['email' => __($status)]);
    // }
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email', // validate the email
        ]);

        // Send password reset link to admin email
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // If link sent, return with success status, else show error
        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }
}

