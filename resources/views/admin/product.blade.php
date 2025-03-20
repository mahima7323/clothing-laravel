<!-- @extends('layouts.admin_header')

@section('content')
<div class="container">
    <h2>Add New Product</h2>
    
    @if (session()->has('success'))
        <div class="message">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="error">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" placeholder="Enter product name" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" placeholder="Enter product description"></textarea>

        <label for="price">Price:</label>
        <input type="number" id="price" step="0.01" name="price" placeholder="Enter price" required>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" placeholder="Enter quantity" required>

        <label for="image">Image:</label>
        <input type="file" id="image" name="image" accept="image/*" required>

        <button type="submit">Add Product</button>
    </form>
</div>

<style>
    .container {
        max-width: 600px;
        margin: 20px auto;
        background-color: #333;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
        font-size: 28px;
        color: #f4f4f4;
    }

    label {
        font-weight: bold;
        margin: 8px 0;
        display: block;
        color: #f4f4f4;
    }

    input, textarea {
        width: 100%;
        margin: 8px 0;
        padding: 10px;
        border-radius: 4px;
        border: 1px solid #555;
        background-color: #222;
        color: #f4f4f4;
    }

    input[type="file"] {
        padding: 5px;
    }

    button {
        width: 100%;
        background-color: #3498db;
        color: white;
        padding: 12px;
        margin-top: 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    button:hover {
        background-color: #2980b9;
    }

    .message {
        color: #2ecc71;
        margin-bottom: 10px;
        text-align: center;
        font-size: 18px;
        font-weight: bold;
    }

    .error {
        color: #e74c3c;
        margin-bottom: 10px;
        text-align: center;
        font-size: 16px;
        font-weight: bold;
    }
</style>
@endsection -->
