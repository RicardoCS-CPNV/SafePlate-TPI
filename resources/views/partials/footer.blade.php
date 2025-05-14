<footer class="{{ request()->routeIs('home') ? 'bg-gray-800 border-gray-900"' : 'bg-gray-100 border-gray-200'}} border-t">
    <div class="max-w-7xl mx-auto px-4 py-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-sm 
    {{ request()->routeIs('home') ? 'text-gray-400' : 'text-gray-600'}}">
        {{-- Logo and Name --}}
        <a href="{{ route('home') }}" class="cursor-pointer flex items-center gap-2">
            <img src="{{ asset('web_images/Logo_Illustration.png') }}" alt="Logo" class="h-6 {{ request()->routeIs('home') ? 'invert' : '' }}">
            <span class="font-semibold text-xl hover:text-green-600 transition {{ request()->routeIs('home') ? 'text-gray-400' : 'text-gray-700'}}">SafePlate</span>
        </a>

        {{-- Navigation Button --}}
        <div class="flex gap-4">
            <a href="{{ route('home') }}" class="hover:text-green-500 transition">Accueil</a>
            <a href="{{ route('dishes.index') }}" class="hover:text-green-500 transition">Plats</a>
            @auth
                <a href="{{ route('orders.index') }}" class="hover:text-green-500 transition">Vos Commandes</a>
            @endauth
        </div>

        <div class="text-xs text-gray-400">
            © {{ now()->year }} SafePlate. Tous droits réservés.
        </div>
    </div>
</footer>