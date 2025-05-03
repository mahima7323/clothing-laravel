@include('layouts.header')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Order Summary</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f2f4f8;
        }

        .section-title {
            text-align: center;
            margin: 30px 0;
            font-weight: bold;
            color: #2c3e50;
        }

        .order-summary-card {
            background-color: #ffffff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        }

        .table th, .table td {
            vertical-align: middle !important;
        }

        .grand-total {
            font-size: 1.3rem;
            font-weight: bold;
            color: #27ae60;
            text-align: right;
        }

        .order-details {
            margin-bottom: 20px;
            font-size: 1rem;
            color: #555;
        }

        .order-details strong {
            color: #000;
        }

        .thank-you-msg {
            font-size: 1.1rem;
            color: #34495e;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="order-summary-card">
            @if($order)
                <h2 class="section-title"><i class="fas fa-check-circle text-success"></i> Order Placed Successfully!</h2>
                <p class="text-center thank-you-msg">Thank you for your order! Your order has been successfully placed.</p>

                <div class="order-details row text-center">
                    <div class="col-md-6">
                        <p>Order ID: <strong>{{ $order->id }}</strong></p>
                    </div>
                    <div class="col-md-6">
                        <p>Order Date: <strong>{{ $order->created_at->format('d M Y, H:i') }}</strong></p>
                    </div>
                </div>

                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price (₹)</th>
                            <th>Total (₹)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->orderItems as $item)
                            <tr>
                                <td>{{ $item->product->name ?? 'Product not found' }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($item->price, 2) }}</td>
                                <td>{{ number_format($item->price * $item->quantity, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <p class="grand-total">Grand Total: ₹{{ number_format($order->total_price, 2) }}</p>
            @else
                <div class="alert alert-warning text-center">
                    No order found. Please place an order first.
                </div>
            @endif
        </div>
    </div>
</body>

</html>
@include('layouts.footer')
