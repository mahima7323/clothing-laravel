@include('layouts.header')

<div class="container">
    <h2>Order Placed Successfully! 🎉</h2>
    <p>Thank you for shopping with us. Your order has been placed successfully.</p>
    <a href="{{ route('home') }}" class="btn btn-primary">Continue Shopping</a>
</div>

@include('layouts.footer')
