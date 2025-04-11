@extends('auth.authForm')

@section('title', 'Inscription')

@section('content')
    <div class="min-h-screen bg-gray-100 text-gray-900 flex justify-center items-center">
        <div class="h-screen sm:h-fit max-w-screen-xl m-0 sm:m-10 bg-white shadow sm:rounded-lg flex justify-center flex-row-reverse items-center flex-1 overflow-hidden">
            <div class="lg:w-1/2 xl:w-5/12 p-6 sm:p-12 flex flex-col items-center @if (!$errors->any()) slide-in-left @endif">
                <a href="{{ route('home') }}" class="cursor-pointer flex justify-center  h-12 items-center gap-[4px]">
                    <img src="{{ asset('storage/web_images/Logo_Illustration.png') }}"
                        class="mx-auto h-12" />
                    <img src="{{ asset('storage/web_images/Logo_Text.png') }}"
                        class="mx-auto h-10" />
                </a>
                <div class="mt-8 flex flex-col items-center">
                    <h1 class="text-2xl xl:text-3xl font-extrabold">
                        Inscription
                    </h1>
                    <div class="w-full flex-1 mt-4">
                        <div class="mx-auto max-w-xs">
                            <div class="mt-2">
                                <!-- Form -->
                                <form action="{{ route('auth.register') }}" method="post" class="relative">
                                    @csrf
                                    @error('failed')
                                        <p class="absolute -top-2 text-red-500">{{ $message }}</p>
                                    @enderror
                                    <div class="divide-y divide-gray-200">
                                        <div class="pt-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                                            <div class="flex gap-3 md:flex-row flex-col">
                                                <!-- Firstname -->
                                                <div class="relative">
                                                    <input autocomplete="off" id="firstname" name="firstname" type="text" value="{{ old('firstname') }}" class="cursor-pointer peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Prénom" />
                                                    <label for="firstname" class="cursor-pointer absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Prénom</label>
                                                    @error('firstname')
                                                        <p class="text-red-500 text-xs">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <!-- Lastname -->
                                                <div class="relative">
                                                    <input autocomplete="off" id="lastname" name="lastname" type="text" value="{{ old('lastname') }}" class="cursor-pointer peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Nom" />
                                                    <label for="lastname" class="cursor-pointer absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Nom</label>
                                                    @error('lastname')
                                                        <p class="text-red-500 text-xs">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Gender -->
                                            <div>
                                                <p>Genre</p>
                                                @error('gender_id')
                                                    <p class="text-red-500 text-xs">{{ $message }}</p>
                                                @enderror
                                                <div class="flex justify-between">
                                                    @foreach ($genders as $gender)
                                                        <label>
                                                            <input 
                                                                type="radio" 
                                                                name="gender_id" 
                                                                value="{{ $gender->id }}"
                                                                {{ old('gender_id') == $gender->id ? 'checked' : '' }}
                                                            >
                                                            {{ ucfirst($gender->name) }}
                                                        </label>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <!-- Email -->
                                            <div class="relative">
                                                <input autocomplete="off" id="email" name="email" type="text" value="{{ old('email') }}" class="cursor-pointer peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Adresse Email" />
                                                <label for="email" class="cursor-pointer absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Adresse Email</label>
                                                @error('email')
                                                    <p class="text-red-500 text-xs">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <!-- Password -->
                                            <div class="relative">
                                                <input autocomplete="off" id="password" name="password" type="password" class="cursor-pointer peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Mot de passe" />
                                                <label for="password" class="cursor-pointer absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Mot de passe</label>
                                                @error('password')
                                                    <p class="text-red-500 text-xs">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <!-- Confirm Password -->
                                            <div class="relative">
                                                <input autocomplete="off" id="password_confirmation" name="password_confirmation" type="password" class="cursor-pointer peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Confirmer le mot de passe" />
                                                <label for="password_confirmation" class="cursor-pointer absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Confirmer le mot de passe</label>
                                                @error('password_confirmation')
                                                    <p class="text-red-500 text-xs">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <!-- Submit -->
                                            <div class="my-6">
                                                <button type="submit" class="w-full rounded-md bg-black px-3 py-4 text-white focus:bg-gray-600 focus:outline-none hover:bg-gray-700 cursor-pointer">S'inscrire</button>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-center text-sm text-gray-500">Vous avez déjà un compte ?
                                        <a href="{{ route('auth.login') }}" class="font-semibold text-gray-600 hover:underline focus:text-gray-800 focus:outline-none">
                                            Se connecter
                                        </a>.
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>     
            </div>
            <div class="relative flex-1 bg-indigo-100 text-center cover center hidden lg:flex @if (!$errors->any()) slide-in-right @endif">
                <div class="absolute top-1/2 transform -translate-y-1/2 right-8 flex flex-col items-end">
                    <h1 class="text-6xl font-extrabold text-white">SafePlate</h1>
                    <h2 class="text-3xl font-semibold text-white">Pour une cuisine <br>qui vous connait</h2>
                </div>
                <div class="h-full w-full">
                    <img src="{{ asset('storage/web_images/Auth_Aliment.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
@endsection