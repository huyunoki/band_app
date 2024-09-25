<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upload;
use App\Models\User;
use App\Models\UploadLike;
use App\Models\Url;

class ListenController extends Controller
{
    public function show(Upload $upload) 
    {
        $uploads = $upload->getPaginateByLimit();
        $likedUploads = auth()->user()->likes->pluck('upload_id')->toArray();
    
        return view("listens.index")->with([
            'uploads' => $uploads,
            'likedUploads' => $likedUploads
        ]);
    }
    
    public function user($userId) 
    {
        $user = User::findOrFail($userId); 
        $uploads = $user->uploads; 
        $likedUploads = auth()->user()->likes->pluck('upload_id')->toArray();
        
        $url = Url::where('user_id', $userId)->first();
        $line = $url ? $url->line : null;
    $instagram = $url ? $url->instagram : null;
        return view('listens.user')->with(['user' => $user,
                                            'uploads' => $uploads,
                                            'likedUploads' => $likedUploads,
                                            'line' => $line,
                                            'instagram' => $instagram]
                                            );
    }

    
    public function likeUpload(Request $request)
    {
        $user_id = \Auth::id();
        //jsのfetchメソッドで記事のidを送信しているため受け取ります。
        $upload_id = $request->upload_id;
        //自身がいいね済みなのか判定します
        $alreadyLiked = UploadLike::where('user_id', $user_id)->where('upload_id', $upload_id)->first();

        if (!$alreadyLiked) {
        //こちらはいいねをしていない場合の処理です。つまり、post_likesテーブルに自身のid（user_id）といいねをした記事のid（post_id）を保存する処理になります。
            $like = new UploadLike();
            $like->upload_id = $upload_id;
            $like->user_id = $user_id;
            $like->save();
        } else {
            //すでにいいねをしていた場合は、以下のようにpost_likesテーブルからレコードを削除します。
            UploadLike::where('upload_id', $upload_id)->where('user_id', $user_id)->delete();
        }
        //ビューにその記事のいいね数を渡すため、いいね数を計算しています。
        $upload = Upload::where('id', $upload_id)->first();
        $likesCount = $upload->likes->count();

        $param = [
            'likesCount' =>  $likesCount,
        ];
        //ビューにいいね数を渡しています。名前は上記のlikesCountとなるため、フロントでlikesCountといった表記で受け取っているのがわかると思います。
        return response()->json($param);
    }
}
