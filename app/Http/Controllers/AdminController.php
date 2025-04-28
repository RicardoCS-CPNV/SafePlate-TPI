<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::check()){
            return view('admin.menu'); // Changer la route
        }

        return redirect('admin.menu');
    }
}
