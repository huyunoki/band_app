<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upload;
use App\Models\User;

class ListenController extends Controller
{
    public function index(Upload $upload) 
    {
        return view("listens.index")->with(['uploads'=> $upload->getPaginateByLimit()]);
    }
    
    public function user($userId) 
    {
        $user = User::findOrFail($userId); //findOrFailはして逸されたもの以外を無視する
        $uploads = $user->uploads; 

        return view('listens.user', compact('user', 'uploads'));
    }
}
