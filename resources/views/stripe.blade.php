<!DOCTYPE html>
<html>
<head>
    <title>Stripe Payment</title>
</head>
<body>
    <h2>Stripe Test Payment</h2>

    <form action="{{ route('stripe.checkout') }}" method="POST">
        @csrf
        <button type="submit">Pay ₹100</button>
    </form>
</body>
</html>
