@include('layouts.header')
<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
    <!-- Add Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            width: 90%;
            margin: 0 auto;
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
            font-size: 28px;
            font-weight: bold;
        }

        .product-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .product-card {
            background-color: #fff;
            padding: 15px;
            margin: 10px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
            transition: transform 0.2s;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-card img {
            width: 100%;
            height: 200px;
            border-radius: 5px;
            object-fit: cover;
        }

        .product-card h3 {
            margin: 8px 0;
            font-size: 22px;
            color: #3498db;
            font-weight: bold;
        }

        table {
            width: 100%;
            margin: 10px 0;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
            font-size: 16px;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .btn-group {
            margin-top: 10px;
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .btn {
            padding: 8px 15px;
            margin: 5px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn:hover {
            background-color: #2980b9;
        }

        .btn-wishlist {
            background-color: #e74c3c;
        }

        .btn-wishlist:hover {
            background-color: #c0392b;
        }

        .btn i {
            margin-right: 5px;
        }

        .message {
            color: green;
            font-weight: bold;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Available Products</h2>

        @if (session('success'))
            <div class="message">{{ session('success') }}</div>
        @endif

        @if($products->isEmpty())
            <p>No products available.</p>
        @else
            <div class="product-grid">
                @foreach($products as $product)
                    <div class="product-card">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        @else
                            <p>No image available</p>
                        @endif
                        <h3>{{ $product->name }}</h3>

                        <table>
                            <tr>
                                <th>Description</th>
                                <td>{{ $product->description }}</td>
                            </tr>
                            <tr>
                                <th>Price</th>
                                <td>${{ number_format($product->price, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Quantity</th>
                                <td>{{ $product->quantity }}</td>
                            </tr>
                        </table>

                        <div class="btn-group">
                            <button class="btn"><i class="fa-solid fa-cart-plus"></i></button>
                            <button class="btn btn-wishlist"><i class="fa-solid fa-heart"></i></button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>
@include('layouts.footer')
