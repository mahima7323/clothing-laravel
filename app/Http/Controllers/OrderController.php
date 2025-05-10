<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use app\Modelsproduct; // Ensure you have Product model included
use App\Models\Cart; // Ensure you have Cart model included
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Address;
use Stripe\Stripe;
use Stripe\Checkout\Session;



class OrderController extends Controller
{
    // Method to display all orders with related user and order items
    // public function index()
    // {
    //     // Retrieve orders along with the user and order items (with product info)
    //     $orders = Order::with(['user', 'orderItems.product'])->paginate(10);

    //     // Pass the orders data to the view
    //     return view('admin.orders.index', compact('orders'));
    // }
    public function index(Request $request)
    {
        $status = $request->get('status');

        // Filter based on the status if it's set
        if ($status) {
            $orders = Order::where('status', $status)->paginate(10);
        } else {
            // If no status is selected, show all orders
            $orders = Order::paginate(10);
        }

        return view('admin.orders.index', compact('orders'));
    }


    // Method to place an order
    public function placeOrder(Request $request)
    {
        $request->validate([
            'street' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip_code' => 'required',
            'country' => 'required',
        ]);

        $userId = Auth::id();
        $cartItems = Cart::with('product')->where('user_id', $userId)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty!');
        }

        $totalPrice = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        // Save address in session (so we can use it after payment)
        session([
            'address' => $request->only(['street', 'city', 'state', 'zip_code', 'country']),
            'cart_total' => $totalPrice
        ]);

        // Stripe Payment
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $lineItems = [];

        foreach ($cartItems as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'inr',
                    'product_data' => [
                        'name' => $item->product->name,
                    ],
                    'unit_amount' => $item->product->price * 100, // in paise
                ],
                'quantity' => $item->quantity,
            ];
        }

        $checkoutSession = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('stripe.success'),
            'cancel_url' => route('stripe.cancel'),
        ]);

        return redirect($checkoutSession->url);
    }
    public function stripeSuccess()
    {
        $userId = Auth::id();

        // Store the address
        $addressData = session('address');
        Address::create([
            'user_id' => $userId,
            'street' => $addressData['street'],
            'city' => $addressData['city'],
            'state' => $addressData['state'],
            'zip_code' => $addressData['zip_code'],
            'country' => $addressData['country'],
        ]);

        $cartItems = Cart::with('product')->where('user_id', $userId)->get();
        $totalPrice = session('cart_total');

        // Create the order
        $order = Order::create([
            'user_id' => $userId,
            'total_price' => $totalPrice,
            'status' => 'Paid',
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }

        // Clear cart
        Cart::where('user_id', $userId)->delete();

        // Send email
        $emailContent = "Dear " . Auth::user()->name . ",\n\n";
        $emailContent .= "Thank you for your payment! Your order has been placed.\n\nOrder Summary:\n";

        foreach ($cartItems as $item) {
            $emailContent .= $item->product->name . " - " . $item->quantity . " x ₹" . $item->product->price . "\n";
        }

        $emailContent .= "\nTotal: ₹" . number_format($totalPrice, 2) . "\n\n";
        $emailContent .= "Thank you for shopping with us!\n";

        Mail::raw($emailContent, function ($message) {
            $message->to(Auth::user()->email)->subject('Payment Successful - Order Confirmation');
        });

        return redirect()->route('order.success', ['orderId' => $order->id])
            ->with('success', 'Payment successful and order placed!');
    }

    // Method to display the order success page after a successful order placement
    // public function orderSuccess()
    // {
    //     $order = Order::with('orderItems.product')
    //         ->where('user_id', Auth::id())
    //         ->latest()
    //         ->first();

    //     if (!$order) {
    //         return redirect()->route('cart.view')->with('error', 'No recent order found.');
    //     }

    //     // Fetch the success message from session (if any)
    //     $successMessage = session('success');

    //     return view('order_success', compact('order', 'successMessage'));
    // }
    // public function orderSuccess($orderId)
    // {
    //     $order = Order::with('orderItems.product')
    //         ->where('user_id', Auth::id())
    //         ->where('id', $orderId)
    //         ->first();

    //     if (!$order) {
    //         return redirect()->route('cart.view')->with('error', 'No recent order found.');
    //     }

    //     $successMessage = session('success');
    //     return view('order_success', compact('order', 'successMessage'));
    // }

    public function orderSuccess($orderId)
    {
        $order = Order::with('orderItems.product')
            ->where('user_id', Auth::id())
            ->where('id', $orderId)
            ->first();

        if (!$order) {
            return redirect()->route('cart.view')->with('error', 'No recent order found.');
        }

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

    public function updateOrderStatus(Request $request, $orderId)
    {
        $order = Order::find($orderId);

        if ($order && $order->status == 'Pending') {
            $order->status = 'Completed';
            $order->save();

            return redirect()->route('admin.orders.index')->with('success', 'Order marked as completed.');
        }

        return redirect()->route('admin.orders')->with('error', 'Order not found or already processed.');
    }

    public function cancelOrderStatus(Request $request, $orderId)
    {
        // Find the order by its ID
        $order = Order::find($orderId);

        // Check if the order exists and is still in the "Pending" status
        if ($order && $order->status == 'Pending') {
            // Update the order status to "Cancelled"
            $order->status = 'Cancelled';
            $order->save();

            // Redirect back to the orders page with a success message
            return redirect()->route('admin.orders.index')->with('success', 'Order marked as cancelled.');
        }

        // Redirect back with an error if the order is not found or cannot be cancelled
        return redirect()->route('admin.orders.index')->with('error', 'Order not found or cannot be cancelled.');
    }
}
