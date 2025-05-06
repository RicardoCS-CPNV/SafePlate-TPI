@extends('base')

@section('title', 'Créer un plat')

@section('content')

    <div class="max-w-5xl mx-auto px-4 md:px-10 py-5 bg-white md:shadow-md rounded-md">
        <!-- Back Button -->
        <div class="mb-4 mt-1">
            <a href="{{ route('admin.dishes.menu') }}"  class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-600 font-semibold rounded-lg shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Retour
            </a>
        </div>

        <h1 class="text-3xl font-bold text-gray-800 mb-2 md:mb-8 text-center md:text-left">
            {{ $dish ? 'Modifier le plat' : 'Créer un plat' }}
        </h1>

        <form action="{{ $dish ? route('admin.dishes.update', $dish->id) : route('admin.dishes.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @if ($dish)
                @method('PUT')
            @endif
            <div class="flex flex-col md:flex-row w-full gap-4">
                {{-- Title --}}
                <div class="flex-1/2">
                    <label for="name" class="mb-2 text-gray-600 font-semibold">Nom du plat</label>
                    <input autocomplete="off" type="text" name="name" id="name" value="{{ old('name', $dish->name ?? '') }}"
                           class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                {{-- Price --}}
                <div class="flex-1/2">
                    <label for="price" class="mb-2 text-gray-600 font-semibold">Prix (CHF)</label>
                    <input autocomplete="off" type="text" name="price" id="price" value="{{ old('price', $dish->price ?? '') }}"
                           class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    @error('price')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Description --}}
            <div>
                <label for="description" class="text-gray-600 font-semibold">Description</label>
                <textarea autocomplete="off" name="description" id="description" rows="7"
                       class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">{{ old('description', $dish->description ?? '') }}</textarea>
                @error('description')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Images --}}
            <div>
                <label for="images" class="mb-2 text-gray-600 font-semibold">Images</label>
                <input type="file" name="images[]" id="images" multiple
                       class="mt-1 block w-full text-sm text-gray-700 file:bg-amber-300 file:border-none file:rounded file:px-4 file:py-2 file:text-white file:font-semibold file:cursor-pointer hover:file:bg-amber-400 transition duration-200">
                @error('images')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
                @error('images.*')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
                <div id="preview-container" class="mt-4 flex flex-wrap gap-2"></div>
            </div>

            {{-- Allergens --}}
            <div>
                <label for="allergens" class="mb-2 text-gray-600 font-semibold">Allergènes</label>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-2">
                    @foreach ($allergens as $allergen)
                        <div class="relative select-none min-w-fit">
                            <input
                                type="checkbox"
                                name="allergens[]"
                                value="{{ $allergen->id }}"
                                id="allergen-{{ $allergen->id }}"
                                class="hidden peer"
                                {{ (is_array(old('allergens', $dish?->allergens->pluck('id')->toArray())) && in_array($allergen->id, old('allergens', $dish?->allergens->pluck('id')->toArray()))) ? 'checked' : '' }}
                            >

                            <label for="allergen-{{ $allergen->id }}"
                                class="flex justify-baseline items-center font-semibold px-4 py-2 gap-1.5 bg-gray-50 hover:bg-gray-100 border-2 border-transparent rounded-xl cursor-pointer transition-all duration-300 shadow-sm
                                        peer-checked:bg-green-400 peer-checked:hover:bg-green-500 hover:border-blue-300">

                                <div class="min-w-12 min-h-12 bg-white rounded-full flex items-center align-bottom justify-center shadow-inner">
                                    <img
                                        src="{{ asset('web_images/allergens_icons/' . $allergen->icon) }}"
                                        alt="{{ $allergen->name }}"
                                        class="w-8 h-8 object-contain"
                                        draggable="false">
                                </div>

                                <span class="text-gray-700 text-sm text-center">{{ $allergen->name }}</span>

                            </label>
                        </div>
                    @endforeach
                </div>
                @error('allergens')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit button --}}
            <div class="text-left">
                <button type="submit"
                        class="w-full md:w-fit inline-block bg-green-500 hover:bg-green-600 text-white font-bold py-2.5 px-6 rounded transition duration-200">
                        {{ $dish ? 'Enregistrer les modifications' : 'Créer le plat' }}
                </button>
            </div>
        </form>
    </div>

    {{-- Script for images --}}
    <script>
        const imageInput = document.getElementById('images');
        const previewContainer = document.getElementById('preview-container');

        let selectedFiles = [];

        imageInput.addEventListener('change', () => {
            selectedFiles = Array.from(imageInput.files);
            showPreviews();
        });

        function showPreviews() {
            previewContainer.innerHTML = '';

            selectedFiles.forEach((file, index) => {
                const reader = new FileReader();

                reader.onload = (e) => {
                    const wrapper = document.createElement('div');
                    wrapper.className = 'relative w-fit';

                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'w-fit h-20 object-cover rounded shadow';

                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.innerText = '✕';
                    btn.className = 'absolute cursor-pointer top-1 right-1 bg-red-500 text-white text-xs px-1 py-0.5 rounded hover:bg-red-600';
                    btn.addEventListener('click', () => {
                        // Supprimer ce fichier du tableau
                        selectedFiles.splice(index, 1);
                        rebuildInputFiles();
                        showPreviews(); // Re-rendu
                    });

                    wrapper.appendChild(img);
                    wrapper.appendChild(btn);
                    previewContainer.appendChild(wrapper);
                };

                reader.readAsDataURL(file);
            });
        }

        function rebuildInputFiles() {
            const dataTransfer = new DataTransfer();
            selectedFiles.forEach(file => dataTransfer.items.add(file));
            imageInput.files = dataTransfer.files;
        }
    </script>



@endsection
