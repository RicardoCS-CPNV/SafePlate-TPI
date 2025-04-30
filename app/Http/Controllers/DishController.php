<?php

namespace App\Http\Controllers;

use App\Http\Requests\DishRequest;
use App\Models\Allergen;
use App\Models\Dish;
use App\Models\DishImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.dishes.index', [
            'dishes' => Dish::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dishes.create', [
            'allergens' => Allergen::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DishRequest $request)
    {
        $validated = $request;

        // dd($validated);

        $dish = Dish::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
        ]);

        if ($request->filled('allergens')) {
            $dish->allergens()->sync($request->input('allergens'));
        }

        if($request->hasFile('images')) {
            $counter = 1;
            foreach($request->file('images') as $imageFile) {
                $extension = $imageFile->getClientOriginalExtension();
                $filename = $dish->id . '_' . $counter . '.' . $extension;

                // Stocker le fichier dans 'storage/app/public/dish_images'
                $path = $imageFile->storeAs('dish_images', $filename, 'public');
                DishImage::create([
                    'dish_id' => $dish->id,
                    'path' => $path,
                ]);
                $counter++;
            }
        }

        return redirect()->route('admin.dishes.menu')->with('success', 'Plat créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dish $dish)
    {
        foreach($dish->images as $image) {
            Storage::disk('public')->delete($image->path);
        }

        $dish->allergens()->detach();

        $dish->delete();

        return redirect()->route('admin.dishes.menu')->with('success', 'Plat supprimé avec succès.');
    }
}
