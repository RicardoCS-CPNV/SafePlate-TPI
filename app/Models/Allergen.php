<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Allergen extends Model
{
    protected $fillable = [
        'name',
        'icon',
    ];
    
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function dishes()
    {
        return $this->belongsToMany(Dish::class, 'allergen_dish');
    }
}
