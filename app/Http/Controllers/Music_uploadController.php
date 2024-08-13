<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Music_uploadController extends Controller
{
    public function index() 
    {
        return view("music_uploads.index");
    }
}
