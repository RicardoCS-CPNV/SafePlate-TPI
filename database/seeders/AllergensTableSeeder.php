<?php

namespace Database\Seeders;

use App\Models\Allergen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
Use Illuminate\Support\Str;

class AllergensTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $allergens = [
            'Gluten',
            'Arachides',
            'Fruits à coque',
            'Lait',
            'Œufs',
            'Poissons',
            'Crustacés',
            'Mollusques',
            'Soja',
            'Céleri',
            'Moutarde',
            'Graines de sésame',
            'Lupin',
            'Sulfites',
            'Maïs',
            'Fruits exotiques',
            'Tomate',
            'Fraises',
            'Chocolat',
            'Champignons',
        ];

        foreach ($allergens as $allergen) {
            Allergen::create([
                'name' => $allergen,
                'icon' => Str::slug($allergen) . ".png",
            ]);
        }
    }
}
