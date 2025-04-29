@extends('base')

@section('title', 'Profil')

@section('content')
    @if(session('success'))
        <div id="flash-message" class="bg-green-200 text-green-900 py-3 px-10 rounded-md absolute top-10 left-1/2 transform -translate-x-1/2 w-fit transition-opacity duration-300">
            {{ session('success') }}
        </div>
    @endif

    <h1>Gérer votre profil</h1>



    <h2>Vos allergènes :</h2>
    <ul>
        @foreach ($userAllergens as $allergen)
            <li>{{ $allergen->name }}</li>
        @endforeach
    </ul>

    <h3>Ajouter des allergènes :</h3>

    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        
        <label for="allergens">Choisir des allergènes :</label>
        <select name="allergens[]" id="allergens" multiple class="bg-gray-200 h-fit">
            @foreach ($allAllergens as $allergen)
                <option value="{{ $allergen->id }}" @selected(in_array($allergen->id, $userAllergenIds))>
                    {{ $allergen->name }}
                </option>
            @endforeach
        </select>
        
        <button type="submit">Mettre à jour</button>
    </form>
@endsection