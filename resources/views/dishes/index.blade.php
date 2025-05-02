@extends('base')

@section('title', 'Plats du restaurant')

@section('content')
<div class="mx-4 md:mx-10 xl:mx-20 my-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center md:text-left">Nos plats</h1>

    @if(session('success'))
        <div class="mb-4 bg-green-200 text-green-800 py-2 px-4 rounded shadow">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($dishes as $dish)
            <div class="bg-white border rounded-lg shadow-md p-4 space-y-3">
                <div class="flex justify-center">
                    @if ($dish->images->first())
                        <img src="{{ asset('storage/' . $dish->images->first()->path) }}"
                             alt="{{ $dish->name }}"
                             class="w-32 h-24 object-cover rounded">
                    @else
                        <div class="w-32 h-24 bg-gray-100 flex items-center justify-center text-gray-500 rounded">
                            Aucune image
                        </div>
                    @endif
                </div>

                <h2 class="text-xl font-semibold text-gray-800">{{ $dish->name }}</h2>
                <p class="text-sm text-gray-700">{{ number_format($dish->price, 2) }} CHF</p>

                <form action="{{ route('cart.store') }}" method="POST" class="flex items-center gap-2">
                    @csrf
                    <input type="hidden" name="dish_id" value="{{ $dish->id }}">
                    <input type="number" name="quantity" value="1" min="1" max="99"
                           class="w-16 text-sm border rounded px-2 py-1 bg-gray-50 text-gray-700">
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded">
                        Ajouter au panier
                    </button>
                </form>
            </div>
        @endforeach
    </div>
</div>
@endsection