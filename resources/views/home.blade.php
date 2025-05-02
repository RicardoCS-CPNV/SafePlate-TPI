@extends('base')

@section('title', 'Home')

@section('content')
    @if(session('success'))
        <div id="flash-message" class="bg-green-200 text-green-900 py-3 px-10 rounded-md absolute top-10 left-1/2 transform -translate-x-1/2 w-fit transition-opacity duration-300">
            {{ session('success') }}
        </div>
    @endif

    <h1>Home</h1>
    @if (Auth::check())
        <p>Vous êtes {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
            @if (Auth::user()->role_id == 1)
            (admin)
            @elseif (Auth::user()->role_id == 2)
            (utilisateur)
            @endif
        </p>

        <form action="{{ route('auth.logout') }}" method="post" onsubmit="return confirm('Êtes-vous sur de vouloir vous déconnecter ?');" class="flex">
            @method("delete")
            @csrf
            <button class="hover:bg-red-300 transition-all cursor-pointer text-red-500 bg-red-200 w-fit py-1 px-4 rounded-full">Se déconnecter</button>
        </form>
        
        @if (Auth::user()->role_id == 1)
            <a class="text-green-800 bg-green-200 w-fit py-1 px-4 rounded-full" href="{{ route('admin.menu') }}">Admin</a>
        @endif
    @else
        <div class="mt-4 flex flex-col gap-2">
            <a href="{{ route('auth.register') }}" class="text-blue-500 bg-blue-200 w-fit py-1 px-4 rounded-full">S'inscrire</a>
            <a href="{{ route('auth.login') }}" class="text-blue-500 bg-blue-200 w-fit py-1 px-4 rounded-full">Se connecter</a>
        </div>
    @endif
@endsection