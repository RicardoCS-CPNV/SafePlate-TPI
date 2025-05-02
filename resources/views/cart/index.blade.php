@extends('base')

@section('title', 'Mon panier')

@section('content')
<h1>Mon panier</h1>

{{-- Message de succès --}}
@if(session('success'))
    <div>{{ session('success') }}</div>
@endif

{{-- Panier vide --}}
@if($cartItems->isEmpty())
    <p>Votre panier est vide.</p>
@else
    <table class="w-full border-collapse border border-gray-300 text-sm">
        <thead class="bg-amber-200">
            <tr class="grid grid-cols-5 text-left font-semibold text-gray-700 px-4 py-2">
                <th>Plat</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Total</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach($cartItems as $item)
                @php
                    $subtotal = $item->dish->price * $item->quantity;
                    $total += $subtotal;
                @endphp
                <tr class="grid grid-cols-5 items-center border-t border-gray-200 px-4 py-2 hover:bg-gray-50">
                    <td class="truncate">{{ $item->dish->name }}</td>

                    <td>
                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center gap-2">
                            @csrf
                            @method('PUT')
                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="w-16 px-2 py-1 border rounded">
                            <button type="submit" class="text-blue-600 hover:underline text-xs">Modifier</button>
                        </form>
                    </td>

                    <td>{{ number_format($item->dish->price, 2) }} CHF</td>
                    <td>{{ number_format($subtotal, 2) }} CHF</td>

                    <td>
                        <form action="{{ route('cart.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Supprimer ce plat ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline text-xs">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Total --}}
    <div class="text-right mt-4 font-semibold">
        Total : {{ number_format($total, 2) }} CHF
    </div>

    <!-- <form action="" method="POST">
        @csrf
        <input type="hidden" name="total_price" value="{{ $total }}">
        <button type="submit">Valider la commande</button>
    </form> -->
@endif
@endsection
