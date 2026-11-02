<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function hello($your_name)
    {
        return "Hello, " . $your_name;
    }

    public function about()
    {
        return view('about');
    }
}