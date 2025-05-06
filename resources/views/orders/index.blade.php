@extends('base')

@section('title', 'Mes commandes')

@section('content')

    <div class="mx-4 md:mx-10 xl:mx-20 my-6">
        <!-- Back Button -->
        <div class="my-4">
            <a href="{{ url()->previous() }}"  class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-600 font-semibold rounded-lg shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Retour
            </a>
        </div>
        
        <h1 class="text-3xl font-bold mb-6">Mes commandes</h1>
    
        @if ($orders->isEmpty())
            <p>Vous n'avez encore passé aucune commande.</p>
        @else
            @foreach ($orders as $order)
                <div class="mb-6 border-b pb-4">
                    <h2>Commande n°{{ $order->id }} — {{ $order->ordered_at->diffForHumans() }}</h2>
                    <p>Total : {{ number_format($order->total_price, 2) }} CHF</p>
    
                    <ul>
                        @foreach ($order->dishes as $dish)
                            <li>
                                {{ $dish->name }} x {{ $dish->pivot->quantity }} — 
                                {{ number_format($dish->price * $dish->pivot->quantity, 2) }} CHF
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        @endif
    </div>
@endsection