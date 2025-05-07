@extends('base')

@section('title', 'Plats du restaurant')

@section('content')
<div class="mx-4 md:mx-10 xl:mx-20 my-6">

    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-left">Nos plats</h1>
    
    @if(session('success'))
        <div id="flash-message" class="bg-green-200 text-green-900 py-3 px-10 rounded-md absolute top-15 left-1/2 transform -translate-x-1/2 w-fit transition-opacity duration-300">
            {{ session('success') }}
        </div>
    @endif

    {{-- Search Bar --}} 
    <div class="relative group mb-4">
        <input type="text" id="search" oninput="searchDishes(this.value)" placeholder="Rechercher un plat..."
            class="w-full md:w-1/2 pr-4 pl-12 py-2 rounded-full shadow-xl border border-gray-300 focus:outline-none focus:ring focus:w-full transition-all duration-300 ease-out">
        <label for="search" class="absolute top-1/6 group left-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-[30px] h-[30px] cursor-pointer group-hover:hidden" viewBox="1 1 51 51"><path d="M 21 3 C 11.601563 3 4 10.601563 4 20 C 4 29.398438 11.601563 37 21 37 C 24.355469 37 27.460938 36.015625 30.09375 34.34375 L 42.375 46.625 L 46.625 42.375 L 34.5 30.28125 C 36.679688 27.421875 38 23.878906 38 20 C 38 10.601563 30.398438 3 21 3 Z M 21 7 C 28.199219 7 34 12.800781 34 20 C 34 27.199219 28.199219 33 21 33 C 13.800781 33 8 27.199219 8 20 C 8 12.800781 13.800781 7 21 7 Z"/></svg>
            <img src="{{ asset('web_images/icons/search.gif') }}" alt="search icon" 
            class="cursor-pointer group-hover:block hidden h-7">
        </label>
    </div>

    {{-- Dishes list --}}
    <div id="dish-list">
        @include('dishes.partials.list', ['dishes' => $dishes])
    </div>
</div>

{{-- Script for instant refresh of the dishes list --}}
<script>
    function searchDishes(query) {
        fetch("{{ route('dishes.search') }}?q=" + encodeURIComponent(query))
            .then(response => response.text())
            .then(html => {
                document.getElementById('dish-list').innerHTML = html;
            });
    }
</script>

@endsection