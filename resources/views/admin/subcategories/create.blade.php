@extends('layouts.admin_header')

@section('content')
<style>
    .container {
        padding: 20px;
        max-width: 600px;
        margin: 0 auto;
        background-color: #f8f9fa;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h2 {
        font-size: 28px;
        margin-bottom: 20px;
        text-align: center;
        color: #2c3e50; /* ગાઢ વાદળી કલર */
    }

    form {
        margin-top: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        font-weight: bold;
        margin-bottom: 5px;
        display: block;
        color: #34495e; /* ગાઢ ધૂળિયા કલર */
    }

    .form-group input, .form-group select {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        margin-top: 5px;
        transition: border-color 0.3s;
        color: #333; /* કાળો કલર */
    }

    .form-group input:focus, .form-group select:focus {
        border-color: #007bff;
        outline: none;
    }

    button {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        width: 100%;
        margin-top: 10px;
        transition: background-color 0.3s;
        font-weight: bold;
    }

    button:hover {
        background-color: #0056b3;
        cursor: pointer;
    }
</style>

<div class="container">
    <h2>Create Subcategory</h2>

    <form action="{{ route('admin.subcategories.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Subcategory Name:</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Enter Subcategory Name" required>
        </div>

        <div class="form-group">
            <label for="category_id">Category:</label>
            <select id="category_id" name="category_id" class="form-control" required>
                <option value="" disabled selected>Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create Subcategory</button>
    </form>
</div>
@endsection
