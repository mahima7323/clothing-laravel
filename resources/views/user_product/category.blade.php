@include('layouts.header')

<!DOCTYPE html>
<html>
<head>
    <title>{{ ucfirst($categoryName) }} Collection</title>
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
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 20px;
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
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 280px;
            text-align: center;
            transition: transform 0.2s;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
        }

        .product-card h3 {
            margin: 8px 0;
            font-size: 20px;
            color: #3498db;
            font-weight: bold;
        }

        .product-card p {
            font-size: 16px;
            color: #555;
        }

        .btn {
            padding: 8px 15px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.2s;
            margin-top: 10px;
        }

        .btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>{{ ucfirst($categoryName) }} Collection</h2>

        @if($products->isEmpty())
            <p>No products available in this category.</p>
        @else
            <div class="product-grid">
                @foreach($products as $product)
                    <div class="product-card">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        <h3>{{ $product->name }}</h3>
                        <p>{{ $product->description }}</p>
                        <p>Price: ₹{{ number_format($product->price, 2) }}</p>
                        <button class="btn">Add to Cart</button>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</body>
</html>

@include('layouts.footer')
