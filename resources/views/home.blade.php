@extends('base')

@section('title', 'Home')

@section('content')
    <h1>Home</h1>
    @if (Auth::check())
        <p>Vous êtes connecté</p>
    @endif
    <a href="{{ route('auth.register') }}">S'inscrire</a>

@endsection