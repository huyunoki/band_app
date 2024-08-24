<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class MessageController extends Controller
{
    public function index(User $user) 
    {
        return view("messages.index")->with(['users'=>$user]);
    }
}