@extends('auth.authForm')

@section('title', 'Connexion')

@section('content')
    <div class="min-h-screen bg-gray-100 text-gray-900 flex justify-center items-center">
        <div class="h-screen sm:h-fit max-w-screen-xl m-0 sm:m-10 bg-white shadow sm:rounded-lg flex justify-center items-center flex-1 overflow-hidden">
            <div class="lg:w-1/2 xl:w-5/12 p-6 sm:p-12 flex flex-col items-center @if (!$errors->any()) slide-in-right @endif">
                <a href="{{ route('home') }}" class="flex justify-center  h-12 items-center gap-[4px]">
                    <img src="{{ asset('storage/web_images/Logo_Illustration.png') }}"
                        class="mx-auto h-12" />
                    <img src="{{ asset('storage/web_images/Logo_Text.png') }}"
                        class="mx-auto h-10" />
                </a>
                <div class="mt-8 flex flex-col items-center">
                    <h1 class="text-2xl xl:text-3xl font-extrabold">
                        Connexion
                    </h1>
                    <div class="w-full flex-1 mt-4">
                        <div class="mx-auto max-w-xs">
                            <div class="mt-2">
                                <!-- Form -->
                                <form action="{{ route('auth.login') }}" method="post" class="relative">
                                    @csrf
                                    @error('failed')
                                        <p class="absolute -top-2 text-red-500">{{ $message }}</p>
                                    @enderror
                                    <div class="divide-y divide-gray-200">
                                        <div class="pt-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
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
                                            <!-- Submit -->
                                            <div class="my-6">
                                                <button type="submit" class="hover:bg-gray-700 cursor-pointer w-full rounded-md bg-black px-3 py-4 text-white focus:bg-gray-600 focus:outline-none">Se connecter</button>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-center text-sm text-gray-500">Vous n'avez pas de compte ?
                                        <a href="{{ route('auth.register') }}" class="font-semibold text-gray-600 hover:underline focus:text-gray-800 focus:outline-none">
                                            S'inscrire
                                        </a>.
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>     
            </div>
            <div class="relative flex-1 bg-indigo-100 text-center cover center hidden lg:flex @if (!$errors->any()) slide-in-left @endif">
                <div class="absolute top-1/2 transform -translate-y-1/2 left-8 flex flex-col items-start">
                    <h1 class="text-6xl font-extrabold text-white">SafePlate</h1>
                    <h2 class="text-3xl font-semibold text-white">Pour une cuisine <br>qui vous connait</h2>
                </div>
                <div class="h-full w-full">
                    <img src="{{ asset('storage/web_images/Auth_Aliment2.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
@endsection