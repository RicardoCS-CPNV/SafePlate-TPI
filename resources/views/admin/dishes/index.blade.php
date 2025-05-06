@extends('base')

@section('title', 'Plats')
@php
    $editRoute = 'admin.dishes.edit';
@endphp

@section('content')
<div class="mx-4 md:mx-10 lg:mx-20 my-6">

    <!-- Back Button -->
    <div class="my-4">
        <a href="{{ route('admin.menu') }}"  class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-600 font-semibold rounded-lg shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Retour
        </a>
    </div>

    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center md:text-left">Gestion des plats</h1>


    <a href="{{ route('admin.dishes.create') }}"
       class="w-full sm:w-fit inline-flex items-center gap-2 mb-8 bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-4 rounded transition duration-200">
        <span class="text-xl">+</span> Ajouter un plat
    </a>

    <div class="shadow-lg rounded-lg overflow-hidden mb-10">
        <div class="overflow-x-auto">
            <table class="w-full table-fixed min-w-[600px]">
                <!-- En-têtes -->
                <thead>
                    <tr class="bg-gray-100">
                        <th class="w-1/20 py-2 px-4 text-center text-gray-600 font-bold uppercase">ID</th>
                        <th class="w-4/20 py-4 px-4 text-left text-gray-600 font-bold uppercase">Nom</th>
                        <th class="w-7/20 py-4 px-4 text-left text-gray-600 font-bold uppercase">Description</th>
                        <th class="w-2/20 py-4 px-4 text-left text-gray-600 font-bold uppercase">Prix</th>
                        <th class="w-2/20 py-4 px-4 text-center text-gray-600 font-bold uppercase">Image</th>
                        <th class="w-3/20 py-4 px-4 text-center text-gray-600 font-bold uppercase">Actions</th>
                    </tr>
                </thead>

                <!-- Données -->
                <tbody class="bg-white text-sm">
                    @foreach ($dishes as $dish)
                    <tr class="border-b border-gray-200 hover:bg-gray-50 cursor-pointer"
                    ondblclick="window.location='{{ route($editRoute, $dish->id) }}'">
                            <!-- ID -->
                            <td class="text-center py-2 px-4">{{ $dish->id }}</td>

                            <!-- Nom -->
                            <td class="text-left py-2 px-4 font-semibold text-gray-800">{{ $dish->name }}</td>

                            <!-- Description -->
                            <td class="text-left py-2 px-4 text-gray-700 truncate max-w-[200px]">
                                {{ Str::limit(strip_tags($dish->description), 60) }}
                            </td>


                            <!-- Prix -->
                            <td class="text-left py-2 px-4 text-gray-700">{{ number_format($dish->price, 2) }} CHF</td>

                            <!-- Image -->
                            <td class="text-center py-0.5 px-0.5">
                                @if ($dish->images->first())
                                    <img src="{{ asset('storage/' . $dish->images->first()->path) }}"
                                        alt="Image du plat"
                                        class="w-12 h-12 object-cover rounded mx-auto">
                                @else
                                    <span class="text-gray-400 italic">Aucune</span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="text-center py-2 px-4">
                                <div class="flex justify-center items-center space-x-3">
                                    <!-- Modifier -->
                                    <a href="{{ route($editRoute, $dish->id) }}"
                                    class="text-blue-600 hover:text-blue-800" title="Modifier">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16.862 3.487a2.25 2.25 0 113.182 3.182L7.5 19.213l-4 1 1-4L16.862 3.487z" />
                                        </svg>
                                    </a>

                                    <!-- Supprimer -->
                                    <form action="{{ route('admin.dishes.destroy', $dish->id) }}" method="POST"
                                        onsubmit="return confirm('Supprimer ce plat ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Supprimer"
                                                class="text-red-600 hover:text-red-800 cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-4 0a1 1 0 00-1 1v1h6V4a1 1 0 00-1-1m-4 0h4" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection