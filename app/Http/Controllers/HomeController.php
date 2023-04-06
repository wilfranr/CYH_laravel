<?php

namespace App\Http\Controllers;


class HomeController extends Controller
{
    //Vista de home
    public function index()
    {
        return view('home.index');
    }
    
}
