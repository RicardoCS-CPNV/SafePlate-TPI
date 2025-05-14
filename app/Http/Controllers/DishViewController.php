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
        $user = Auth::user();

        // Check if user is connected
        if ($user) {
            $userAllergenIds = $user->allergens->pluck('id');

            $dishes = Dish::whereDoesntHave('allergens', function ($query) use ($userAllergenIds) {
                $query->whereIn('allergen_id', $userAllergenIds);
            })->with('images')->get();
        } else {
            // if user is not connected
            $dishes = Dish::with('images')->get();
        }

        return view('dishes.index', compact('dishes'));
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
     * Display the dishes by the user's search.
     */
    public function search(Request $request)
    {
        $query = $request->q;
        $user = Auth::user();
    
        // Get the dishes by the user's search
        $dishesQuery = Dish::where('name', 'like', "%{$query}%");
    
        // Filter the search with the user's allergens
        if ($user) {
            $userAllergenIds = $user->allergens->pluck('id');
    
            $dishesQuery->whereDoesntHave('allergens', function ($q) use ($userAllergenIds) {
                $q->whereIn('allergen_id', $userAllergenIds);
            });
        }
    
        // Get the images
        $dishes = $dishesQuery->with('images')->get();
    
        return view('dishes.partials.list', compact('dishes'));
    }
}
