@extends('base')

@section('title', 'Home')

@section('content')
    @if(session('success'))
        <div id="flash-messag" class="bg-green-200/30 backdrop-blur-sm z-50 text-green-800 font-semibold py-3 px-10 rounded-md absolute top-20 left-1/2 transform -translate-x-1/2 w-fit transition-opacity duration-300">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div id="flash-message" class="bg-red-200/30 backdrop-blur-sm z-50 text-red-900 font-semibold py-3 px-10 rounded-md absolute top-20 left-1/2 transform -translate-x-1/2 w-fit transition-opacity duration-300">
            {{ session('error') }}
        </div>
    @endif

    {{-- Section 1 --}}
    <section id="hero" class="-mt-15 relative h-screen bg-cover bg-center" style="background-image: url({{ asset('web_images/auth_images/Auth_Aliment.png') }})">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm flex flex-col items-center justify-center gap-6">
            <h1 class="select-none text-gray-300 text-4xl md:text-6xl font-bold text-center drop-shadow-lg cursor-pointer"
                onclick="document.getElementById('about').scrollIntoView()">
            Bienvenue chez SafePlate
            </h1>
            <button onclick="document.getElementById('about').scrollIntoView()"
                    class="select-none cursor-pointer bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-full font-semibold text-lg transition transform hover:scale-105">
            En savoir plus ↓
            </button>
        </div>
    </section>


    {{-- Section 2 --}}
    <section id="about" class="px-6 py-16 bg-gray-800 ">
        <div class="text-center max-w-5xl mx-auto">
            <h2 class="text-3xl font-bold text-gray-500 mb-4">Une cuisine pensée pour votre sécurité</h2>
            <p class="text-gray-300 text-lg leading-relaxed">
                Chez SafePlate, nous mettons un point d'honneur à adapter nos plats à vos besoins alimentaires.
                Grâce à notre système de filtrage par allergènes, vous pouvez commander en toute confiance.
                Une expérience culinaire saine, inclusive et savoureuse !
            </p>
        </div>
    </section>

    {{-- Section 3 --}}
    <section class="relative h-[75vh] bg-cover bg-center" style="background-image: url({{ asset('web_images/auth_images/Auth_Aliment2.png') }});">
        <div class="absolute inset-0 bg-black/50 flex flex-col items-center justify-center text-center px-4">
            <h2 class="select-none text-gray-300 text-3xl md:text-4xl font-bold mb-4">Découvrez nos plats</h2>
            <a href="{{ route('dishes.index') }}"
            class="select-none bg-amber-500 hover:bg-amber-600 text-white px-6 py-3 rounded-full font-semibold text-lg transition">
                Voir la carte
            </a>
        </div>
    </section>

    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 500)"
        x-show="show"
        x-transition:leave="transition-opacity duration-1000"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        x-cloak
        class="fixed inset-0 bg-black z-50 flex items-center justify-center">

        <img src="{{ asset('web_images/Logo_Illustration.png') }}" alt="Logo" class="h-40 animate-pulse">
    </div>


    <style>
        html{
            scroll-behavior: smooth;
        }
    </style>
@endsection