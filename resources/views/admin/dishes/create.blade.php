@extends('base')

@section('title', 'Créer un plat')

@section('content')

    <h1 class="mx-4 md:mx-10 xl:mx-20 py-4 text-3xl font-bold">Créer un plat</h1>

    <form action="{{ route('admin.dishes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="flex flex-col items-baseline gap-2">
            <div>
                <label for="name">Titre</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="bg-amber-200">
            </div>
            <div>
                <label for="description">Description</label>
                <input type="text" name="description" id="description" value="{{ old('description') }}" class="bg-amber-200">
            </div>
            <div>
                <label for="price">Prix</label>
                <input type="text" name="price" id="price" value="{{ old('price') }}" class="bg-amber-200">
            </div>
            <div>
                <label for="images">Images</label>
                <input type="file" name="images[]" id="images" multiple>
            </div>
            <div class="flex flex-col">
                <label for="allergens">Allergènes</label>
                <select name="allergens[]" id="allergens" multiple>
                    @foreach ($allergens as $allergen)
                        <option value="{{ $allergen->id }}">{{ $allergen->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit">Créer</button>
        </div>
    </form>

@endsection