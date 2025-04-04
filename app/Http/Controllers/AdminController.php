<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\Category;
use App\Models\Subcategory;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalProducts = Product::count();
        $totalUsers = User::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total_price'); // Assuming total_price column exists
        $totalCategories = Category::count();
        $totalSubcategories = Subcategory::count();

        return view('admin.dashboard', compact(
            'totalProducts', 
            'totalUsers', 
            'totalOrders', 
            'totalRevenue', 
            'totalCategories', 
            'totalSubcategories'
        ));
    }

    // Show the admin login page
    public function showLogin()
    {
        return view('admin.login');
    }

    // Handle the admin login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) { // Default auth guard
            session()->flash('success', 'Login Successful! Welcome to the Admin Dashboard.');
            return redirect()->route('admin.dashboard');
        } else {
            session()->flash('error', 'Invalid Credentials! Please try again.');
            return redirect()->back();
        }
    }

    // Admin logout
    public function logout()
    {
        Auth::logout(); // Use default guard
        return redirect()->route('admin.login')->with('success', 'Logged out successfully.');
    }
}
