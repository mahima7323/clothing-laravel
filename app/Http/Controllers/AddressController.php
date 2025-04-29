<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    // Display the form to create a new address
    public function create()
    {
        return view('address.create');
    }

    // Store the address in the database
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'street' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip_code' => 'required',
            'country' => 'required',
        ]);

        // Check if user is logged in
        if (auth()->check()) {
            // Store the address for the logged-in user
            Address::create([
                'user_id' => auth()->user()->id,
                'street' => $request->street,
                'city' => $request->city,
                'state' => $request->state,
                'zip_code' => $request->zip_code,
                'country' => $request->country,
            ]);
            
            // Redirect to the order success page with a success message
            return redirect()->route('order_success')->with('success', 'Address saved successfully!');
        } else {
            // If the user is not logged in, redirect with an error
            return redirect()->route('login')->with('error', 'You must be logged in to add an address.');
        }
    }
}
