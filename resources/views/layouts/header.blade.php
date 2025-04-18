<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Panel</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f4f4f4;
        }

        header {
            background-color: #000;
            color: #fff;
            padding: 25px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .logo img {
            height: 80px;
            width: 80px;
            border-radius: 50%;
            border: 3px solid #fff;
            transition: transform 0.3s ease;
        }

        .logo img:hover {
            transform: scale(1.1);
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 30px;
        }

        nav ul li {
            display: inline-block;
        }

        nav ul li a {
            text-decoration: none;
            color: #fff;
            padding: 12px 24px;
            border-radius: 30px;
            background-color: rgba(255, 255, 255, 0.1);
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        nav ul li a:hover {
            background-color: rgba(255, 255, 255, 0.3);
            transform: scale(1.05);
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .icons {
            display: flex;
            gap: 15px;
            align-items: center;
            margin-top: 10px; /* Adjusted to move icons down */
        }

        .icon {
            text-decoration: none;
            color: #fff;
            font-size: 22px;
            transition: transform 0.3s ease;
        }

        .icon:hover {
            transform: scale(1.2);
            color:rgb(196, 70, 39);
        }

        .user-section {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        .user-greeting {
            color: #e74c3c; /* Red color for the name */
            font-size: 22px; /* Larger font size */
            font-weight: bold; /* Bold font weight */
            margin-bottom: 5px;
        }

        .btn-logout {
            background-color: #e74c3c;
            padding: 10px 20px;
            border-radius: 30px;
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px; /* Space between text and icon */
        }

        .btn-logout:hover {
            background-color: #c0392b;
            transform: scale(1.05);
        }

        .btn-logout i {
            font-size: 18px; /* Icon size */
        }

        @media screen and (max-width: 768px) {
            header {
                flex-direction: column;
                align-items: center;
                padding: 20px;
                gap: 20px;
            }

            nav ul {
                flex-direction: column;
                gap: 15px;
                align-items: center;
            }

            .header-right {
                flex-direction: column;
                align-items: center;
            }

            .user-section {
                align-items: center;
            }

            .user-greeting {
                color: #e74c3c; /* Red color for the name */
                font-size: 18px; /* Larger font size for smaller screens */
                font-weight: bold; /* Bold font weight */
                margin-bottom: 5px;
            }
        }
    </style>
</head>
<body>

<header>
    <div class="logo">
        <img src="https://img.freepik.com/premium-vector/circle-floral-fashion-store-hanger-logo-design-vector_680355-4.jpg" alt="Logo">
    </div>

    <nav>
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/product_list">Products</a></li>
            <li><a href="/about">About Us</a></li>
            <li><a href="/contact">Contact Us</a></li>
            <li><a href="/feedback">Feedback</a></li>
            <li><a href="/order_success">Orders</a></li>

        </ul>
    </nav>

    <div class="header-right">
        <div class="icons">
            <a href="{{ route('wishlist.view') }}" class="icon">
                <i class="fa-solid fa-heart"></i>
            </a>
            <a href="{{ route('cart.page') }}" class="icon">
                <i class="fa-solid fa-cart-shopping"></i>
            </a>
        </div>

        <div class="user-section">
            @if(Auth::check())
            <div class="user-greeting">
                Hello, {{ Auth::user()->name }}!
            </div>
            @endif

            <a href="#" class="btn-logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>

    </div>
</header>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
</body>
</html>
