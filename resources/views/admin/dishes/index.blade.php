@extends('base')

@section('title', 'Plats')

@section('content')

    <h1>Gestion des plats</h1>

    <a href="{{ route('admin.dishes.create') }}">Créer un plat</a>

    <div>
        @foreach ($dishes as $dish)
        <div class="bg-amber-300">
            <h2>{{ $dish->name }}</h2>
            <p>{{ $dish->description }}</p>
            <p>{{ $dish->price }}</p>
            <div class="flex">
                @foreach ($dish->images as $image)
                    <img src="{{ asset('storage/' . $image->path) }}" alt="Image du plat" class="w-24 h-24 object-cover rounded">
                @endforeach
            </div>
            <div>
                <form action="{{ route('admin.dishes.destroy', $dish->id) }}" method="POST" onsubmit="return confirm('Supprimer ce plat ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" title="Supprimer" class="cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600 hover:text-red-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-4 0a1 1 0 00-1 1v1h6V4a1 1 0 00-1-1m-4 0h4" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

@endsection