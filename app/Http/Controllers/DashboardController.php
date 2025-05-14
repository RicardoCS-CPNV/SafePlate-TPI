<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the home page.
     */
    public function home()
    {
        // Redirect to home page
        return view('home');
    }

    /**
     * Display the admin page.
     */
    public function admin()
    {
        // Redirect to admin page
        return view('admin.menu');
    }
}
