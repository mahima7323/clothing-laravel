<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Add your CSS files here -->
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
    </header>

    <div class="container">
        @yield('content')  <!-- This will render content from views extending this layout -->
    </div>

    <!-- Add your JavaScript files here -->
    <script src="{{ mix('js/app.js') }}"></script>

</body>
</html>
