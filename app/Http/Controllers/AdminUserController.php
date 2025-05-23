<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all(); // Get all the users
        $activeUsers = DB::table('sessions'); // Get the active users (guest, user and admin)

        return view('admin.users.index', compact(['users', 'activeUsers']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Check if the request is good
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'role_id' => 'required|in:1,2',
        ]);

        // Update the user
        $user->update($request->only(['firstname','lastname','email','role_id']));

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur mis à jour.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Delete the user
        $user->delete();
        
        return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé.');
    }
}
