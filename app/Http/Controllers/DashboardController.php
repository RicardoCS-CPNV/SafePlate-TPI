<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the admin menu.
     */
    public function home()
    {
        // Redirect to admin menu
        return view('home');
    }

    /**
     * Display the admin menu.
     */
    public function admin()
    {
        // Redirect to admin menu
        return view('admin.menu');
    }
}
