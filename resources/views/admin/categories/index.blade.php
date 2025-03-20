@extends('layouts.admin_header')

@section('content')
<div class="container">
    <h2 class="page-title">Category List</h2>

    <!-- Category Table -->
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>
                    <!-- Edit Button with Pen Icon -->
                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-success btn-sm">
                        <i class="fas fa-pen"></i> Edit
                    </a>

                    <!-- Delete Button with Dustbin Icon -->
                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?')">
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
        {{ $categories->links() }}
    </div>
</div>

<!-- Custom CSS -->
<style>
    /* General Container Styling */
    .container {
        margin-top: 30px;
        max-width: 1200px;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Heading Styling */
    .page-title {
        text-align: center;
        font-size: 28px;
        margin-bottom: 20px;
        color: #333; /* Dark grey for title */
    }

    /* Table Styling */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    table th, table td {
        padding: 12px;
        text-align: center;
        border: 1px solid #ddd;
        color: #555; /* Dark grey for table text */
    }

    /* Table Header Styling */
    table th {
        background-color: #007bff;
        color: white;
        font-weight: bold;
    }

    /* Table Row Hover Effect */
    table tbody tr:hover {
        background-color: #f5f5f5;
    }

    /* Action Button Styling */
    .btn {
        display: inline-flex;
        align-items: center;
        padding: 6px 12px;
        margin: 0 5px;
        font-size: 14px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn i {
        margin-right: 5px;
    }

    /* Button Sizes */
    .btn-sm {
        font-size: 12px;
        padding: 6px 12px;
    }

    /* Button Hover Effects */
    .btn:hover {
        opacity: 0.85;
    }

    /* Edit Button */
    .btn-success {
        background-color: #28a745;
        color: white;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    /* Delete Button */
    .btn-danger {
        background-color: #dc3545;
        color: white;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    /* Pagination Styling */
    .pagination {
        text-align: center;
        margin-top: 20px;
    }

    .pagination a {
        padding: 8px 16px;
        margin: 0 4px;
        color: #007bff;
        text-decoration: none;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .pagination a:hover {
        background-color: #007bff;
        color: white;
    }

    .pagination .active {
        background-color: #007bff;
        color: white;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .container {
            width: 100%;
            padding: 10px;
        }

        table th, table td {
            font-size: 12px;
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
