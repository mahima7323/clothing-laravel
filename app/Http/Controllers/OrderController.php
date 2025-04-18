<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product; // Ensure you have Product model included
use App\Models\Cart; // Ensure you have Cart model included
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Method to display all orders with related user and order items
    public function index()
    {
        // Retrieve orders along with the user and order items (with product info)
        $orders = Order::with(['user', 'orderItems.product'])->paginate(10);

        // Pass the orders data to the view
        return view('admin.orders.index', compact('orders'));
    }

    // Method to place an order
    public function placeOrder(Request $request)
    {
        // Check if the user is logged in
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'You must be logged in to place an order.']);
        }

        // Retrieve the cart from the database for the logged-in user
        $userId = Auth::id();
        $cartItems = Cart::with('product')->where('user_id', $userId)->get();

        // Check if the cart is empty
        if ($cartItems->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'Your cart is empty!']);
        }

        // Calculate the total price
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        // Create the order
        $order = Order::create([
            'user_id' => $userId,
            'total_price' => $totalPrice,
            'status' => 'Pending',  // Default status for a new order
        ]);

        // Save order items
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }

        // Clear the cart after placing the order
        Cart::where('user_id', $userId)->delete();

        // Return success message and redirect route
        return redirect()->route('order.success')->with('success', 'Your order has been placed successfully!');

        // return response()->json([
        //     'success' => true,
        //     'message' => 'Your order has been placed successfully!',
        //     'redirect' => route('order.success')
        // ]);
    }

    // Method to display the order success page after a successful order placement
    public function orderSuccess()
    {
        $order = Order::with('orderItems.product')
            ->where('user_id', Auth::id())
            ->latest()
            ->first();

        if (!$order) {
            return redirect()->route('cart.view')->with('error', 'No recent order found.');
        }

        // Fetch the success message from session (if any)
        $successMessage = session('success');

        return view('order_success', compact('order', 'successMessage'));
    }

    // Method to display order details based on the order ID
    public function orderDetails($id)
    {
        // Fetch order with its items and products, ensuring it's for the logged-in user
        $order = Order::with('orderItems.product')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Pass the order details to the view
        return view('order_details', compact('order'));
    }

    // Function to calculate total price of all items in the cart
    private function calculateTotal($cart)
    {
        return $cart->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
    }
}
