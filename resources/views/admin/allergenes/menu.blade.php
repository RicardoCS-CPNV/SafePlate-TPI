@extends('base')

@section('title', 'Allergenes')

@section('content')
    <!-- Success Message -->
    @if(session('success'))
        <div id="flash-message" class="bg-green-200 text-green-900 py-3 px-10 rounded-md absolute top-10 left-1/2 transform -translate-x-1/2 w-fit transition-opacity duration-300">
            {{ session('success') }}
        </div>
    @endif
    <h1 class="mx-4 md:mx-10 xl:mx-20 py-4 text-3xl font-bold">Gestion allergènes</h1>

    <!-- Back Button (Only mobile) -->
    <div class="mx-4 md:mx-10 xl:mx-20 mb-4 md:hidden">
        <a href="{{ route('admin.menu') }}"  class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-600 font-semibold rounded-lg shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Retour
        </a>
    </div>

    <!-- Add Allergen -->
    <div x-data="{ open: false }" class="shadow-lg rounded-lg p-2 bg-white mx-4 md:mx-10 xl:mx-20 mb-4">
        <!-- Button to show the form -->
        <div class="flex justify-between items-center">
            <button 
                @click="open = !open"
                class="w-full md:w-fit cursor-pointer text-white font-semibold py-2 px-4 rounded-lg transition" :class="open ? 'bg-red-500 hover:bg-red-600' : 'bg-green-500 hover:bg-green-600'">
                <span x-show="!open">Ajouter un allergène</span>
                <span x-show="open">Annuler</span>
            </button>
        </div>

        <!-- Form -->
        <div x-show="open" class="mt-4">
            <form action="{{ route('admin.allergenes.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                @csrf

                <div class="flex flex-col">
                    <label for="name" class="mb-2 text-gray-600 font-semibold">Nom</label>
                    <input type="text" id="name" name="name" class="bg-gray-100 border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div class="flex flex-col">
                    <label for="icon" class="mb-2 text-gray-600 font-semibold">Icon</label>
                    <input type="text" id="icon" name="icon" class="bg-gray-100 border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div>
                    <button type="submit" class="w-full cursor-pointer bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg">
                        Créer
                    </button>
                </div>
            </form>
        </div>
    </div>


    <!-- Allergen list -->
    <div class="shadow-lg rounded-lg overflow-hidden mx-4 md:mx-10 xl:mx-20 mb-10">
        <div class="overflow-x-auto">
            <!-- Table to show the list -->
            <table class="w-full table-fixed min-w-[600px]">

                <!-- Header table -->
                <thead>
                    <tr class="bg-gray-100">
                        <th class="w-8 md:w-20 py-4 px-4 text-center text-gray-600 font-bold uppercase">ID</th>
                        <th class="w-1/3 md:w-2/4 py-4 px-6 text-center text-gray-600 font-bold uppercase">Nom</th>
                        <th class="w-1/5 md:w-fit py-4 px-6 text-center text-gray-600 font-bold uppercase">Icon</th>
                        <th class="max-w-fit py-4 px-6 text-center text-gray-600 font-bold uppercase">Edit</th>
                    </tr>
                </thead>

                <!-- Data elements -->
                <tbody class="bg-white">
                    @foreach ($allergenes as $allergene)
                        <!-- Keep the data in mind -->
                        <tr 
                        
                            x-data="{
                                edit: false,
                                name: '{{ $allergene->name }}',
                                icon: '{{ $allergene->icon }}',
                                reset() {
                                    this.name = '{{ $allergene->name }}';
                                    this.icon = '{{ $allergene->icon }}';
                                    this.edit = false;
                                }
                            }"
                            @keydown.escape.window="reset()"
                        >
                            <!-- Data ID -->
                            <td class="py-2 px-6 border-b border-gray-200 text-center">{{ $allergene->id }}</td>

                            <!-- Data name -->
                            <td class="py-2 px-6 border-b border-gray-200 text-center">
                                <div x-show="!edit">
                                    {{ $allergene->name }}
                                </div>
                                <div x-show="edit">
                                    <input type="text" x-model="name" class="w-full bg-gray-100 border border-gray-300 rounded-lg p-0.75">
                                </div>
                            </td>

                            <!-- Data icon -->
                            <td class="py-2 px-6 border-b border-gray-200 text-center">
                                <div x-show="!edit">
                                    @if ($allergene->icon)
                                        <img src="{{ asset('web_images/allergens_icons/' . $allergene->icon) }}" alt="{{ $allergene->name }}" class="w-8 h-8 mx-auto">
                                    @else
                                        X
                                    @endif
                                </div>
                                <div x-show="edit">
                                    <input type="text" x-model="icon" class="w-full bg-gray-100 border border-gray-300 rounded-lg p-0.75">
                                </div>
                            </td>

                            <!-- Data edit -->
                            <td class="py-2 px-6 border-b border-gray-200 text-center">
                                <div class="flex justify-center items-center space-x-4">
                                    <!-- Edit button -->
                                    <button type="button" @click="edit = true" class="text-blue-600 cursor-pointer hover:text-blue-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.862 3.487a2.25 2.25 0 113.182 3.182L7.5 19.213l-4 1 1-4L16.862 3.487z" />
                                        </svg>
                                    </button>

                                    <!-- Validate the form (modification) -->
                                    <form method="POST" action="{{ route('admin.allergenes.update', $allergene->id) }}" x-show="edit" class="flex items-center space-x-2">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="name" :value="name">
                                        <input type="hidden" name="icon" :value="icon">
                                        <button type="submit" class="text-green-600 cursor-pointer hover:text-green-800" title="Valider">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </button>
                                    </form>

                                    <!-- Reset and cancel the form -->
                                    <button type="button" x-show="edit" @click="reset()" class="text-red-600 cursor-pointer hover:text-red-800" title="Annuler">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>

                                    <!-- Delete the row -->
                                    <form action="{{ route('admin.allergenes.destroy', $allergene->id) }}" method="POST" onsubmit="return confirm('Supprimer cet allergène ?');" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Supprimer" class="cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600 hover:text-red-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-4 0a1 1 0 00-1 1v1h6V4a1 1 0 00-1-1m-4 0h4" />
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