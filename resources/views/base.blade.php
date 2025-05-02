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
    <nav class="flex justify-around">
        <a href="{{  route('home') }}" class="bg-amber-100 hover:bg-amber-200 cursor-pointer">Home</a>
        <a href="{{ route('dishes.index') }}" class="bg-amber-100 hover:bg-amber-200 cursor-pointer">Plats</a>
        @if (Auth::user()->role_id == 1)
            <a class="bg-amber-100 hover:bg-amber-200 cursor-pointer" href="{{ route('admin.menu') }}">Admin</a>
        @endif
        <div class="flex gap-2">
            <a href="{{ route('profile.edit') }}" class="bg-amber-100 hover:bg-amber-200 cursor-pointer">Profil</a>
            <a href="{{ route('cart.index') }}" class="bg-amber-100 hover:bg-amber-200 cursor-pointer">Panier</a>
        </div>
    </nav>

    @yield('content')

    <footer class="fixed bottom-0">
        <h1>Footer</h1>
    </footer>
</body>
</html>