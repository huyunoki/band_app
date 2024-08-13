<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Music_listenController extends Controller
{
    public function index() 
    {
        return view("music_listens.index");
    }
}
