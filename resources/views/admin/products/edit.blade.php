@extends('layouts.admin_header')

@section('content')
    <div class="container mt-5">
        <h2>Edit Product</h2>
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="category">Category</label>
                <select name="category_id" id="category" class="form-control" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mt-3">
                <label for="subcategory">Subcategory</label>
                <select name="subcategory_id" id="subcategory" class="form-control" required>
                    @foreach($subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}" {{ $subcategory->id == $product->subcategory_id ? 'selected' : '' }}>
                            {{ $subcategory->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mt-3">
                <label for="name">Product Name</label>
                <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
            </div>

            <div class="form-group mt-3">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" rows="4">{{ $product->description }}</textarea>
            </div>

            <div class="form-group mt-3">
                <label for="price">Price</label>
                <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
            </div>

            <div class="form-group mt-3">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" class="form-control" value="{{ $product->quantity }}" required>
            </div>

            <div class="form-group mt-3">
                <label for="image">Product Image</label>
                <!-- Custom file input label -->
                <div class="custom-file">
                    <input type="file" name="image" class="form-control" id="image" onchange="updateFileName()">
                    <label for="image" id="fileLabel" class="custom-file-label">No file chosen</label>
                </div>
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" width="100" class="mt-2" alt="Product Image">
                @endif
            </div>

            <button type="submit" class="btn btn-primary mt-3">Update Product</button>
        </form>
    </div>

    <!-- Inline CSS -->
    <style>
        /* Container for the form */
        .container {
            max-width: 800px;
            margin-top: 30px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Heading styling */
        h2 {
            font-size: 26px;
            margin-bottom: 20px;
            color: #333;
            text-align: center;
            font-weight: bold;
        }

        /* Form field styling */
        .form-group label {
            font-size: 16px;
            color: #555;
            margin-bottom: 8px;
            display: block;
        }

        .form-control {
            border-radius: 4px;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ddd;
            transition: border-color 0.3s;
            width: 100%;
            box-sizing: border-box; /* Ensure padding is included in the width */
        }

        /* Focus effect on input fields */
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        /* Button styling */
        button[type="submit"] {
            background-color: #007bff;
            border: none;
            color: white;
            padding: 12px 24px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: block;
            width: 100%;
            margin-top: 20px;
        }

        /* Hover effect on button */
        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Image preview styling */
        img.mt-2 {
            display: block;
            margin-top: 10px;
        }

        /* Custom file input label */
        .custom-file-label {
            display: block;
            font-size: 14px;
            color: black; /* Black text color */
            margin-top: 10px;
        }

        /* Responsive styling */
        @media (max-width: 768px) {
            .container {
                width: 100%;
                padding: 15px;
            }

            h2 {
                font-size: 22px;
            }

            .form-control {
                font-size: 14px;
                padding: 10px;
            }

            button[type="submit"] {
                padding: 10px 20px;
            }
        }
    </style>

    <script>
        // Function to update the label text when a file is chosen
        function updateFileName() {
            var fileInput = document.getElementById('image');
            var fileLabel = document.getElementById('fileLabel');
            if (fileInput.files.length > 0) {
                fileLabel.textContent = fileInput.files[0].name;
            } else {
                fileLabel.textContent = "No file chosen";
            }
        }
    </script>
@endsection
