<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Add your CSS files here -->
    @vite('resources/css/app.css')
</head>
<body>
    <nav>
        <!-- Add your navigation here (optional) -->
    </nav>

    <div class="container">
        @yield('content')  <!-- This will render content from views extending this layout -->
    </div>

    <!-- Add your JavaScript files here -->
    <script src="{{ mix('js/app.js') }}"></script>

</body>
</html>
