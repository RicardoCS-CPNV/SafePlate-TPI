<div
    x-data="scrollNav"
    x-init="init()"
    :class="{ 'translate-y-0': visible, '-translate-y-full': !visible }"
    class="fixed top-0 inset-x-0 z-50  {{ request()->routeIs('home') ? 'bg-white/35' : 'bg-white/70 shadow' }} backdrop-blur transition-transform duration-300">
    
    <nav class="w-full mx-auto flex flex-wrap justify-between items-center px-6 py-3 text-sm font-semibold text-gray-700" x-data="{ open: false }">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex gap-1">
            <img src="{{ asset('web_images/Logo_Illustration.png') }}" alt="" class="h-5">
            <img src="{{ asset('web_images/Logo_Text.png') }}" alt="" class="h-5">
        </a>

        {{-- Hamburger Button (mobile) --}}
        <button @click="open = !open" class="sm:hidden text-gray-700 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path :class="{ 'hidden': open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16" />
                <path :class="{ 'hidden': !open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        {{-- Nav Menu (mobile + desktop) --}}
        <div :class="{ 'block': open, 'hidden': !open }" class="w-full sm:flex sm:items-center sm:w-fit hidden mt-4 sm:mt-0 sm:gap-6">
            <div class="flex flex-col sm:flex-row gap-4 sm:items-center sm:mr-15">
                <a href="{{ route('home') }}" class="hover:text-green-500 transition">Accueil</a>
                <a href="{{ route('dishes.index') }}" class="hover:text-green-500 transition">Plats</a>
                @auth
                    <a href="{{ route('orders.index') }}" class="hover:text-green-500 transition">Vos Commandes</a>
                    @if (Auth::user()->role_id == 1)
                        <a href="{{ route('admin.menu') }}" class="hover:text-green-500 transition">Admin</a>
                    @endif
                @endauth
            </div>

            <div class="select-none hidden sm:block">
                |
            </div>

            {{-- Connected User --}}
            @auth
                <div class="mt-4 sm:mt-0 flex flex-col sm:flex-row gap-4 sm:items-center">
                    <a href="{{ route('profile.edit') }}" class="hover:text-green-500 transition">
                        Profil @if (Auth::user()->role_id == 1) (admin) @endif
                    </a>
                    <a href="{{ route('cart.index') }}" class="hover:text-yellow-500 transition">
                        {{-- Cart Icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 -2 24 24" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 10L5.4 5M7 10l-1.50 5.4a1 1 0 001 1.2h10.3a1 1 0 001-1.2L17 13M9 18h.01M15 18h.01" />
                        </svg>
                    </a>
                    <form action="{{ route('auth.logout') }}" method="post"
                        onsubmit="return confirm('Êtes-vous sur de vouloir vous déconnecter ?');" class="flex">
                        @method("delete")
                        @csrf
                        <button class="group cursor-pointer">
                            <img src="{{ asset('web_images/icons/logout.png') }}" alt="logout" class="h-5.5 group-hover:hidden">
                            <img src="{{ asset('web_images/icons/logoutGIF.gif') }}" alt="logout" class="h-5.5 group-hover:block hidden">
                        </button>
                    </form>
                </div>
            @endauth

            {{-- Guest --}}
            @guest
                <div class="mt-4 sm:mt-0 flex flex-col sm:flex-row gap-2 sm:items-center">
                    <a href="{{ route('auth.register') }}" class="hover:text-green-500">S'inscrire</a>
                    <a href="{{ route('auth.login') }}" class="hover:text-blue-600">Se connecter</a>
                </div>
            @endguest
        </div>
    </nav>
</div>