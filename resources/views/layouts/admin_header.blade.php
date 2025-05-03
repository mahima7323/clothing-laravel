<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    @vite('resources/js/admin.js')
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #2c2c2c;
            margin: 0;
            padding: 0;
            color: #f4f4f4;
        }

        .navbar {
            background: linear-gradient(90deg, #1a1a1a, #333);
            color: #f4f4f4;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
        }

        .navbar h2 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
            display: flex;
            align-items: center;
        }

        .navbar h2 i {
            margin-right: 10px;
            color: #4CAF50;
        }

        .profile {
            display: flex;
            align-items: center;
        }

        .profile img {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            margin-right: 10px;
            object-fit: cover;
            background-color: #fff;
        }

        .profile span {
            font-weight: 500;
        }

        .sidebar {
            width: 250px;
            background-color: #1a1a1a;
            position: fixed;
            height: 100%;
            padding-top: 20px;
            transition: all 0.3s ease;
        }

        .sidebar a, .dropdown {
            display: block;
            padding: 15px 25px;
            color: #f4f4f4;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .sidebar a:hover, .sidebar a.active, .dropdown:hover {
            background: linear-gradient(90deg, #4CAF50, #2ecc71);
            font-weight: 600;
            color: #fff;
        }

        .dropdown {
            cursor: pointer;
        }

        .submenu {
            display: none;
            background-color: #333;
            padding-left: 20px;
            transition: all 0.3s ease;
        }

        .submenu a {
            font-size: 14px;
            padding: 10px 20px;
            color: #ddd;
        }

        .submenu a:hover {
            background-color: #444;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .logout-btn {
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 80%;
            margin: 20px 10%;
            display: block;
        }

        .logout-btn:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<div class="navbar">
    <h2><i class="fa fa-dashboard"></i> Admin Panel</h2>
    <div class="profile">
        @if(Auth::check())
            <img src="https://www.shutterstock.com/image-vector/user-icon-trendy-flat-style-600nw-418179856.jpg" alt="Admin" style="width: 40px; height: 40px; border-radius: 50%;">

            <!-- <img src="{{ Auth::user()->profile_photo ? asset('storage/profile_photos/' . Auth::user()->profile_photo) : asset('default-admin.png') }}" alt="Admin"> -->
            <span>{{ Auth::user()->name }}</span>
        @else
            <img src="{{ asset('default-admin.png') }}" alt="Admin">
            <span>Admin</span>
        @endif
    </div>
</div>

<!-- Sidebar -->
<div class="sidebar">
    <a href="{{ route('admin.dashboard') }}" class="{{ request()->is('admin') ? 'active' : '' }}"><i class="fa fa-home"></i> Dashboard</a>
    
    <div class="dropdown"><i class="fa fa-list"></i> Categories</div>
    <div class="submenu">
        <a href="{{ route('admin.categories.index') }}">Category List</a>
        <a href="{{ route('admin.categories.create') }}">Add Category</a>
    </div>
    
    <div class="dropdown"><i class="fa fa-tags"></i> Sub-Category</div>
    <div class="submenu">
        <a href="{{ route('admin.subcategories.index') }}">Sub-Category List</a>
        <a href="{{ route('admin.subcategories.create') }}">Add Sub-Category</a>
    </div>
    
    <div class="dropdown"><i class="fa fa-cube"></i> Products</div>
    <div class="submenu">
        <a href="{{ route('admin.products.index') }}">Product List</a>
        <a href="{{ route('admin.products.create') }}">Add Product</a>
    </div>
    
    <a href="{{ route('admin.users') }}"><i class="fa fa-users"></i> Users</a>
    <a href="{{ route('admin.orders.index') }}" class="{{ request()->is('admin/orders') ? 'active' : '' }}"><i class="fa fa-shopping-cart"></i> Orders</a>
    <a href="{{ route('feedback.list') }}"><i class="fa fa-comments"></i> Feedbacks</a>
    <a href=""><i class="fa fa-bar-chart"></i> Reports</a>
    <a href="#"><i class="fa fa-cogs"></i> Settings</a>
    
    <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="logout-btn">Logout</button>
    </form>
</div>

<!-- Content -->
<div class="content">
    @yield('content')
</div>

<!-- jQuery for dropdown -->
<script>
    $(document).ready(function () {
        $('.dropdown').click(function () {
            $(this).next('.submenu').slideToggle(300);
            $('.submenu').not($(this).next('.submenu')).slideUp(300);
        });
    });
</script>

</body>
</html>
