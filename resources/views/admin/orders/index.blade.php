@extends('layouts.admin_header')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Order List</h2>

    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Ordered At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user->name ?? 'N/A' }}</td>
                <td>{{ $order->product->name ?? 'N/A' }}</td>
                <td>{{ $order->quantity }}</td>
                <td>₹{{ number_format($order->total_amount, 2) }}</td>
                <td>{{ ucfirst($order->status) }}</td>
                <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">No orders found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="pagination justify-content-center">
        {{ $orders->links() }}
    </div>
</div>

<style>
    body {
        background-color: #121212;
        color: #f1f1f1;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .container {
        background-color: #1e1e2f;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        max-width: 1200px;
    }

    h2 {
        font-size: 26px;
        color: #ffffff;
    }

    .table {
        color: #f1f1f1;
    }

    .table th {
        background-color: #007bff;
        color: #fff;
    }

    .table td {
        background-color: #2c2f4a;
        vertical-align: middle;
    }

    .pagination a {
        background-color: #007bff;
        color: #fff;
        padding: 8px 14px;
        margin: 0 2px;
        border-radius: 4px;
        text-decoration: none;
    }

    .pagination a:hover {
        background-color: #0056b3;
    }
</style>
@endsection
