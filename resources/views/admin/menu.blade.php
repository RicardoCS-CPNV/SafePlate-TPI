@extends('base')

@section('title', 'Admin')

@section('content')

<div class="mx-4 md:mx-10 xl:mx-20 my-6">
    <!-- Back Button -->
    <div class="my-4">
        <a href="{{ url()->previous() }}"  class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-600 font-semibold rounded-lg shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Retour
        </a>
    </div>

    <h1 class="text-3xl font-bold text-gray-800 mb-6 :text-left">Gestion Administrateur</h1>
    
    
    <a href="{{ route('admin.allergenes.menu') }}" class="bg-red-300 py-2 px-4 font-semibold hover:bg-amber-400 rounded-full">Gerer les allergenes</a>
    
    <a href="{{ route('admin.dishes.menu') }}" class="bg-red-300 py-2 px-4 font-semibold hover:bg-amber-400 rounded-full">Gerer les plats</a>

    <a href="{{ route('admin.users.index') }}" class="bg-red-300 py-2 px-4 font-semibold hover:bg-amber-400 rounded-full">Gerer les utilisateurs</a>
</div>


@endsection