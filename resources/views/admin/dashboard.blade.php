@extends('layouts.admin_header')

@section('content')

<!-- Include SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                title: "Success!",
                text: "{{ session('success') }}",
                icon: "success",
                confirmButtonText: "OK"
            });
        });
    </script>
@endif

@if(session('error'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                title: "Error!",
                text: "{{ session('error') }}",
                icon: "error",
                confirmButtonText: "Try Again"
            });
        });
    </script>
@endif

<style>
    body {
        background-color: #181c27;
        font-family: 'Poppins', sans-serif;
        color: white;
    }

    .dashboard-container {
        padding: 20px;
    }

    .cards-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 20px;
    }

    .card {
        background: #222b3c;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }

    .card h3 {
        font-size: 18px;
        color: #f1c40f;
    }

    .card p {
        font-size: 24px;
        font-weight: bold;
        margin-top: 10px;
    }

    .chart-container {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 20px;
    }

    .chart-card {
        background: #222b3c;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }

    @media (max-width: 768px) {
        .chart-container {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="dashboard-container">
    <h2 class="text-center mb-4">Admin Dashboard</h2>

    <div class="cards-container">
        <div class="card">
            <h3>Total Products</h3>
            <p>{{ $totalProducts }}</p>
        </div>
        <div class="card">
            <h3>Total Users</h3>
            <p>{{ $totalUsers }}</p>
        </div>
        <div class="card">
            <h3>Total Orders</h3>
            <p>{{ $totalOrders }}</p>
        </div>
        <div class="card">
            <h3>Total Revenue</h3>
            <p>{{ number_format($totalRevenue, 2) }}/-</p>
        </div>
        <div class="card">
            <h3>Total Categories</h3>
            <p>{{ $totalCategories }}</p>
        </div>
        <div class="card">
            <h3>Total Sub-Categorey</h3>
            <p>{{ $totalSubcategories }}</p>
        </div>
    </div>

    <!-- <div class="chart-container">
        <div class="chart-card">
            <h3>Sales Reports</h3>
            <canvas id="salesChart"></canvas>
        </div>
        <div class="chart-card">
            <h3>Transaction Analytics</h3>
            <canvas id="transactionChart"></canvas>
        </div>
    </div> -->
</div>

<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Sales',
                data: [1200, 1900, 3000, 2500, 2200, 2800],
                borderColor: '#f1c40f',
                backgroundColor: 'rgba(241, 196, 15, 0.2)',
                fill: true
            }]
        },
        options: {
            responsive: true
        }
    });

    const ctx2 = document.getElementById('transactionChart').getContext('2d');
    new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: ['Safe', 'Distribute', 'Return'],
            datasets: [{
                data: [85, 10, 5],
                backgroundColor: ['#2ecc71', '#e74c3c', '#f1c40f']
            }]
        },
        options: {
            responsive: true
        }
    });
</script> -->
<br><br><br><br>

@include('layouts.footer')

@endsection