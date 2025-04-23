@extends('layouts.admin_header')

@section('content')
    <div class="container mt-5">
        <h2 class="page-title">Subcategory List</h2>

        <!-- Subcategory Table -->
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subcategories as $subcategory)
                    <tr>
                        <td>{{ $subcategory->id }}</td>
                        <td>{{ $subcategory->name }}</td>
                        <td>{{ $subcategory->category->name }}</td>
                        <td>
                            <!-- Edit Button (Green) -->
                            <a href="{{ route('admin.subcategories.edit', $subcategory->id) }}" class="btn btn-edit-green btn-sm">
                                <i class="fa fa-pencil"></i> Edit
                            </a>

                            <!-- Delete Button -->
                            <form action="{{ route('admin.subcategories.destroy', $subcategory->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this subcategory?')">
                                    <i class="fa fa-trash"></i> Delete
                                </button>
                            </form>

                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="pagination">
            {{ $subcategories->links() }}
        </div>
    </div>

    <!-- Dark Theme CSS -->
    <style>
        body {
            background-color: #121212;
            color: #f1f1f1;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            background-color: #1e1e2f;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            max-width: 1200px;
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
            margin: 20px 0;
            border-collapse: collapse;
            color: #f1f1f1;
        }

        table th {
            background-color: #007bff;
            color: #ffffff;
            padding: 14px;
            font-weight: bold;
        }

        table td {
            background-color: #2c2f4a;
            padding: 12px;
            border: 1px solid #444;
            text-align: center;
        }

        table tbody tr:hover {
            background-color: #3a3f5c;
        }

        .btn {
            padding: 6px 12px;
            font-size: 14px;
            border-radius: 4px;
            margin: 0 4px;
            display: inline-flex;
            align-items: center;
            color: white;
            transition: 0.3s ease;
        }

        .btn-sm {
            font-size: 12px;
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

        .btn i {
            margin-right: 5px;
        }

        .pagination {
            text-align: center;
            margin-top: 20px;
        }

        .pagination a {
            padding: 8px 16px;
            margin: 0 4px;
            background-color: #007bff;
            color: white;
            border-radius: 4px;
            text-decoration: none;
            border: 1px solid transparent;
        }

        .pagination a:hover,
        .pagination .active {
            background-color: #0056b3;
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            table th, table td {
                font-size: 12px;
                padding: 10px;
            }

            .btn {
                font-size: 12px;
                padding: 5px 10px;
            }

            .pagination a {
                padding: 6px 12px;
            }
        }
    </style>
@endsection
