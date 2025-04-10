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
    <h1>Se connecter</h1>
    <form action="{{ route('auth.login') }}" method="post" class="flex flex-col gap-4">
        @csrf
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
        <!-- Submit -->
        <div>
            <button id="submit" type="submit">Submit</button>
        </div>
    </form>
</body>

</html>