<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <script src="//unpkg.com/alpinejs" defer></script>
    <title>@yield('title')</title>
</head>
<body>
    <nav>
        <h1>Nav Bar</h1>
    </nav>

    @yield('content')

    <footer class="fixed bottom-0">
        <h1>Footer</h1>
    </footer>
</body>
</html>