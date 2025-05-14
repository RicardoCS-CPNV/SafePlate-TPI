@extends('base')

@section('title', $dish->name)

@section('content')
    <!-- Success Message -->
    @if(session('success'))
        <div id="flash-message" class="bg-green-200 text-green-900 py-3 px-10 rounded-md absolute top-15 left-1/2 transform -translate-x-1/2 w-fit transition-opacity duration-300">
            {{ session('success') }}
        </div>
    @endif

    <!-- Back Button -->
    <div class="mx-4 md:mx-10 xl:mx-20 mb-4 mt-6">
        <a href="{{ url()->previous() }}"  class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-600 font-semibold rounded-lg shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Retour
        </a>
    </div>
    
    <div class="mx-4 md:mx-10 xl:mx-20 pb-6">
        {{-- Title --}}
        <h1 class="text-3xl font-bold text-gray-800 mb-6">{{ $dish->name }}</h1>

        {{-- Scroll Images --}}
        <div x-data="{ modalOpen: false, modalImage: '' }">
            <div class="overflow-x-auto mb-0">
                <div class="flex gap-4 w-max">
                    @forelse ($dish->images as $image)
                        <img src="{{ asset('storage/' . $image->path) }}"
                            @click="modalImage = '{{ asset('storage/' . $image->path) }}'; modalOpen = true"
                            alt="{{ $dish->name }}"
                            class="h-32 cursor-pointer object-contain rounded shadow flex-shrink-0 border transition-transform duration-200 hover:scale-105">
                    @empty
                        <p class="text-gray-500 italic">Aucune image disponible.</p>
                    @endforelse
                </div>
            </div>

            {{-- Open image --}}
            <div x-show="modalOpen" x-cloak
                x-transition
                class="fixed inset-0 flex items-center justify-center z-40 bg-black/15 backdrop-blur-xs">
                <div class="absolute cursor-pointer w-full h-full" @click="modalOpen = false"></div>
                <div class="relative max-w-3xl w-full px-4">
                    <img :src="modalImage" alt="Image zoomée" class="w-full max-h-[80vh] object-contain rounded-2xl shadow-xl">
                    <button @click="modalOpen = false"
                            class="cursor-pointer absolute top-4 right-9 bg-gray-100/40 px-2 pb-1 rounded text-gray-900 text-2xl font-bold hover:text-red-600">
                        ✕
                    </button>
                </div>
            </div>
        </div>

        {{-- Before button --}}
        <button
            @click="index = (index === 0) ? {{ $dish->images->count() }} - 1 : index - 1"
            class="absolute top-1/2 left-2 transform -translate-y-1/2 bg-white bg-opacity-70 hover:bg-opacity-90 text-gray-800 px-2 py-1 rounded shadow"
            x-show="{{ $dish->images->count() }} > 1"
            x-cloak
        >&lt;</button>

        {{-- Next button --}}
        <button
            @click="index = (index === {{ $dish->images->count() }} - 1) ? 0 : index + 1"
            class="absolute top-1/2 right-2 transform -translate-y-1/2 bg-white bg-opacity-70 hover:bg-opacity-90 text-gray-800 px-2 py-1 rounded shadow"
            x-show="{{ $dish->images->count() }} > 1"
            x-cloak
        >&gt;</button>
    </div>

    {{-- Informations --}}
    <div class="bg-white rounded-lg shadow p-6 space-y-4 mx-4 md:mx-10 xl:mx-20">
        {{-- Description --}}
        <div>
            <h2 class="text-xl font-semibold text-gray-700 mb-1">Description</h2>
            <p class="text-gray-800 whitespace-pre-line">{{ $dish->description }}</p>
        </div>

        {{-- Price --}}
        <div>
            <h2 class="text-xl font-semibold text-gray-700 mb-1">Prix</h2>
            <p class="text-gray-900 font-bold">{{ number_format($dish->price, 2) }} CHF</p>
        </div>

        {{-- Allergens --}}
        <div>
            <h2 class="text-xl font-semibold text-gray-700 mb-2">Allergènes</h2>
            @if ($dish->allergens->isEmpty())
                <p class="text-gray-500 italic">Aucun allergène associé.</p>
            @else
                <div class="flex flex-wrap gap-3">
                    @foreach ($dish->allergens as $allergen)
                        <div class="flex items-center gap-2 bg-gray-100 px-3 py-1 rounded-lg shadow-sm">
                            @if ($allergen->icon)
                                <img src="{{ asset('web_images/allergens_icons/' . $allergen->icon) }}"
                                        alt="{{ $allergen->name }}"
                                        class="w-6 h-6 object-contain">
                            @endif
                            <span class="text-sm text-gray-800">{{ $allergen->name }}</span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Add to cart --}}
        <form action="{{ route('cart.store') }}" method="POST" class="mt-6 flex items-center gap-4">
            @csrf
            <input type="hidden" name="dish_id" value="{{ $dish->id }}">
            <select name="quantity" class="border rounded px-3 py-1 text-sm">
                @for ($i = 1; $i <= 9; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded shadow">
                Ajouter au panier
            </button>
        </form>
    </div>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

@endsection
