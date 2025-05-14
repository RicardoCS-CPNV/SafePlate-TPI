<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartItems = Auth::user()->cartItems()->with('dish')->get();
        return view('cart.index', compact('cartItems'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddToCartRequest $request)
    {
        $user = Auth::user();
        $dishId = $request->dish_id;
        $quantity = $request->quantity;

        $item = $user->cartItems()->where('dish_id', $dishId)->first();

        // Check if dish already on cart
        if ($item) { // Increment thr quantity of the dish
            $item->increment('quantity', $quantity);
        } else { // Add the dish to the cart
            $user->cartItems()->create([
                'dish_id' => $dishId,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Plat ajouté au panier.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CartItem $cartItem)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1|max:99'
        ]);

        $cartItem->update([
            'quantity' => $validated['quantity'],
        ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CartItem $cartItem)
    {
        $cartItem->delete();

        return redirect()->back()->with('success', 'Plat supprimé du panier.');
    }

    public function clear()
    {
        $user = Auth::user();
        $user->cartItems()->delete();

        return redirect()->route('cart.index')->with('success', 'Votre panier a été vidé.');
    }
}
