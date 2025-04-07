<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Add product to cart
    public function addToCart(Request $request)
    {
        $userId = Auth::id();

        if (!$userId) {
            return response()->json([
                'message' => 'User is not authenticated. Please log in to add items to the cart.'
            ], 401);
        }

        $cartItem = Cart::where('user_id', $userId)
                        ->where('product_id', $request->id)
                        ->first();

        if ($cartItem) {
            return response()->json([
                'message' => 'Item already in cart.'
            ]);
        }

        Cart::create([
            'user_id' => $userId,
            'product_id' => $request->id,
            'quantity' => 1,
        ]);

        return response()->json([
            'message' => 'Product added to cart successfully!'
        ]);
    }

    // Show Cart Page
    public function cartPage()
    {
        $userId = auth()->id();

        $cartItems = Cart::with('product')
                        ->where('user_id', $userId)
                        ->get();

        $cart = [];
        $grandTotal = 0;

        foreach ($cartItems as $item) {
            $product = $item->product;

            if ($product) {
                $total = $product->price * $item->quantity;
                $grandTotal += $total;

                $cart[] = [
                    'id' => $item->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $item->quantity,
                    'image' => asset('storage/' . $product->image),
 // ✅ Corrected image path
                ];
            }
        }

        return view('cart', compact('cart', 'grandTotal'));
    }

    // Remove item from cart
    public function remove(Request $request)
    {
        $id = $request->id;

        $cartItem = Cart::find($id);

        if ($cartItem) {
            $cartItem->delete();

            return response()->json([
                'success' => true,
                'id' => $id,
                'message' => 'Item removed from cart.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Unable to remove item.'
        ]);
    }

    // Update cart quantity
    public function updateCart(Request $request)
    {
        $userId = Auth::id();

        $cartItem = Cart::where('user_id', $userId)
                        ->where('product_id', $request->id)
                        ->first();

        if ($cartItem) {
            $cartItem->quantity = max(1, (int) $request->quantity);
            $cartItem->save();
        }

        $grandTotal = $this->calculateGrandTotal($userId);

        return response()->json([
            'new_total' => number_format($cartItem->quantity * $cartItem->product->price, 2, '.', ''),
            'grand_total' => number_format($grandTotal, 2, '.', '')
        ]);
    }

    // Calculate grand total
    private function calculateGrandTotal($userId)
    {
        return Cart::where('user_id', $userId)
                   ->with('product')
                   ->get()
                   ->sum(function ($item) {
                       return $item->product->price * $item->quantity;
                   });
    }
}
