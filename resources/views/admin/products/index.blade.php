@extends('layouts.admin_header')

@section('content')

<div class="container">
    <h2 class="page-title">Product List</h2>

    <!-- Product Table -->
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th> <!-- New Column for Image -->
                <th>Name</th>
                <th>Category</th>
                <th>Subcategory</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>
                        <!-- Display Image if exists -->
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width: 50px; height: auto;">
                        @else
                            No Image
                        @endif
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->subcategory->name }}</td>
                    <td>{{ number_format($product->price, 2) }}</td>
                    <td>
                        <!-- Edit Button -->
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-success btn-sm">
                            <i class="fas fa-pen"></i> Edit
                        </a>

                        <!-- Delete Button -->
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="pagination">
        {{ $products->links() }}
    </div>
</div>

<!-- Dark Theme CSS -->
<style>
    body {
        background-color: #121212;
        color: #f1f1f1;
        font-family: 'Poppins', sans-serif;
    }

    .container {
        margin-top: 30px;
        max-width: 1200px;
        padding: 30px;
        background-color: #1e1e2f;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .page-title {
        text-align: center;
        font-size: 28px;
        margin-bottom: 25px;
        font-weight: 600;
        color: #ffffff;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        color: #f1f1f1;
    }

    table th {
        background-color: #343a40;
        color: #ffffff;
        padding: 14px;
        font-weight: 600;
    }

    table td {
        background-color: #2c2f4a;
        border: 1px solid #444;
        padding: 12px;
        text-align: center;
    }

    table tbody tr:hover {
        background-color: #3a3f5c;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        padding: 6px 12px;
        margin: 0 4px;
        font-size: 14px;
        border-radius: 4px;
        color: white;
        transition: all 0.3s ease-in-out;
    }

    .btn i {
        margin-right: 5px;
    }

    .btn-sm {
        font-size: 12px;
        padding: 5px 10px;
    }

    .btn-success {
        background-color: #28a745;
        border: none;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .pagination {
        text-align: center;
        margin-top: 20px;
    }

    .pagination a {
        padding: 8px 16px;
        margin: 0 4px;
        color: #007bff;
        text-decoration: none;
        border: 1px solid #444;
        border-radius: 4px;
        background-color: #1e1e2f;
    }

    .pagination a:hover,
    .pagination .active {
        background-color: #007bff;
        color: white;
    }

    @media (max-width: 768px) {
        .container {
            padding: 15px;
        }

        table th, table td {
            font-size: 12px;
            padding: 10px;
        }

        .btn-sm {
            font-size: 10px;
            padding: 4px 8px;
        }

        .pagination a {
            padding: 6px 12px;
        }
    }
</style>

@endsection
