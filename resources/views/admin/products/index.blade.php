@extends('layouts.admin_header')

@section('content')

<div class="container">
    <h2 class="page-title">Product List</h2>

    <!-- Product Table -->
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
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
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width: 50px; height: auto;">
                    @else
                        No Image
                    @endif
                </td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ $product->subcategory->name }}</td>
                <td>₹{{ number_format($product->price, 2) }}</td>
                <td>
                    <!-- Edit Button (Green) -->
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-edit btn-sm">
                        <i class="fa fa-pencil"></i>
                    </a>

                    <!-- Delete Button (Red) -->
                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">
                            <i class="fa fa-trash"></i> 
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
        margin: 30px auto;
        max-width: 1100px;
        padding: 25px;
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
        table-layout: auto;
    }

    table th {
        background-color: #343a40;
        color: #ffffff;
        padding: 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    table td {
        background-color: #2c2f4a;
        border: 1px solid #444;
        padding: 12px;
        text-align: center;
        vertical-align: middle;
    }

    table tbody tr:hover {
        background-color: #3a3f5c;
    }

    .badge {
        font-size: 12px;
        padding: 5px 12px;
        border-radius: 4px;
        text-transform: capitalize;
    }

    .badge-info {
        background-color: #3498db;
    }

    .badge-success {
        background-color: rgb(6, 114, 51);
    }

    .badge-danger {
        background-color: rgb(145, 22, 8);
    }

    .badge-secondary {
        background-color: #95a5a6;
    }

    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
        flex-wrap: wrap;
    }

    .pagination a,
    .pagination span {
        display: inline-block;
        padding: 6px 12px;
        margin: 4px;
        font-size: 14px;
        color: #007bff;
        text-decoration: none;
        border: 1px solid #444;
        border-radius: 4px;
        background-color: #1e1e2f;
    }

    .pagination a:hover,
    .pagination .active span {
        background-color: #007bff;
        color: white;
    }

    .pagination svg {
        width: 18px;
        height: 18px;
        vertical-align: middle;
    }

    /* Buttons Style - Square corners */
    .btn-edit {
        background-color: #28a745; /* Green */
        border: 1px solid #218838; /* Darker green border */
        color: white;
        font-size: 14px;
        padding: 10px 15px;
        text-decoration: none;
        transition: all 0.3s ease-in-out;
    }

    .btn-edit:hover {
        background-color: #218838; /* Darker Green */
        transform: translateY(-3px);
    }

    .btn-edit i {
        margin-right: 5px;
    }

    .btn-delete {
        background-color: #dc3545; /* Red */
        border: 1px solid #c82333; /* Darker red border */
        color: white;
        font-size: 14px;
        padding: 10px 15px;
        text-decoration: none;
        transition: all 0.3s ease-in-out;
    }

    .btn-delete:hover {
        background-color: #c82333; /* Darker Red */
        transform: translateY(-3px);
    }

    .btn-delete i {
        margin-right: 5px;
    }

    @media (max-width: 768px) {
        .container {
            padding: 15px;
        }

        table th, table td {
            font-size: 12px;
            padding: 10px;
        }

        .pagination a,
        .pagination span {
            font-size: 12px;
            padding: 5px 10px;
        }
    }
</style>

@endsection
