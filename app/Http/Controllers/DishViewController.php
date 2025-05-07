<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DishViewController extends Controller
{
    /**
     * Display the dishes with the automatic filter.
     */
    public function index()
    {
        // Get the user allergens
        $user = Auth::user();
        $userAllergenIds = $user->allergens->pluck('id');

        // Get the dishes without allergens of the user
        $dishes = Dish::whereDoesntHave('allergens', function ($query) use ($userAllergenIds) {
            $query->whereIn('allergen_id', $userAllergenIds); // Make the comparison
        })->with('images')->get(); // Less requests on the view page

        // Return the view
        return view('dishes.index', [
            'dishes' => $dishes,
        ]);
    }

    /**
     * Display the dish.
     */
    public function show(Dish $dish)
    {
        return view('dishes.show', [
            'dish' => $dish,
        ]);
    }

    /**
     * Display the dish.
     */
    public function search(Request $request)
    {
        $query = $request->q;
        $userAllergenIds = Auth::user()->allergens->pluck('id');

        $dishes = Dish::where('name', 'like', "%{$query}%")
            ->whereDoesntHave('allergens', function ($q) use ($userAllergenIds) {
                $q->whereIn('allergen_id', $userAllergenIds);
            })
            ->with('images')
            ->get();

        return view('dishes.partials.list', compact('dishes'));
    }
}
