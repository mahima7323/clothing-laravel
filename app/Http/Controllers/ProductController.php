<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    // Display the list of products (Admin Side)
    public function index()
    {
        $products = Product::with('category', 'subcategory')->get();
        return view('admin.products.index', compact('products')); 
    }

    // Show the product creation form
    public function create()
    {
        // Optionally, pass any data needed, such as categories, etc.
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }
    

    // Store a new product
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

    // Show the product editing form
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $subcategories = Subcategory::where('category_id', $product->category_id)->get();  // Ensure correct subcategories
        return view('admin.products.edit', compact('product', 'categories', 'subcategories')); 
    }

    // Update the product
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

    // Delete the product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }

    // Get subcategories by category_id (for dynamic loading)
   
    public function getSubcategories($category_id)
    {
        $subcategories = Subcategory::where('category_id', $category_id)->get();
        return response()->json($subcategories);
    }

    public function userProductList()
    {
        $products = Product::all(); // દરેક પ્રોડક્ટ્સ લાવો
        return view('product_list', compact('products')); // product_list.blade.php માં ડેટા મોકલો
    }
// -----------------------------------------------------------------------------------------

    //Show products by category name
    // public function showCategoryProducts($categoryName)
    // {
    //     try {
    //         // Log the received category name
    //         Log::info('Received category name: ' . $categoryName);
    
    //         // Fetch category (case-insensitive)
    //         $category = DB::table('categories')
    //             ->whereRaw('LOWER(name) = ?', [strtolower($categoryName)])
    //             ->first();
    
    //         if (!$category) {
    //             // Log if the category is not found
    //             Log::info('❌ Category not found: ' . $categoryName);
    //             return back()->with('error', 'Category not found.');
    //         }
    
    //         // Log the category found
    //         Log::info('✅ Category found! ID: ' . $category->id);
    
    //         // Fetch products for this category
    //         $products = DB::table('products')
    //             ->where('category_id', $category->id)
    //             ->get();
    
    //         // Log the products fetched (convert to JSON string for readability)
    //         Log::info('Products for Category ' . $categoryName . ': ' . json_encode($products->toArray(), JSON_PRETTY_PRINT));
    
    //         // If no products are found, log it
    //         if ($products->isEmpty()) {
    //             Log::info('🛍 No products found for Category ' . $categoryName);
    //         }
    
    //         // Return the view with products and category name
    //         return view("user_product.$categoryName", compact('products', 'categoryName'));
    
    //     } catch (\Exception $e) {
    //         // Log the error if any exception occurs
    //         Log::error('Error occurred while fetching products for category ' . $categoryName . ': ' . $e->getMessage());
    //         return back()->with('error', 'An error occurred while fetching products.');
    //     }
    // }
    
    

        

}
