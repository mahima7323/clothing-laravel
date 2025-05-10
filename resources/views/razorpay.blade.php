<!DOCTYPE html>
<html>
<head>
    <title>Razorpay Payment</title>
</head>
<body>
    <h2>Razorpay Test Payment</h2>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif
    @if(session('error'))
        <p style="color:red">{{ session('error') }}</p>
    @endif

    <form action="{{ route('razorpay.payment.store') }}" method="POST">
        @csrf
        <script src="https://checkout.razorpay.com/v1/checkout.js"
                data-key="{{ env('RAZORPAY_KEY') }}"
                data-amount="10000"
                data-currency="INR"
                data-buttontext="Pay ₹100"
                data-name="College Project"
                data-description="Test Payment"
                data-prefill.name="Test User"
                data-prefill.email="test@example.com"
                data-theme.color="#F37254">
        </script>
    </form>
</body>
</html>
