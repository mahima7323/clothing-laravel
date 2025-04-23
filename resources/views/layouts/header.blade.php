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
            margin-top: 10px;
        }

        .icon {
            text-decoration: none;
            color: #fff;
            font-size: 22px;
            transition: transform 0.3s ease;
        }

        .icon:hover {
            transform: scale(1.2);
            color: rgb(196, 70, 39);
        }

        .user-section {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            position: relative;
        }

        .user-greeting {
            color: #e74c3c;
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .dropdown-container {
            position: relative;
            display: inline-block;
            margin-bottom: 10px;
        }

        .dropdown-toggle {
            background: none;
            border: none;
            color: #fff;
            font-size: 22px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .dropdown-toggle:hover {
            transform: scale(1.2);
            color: rgb(196, 70, 39);
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 40px;
            right: 0;
            background-color: #fff;
            color: #000;
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            z-index: 100;
            min-width: 160px;
            flex-direction: column;
        }

        .dropdown-menu a {
            padding: 10px 15px;
            display: block;
            text-decoration: none;
            color: #333;
            transition: background 0.3s ease;
        }

        .dropdown-menu a:hover {
            background-color: #f4f4f4;
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
                font-size: 18px;
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

            <div class="dropdown-container">
                <button class="dropdown-toggle" onclick="toggleDropdown()">
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
                <div class="dropdown-menu" id="dropdown-menu">
                    <a href="{{ route('profile.edit') }}">Update Profile</a>
                    <!-- <a href="{{ route('order_success') }}">Order History</a> -->
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa-solid fa-right-from-bracket"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
<script>
    function toggleDropdown() {
        const menu = document.getElementById('dropdown-menu');
        menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    }

    window.onclick = function(event) {
        if (!event.target.matches('.dropdown-toggle') && !event.target.closest('.dropdown-container')) {
            document.getElementById('dropdown-menu').style.display = 'none';
        }
    }
</script>

</body>
</html>
