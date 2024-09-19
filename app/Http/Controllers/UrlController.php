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
        return view('dashboard');
    }

    public function store(UrlRequest $request, Url $url)
    {
        $input = $request->input('url');

        // Instagram URLが存在する場合、既存のInstagram URLを削除
        if (isset($input['instagram'])) {
            Url::where('user_id', auth()->id())->whereNotNull('instagram')->delete();
        }

        // LINE URLが存在する場合、既存のLINE URLを削除
        if (isset($input['line'])) {
            Url::where('user_id', auth()->id())->whereNotNull('line')->delete();
        }

        // 新しいURLを保存
        $input['user_id'] = auth()->id();
        $url->fill($input)->save();

        return redirect('/dashboard');
    }
}
