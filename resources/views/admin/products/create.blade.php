@extends('layouts.admin_header')

@section('content')
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #2c2c2c;
        color: #f4f4f4;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 30px;
        background-color: #333;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }

    h2 {
        text-align: center;
        margin-bottom: 30px;
        color: #f4f4f4;
    }

    .form-group label {
        font-size: 16px;
        color: #ddd;
    }

    .form-control {
        border: 1px solid #555;
        border-radius: 5px;
        padding: 10px;
        background-color: #444;
        color: #fff;
    }

    .form-control:focus {
        background-color: #555;
        border-color: #777;
    }

    .btn-success {
        background-color: #4CAF50;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-success:hover {
        background-color: #45a049;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-control {
        width: 100%;
        max-width: 100%;
    }

    .btn {
        margin-top: 20px;
    }
</style>

<div class="container mt-5">
    <h2>Add Product</h2>
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
  
        <!-- Category Selection -->
        <div class="form-group">
            <label for="category">Category</label>
            <select name="category_id" id="category" class="form-control" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Subcategory Selection -->
        <div class="form-group mt-3">
            <label for="subcategory">Subcategory</label>
            <select name="subcategory_id" id="subcategory_id" class="form-control" required>
                <option value="">Select Subcategory</option>
            </select>
        </div>

        <!-- Product Name -->
        <div class="form-group mt-3">
            <label for="name">Product Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <!-- Description -->
        <div class="form-group mt-3">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" rows="4"></textarea>
        </div>

        <!-- Price -->
        <div class="form-group mt-3">
            <label for="price">Price</label>
            <input type="number" name="price" class="form-control" required min="1">
        </div>

        <!-- Quantity -->
        <div class="form-group mt-3">
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" class="form-control" required min="1">
        </div>

        <!-- Product Image -->
        <div class="form-group mt-3">
            <label for="image">Product Image</label>
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-success mt-3">Add Product</button>
    </form>
</div>

<script>
    document.getElementById('category').addEventListener('change', function() {
        var categoryId = this.value;
        var subcategorySelect = document.getElementById('subcategory_id');
        subcategorySelect.innerHTML = '<option value="">Select Subcategory</option>'; // Reset the subcategory dropdown

        if (categoryId) {
            // Make a GET request to fetch subcategories
            fetch('/admin/subcategories/' + categoryId)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        // Populate subcategories if available
                        data.forEach(function(subcategory) {
                            var option = document.createElement('option');
                            option.value = subcategory.id;
                            option.textContent = subcategory.name;
                            subcategorySelect.appendChild(option);
                        });
                    } else {
                        // If no subcategories are found, display a message
                        subcategorySelect.innerHTML = '<option value="">No subcategories available</option>';
                    }
                })
                .catch(error => {
                    // console.error('Error loading subcategories:', error);
                    subcategorySelect.innerHTML = '<option value="">Error loading subcategories</option>';
                });
        }
    });
</script>

@endsection
