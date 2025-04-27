@extends('layouts.admin_header')

@section('content')

<div class="container">
    <h2 class="page-title">Order List</h2>

    <!-- Filter Buttons -->
    <div class="d-flex justify-content-center mb-3">
        <form action="{{ route('admin.orders.index') }}" method="GET" class="mx-2">
            <button type="submit" name="status" value="Pending" class="btn btn-primary">Pending Orders</button> <!-- Changed btn-info to btn-primary -->
        </form>
        <form action="{{ route('admin.orders.index') }}" method="GET" class="mx-2">
            <button type="submit" name="status" value="Completed" class="btn btn-success">Completed Orders</button>
        </form>
        <form action="{{ route('admin.orders.index') }}" method="GET" class="mx-2">
            <button type="submit" name="status" value="Cancelled" class="btn btn-danger">Cancelled Orders</button>
        </form>
    </div>

    @if($orders->isEmpty())
        <div class="alert alert-info text-center">
            No orders available at the moment.
        </div>
    @else
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Products</th>
                    <th>Quantity</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th>Ordered At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr @if($order->status == 'Pending') class="table-warning" @endif>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name ?? 'N/A' }}</td>
                        <td>
                            @foreach($order->orderItems as $item)
                                {{ $item->product->name ?? 'N/A' }} (₹{{ number_format($item->price, 2) }})<br>
                            @endforeach
                        </td>
                        <td>
                            @foreach($order->orderItems as $item)
                                {{ $item->quantity }}<br>
                            @endforeach
                        </td>
                        <td>
                            @php
                                $totalAmount = $order->orderItems->sum(function($item) {
                                    return $item->quantity * $item->price;
                                });
                            @endphp
                            ₹{{ number_format($totalAmount, 2) }}
                        </td>
                        <td>
                            <span class="badge 
                                @if($order->status == 'Pending') badge-info 
                                @elseif($order->status == 'Completed') badge-success 
                                @elseif($order->status == 'Cancelled') badge-danger 
                                @else badge-secondary @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>
                        
                        <td>
                            @if($order->status == 'Pending')
                                <form action="{{ route('admin.updateOrderStatus', $order->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success">Mark as Completed</button>
                                </form>

                                <form action="{{ route('admin.cancelOrderStatus', $order->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-danger">Cancel Order</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <div class="pagination">
        {{ $orders->links() }}
    </div>
</div>

<!-- Dark Theme CSS -->
<style>
    body {
        background-color: #121212;
        color: #f1f1f1;
        font-family: 'Poppins', sans-serif;
    }

    .container {
        margin: 30px auto;
        max-width: 1100px;
        padding: 25px;
        background-color: #1e1e2f;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .page-title {
        text-align: center;
        font-size: 28px;
        margin-bottom: 25px;
        font-weight: 600;
        color: #ffffff;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        color: #f1f1f1;
        table-layout: auto;
    }

    table th {
        background-color: #343a40;
        color: #ffffff;
        padding: 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    table td {
        background-color: #2c2f4a;
        border: 1px solid #444;
        padding: 12px;
        text-align: center;
        vertical-align: middle;
    }

    table tbody tr:hover {
        background-color: #3a3f5c;
    }

    .badge {
        font-size: 12px;
        padding: 5px 12px;
        border-radius: 4px;
        text-transform: capitalize;
    }

    .badge-info {
        background-color: #3498db;
    }

    .badge-success {
        background-color: #2ecc71;
    }

    .badge-danger {
        background-color: #e74c3c;
    }

    .badge-secondary {
        background-color: #95a5a6;
    }

    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
        flex-wrap: wrap;
    }

    .pagination a,
    .pagination span {
        display: inline-block;
        padding: 6px 12px;
        margin: 4px;
        font-size: 14px;
        color: #007bff;
        text-decoration: none;
        border: 1px solid #444;
        border-radius: 4px;
        background-color: #1e1e2f;
    }

    .pagination a:hover,
    .pagination .active span {
        background-color: #007bff;
        color: white;
    }

    .pagination svg {
        width: 18px;
        height: 18px;
        vertical-align: middle;
    }

    button {
        border: 1px solid transparent;
        border-radius: 4px;
        padding: 10px 20px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
    }

    button.btn-primary {
        background-color: #007bff;  /* Changed to blue for Pending */
        color: #fff;
    }

    button.btn-success {
        background-color: #27ae60;
        color: #fff;
    }

    button.btn-danger {
        background-color: #c0392b;
        color: #fff;
    }

    button:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }

    button:active {
        background-color: #34495e;
        box-shadow: none;
    }

    button:focus {
        outline: none;
        box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.8);
    }

    button:disabled {
        background-color: #7f8c8d;
        cursor: not-allowed;
    }

    form {
        display: inline-block;
        margin-right: 12px;
    }
</style>

@endsection
