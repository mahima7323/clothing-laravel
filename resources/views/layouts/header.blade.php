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
            background-color: #000; /* Black color */
            color: #fff;
            padding: 25px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
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

        .logo h1 {
            font-size: 32px;
            font-weight: bold;
            text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.2);
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

        .btn-logout {
            background-color: #e74c3c; /* Red color */
            padding: 10px 20px;
            border-radius: 30px;
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-logout:hover {
            background-color: #c0392b; /* Darker red on hover */
            transform: scale(1.05);
        }

        /* Responsive Design */
        @media screen and (max-width: 768px) {
            header {
                flex-direction: column;
                align-items: center;
                padding: 20px;
            }

            .logo h1 {
                font-size: 26px;
            }

            nav ul {
                flex-direction: column;
                gap: 15px;
            }

            .btn-logout {
                margin-top: 10px;
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
        <a href="/logout" class="btn-logout">Logout</a>
    </header>
</body>

</html>
