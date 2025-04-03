<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        // Debugging: Check if request method is POST
        if ($request->method() !== 'POST') {
            return redirect()->back()->with('error', 'Invalid request method. Please submit the form correctly.');
        }
        
        $cart = session()->get('cart', []);
    
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty!');
        }
    
        // Create order
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $this->calculateTotal($cart),
            'status' => 'Pending',
        ]);
    
        // Save order items
        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }
    
        // Clear cart session
        session()->forget('cart');
    
        return redirect()->route('order.success')->with('success', 'Your order has been placed successfully!');
    }
        // Function to calculate total price
    private function calculateTotal($cart)
    {
        return array_reduce($cart, function ($total, $item) {
            return $total + ($item['price'] * $item['quantity']);
        }, 0);
    }

    public function orderSuccess()
    {
        return view('order_success');
    }
}
