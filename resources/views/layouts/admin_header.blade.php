<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    @vite('resources/js/admin.js')
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
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

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .content h3 {
            color: #f4f4f4;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .card {
            background-color: #333;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .card h4 {
            color: #f4f4f4;
        }

        .card p {
            color: #ddd;
        }

        .logout-btn {
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 20px; /* Ensure spacing from other elements */
            width: 100%; /* Make the button span the width of the sidebar */
            text-align: center;
        }

        .logout-btn:hover {
            background-color: #c0392b;
        }

        .submenu {
            padding-left: 20px;
            background-color: #333;
        }

        .submenu a {
            font-size: 14px;
            color: #ddd;
        }

        .submenu a:hover {
            background-color: #444;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <a href="{{ route('admin.dashboard') }}" class="{{ request()->is('admin') ? 'active' : '' }}">Dashboard</a>
    <a href="{{ route('admin.categories.index') }}" class="{{ request()->is('admin/categories') ? 'active' : '' }}">Categories</a>
    <div class="submenu">
        <a href="{{ route('admin.categories.index') }}">Category Index</a>
        <a href="{{ route('admin.categories.create') }}">Add Category</a>
    </div>
    <a href="{{ route('admin.subcategories.index') }}" class="{{ request()->is('admin/subcategories') ? 'active' : '' }}">Subcategories</a>
    <div class="submenu">
        <a href="{{ route('admin.subcategories.index') }}">Subcategory Index</a>
        <a href="{{ route('admin.subcategories.create') }}">Add Subcategory</a>
    </div>
    <a href="{{ route('admin.products.index') }}" class="{{ request()->is('admin/products') ? 'active' : '' }}">Products</a>
    <div class="submenu">
        <a href="{{ route('admin.products.index') }}">Product Index</a>
        <a href="{{ route('admin.products.create') }}">Add Product</a>
    </div>
    <a href="{{ route('admin.users') }}" class="{{ request()->is('admin/users') ? 'active' : '' }}">User Management</a>
    <a href="#">Orders</a>
    <a href="#">Reports</a>
    <a href="#">Settings</a>
    
    <!-- Logout Button -->
    <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="logout-btn">Logout</button>
    </form>
</div>

<div class="content">
    @yield('content')
</div>

</body>
</html>
