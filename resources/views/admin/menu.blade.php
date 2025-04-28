@extends('base')

@section('title', 'Admin')

@section('content')

    <h1>Gestion Administrateur</h1>

    <a href="{{ route('admin.allergenes.menu') }}">Gerer les allergenes</a>

@endsection