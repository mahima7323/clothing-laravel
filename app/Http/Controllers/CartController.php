<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    // Add product to cart
    public function addToCart(Request $request)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$request->id])) {
            $cart[$request->id]['quantity'] += 1;
        } else {
            $cart[$request->id] = [
                "name" => $request->name,
                "price" => (float) $request->price,
                "image" => $request->image,
                "quantity" => 1
            ];
        }

        session()->put('cart', $cart);
        $grandTotal = $this->calculateGrandTotal($cart);
        session()->put('grand_total', $grandTotal);

        return response()->json([
            'message' => 'Product added to cart successfully!',
            'grand_total' => number_format($grandTotal, 2, '.', '')
        ]);
    }

    // View Cart Page
    public function viewCart()
    {
        $cart = session()->get('cart', []);
        $grandTotal = $this->calculateGrandTotal($cart);

        return view('cart', compact('cart', 'grandTotal'));
    }

    // Remove product from cart
    public function removeFromCart(Request $request)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$request->id])) {
            unset($cart[$request->id]);
            session()->put('cart', $cart);
        }

        $grandTotal = $this->calculateGrandTotal($cart);
        session()->put('grand_total', $grandTotal);

        return response()->json([
            'message' => 'Product removed successfully!',
            'grand_total' => number_format($grandTotal, 2, '.', '')
        ]);
    }

    // Update quantity in cart
    public function updateCart(Request $request)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$request->id])) {
            $cart[$request->id]['quantity'] = max(1, (int) $request->quantity);
            session()->put('cart', $cart);
        }

        $grandTotal = $this->calculateGrandTotal($cart);
        session()->put('grand_total', $grandTotal);

        return response()->json([
            'new_total' => number_format($cart[$request->id]['quantity'] * $cart[$request->id]['price'], 2, '.', ''),
            'grand_total' => number_format($grandTotal, 2, '.', '') // **This is now updated correctly**
        ]);
    }

    // Calculate Grand Total
    private function calculateGrandTotal($cart)
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += ((float) $item['price'] * (int) $item['quantity']);
        }
        return $total;
    }
}
