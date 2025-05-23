<?php

namespace App\Http\Controllers;

use App\Models\Allergen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as FacadesRequest;

class AllergenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Show the view and send the list of allergens
        return view('admin.allergenes.menu',[
            'allergenes' => Allergen::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Check if the request is correct
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
        ]);

        // Create allergen
        Allergen::create($data);

        // Redirect with a success message
        return redirect()->back()->with('success', 'Allergène créé avec succès !');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Allergen $allergene)
    {
        // Check if the request is correct
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
        ]);

        // Update allergen
        $allergene->update($validate);

        return redirect()->route('admin.allergenes.menu')->with('success', 'Allergène mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Allergen $allergene)
    {
        $allergene->delete();

        return redirect()->back()->with('success', 'Allergène supprimé avec succès.');
    }
}
