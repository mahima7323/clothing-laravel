<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    @vite('resources/js/admin.js')
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #2c2c2c;
            margin: 0;
            padding: 0;
            color: #f4f4f4;
        }

        .navbar {
            background-color: #1a1a1a;
            color: #f4f4f4;
            padding: 15px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        }

        .navbar h2 {
            margin: 0;
            font-size: 28px;
            font-weight: bold;
        }

        .sidebar {
            width: 250px;
            background-color: #1a1a1a;
            position: fixed;
            height: 100%;
            padding: 20px 0;
            color: #f4f4f4;
        }

        .sidebar a {
            display: block;
            padding: 15px 20px;
            color: #f4f4f4;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .sidebar a:hover, .sidebar a.active {
            background-color: #555;
            font-weight: bold;
        }

        .dropdown {
            cursor: pointer;
            padding: 15px 20px;
            display: block;
            background-color: #1a1a1a;
            color: #f4f4f4;
        }

        .dropdown:hover {
            background-color: #555;
        }

        .submenu {
            display: none;
            background-color: #333;
            padding-left: 20px;
        }

        .submenu a {
            font-size: 14px;
            color: #ddd;
            padding: 10px 20px;
            display: block;
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
            width: 100%;
            text-align: center;
        }

        .logout-btn:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <a href="{{ route('admin.dashboard') }}" class="{{ request()->is('admin') ? 'active' : '' }}">Dashboard</a>
    
    <div class="dropdown">Categories</div>
    <div class="submenu">
        <a href="{{ route('admin.categories.index') }}">Category Index</a>
        <a href="{{ route('admin.categories.create') }}">Add Category</a>
    </div>
    
    <div class="dropdown">Subcategories</div>
    <div class="submenu">
        <a href="{{ route('admin.subcategories.index') }}">Subcategory Index</a>
        <a href="{{ route('admin.subcategories.create') }}">Add Subcategory</a>
    </div>
    
    <div class="dropdown">Products</div>
    <div class="submenu">
        <a href="{{ route('admin.products.index') }}">Product Index</a>
        <a href="{{ route('admin.products.create') }}">Add Product</a>
    </div>
    
    <a href="{{ route('admin.users') }}">User Management</a>
    <a href="{{ route('admin.orders.index') }}" class="{{ request()->is('admin/orders') ? 'active' : '' }}">Orders</a>

    <a href="#">Reports</a>
    <a href="#">Settings</a>
    
    <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="logout-btn">Logout</button>
    </form>
</div>

<div class="content">
    @yield('content')
</div>

<script>
    $(document).ready(function () {
        $('.dropdown').click(function () {
            $(this).next('.submenu').slideToggle();
        });
    });
</script>

</body>
</html>