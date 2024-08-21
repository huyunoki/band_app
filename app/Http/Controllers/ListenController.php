<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upload;

class ListenController extends Controller
{
    public function index(Upload $upload) 
    {
        return view("listens.index")->with(['uploads'=> $upload->getPaginateByLimit()]);
    }
}
