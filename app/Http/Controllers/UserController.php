<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(User $user){
        return view('uploads/show')->with(['uploads' => $user->getByCategory()]);
    }
}
