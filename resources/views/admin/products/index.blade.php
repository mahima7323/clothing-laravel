@extends('layouts.admin_header')

@section('content')

<style>
    body {
        background-color: #121212;
        font-family: 'Poppins', sans-serif;
        color: #f1f1f1;
    }

    .container {
        max-width: 1200px;
        margin: auto;
        padding: 30px;
        border-radius: 10px;
        background-color: #1e1e2f;
    }

    h2 {
        font-weight: 600;
        color: #ffffff;
        text-align: center;
        margin-bottom: 30px;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        padding: 10px 20px;
        font-weight: 500;
        border-radius: 6px;
        color: white;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .alert-success {
        text-align: center;
        padding: 12px;
        border-radius: 5px;
        font-weight: bold;
        background-color: #28a745;
        color: white;
        border: 1px solid #28a745;
    }

    .product-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 10px;
        color: #f1f1f1;
    }

    .product-table th {
        background-color: #343a40;
        color: #f8f9fa;
        padding: 12px;
        text-align: center;
        border-radius: 5px 5px 0 0;
    }

    .product-table td {
        background-color: #2c2f4a;
        padding: 12px;
        text-align: center;
        border: 1px solid #3e415a;
    }

    .product-table img {
        border-radius: 5px;
        width: 60px;
        height: 60px;
        object-fit: cover;
    }

    .btn {
        padding: 6px 14px;
        font-size: 14px;
        border-radius: 6px;
        color: white;
    }

    .btn-edit-green {
        background-color: #28a745;
        border: none;
    }

    .btn-edit-green:hover {
        background-color: #218838;
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    @media (max-width: 768px) {
        .product-table, .product-table thead, .product-table tbody, .product-table th, .product-table td, .product-table tr {
            display: block;
        }

        .product-table tr {
            margin-bottom: 15px;
        }

        .product-table td {
            text-align: right;
            padding-left: 50%;
            position: relative;
        }

        .product-table td::before {
            content: attr(data-label);
            position: absolute;
            left: 10px;
            text-align: left;
            font-weight: bold;
            color: #aaa;
        }
    }
</style>

<div class="container">
    <h2>Product List</h2>

    <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">+ Add Product</a>

    @if (session('success'))
        <div class="alert-success mb-3">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="product-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Subcategory</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td data-label="ID">{{ $product->id }}</td>
                        <td data-label="Category">{{ $product->category->name }}</td>
                        <td data-label="Subcategory">{{ $product->subcategory->name }}</td>
                        <td data-label="Name">{{ $product->name }}</td>
                        <td data-label="Price">₹{{ number_format($product->price, 2) }}</td>
                        <td data-label="Quantity">{{ $product->quantity }}</td>
                        <td data-label="Image">
                            @if($product->image)
                                <img src="{{ asset("storage/{$product->image}") }}" alt="Product Image">
                            @endif
                        </td>
                        <td data-label="Actions">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-edit-green">Edit</a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete this product?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
