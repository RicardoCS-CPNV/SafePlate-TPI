<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DishImage extends Model
{
    protected $fillable = [
        'dish_id',
        'path',
    ];

    public function dish()
    {
        return $this->belongsTo(Dish::class);
    }
}
