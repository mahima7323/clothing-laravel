<?php
namespace App\Http\Controllers;

use App\Models\Order; // Assuming you have an Order model

class ReportController extends Controller
{
    public function index()
    {
        // Fetch the status and count of orders from your database
        $ordersStatus = Order::selectRaw('status, COUNT(*) as count')
                             ->groupBy('status')
                             ->get();

        // Prepare statuses and counts for JavaScript
        $statuses = $ordersStatus->pluck('status');
        $counts = $ordersStatus->pluck('count');

        // Pass data to the view
        return view('admin.reports', compact('statuses', 'counts'));
    }
}
