@extends('base')

@section('title', 'Plats')

@section('content')

<div class="mx-4 md:mx-10 my-5 lg:mx-20">
    <h1 class="text-3xl mb-2 md:mb-8 font-bold text-gray-800 text-center md:text-left">Gestion des plats</h1>

    <a href="{{ route('admin.dishes.create') }}" class="w-full flex items-center gap-2 sm:w-fit bg-green-500 hover:bg-green-600 text-white font-bold py-2.5 px-6 rounded transition duration-200">
        <span class="text-2xl">+</span>Ajouter un plat
    </a>

    <div class="grid gap-2">
        @foreach ($dishes as $dish)
            <div class="bg-amber-100">
                <h2>{{ $dish->name }}</h2>
                <p>{!! nl2br(e($dish->description)) !!}</p>
                <p>{{ $dish->price }}</p>
                <div class="flex flex-wrap gap-4 justify-left md:justify-normal">
                    @forelse ($dish->allergens as $allergen)
                        <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center shadow">
                            <img
                                src="{{ asset('web_images/allergens_icons/' . $allergen->icon) }}"
                                alt="{{ $allergen->name }}"
                                class="w-8 h-8 object-contain"
                                draggable="false">
                        </div>
                    @empty
                        <p class="text-gray-500">Aucun allergène sélectionné.</p>
                    @endforelse
                </div>
                @if ($dish->images->count())
                    <div class="mt-4 flex flex-wrap gap-2">
                        @foreach ($dish->images as $image)
                            <div class="relative w-fit">
                                <img src="{{ asset('storage/' . $image->path) }}"
                                    alt="Image du plat"
                                    class="w-fit h-20 object-cover rounded shadow">

                                {{-- Bouton de suppression --}}
                                <form action="{{ route('admin.dishes.destroyImage', $image->id) }}" method="POST"
                                    class="absolute top-1 right-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="cursor-pointer bg-red-500 text-white text-xs px-1 py-0.5 rounded hover:bg-red-600">
                                        ✕
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @endif
                <div class="flex items-center gap-4 mt-2">
                    {{-- Bouton Modifier --}}
                    <a href="{{ route('admin.dishes.edit', $dish->id) }}"
                    class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700 transition">
                        Modifier
                    </a>

                    {{-- Bouton Supprimer --}}
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
</div>

@endsection