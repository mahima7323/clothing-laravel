<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f4f4f4;
        }

        /* Header Styling */
        header {
            background: linear-gradient(135deg, #1e3c72, #2a5298); /* Blue gradient */
            color: #ffffff; /* White text for contrast */
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Subtle shadow */
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo img {
            height: 60px;
            width: 60px;
            border-radius: 50%;
            border: 2px solid #ffffff; /* Matches text color */
            transition: transform 0.3s ease;
        }

        .logo img:hover {
            transform: scale(1.1);
        }

        /* Navigation Menu */
        nav ul {
            list-style: none;
            display: flex;
            gap: 20px;
            justify-content: center;
        }

        nav ul li {
            display: inline-block;
        }

        nav ul li a {
            text-decoration: none;
            color: #ffffff; /* White text for contrast */
            padding: 12px 30px;
            border-radius: 30px; /* Rounded buttons */
            background: rgba(255, 255, 255, 0.1); /* Transparent white background */
            transition: all 0.3s ease; /* Smooth transition for hover effects */
            font-weight: bold;
            font-size: 16px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }

        nav ul li a:hover {
            background: rgba(255, 255, 255, 0.3); /* Brighter background on hover */
            transform: translateY(-5px); /* Move up on hover */
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Stronger shadow on hover */
        }

        nav ul li a:active {
            transform: translateY(1px); /* Pressed effect */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Reset shadow */
        }

        /* Header Right Section */
        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .icons {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .icon {
            text-decoration: none;
            color: #ffffff; /* Matches text color */
            font-size: 20px;
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .icon:hover {
            transform: scale(1.2);
            color: #f1c40f; /* Highlight color */
        }

        /* Dropdown Menu */
        .dropdown-container {
            position: relative;
        }

        .dropdown-toggle {
            background: none;
            border: none;
            color: #ffffff; /* Matches text color */
            font-size: 20px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .dropdown-toggle:hover {
            transform: scale(1.2);
            color: #f1c40f; /* Highlight color */
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 40px;
            right: 0;
            background: linear-gradient(135deg, #1e3c72, #2a5298); /* Matches header gradient */
            color: #ffffff; /* White text for contrast */
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 100;
            min-width: 200px;
            overflow: hidden;
        }

        .dropdown-menu a {
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: #ffffff; /* Matches text color */
            font-size: 16px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .dropdown-menu a:hover {
            background-color: rgba(255, 255, 255, 0.2); /* Highlight background */
            color: #f1c40f; /* Highlight text color */
        }

        @media screen and (max-width: 768px) {
            header {
                flex-direction: column;
                align-items: center;
                padding: 20px;
                gap: 15px;
            }

            nav ul {
                flex-direction: column;
                gap: 10px;
                align-items: center;
            }

            .header-right {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>

<header>
    <div class="logo">
        <img src="https://img.freepik.com/premium-vector/circle-floral-fashion-store-hanger-logo-design-vector_680355-4.jpg" alt="Logo">
        <!-- <h1 style="color: #fff; font-size: 20px;">User Panel</h1> -->
    </div>

    <nav>
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/product_list">Products</a></li>
            <li><a href="/about">About Us</a></li>
            <li><a href="/contact">Contact Us</a></li>
            <li><a href="/feedback">Feedback</a></li>
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
            <div class="dropdown-container">
                <button class="dropdown-toggle" onclick="toggleDropdown()">
                    Hello, {{ Auth::user()->name }} <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="dropdown-menu" id="dropdown-menu">
                    <a href="{{ route('profile.edit') }}"><i class="fa-solid fa-user"></i> Update Profile</a>
                    <a href="{{ route('feedbacks') }}"><i class="fa-solid fa-comments"></i> View Feedbacks</a>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa-solid fa-right-from-bracket"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
            @else
            <a href="{{ route('login') }}" class="icon">Login</a>
            <a href="{{ route('register') }}" class="icon">Register</a>
            @endif
        </div>
    </div>
</header>

<script>
    function toggleDropdown() {
        const menu = document.getElementById('dropdown-menu');
        menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    }

    window.onclick = function(event) {
        if (!event.target.matches('.dropdown-toggle') && !event.target.closest('.dropdown-container')) {
            const menu = document.getElementById('dropdown-menu');
            if (menu) menu.style.display = 'none';
        }
    }
</script>

</body>
</html>
