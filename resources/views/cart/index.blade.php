@extends('base')

@section('title', 'Mon panier')

@section('content')

@if(session('success'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition
        class="fixed top-15 left-1/2 transform -translate-x-1/2 bg-green-100 text-green-900 px-6 py-3 rounded shadow-lg z-50">
        {{ session('success') }}
    </div>
@endif

<div class="mx-4 md:mx-10 xl:mx-20 pb-6 mt-6">

    <!-- Back Button -->
    <div class="mb-4">
        <a href="{{ url()->previous() }}"  class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-600 font-semibold rounded-lg shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Retour
        </a>
    </div>

    <h1 class="text-3xl font-bold mb-6">Mon panier</h1>

    @if($cartItems->isEmpty())
        <p class="text-gray-600">Votre panier est vide.</p>
    @else
        {{-- Clean Cart Button --}}
        <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Vider tout le panier ?');" class="mb-4">
            @csrf
            @method('DELETE')
            <button type="submit" class="cursor-pointer transition bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded shadow">
                Vider le panier
            </button>
        </form>

        {{-- Dishes List --}}
        <div class="grid gap-4">
            @php $total = 0; @endphp
            @foreach($cartItems as $item)
                @php
                    $subtotal = $item->dish->price * $item->quantity;
                    $total += $subtotal;
                @endphp

                <div class="relative transition bg-white hover:bg-gray-100 rounded-lg shadow p-4 flex flex-col md:flex-row items-start md:items-center justify-baseline gap-4">
                    {{-- Dish info --}}
                    <div class="w-fit">
                        <a href="{{ route('dishes.show', $item->dish->id) }}">
                            <img src="{{ asset('storage/' . $item->dish->images->first()->path) }}"
                            alt="{{ $item->dish->name }}"
                            class="w-20 h-20 object-cover rounded shadow">
                        </a>
                    </div>
                    <div class="flex flex-col">
                        <a href="{{ route('dishes.show', $item->dish->id) }}" class="text-lg font-semibold text-gray-800">{{ $item->dish->name }}</a>
                        <p class="text-sm text-gray-600">Prix unitaire : {{ number_format($item->dish->price, 2) }} CHF</p>
                        <p class="text-sm text-gray-600">Total : {{ number_format($subtotal, 2) }} CHF</p>
                    </div>

                    <div class="sm:absolute sm:right-5 flex flex-col sm:flex-row items-center gap-2">
                        {{-- Modify quantity --}}
                        <form action="{{ route('cart.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1"
                            class="w-20 px-2 py-1 border rounded text-center text-sm"
                            onchange="this.form.submit()">
                    </form>


                        {{-- Delete dish --}}
                        <form action="{{ route('cart.destroy', $item->id) }}" method="POST"
                              onsubmit="return confirm('Supprimer ce plat ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="cursor-pointer text-red-600 hover:underline text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600 hover:text-red-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-4 0a1 1 0 00-1 1v1h6V4a1 1 0 00-1-1m-4 0h4" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Total --}}
        <div class="text-right text-lg font-bold mt-4">
            Total : {{ number_format($total, 2) }} CHF
        </div>

        {{-- Validate the order --}}
        <div x-data="{ showConfirm: false }" class="mt-6">
            <button type="button"
                    @click="showConfirm = true"
                    class="cursor-pointer w-full sm:w-fit bg-green-600 hover:bg-green-700 text-white font-bold px-6 py-3 rounded shadow transition">
                Valider la commande
            </button>

            {{-- Confirmation Window --}}
            <div x-show="showConfirm" x-cloak x-transition
                 class="fixed inset-0 flex items-center justify-center z-50 bg-black/15 backdrop-blur-sm">
                <div class="bg-gray-50 rounded-xl shadow-lg w-11/12 max-w-md p-6 text-center">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">
                         Confirmer la commande
                    </h2>
                    <p class="text-gray-600 mb-6">Souhaitez-vous vraiment valider votre commande ?</p>
                    <div class="flex justify-center gap-4">
                        {{-- Validate --}}
                        <form action="{{ route('orders.store') }}" method="POST">
                            @csrf
                            <button type="submit" class="cursor-pointer bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded font-medium shadow">
                                Oui
                            </button>
                        </form>
                        {{-- Cancel --}}
                        <button @click="showConfirm = false"
                            class="cursor-pointer bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded font-medium shadow">
                            Non
                        </button>
                    </div>
                    <div class="absolute top-0 left-0 cursor-pointer w-full h-full -z-10" @click="showConfirm = false"></div>
                </div>
            </div>
        </div>
    @endif
</div>

{{-- Alpine and Cloak --}}
@push('scripts')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush

<style>
    [x-cloak] { display: none !important; }
</style>

@endsection
