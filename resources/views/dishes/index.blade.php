@extends('base')

@section('title', 'Plats du restaurant')

@section('content')
<div class="mx-4 md:mx-10 xl:mx-20 my-6">

    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-left">Nos plats</h1>
    
    @if(session('success'))
        <div id="flash-message" class="bg-green-200 text-green-900 py-3 px-10 rounded-md absolute top-15 left-1/2 transform -translate-x-1/2 w-fit transition-opacity duration-300">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-2 sm:flex sm:flex-wrap gap-6">
        @foreach ($dishes as $dish)
            <div class="bg-white rounded-xl h-[300px] sm:w-[200px] shadow-md overflow-hidden flex flex-col justify-between">
                {{-- Image avec navigation --}}
                <div x-data="{ index: 0 }" class="select-none relative w-full h-80 bg-gray-100 overflow-hidden">
                    <template x-for="(image, i) in {{ $dish->images->toJson() }}" :key="i">
                        <a href="{{ route('dishes.show', $dish->id) }}">
                            <img x-show="index === i"
                                :src="'/storage/' + image.path"
                                alt=""
                                draggable="false"
                                class="absolute inset-0 w-full h-full object-cover transition-all duration-300 ease-in-out"
                                x-cloak>
                        </a>
                    </template>

                    {{-- Navigation --}}
                    <template x-if="{{ $dish->images->count() }} > 1">
                        <div>
                            <button @click="index = (index === 0) ? {{ $dish->images->count() }} - 1 : index - 1"
                                    class="cursor-pointer absolute top-1/2 left-2 transform -translate-y-1/2 bg-white bg-opacity-70 hover:bg-opacity-90 text-gray-800 px-2 py-1 rounded shadow">
                                &lt;
                            </button>
                            <button @click="index = (index === {{ $dish->images->count() }} - 1) ? 0 : index + 1"
                                    class="cursor-pointer absolute top-1/2 right-2 transform -translate-y-1/2 bg-white bg-opacity-70 hover:bg-opacity-90 text-gray-800 px-2 py-1 rounded shadow">
                                &gt;
                            </button>
                        </div>
                    </template>
                </div>

                {{-- Infos plat --}}
                <div class="p-4 pt-2 flex flex-col justify-between h-full">
                    <div>
                        <a href="{{ route('dishes.show', $dish->id) }}" class="text-lg font-bold text-gray-900 line-clamp-2">{{ $dish->name }}</a>
                        <p class="text-sm text-gray-600 mb-1">Prix : <strong>{{ number_format($dish->price, 2) }} CHF</strong></p>
                    </div>

                    {{-- Formulaire --}}
                    <form action="{{ route('cart.store') }}" method="POST" class="mt-3 flex items-center justify-between gap-2">
                        @csrf
                        <input type="hidden" name="dish_id" value="{{ $dish->id }}">

                        <select name="quantity" class="cursor-pointer border rounded px-2 py-1 text-sm bg-gray-50 text-gray-800">
                            @for ($i = 1; $i <= 9; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>

                        <button type="submit"
                                class="select-none cursor-pointer bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded shadow">
                            Ajouter
                        </button>
                    </form>
                </div>
            </div>


        @endforeach
    </div>
</div>
@endsection