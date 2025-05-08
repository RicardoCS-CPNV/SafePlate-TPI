<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <script src="//unpkg.com/alpinejs" defer></script>
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('web_images/Logo_Illustration.png') }}">
</head>
<body>

    <div class="min-h-screen flex flex-col">
        @include('partials.nav')

        <div class="mt-10 flex-grow">
            @yield('content')
        </div>

        @include('partials.footer')
    </div>

</body>
</html>