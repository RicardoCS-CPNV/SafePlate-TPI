<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use Illuminate\Http\Request;

class DishViewController extends Controller
{
    public function index()
    {
        return view('dishes.index',[
            'dishes' => Dish::all(),
        ]);
    }

    public function show(Dish $dish)
    {
        return view('dishes.show', [
            'dish' => $dish,
        ]);
    }
}
