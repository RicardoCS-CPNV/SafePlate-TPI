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
    <div
        x-data="scrollNav"
        x-init="init()"
        :class="{ 'translate-y-0': visible, '-translate-y-full': !visible }"
        class="fixed top-0 inset-x-0 z-50 bg-white/50 backdrop-blur shadow transition-transform duration-300">
        
        <nav class="w-full mx-auto flex justify-between items-center px-6 py-3 text-sm font-semibold text-gray-700">
            <a href="{{ route('home') }}" class="flex gap-1">
                <img src="{{ asset('web_images/Logo_Illustration.png') }}" alt="" class="h-5">
                <img src="{{ asset('web_images/Logo_Text.png') }}" alt="" class="h-5">
            </a>
            <div class="flex gap-6">
                <a href="{{ route('home') }}" class="hover:text-green-500 transition">Accueil</a>
                <a href="{{ route('dishes.index') }}" class="hover:text-green-500 transition">Plats</a>
                @auth
                    <a href="{{ route('orders.index') }}" class="hover:text-green-500 transition">Commandes</a>
                    @if (Auth::user()->role_id == 1)
                        <a href="{{ route('admin.menu') }}" class="hover:text-green-500 transition">Admin</a>
                    @endif
                @endauth
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('profile.edit') }}" class="hover:text-green-500 transition">Profil</a>
                <a href="{{ route('cart.index') }}" class="hover:text-green-500 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 -2 24 24" stroke="currentColor"
                        class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 10L5.4 5M7 10l-1.50 5.4a1 1 0 001 1.2h10.3a1 1 0 001-1.2L17 13M9 18h.01M15 18h.01" />
                    </svg>
                </a>
            </div>
        </nav>
    </div>
    <div class="mt-15">
        @yield('content')
    </div>

    <footer class="fixed bottom-0">
        <h1>Footer</h1>
    </footer>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('scrollNav', () => ({
            lastY: window.scrollY,
            visible: true,
            ticking: false,

            init() {
                window.addEventListener('scroll', this.onScroll.bind(this));
            },

            onScroll() {
                if (!this.ticking) {
                    window.requestAnimationFrame(() => {
                        const currentY = window.scrollY;
                        this.visible = currentY < this.lastY || currentY < 10;
                        this.lastY = currentY;
                        this.ticking = false;
                    });
                    this.ticking = true;
                }
            }
        }));
    });
</script>


<style>
    [x-cloak] { display: none;}
</style>

</body>
</html>