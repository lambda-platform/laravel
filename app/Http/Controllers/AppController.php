<?php

namespace App\Http\Controllers;

class AppController extends Controller
{
    function home()
    {

        return view('index');
    }
}
