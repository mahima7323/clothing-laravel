@extends('layouts.admin_header')

@section('content')
    <div class="container">
        <h2>Edit Category</h2>
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <!-- Inline CSS -->
    <style>
        /* Container for the form */
        .container {
            max-width: 600px;
            margin-top: 30px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Heading styling */
        h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        /* Form Styling */
        .form-control {
            border-radius: 4px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            transition: border-color 0.3s;
        }

        /* Focus Effect on Input */
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        /* Button Styling */
        button[type="submit"] {
            background-color: #007bff;
            border: none;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        /* Hover Effect on Button */
        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Responsive Form Styling */
        @media (max-width: 768px) {
            .container {
                width: 100%;
                padding: 10px;
            }

            h2 {
                font-size: 20px;
            }

            .form-control {
                font-size: 14px;
                padding: 8px;
            }

            button[type="submit"] {
                padding: 8px 16px;
            }
        }
    </style>
@endsection
