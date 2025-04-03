<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function addToWishlist(Request $request)
    {
        $wishlist = session()->get('wishlist', []);

        // Check if product is already in wishlist
        if (isset($wishlist[$request->id])) {
            return response()->json(['message' => 'Product is already in wishlist!']);
        }

        // Add product to wishlist
        $wishlist[$request->id] = [
            "name" => $request->name,
            "price" => $request->price,
            "image" => $request->image
        ];

        session()->put('wishlist', $wishlist);
        session()->save();
        
        return response()->json(['message' => 'Product added to wishlist successfully!']);
    }

    public function viewWishlist()
    {
        $wishlist = session()->get('wishlist', []);
        return view('wishlist', compact('wishlist'));
    }

    public function removeFromWishlist(Request $request)
    {
        $wishlist = session()->get('wishlist', []);

        if (isset($wishlist[$request->id])) {
            unset($wishlist[$request->id]);
            session()->put('wishlist', $wishlist);
        }

        return redirect()->route('wishlist.view')->with('success', 'Product removed from wishlist');
    }
}
