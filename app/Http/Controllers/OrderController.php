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
        // Check if the user is logged in
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'You must be logged in to place an order.']);
        }

        // Retrieve the cart from the session
        $cart = session()->get('cart', []);

        // If cart is empty, return an error message
        if (empty($cart)) {
            return response()->json(['success' => false, 'message' => 'Your cart is empty!']);
        }

        // Create the order
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $this->calculateTotal($cart),
            'status' => 'Pending',
        ]);

        // Save order items with validation
        foreach ($cart as $id => $item) {
            // Ensure the cart item has all necessary fields
            if (!isset($item['id']) || !isset($item['quantity']) || !isset($item['price'])) {
                return response()->json(['success' => false, 'message' => 'Invalid cart data. Please try again.']);
            }

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Clear cart session after order placement
        session()->forget('cart');

        // Redirect to the order success page
        return response()->json([
            'success' => true,
            'message' => 'Your order has been placed successfully!',
            'redirect' => route('order.success')
        ]);
    }

    // Function to calculate total price
    private function calculateTotal($cart)
    {
        return array_reduce($cart, function ($total, $item) {
            return $total + ($item['price'] * $item['quantity']);
        }, 0);
    }

    // Order success page
    public function orderSuccess()
    {
        return view('order_success');
    }
}
