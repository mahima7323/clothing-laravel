@include('layouts.header')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Product List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .section-title {
            text-align: center;
            margin-top: 30px;
            margin-bottom: 20px;
            font-weight: bold;
            color: #333;
        }

        .filter-box {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }

        .product-card {
            background-color: #fff;
            padding: 15px;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .product-card img {
            width: 100%;
            height: 220px;
            border-radius: 10px;
            object-fit: cover;
            margin-bottom: 15px;
        }

        .product-card h5 {
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: #333;
        }

        .product-card p {
            font-size: 0.95rem;
            color: #555;
        }

        .price {
            font-size: 1.1rem;
            font-weight: bold;
            color: #28a745;
            margin: 10px 0;
        }

        .btn-cart,
        .btn-wishlist {
            width: 48%;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Display Success Message -->
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <h2>Order Summary</h2>

        @if($order)
        <h1 class="section-title">Order Success</h1>
        <p class="text-center">Thank you for your order! Your order has been successfully placed.</p>
        <p class="text-center">Order ID: <strong>{{ $order->id }}</strong></p>
        <p class="text-center">Order Date: <strong>{{ $order->created_at->format('d M Y, H:i') }}</strong></p>
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderItems as $item)
                <tr>
                    <td>{{ $item->product->name ?? 'Product not found' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>₹{{ number_format($item->price, 2) }}</td>
                    <td>₹{{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <p><strong>Grand Total: ₹{{ number_format($order->total_price, 2) }}</strong></p>
        @else
        <p>No order found. Please place an order first.</p>
        @endif
    </div>
</body>

</html>
@include('layouts.footer')