<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
    ];

    public function allergens()
    {
        return $this->belongsToMany(Allergen::class, 'allergen_dish');
    }

    public function images()
    {
        return $this->hasMany(DishImage::class);
    }
}
