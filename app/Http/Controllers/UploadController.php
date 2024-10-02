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
    public function index(Request $request) 
    {
        $userId = Auth::id();
        $order = $request->input('order', 'desc'); // desc=新しい順番 asc=古い順番
        $uploads = Upload::where('user_id', $userId)
                         ->orderBy('created_at', $order)
                         ->get();
        return view("uploads/index")->with(['uploads' => $uploads, 'order' => $order]);
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
