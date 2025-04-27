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

<!-- FontAwesome CSS Link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    body {
        background: linear-gradient(to right, #141e30, #243b55);
        font-family: 'Poppins', sans-serif;
        color: white;
    }

    .dashboard-container {
        padding: 30px;
    }

    .cards-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 25px;
        margin-top: 30px;
    }

    .card {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 25px;
        text-align: center;
        box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.5);
    }

    .card i {
        font-size: 40px;
        margin-bottom: 15px;
        color: #f1c40f;
    }

    .card h3 {
        font-size: 20px;
        margin: 10px 0 5px;
        color: #ffffff;
    }

    .card p {
        font-size: 28px;
        font-weight: bold;
        margin-top: 5px;
        color: #1abc9c;
    }

    .chart-container {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 20px;
        margin-top: 40px;
    }

    .chart-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        padding: 20px;
        border-radius: 20px;
        text-align: center;
        box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
    }

    @media (max-width: 768px) {
        .chart-container {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="dashboard-container">
    <h2 class="text-center mb-4" style="font-size: 32px; color: #f1c40f;">Admin Dashboard</h2>

    <div class="cards-container">
        <div class="card">
            <i class="fa fa-box"></i>
            <h3>Total Products</h3>
            <p>{{ $totalProducts }}</p>
        </div>
        <div class="card">
            <i class="fa fa-users"></i>
            <h3>Total Users</h3>
            <p>{{ $totalUsers }}</p>
        </div>
        <div class="card">
            <i class="fa fa-shopping-cart"></i>
            <h3>Total Orders</h3>
            <p>{{ $totalOrders }}</p>
        </div>
        <div class="card">
            <i class="fa fa-dollar-sign"></i>
            <h3>Total Revenue</h3>
            <p>{{ number_format($totalRevenue, 2) }}/-</p>
        </div>
        <div class="card">
            <i class="fa fa-list"></i>
            <h3>Total Categories</h3>
            <p>{{ $totalCategories }}</p>
        </div>
        <div class="card">
            <i class="fa fa-tags"></i>
            <h3>Total Sub-Category</h3>
            <p>{{ $totalSubcategories }}</p>
        </div>
    </div>

    <!-- Future Chart Section
    <div class="chart-container">
        <div class="chart-card">
            <h3>Sales Reports</h3>
            <canvas id="salesChart"></canvas>
        </div>
        <div class="chart-card">
            <h3>Transaction Analytics</h3>
            <canvas id="transactionChart"></canvas>
        </div>
    </div>
    -->
</div>

<!-- Chart.js Scripts (optional)
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
</script>
-->

<br><br><br><br>

@include('layouts.footer')

@endsection
