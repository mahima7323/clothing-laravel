<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

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
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .logo h1 {
            font-size: 24px;
        }

        .btn-logout {
            background-color: #e74c3c;
            padding: 10px 20px;
            border-radius: 30px;
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-logout:hover {
            background-color: #c0392b;
            transform: scale(1.05);
        }
    </style>
</head>

<body>
    <header>
        <div class="logo">
            <h1>Admin Panel</h1>
        </div>
        
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">Logout</button>
        </form>
    </header>
</body>

</html>