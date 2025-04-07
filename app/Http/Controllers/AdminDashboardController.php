<?php
 
 namespace App\Http\Controllers;
 
 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Auth; // Ensure Auth is included
 use App\Models\Product;
 use App\Models\User;
 use App\Models\Order;
 use App\Models\Category;
 use App\Models\Subcategory;
 
 class AdminDashboardController extends Controller
 {
     public function __construct()
     {
         $this->middleware('auth:admin'); // Restrict access to authenticated admins
     }
 
     public function index()
     {
         // Fetch total counts
         $totalProducts = Product::count();
         $totalUsers = User::count();
         $totalOrders = Order::count();
         $totalRevenue = Order::sum('total_price'); // Assuming total_price exists in orders table
         $totalCategories = Category::count();
         $totalSubcategories = Subcategory::count();
 
         // Pass data to the dashboard view
         return view('admin.dashboard', compact(
             'totalProducts', 
             'totalUsers', 
             'totalOrders', 
             'totalRevenue', 
             'totalCategories', 
             'totalSubcategories'
         ));
     }
 }