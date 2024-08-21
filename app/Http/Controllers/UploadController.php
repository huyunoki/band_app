<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UploadRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Upload;
use Cloudinary;

class UploadController extends Controller
{
    public function index(Upload $upload) 
    {
        $userId = Auth::id();
        $upload = Upload::where('user_id', $userId)->get(); //where(フィールド名,条件)
        return view("uploads/index")->with(['uploads'=> $upload]);
    }
    
    public function create()
    {
        return view('uploads/create');
    }
    
    public function store(Upload $upload, UploadRequest $request)  
    {
        $music_url = Cloudinary::uploadVideo($request->file('music')->getRealPath())->getSecurePath();
        $input = $request['file'];
        $input += ['user_id' => $request->user()->id]; 
        $input += ['image_url' => $music_url];
        $upload->fill($input)->save();
        return redirect('/upload/'. $upload->id);
    }
    
    public function edit(Upload $upload)
    {
        return view('uploads.edit')->with(['uploads'=> $upload]);
    }
    
    public function update(Upload $upload, UploadRequest $request)  
    {
        $music_url = Cloudinary::uploadVideo($request->file('music')->getRealPath())->getSecurePath();
        $input = $request['file'];
        $input += ['user_id' => $request->user()->id]; 
        $input += ['image_url' => $music_url];
        $upload->fill($input)->save();
        return redirect('/upload/'. $upload->id);
    }
    
    public function delete(Upload $upload)
    {
        $upload->delete();
        return redirect('upload/index')->with(['uploads'=> $upload]);
    }
}
