<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'ordered_at', 'total_price'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function dishes() {
        return $this->belongsToMany(Dish::class, 'order_dish')->withPivot('quantity');
    }
}
