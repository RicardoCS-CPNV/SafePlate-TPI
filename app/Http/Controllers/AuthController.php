<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\Gender;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        $genders = Gender::all();
        return view('auth.register', compact('genders'));
    }

    public function store(RegisterRequest $request)
    {
        $user = User::create(
            $request->only(['firstname', 'lastname', 'email', 'gender_id']) + [
                'password' => bcrypt($request->password),
                'role_id' => 2,
            ]
        );

        Auth::login($user);

        return redirect()->route('home');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // ...
    }
}
