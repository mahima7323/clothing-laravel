@extends('layouts.app') <!-- Replace with your layout file -->

@section('content')
<div class="container">
    <h2>Order Summary</h2>

    @if($order)
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
@endsection
