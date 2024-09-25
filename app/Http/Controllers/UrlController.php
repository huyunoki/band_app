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

    // 既存のURLレコードを取得または新規作成
    $userUrl = Url::firstOrNew(['user_id' => $userId]);

    // Instagram URLが提供されている場合
    if (isset($input['instagram'])) {
        // Instagram URLを更新
        $userUrl->instagram = $input['instagram'];
    }

    // LINE URLが提供されている場合
    if (isset($input['line'])) {
        // LINE URLを更新
        $userUrl->line = $input['line'];
    }

    // URLレコードを保存
    $userUrl->save();

    return redirect('/dashboard')->with('success', 'URLが更新されました。');
}

}
