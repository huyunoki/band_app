<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UrlRequest;
use App\Models\Url;
use Illuminate\Support\Facades\Log;

class UrlController extends Controller
{
    public function index()
    {
        // ユーザーのLINEとInstagramのURLを取得
        $urls = Url::where('user_id', auth()->id())
                    ->where(function($query) {
                        $query->whereNotNull('line')
                              ->orWhereNotNull('instagram');
                    })
                    ->get();

        // LINEとInstagramのURLを個別に取得
        $lineUrl = $urls->whereNotNull('line')->pluck('line')->first();
        $instagramUrl = $urls->whereNotNull('instagram')->pluck('instagram')->first();

        return view('dashboard', [
            'lineUrl' => $lineUrl,
            'instagramUrl' => $instagramUrl
        ]);
    }

    public function store(UrlRequest $request, Url $url)
    {
        $input = $request->input('url');
        $userId = auth()->id();
    
        // Check if Instagram URL is provided
        if (isset($input['instagram'])) {
            // Delete existing Instagram URL for the user
            Url::where('user_id', $userId)->whereNotNull('instagram')->delete();
    
            // Save new Instagram URL
            $instagramUrl = new Url();
            $instagramUrl->user_id = $userId;
            $instagramUrl->instagram = $input['instagram'];
            $instagramUrl->save();
        }
    
        // Check if LINE URL is provided
        if (isset($input['line'])) {
            // Delete existing LINE URL for the user
            Url::where('user_id', $userId)->whereNotNull('line')->delete();
    
            // Save new LINE URL
            $lineUrl = new Url();
            $lineUrl->user_id = $userId;
            $lineUrl->line = $input['line'];
            $lineUrl->save();
        }
    
        return redirect('/dashboard')->with('success', 'URLが更新されました。');
    }
}
