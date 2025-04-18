@include('layouts.header')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Address</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .form-container {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 50px auto;
        }

        .form-container h3 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
            color: #333;
        }

        .form-container label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        .form-container input,
        .form-container textarea {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            width: 100%;
            margin-bottom: 15px;
            font-size: 16px;
        }

        .form-container button {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .form-container button:hover {
            background-color: #218838;
        }

        .form-container .alert {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h3>Shipping Address</h3>

            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form id="address-form" action="{{ route('order.place') }}" method="POST">
                @csrf
                <label for="fullname">Full Name:</label>
                <input type="text" name="fullname" id="fullname" placeholder="Enter your full name" required>

                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="Enter your email address" required>

                <label for="address">Address:</label>
                <textarea name="address" id="address" placeholder="Enter your address" rows="3" required></textarea>

                <label for="city">City:</label>
                <input type="text" name="city" id="city" placeholder="Enter your city" required>

                <label for="pincode">Pincode:</label>
                <input type="text" name="pincode" id="pincode" placeholder="Enter your pincode" required>

                <label for="phone">Phone:</label>
                <input type="text" name="phone" id="phone" placeholder="Enter your phone number" required>

                <button type="submit">Submit Order</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>
@include('layouts.footer')