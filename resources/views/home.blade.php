@extends('base')

@section('title', 'Home')

@section('content')
    <h1>Home</h1>
    @if (Auth::user()->role_id == 2)
        <p>Vous êtes connecté</p>
        <p>Vous êtes {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</p>
        <form action="{{ route('auth.logout') }}" method="post" onsubmit="return confirm('Êtes-vous sur de vouloir vous déconnecter ?');" class="flex">
            @method("delete")
            @csrf
            <button class="hover:bg-red-300 transition-all cursor-pointer text-red-500 bg-red-200 w-fit py-1 px-4 rounded-full">Se déconnecter</button>
        </form>
    @elseif (Auth::user()->role_id == 1)
        <p>Vous êtes un admin</p>    
    @elseif (Auth::guest())
        <div class="mt-4 flex flex-col gap-2">
            <a href="{{ route('auth.register') }}" class="text-blue-500 bg-blue-200 w-fit py-1 px-4 rounded-full">S'inscrire</a>
            <a href="{{ route('auth.login') }}" class="text-blue-500 bg-blue-200 w-fit py-1 px-4 rounded-full">Se connecter</a>
        </div>
    @endif

@endsection