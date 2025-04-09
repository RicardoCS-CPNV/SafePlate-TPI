<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <title>Document</title>
</head>

<body>
    <h1>S'inscrire</h1>
    <form action="{{ route('auth.register') }}" method="post" class="flex flex-col gap-4">
        @csrf
        <!-- Firstname -->
        <div class="flex flex-row items-center">
            <label for="firstname">Prénom</label>
            @error('firstname')
                <p class="ml-5 text-red-500 text-xs text-center">{{ $message }}</p>
            @enderror
            <input type="text" name="firstname" placeholder="Inscrivez votre prénom" value="{{ old('firstname') }}">
        </div>
        <!-- Lastname -->
        <div>
            @error('lastname')
                <p class="text-red-500 text-xs">{{ $message }}</p>
            @enderror
            <label for="lastname">Nom</label>
            <input type="text" name="lastname" placeholder="Inscrivez votre nom" value="{{ old('lastname') }}">
        </div>
        <!-- Gender -->
        <div>
            <p>Genre</p>
            @error('gender_id')
                <p class="text-red-500 text-xs">{{ $message }}</p>
            @enderror
            @foreach ($genders as $gender)
                <label>
                    <input 
                        type="radio" 
                        name="gender_id" 
                        value="{{ $gender->id }}"
                        {{ old('gender_id') == $gender->id ? 'checked' : '' }}
                    >
                    {{ ucfirst($gender->name) }}
                </label><br>
            @endforeach
        </div>
        <!-- Email -->
        <div>
            @error('email')
                <p class="text-red-500 text-xs">{{ $message }}</p>
            @enderror
            <label for="email">Adresse mail</label>
            <input type="email" name="email" placeholder="Inscrivez votre email" value="{{ old('email') }}">
        </div>
        <!-- Password -->
        <div>
            @error('password')
                <p class="text-red-500 text-xs">{{ $message }}</p>
            @enderror
            <label for="password">Mot de passe</label>
            <input type="password" name="password" placeholder="Inscrivez votre mot de passe">
        </div>
        <!-- Confirm Password -->
        <div>
            @error('password_confirmation')
                <p class="text-red-500 text-xs">{{ $message }}</p>
            @enderror
            <label for="password_confirmation">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" placeholder="Inscrivez votre nom">
        </div>
        <!-- Submit -->
        <div>
            <button id="submit" type="submit">Submit</button>
        </div>
    </form>
</body>

</html>