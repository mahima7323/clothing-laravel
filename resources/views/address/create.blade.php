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
        .form-container textarea,
        .form-container select {
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
            <h3>Add New Address</h3>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form id="address-form" action="{{ route('order.place') }}" method="POST">
                @csrf

                <!-- Hidden user_id (if user is logged in) -->
                <input type="hidden" name="user_id" value="{{ auth()->user()->id ?? '' }}">

                <label for="street">Street:</label>
                <input type="text" name="street" id="street" placeholder="Enter your street address" required>

                <label for="city">City:</label>
                <input type="text" name="city" id="city" placeholder="Enter your city" required>

                <label for="state">State:</label>
                <input type="text" name="state" id="state" placeholder="Enter your state" required>

                <label for="zip_code">Zip Code:</label>
                <input type="text" name="zip_code" id="zip_code" placeholder="Enter your zip code" required>

                <label for="country">Country:</label>
                <input type="text" name="country" id="country" placeholder="Enter your country" required>

                <button type="submit">Submit Address</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>

@include('layouts.footer')
