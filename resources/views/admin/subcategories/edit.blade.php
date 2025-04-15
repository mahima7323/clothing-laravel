@extends('layouts.admin_header')

@section('content')
    <div class="container mt-5">
        <h2>Edit Subcategory</h2>
        <form action="{{ route('admin.subcategories.update', $subcategory->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Subcategory Name:</label>
                <input type="text" id="name" name="name" class="form-control input-lg" value="{{ $subcategory->name }}" required>
            </div>

            <div class="form-group mt-3">
                <label for="category_id">Category:</label>
                <select id="category_id" name="category_id" class="form-control input-lg" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $subcategory->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-4">Update Subcategory</button>
        </form>
    </div>

    <!-- Inline CSS -->
    <style>
        .container {
            max-width: 800px;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        h2 {
            font-size: 28px;
            margin-bottom: 25px;
            color: #333;
            text-align: center;
        }

        .form-group label {
            font-size: 17px;
            color: #444;
            margin-bottom: 10px;
            display: block;
        }

        .form-control {
            width: 100%;
            font-size: 16px;
            padding: 12px 14px;
            border-radius: 6px;
            border: 1px solid #ccc;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.4);
        }

        button[type="submit"] {
            background-color: #007bff;
            border: none;
            color: white;
            padding: 14px;
            font-size: 17px;
            border-radius: 6px;
            width: 100%;
            cursor: pointer;
            margin-top: 25px;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            h2 {
                font-size: 24px;
            }

            .form-control {
                font-size: 15px;
                padding: 10px;
            }

            button[type="submit"] {
                font-size: 16px;
                padding: 12px;
            }
        }
    </style>
@endsection
