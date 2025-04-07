<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    // Show all wishlist items for the logged-in user
    public function index()
    {
        $wishlist = Wishlist::where('user_id', Auth::id())->with('product')->get();
        return view('wishlist', compact('wishlist'));
    }

    // Add a product to wishlist
    public function addToWishlist(Request $request)
    {
        Wishlist::firstOrCreate([
            'user_id' => Auth::id(),
            'product_id' => $request->id
        ]);

        return response()->json(['message' => 'Added to wishlist!']);
    }

    // Remove a product from wishlist
    public function removeFromWishlist(Request $request)
    {
        Wishlist::where('user_id', Auth::id())
                ->where('product_id', $request->id)
                ->delete();

        return redirect()->back()->with('success', 'Removed from wishlist!');
    }

    // ✅ Add product from wishlist to cart
    public function addToCartFromWishlist(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            return redirect()->back()->with('warning', 'Item is already in the cart.');
        }

        // Add to cart session
        $cart[$id] = [
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "image" => $product->image,
        ];

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
}
