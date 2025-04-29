<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Allergen;
use App\Models\Gender;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use const Dom\INDEX_SIZE_ERR;

class AuthController extends Controller
{
    // Show the registration form
    public function showRegistrationForm()
    {
        if (Auth::check()) {
            return redirect()->route('home')->with('success', 'Vous êtes déjà connecté(e)');
        }
        // Find all the genders from the database and pass them to the view
        $genders = Gender::all();
        
        return view('auth.register', compact('genders'));
    }

    // Create a new user
    public function store(RegisterRequest $request)
    {
        // Create the user
        $user = User::create(
            $request->only(['firstname', 'lastname', 'email', 'gender_id']) + [
                'password' => bcrypt($request->password),
                'role_id' => 2,
            ]
        );

        // Log the user in
        Auth::login($user);

        // Redirect to the home page
        return redirect()->route('home')->with('success', 'Votre compte a été créé avec succès ! 🎉');
    }

    // Show the login form
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('home')->with('success', 'Vous êtes déjà connecté(e)');
        }

        return view('auth.login');
    }

    // Login the user
    public function login(LoginRequest $request)
    {
        // Validate the request
        $credentials = $request->only('email', 'password');

        // Attempt to log the user in
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Regenerate the session
            return redirect()->route('home')->with('success', 'Bienvenue, vous êtes connecté(e) ! 👋');
        }else{ // If the login attempt fails
            // Redirect the user back to the login form
            return to_route('auth.login')->withErrors([
                'failed' => 'Les identifiants sont incorrects.' // Display an error message
            ])->onlyInput('email');
        }
    }

    // Logout the user
    public function logout(Request $request)
    {
        Auth::logout(); // Log the user out
        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate the session token
        return redirect()->route('auth.login');
    }

    public function edit(User $user)
    {
        $user = Auth::user();

        return view('user.profile',[
            'userAllergens' => $user->allergens,
            'userAllergenIds' => $user->allergens->pluck('id')->toArray(),
            'allAllergens' => Allergen::all(),
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user(); // User connected

        $data = $request->validate([
            'allergens' => 'array',
            'allergens.*' => 'exists:allergens,id',
        ]);

        // Sync allergens (Add or delete)
        $user->allergens()->sync($data['allergens'] ?? []);

        return redirect()->back()->with('success', 'Allergènes mis à jour !');
    }
}