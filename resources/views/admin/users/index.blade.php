@extends('base')

@section('title', 'Gestion des utilisateurs')

@section('content')
    <!-- Success Message -->
    @if(session('success'))
        <div id="flash-message" class="bg-green-200 text-green-900 py-3 px-10 rounded-md absolute top-15 left-1/2 transform -translate-x-1/2 w-fit transition-opacity duration-300">
            {{ session('success') }}
        </div>
    @endif

    <!-- Back Button -->
    <div class="mx-4 md:mx-10 xl:mx-20 mt-6">
        <a href="{{ route('admin.menu') }}"  class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-600 font-semibold rounded-lg shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Retour
        </a>
    </div>

    <div class="flex flex-wrap mx-4 md:mx-10 xl:mx-20 mt-4 gap-3 items-baseline justify-between">
        <h1 class="text-3xl font-bold">Gestion des utilisateurs</h1>
        <div class="sm:text-end">
            <p class="text-xl font-semibold">Utilisateur total: {{ $users->count() }}</p>
            <p class="text-xl font-semibold">Utilisateur connecté: {{ $activeUsers->whereNotNull('user_id')->count() }}</p>
        </div>
    </div>

    <!-- Users list -->
    <div class="shadow-lg rounded-lg overflow-x-auto mx-4 md:mx-10 xl:mx-20 mb-10">
        <table class="w-full min-w-fit">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-4 px-4 text-center text-gray-600 font-bold uppercase">ID</th>
                    <th class="py-4 px-6 text-left text-gray-600 font-bold uppercase">Prénom</th>
                    <th class="py-4 px-6 text-left text-gray-600 font-bold uppercase">Nom</th>
                    <th class="py-4 px-6 text-left text-gray-600 font-bold uppercase">Email</th>
                    <th class="py-4 px-6 text-left text-gray-600 font-bold uppercase">Rôle</th>
                    <th class="min-w-38 py-4 px-6 text-center text-gray-600 font-bold uppercase">Actions</th>
                </tr>
            </thead>
                <tbody class="bg-white">
                    @foreach ($users as $user)
                        <tr x-data="{
                                edit: false,
                                firstname: '{{ $user->firstname }}',
                                lastname: '{{ $user->lastname }}',
                                email: '{{ $user->email }}',
                                role_id: '{{ $user->role_id }}',
                                reset() {
                                    this.edit = false;
                                    this.firstname = '{{ $user->firstname }}';
                                    this.lastname = '{{ $user->lastname }}';
                                    this.email = '{{ $user->email }}';
                                    this.role_id = '{{ $user->role_id }}';
                                }
                            }" @keydown.escape.window="reset()"
                            class="hover:bg-gray-100 transition">
                            <td class="py-2 px-6 border-b border-gray-200 text-center">{{ $user->id }}</td>

                            <!-- Firstname -->
                            <td class="py-2 px-6 border-b border-gray-200 text-left">
                                <template x-if="!edit">
                                    <span x-text="firstname"></span>
                                </template>
                                <template x-if="edit">
                                    <input type="text" x-model="firstname" class="w-full bg-gray-100 border border-gray-300 rounded-lg px-0.75">
                                </template>
                            </td>

                            <!-- Lastname -->
                            <td class="py-2 px-6 border-b border-gray-200 text-left">
                                <template x-if="!edit">
                                    <span x-text="lastname"></span>
                                </template>
                                <template x-if="edit">
                                    <input type="text" x-model="lastname" class="w-full bg-gray-100 border border-gray-300 rounded-lg px-0.75">
                                </template>
                            </td>

                            <!-- Email -->
                            <td class="py-2 px-6 border-b border-gray-200 text-left">
                                <template x-if="!edit">
                                    <span x-text="email"></span>
                                </template>
                                <template x-if="edit">
                                    <input type="text" x-model="email" class="w-full bg-gray-100 border border-gray-300 rounded-lg px-0.75">
                                </template>
                            </td>

                            <!-- Role -->
                            <td class="py-2 px-6 border-b border-gray-200 text-left">
                                <template x-if="!edit">
                                    <span x-text="role_id == 1 ? 'Admin' : 'Utilisateur'"></span>
                                </template>
                                <template x-if="edit">
                                    <select x-model="role_id" class="w-full bg-gray-100 border border-gray-300 rounded-lg px-0.75">
                                        <option value="1">Admin</option>
                                        <option value="2">Utilisateur</option>
                                    </select>
                                </template>
                            </td>

                            <td class="py-2 px-6 border-b border-gray-200 text-center">
                                <div class="flex justify-center items-center space-x-4">
                                    <!-- Modify -->
                                    <button type="button" @click="edit = true" x-show="!edit" class="text-blue-600 cursor-pointer hover:text-blue-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.862 3.487a2.25 2.25 0 113.182 3.182L7.5 19.213l-4 1 1-4L16.862 3.487z" />
                                        </svg>
                                    </button>

                                    <!-- Validate -->
                                    <form method="POST" action="{{ route('admin.users.update', $user->id) }}" x-show="edit" class="flex items-center space-x-2">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="firstname" :value="firstname">
                                        <input type="hidden" name="lastname" :value="lastname">
                                        <input type="hidden" name="email" :value="email">
                                        <input type="hidden" name="role_id" :value="role_id">
                                        <button type="submit" class="text-green-600 cursor-pointer hover:text-green-800" title="Valider">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </button>
                                    </form>

                                    <!-- Cancel -->
                                    <button type="button" x-show="edit" @click="reset()" class="text-red-600 cursor-pointer hover:text-red-800" title="Annuler">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>

                                    <!-- Delete -->
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Supprimer cet utilisateur ?');" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600 hover:text-red-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-4 0a1 1 0 00-1 1v1h6V4a1 1 0 00-1-1m-4 0h4" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
