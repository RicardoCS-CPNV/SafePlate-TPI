@extends('base')

@section('title', 'Profil')

@section('content')
@if(session('success'))
<div id="flash-message" class="bg-green-200 text-green-900 py-3 px-10 rounded-md absolute top-10 left-1/2 transform -translate-x-1/2 w-fit transition-opacity duration-300">
    {{ session('success') }}
</div>
@endif

<div class=" mx-auto md:mx-10 lg:mx-20 p-6 bg-white shadow-lg rounded-lg mt-10">
    <h1 class="text-3xl font-bold mb-4 text-gray-800 text-center md:text-left">Gérer votre profil</h1>

    <!-- User allergens list -->
    <div class="mb-0">
        <h2 class="text-2xl font-semibold mb-4 text-gray-700 text-center md:text-left">Vos allergènes :</h2>

        <div class="flex flex-wrap gap-4 justify-center md:justify-normal">
            @forelse ($userAllergens as $allergen)
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
    </div>

    <!-- Form to add allergens -->
    <div class=" bg-white rounded-2xl mt-10">
        <h2 class="text-3xl font-bold text-green-500 mb-8 text-center md:text-left">Modifier vos allergènes</h2>

        <form action="{{ route('profile.update') }}" method="POST" class="space-y-8">
            @csrf

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6 mb-25 md:mb-0">
                @foreach ($allAllergens as $allergen)
                <div class="relative">
                    <input
                        type="checkbox"
                        name="allergens[]"
                        value="{{ $allergen->id }}"
                        id="allergen-{{ $allergen->id }}"
                        @checked(in_array($allergen->id, $userAllergenIds))
                    class="hidden peer"
                    >

                    <label for="allergen-{{ $allergen->id }}"
                        class="flex flex-col items-center p-4 bg-gray-50 hover:bg-gray-100 border-2 border-transparent rounded-xl cursor-pointer transition-all duration-300 shadow-sm
                                peer-checked:bg-green-400 peer-checked:hover:bg-green-500 hover:border-blue-300">

                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mb-3 shadow-inner">
                            <img
                                src="{{ asset('web_images/allergens_icons/' . $allergen->icon) }}"
                                alt="{{ $allergen->name }}"
                                class="w-10 h-10 object-contain"
                                draggable="false">
                        </div>

                        <span class="text-gray-700 text-sm text-center">{{ $allergen->name }}</span>

                        <div class="hidden peer-checked:block mt-2 text-green-600 text-sm font-semibold">
                            Sélectionné
                        </div>

                    </label>
                </div>
                @endforeach
            </div>

            <!-- Bouton de validation -->
            <div class="md:relative fixed bottom-5 left-0 right-0 py-4 flex justify-center md:mt-6">
                <button type="submit" class="cursor-pointer bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-3 px-8 rounded-2xl shadow-md transition-all">
                    Mettre à jour mes allergènes
                </button>
            </div>

        </form>
    </div>

    @endsection