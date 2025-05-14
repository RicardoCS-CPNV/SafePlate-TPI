<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmation;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Make a request to the DB
        $orders = Auth::user()
            ->orders() // Orders of the user
            ->with(['dishes']) // get the dishes relation
            ->orderByDesc('ordered_at')
            ->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $cartItems = $user->cartItems()->with('dish')->get();

        // Avoid problems / Cancel the order of there is a problem
        DB::transaction(function () use ($user, $cartItems) {
            // Calculate the total
            $total = $cartItems->sum(fn($item) => $item->dish->price * $item->quantity);
    
            // Create the order
            $order = Order::create([
                'user_id' => $user->id,
                'total_price' => $total,
                'ordered_at' => now(),
            ]);
    
            // Add dishes
            foreach ($cartItems as $item) {
                $order->dishes()->attach($item->dish_id, [
                    'quantity' => $item->quantity,
                ]);
            }
    
            // Delete the cart
            $user->cartItems()->delete();

            // Send the mail
            Mail::to($user->email)->send(new OrderConfirmation($order));
        });
        
        return redirect()->route('dishes.index')->with('success', 'Votre commande a été validée avec succès.');
    }
}
