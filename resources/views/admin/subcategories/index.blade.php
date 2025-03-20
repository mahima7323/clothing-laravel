@extends('layouts.admin_header')

@section('content')
    <div class="container mt-5">
        <h2>Subcategory List</h2>

        <!-- Subcategory Table -->
        <table class="table table-bordered table-striped table-hover">
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
                        <td>{{ $subcategory->category->name }}</td> <!-- Display related category name -->
                        <td>
                            <!-- Edit Link -->
                            <a href="{{ route('admin.subcategories.edit', $subcategory->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>

                            <!-- Delete Form -->
                            <form action="{{ route('admin.subcategories.destroy', $subcategory->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this subcategory?')">
                                    <i class="fas fa-trash-alt"></i> Delete
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

    <!-- Inline CSS -->
    <style>
        /* Container for the table */
        .container {
            max-width: 1200px;
            margin-top: 30px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Heading Styling */
        h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333; /* Changed font color to dark gray */
            text-align: center;
        }

        /* Table Styling */
        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }

        table th, table td {
            text-align: center;
            padding: 12px;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #007bff;
            color: white; /* White text for the table header */
        }

        table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tbody td {
            color: #555; /* Changed font color of the table body cells to a softer gray */
        }

        /* Button Styling */
        .btn {
            padding: 8px 16px;
            font-size: 14px;
            border-radius: 4px;
            text-align: center;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-warning {
            background-color: #ffc107;
            border: none;
            color: white;
        }

        .btn-warning:hover {
            background-color: #e0a800;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
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
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        .pagination a:hover {
            background-color: #0056b3;
        }

        /* Responsive Styling */
        @media (max-width: 768px) {
            .container {
                width: 100%;
                padding: 10px;
            }

            table th, table td {
                font-size: 12px;
            }

            .btn {
                font-size: 12px;
            }

            .pagination a {
                padding: 6px 12px;
            }
        }
    </style>
@endsection
