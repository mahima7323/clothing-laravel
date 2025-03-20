<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    // Display a list of subcategories with pagination
    public function index()
    {
        $subcategories = Subcategory::paginate(10);
        return view('admin.subcategories.index', compact('subcategories'));
    }

    // Show the form for creating a new subcategory
    public function create()
    {
        $categories = Category::all();
        return view('admin.subcategories.create', compact('categories'));
    }

    // Store a newly created subcategory in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        try {
            Subcategory::create($request->only('name', 'category_id'));
            return redirect()->route('admin.subcategories.index')->with('success', 'Subcategory created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create subcategory: ' . $e->getMessage());
        }
    }

    // Fetch subcategories based on category ID (AJAX call)
    public function getSubcategories($category_id)
    {
        $subcategories = Subcategory::where('category_id', $category_id)->get();
        return response()->json($subcategories);
    }

    // Show the form for editing the specified subcategory
    public function edit($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $categories = Category::all();
        return view('admin.subcategories.edit', compact('subcategory', 'categories'));
    }

    // Update the specified subcategory in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        try {
            $subcategory = Subcategory::findOrFail($id);
            $subcategory->update($request->only('name', 'category_id'));
            return redirect()->route('admin.subcategories.index')->with('success', 'Subcategory updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update subcategory: ' . $e->getMessage());
        }
    }

    // Remove the specified subcategory from the database
    public function destroy($id)
    {
        try {
            $subcategory = Subcategory::findOrFail($id);
            $subcategory->delete();
            return redirect()->route('admin.subcategories.index')->with('success', 'Subcategory deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete subcategory: ' . $e->getMessage());
        }
    }

    public function show($subcategory)
    {
        // Fetch the subcategory data
        $subcategoryData = Subcategory::where('category_id', (int)$subcategory)->get();

        // Check if subcategory exists
        if (!$subcategoryData) {
            return response()->json(['error' => 'Subcategory not found'], 404);
        }

        // Return the subcategory data as JSON
        return response()->json($subcategoryData);
    }



}
