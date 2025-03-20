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

    .btn-primary {
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
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
    <h2>Add New Category</h2>
    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf

        <!-- Category Name -->
        <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary mt-3">Add Category</button>
    </form>
</div>
@endsection
