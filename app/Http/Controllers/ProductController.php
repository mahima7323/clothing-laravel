<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;

class ProductController extends Controller
{
    // Display products in admin panel
    public function index()
    {
        $products = Product::with('category', 'subcategory')->get();
        return view('admin.products.index', compact('products'));
    }

    // Show product creation form
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    // Store product
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->hasFile('image') ? $request->file('image')->store('products', 'public') : null;

        Product::create([
            'category_id' => $validated['category_id'],
            'subcategory_id' => $validated['subcategory_id'],
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'quantity' => $validated['quantity'],
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product added successfully!');
    }

    // Show edit form
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $subcategories = Subcategory::where('category_id', $product->category_id)->get();

        return view('admin.products.edit', compact('product', 'categories', 'subcategories'));
    }

    // Update product
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        $product->update([
            'category_id' => $validated['category_id'],
            'subcategory_id' => $validated['subcategory_id'],
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'quantity' => $validated['quantity'],
            'image' => $product->image,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    // Delete product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }

    // Fetch subcategories dynamically for admin panel
    public function getSubcategories($category_id)
    {
        $subcategories = Subcategory::where('category_id', $category_id)->get();
        return response()->json($subcategories);
    }

    // Show user product list with filter
   // In ProductController

// Fetch products by subcategory for the user product list
public function userProductList(Request $request)
{
    $query = Product::with('category', 'subcategory');

    // Filter by category if category_id is present in the request
    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    // Filter by subcategory if subcategory_id is present in the request
    if ($request->filled('subcategory_id')) {
        $query->where('subcategory_id', $request->subcategory_id);
    }

    // Get filtered products with pagination
    $products = $query->paginate(10);

    // Fetch all categories and subcategories to populate the filters
    $categories = Category::all();
    $subcategories = Subcategory::all();

    return view('product_list', compact('products', 'categories', 'subcategories'));
}

public function filterBySubcategory(Request $request)
{
    $query = Product::query();

    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    if ($request->filled('subcategory_id')) {
        $query->where('subcategory_id', $request->subcategory_id);
    }

    $products = $query->get()->map(function ($product) {
        return [
            'id' => $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'price' => $product->price,
            'image' => asset('storage/' . $product->image),
        ];
    });

    return response()->json(['products' => $products]);
}

public function addToCart(Request $request)
{
    // Validate product ID
    $product = Product::findOrFail($request->product_id);

    // Fetch current cart from session, if exists
    $cart = session()->get('cart', []);

    // Check if product already exists in cart
    if(isset($cart[$product->id])) {
        $cart[$product->id]['quantity']++;
    } else {
        // Add new product to cart
        $cart[$product->id] = [
            'name' => $product->name,
            'quantity' => 1,
            'price' => $product->price,
            'image' => asset('storage/' . $product->image),
        ];
    }

    // Update session with new cart
    session()->put('cart', $cart);

    return response()->json(['success' => 'Product added to cart!']);
}

    
}
