@extends('base')

@section('title', 'Allergenes')

@section('content')
    @if(session('success'))
        <div id="flash-message" class="bg-green-200 text-green-900 py-3 px-10 rounded-md absolute top-10 left-1/2 transform -translate-x-1/2 w-fit transition-opacity duration-300">
            {{ session('success') }}
        </div>
    @endif
    <h1>Gestion allergènes</h1>

    <a href="{{ route('admin.allergenes.store') }}">Créer une allergene</a>

    <form action="{{ route('admin.allergenes.store') }}" method="POST" class="flex flex-col w-24">
        @csrf
        <label for="name">Nom</label>
        <input type="text" id="name" name="name" class="bg-gray-200">
        <label for="icon">Icon</label>
        <input type="text" id="icon" name="icon" class="bg-gray-200">
        <button type="submit">Créer</button>
    </form>

    <table class="table-auto border-collapse border border-gray-300">
        <thead>
            <tr>
                <th class="border border-gray-300 px-4 py-2">Nom</th>
                <!-- <th class="border border-gray-300 px-4 py-2">Icon</th> -->
                 <th class="border border-gray-300 px-4 py-2">Edit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allergenes as $allergene)
                <tr>
                    <td class="border border-gray-300 px-4">{{ $allergene->name }}</td>
                    <!-- <td class="border border-gray-300 px-4 py-0">
                        <img src="{{ asset('icons/' . $allergene->icon) }}" alt="{{ $allergene->name }}" class="w-8 h-8">
                    </td> -->
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection