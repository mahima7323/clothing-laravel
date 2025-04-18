<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
public function create()
{
    return view('address.create');
}

public function store(Request $request)
{
    $request->validate([
        'street' => 'required',
        'city' => 'required',
        'state' => 'required',
        'zip_code' => 'required',
        'country' => 'required',
    ]);

    Address::create([
        'user_id' => auth()->id(), // if user is logged in
        'street' => $request->street,
        'city' => $request->city,
        'state' => $request->state,
        'zip_code' => $request->zip_code,
        'country' => $request->country,
    ]);

    return redirect()->back()->with('success', 'Address saved successfully!');
}
}
