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
        <h2>Add Address</h2>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form id="address-form" action="{{ route('order.place') }}" method="POST" style="margin-top: 20px;">
            @csrf
            <h3>Shipping Address</h3>
            <div style="max-width: 500px; margin: 0 auto; text-align: left;">
                <label for="fullname">Full Name:</label><br>
                <input type="text" name="fullname" id="fullname" required style="width: 100%; padding: 8px;"><br><br>

                <label for="address">Address:</label><br>
                <textarea name="address" id="address" required style="width: 100%; padding: 8px;"></textarea><br><br>

                <label for="city">City:</label><br>
                <input type="text" name="city" id="city" required style="width: 100%; padding: 8px;"><br><br>

                <label for="pincode">Pincode:</label><br>
                <input type="text" name="pincode" id="pincode" required style="width: 100%; padding: 8px;"><br><br>

                <label for="phone">Phone:</label><br>
                <input type="text" name="phone" id="phone" required style="width: 100%; padding: 8px;"><br><br>

                <button type="submit" class="btn-success">Submit Order</button>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // When Place Order button is clicked
            $('#show-address-form').on('click', function() {
                // Hide the Place Order button
                $(this).hide();

                // Show the address form with an animation
                $('#address-form').slideDown();
            });
        });
    </script>

</body>

</html>
@include('layouts.footer')