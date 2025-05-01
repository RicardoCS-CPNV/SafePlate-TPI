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
            'dish' => null,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DishRequest $request)
    {
        $validated = $request;

        // Create the dish
        $dish = Dish::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => number_format($validated['price']),
        ]);

        // Check if allergens were selecte and add them
        if ($request->filled('allergens')) {
            $dish->allergens()->sync($request->input('allergens'));
        }

        // Check if images were selecte and add them
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
        $dish = Dish::with('allergens')->findOrFail($id);

        return view('admin.dishes.create', [
            'dish' => $dish,
            'allergens' => Allergen::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DishRequest $request, Dish $dish)
    {
        $validated = $request;

        // Update the dish
        $dish->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
        ]);

        // Update allergens
        if ($request->filled('allergens')) {
            $dish->allergens()->sync($validated['allergens']);
        }

        // Add images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $imageFile) {
                $filename = $dish->id . '_' . now()->timestamp . '_' . $index . '.' . $imageFile->getClientOriginalExtension();
                $path = $imageFile->storeAs('dish_images', $filename, 'public');
                $dish->images()->create(['path' => $path]);
            }
        }

        return redirect()->route('admin.dishes.edit', $dish->id)->with('success', 'Plat mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dish $dish)
    {
        // Check all the images and delete them from the public disk
        foreach($dish->images as $image) {
            Storage::disk('public')->delete($image->path);
        }

        // Delete the link between the dish and the allergens
        $dish->allergens()->detach();

        // Delete the dish
        $dish->delete();

        return redirect()->route('admin.dishes.menu')->with('success', 'Plat supprimé avec succès.');
    }

    public function destroyImage(DishImage $image)
    {
        if ($image->path && Storage::disk('public')->exists($image->path)) {
            Storage::disk('public')->delete($image->path);
        }

        $image->delete();

        return back()->with('success', "Image supprimée de l'annonce.");
    }
}
