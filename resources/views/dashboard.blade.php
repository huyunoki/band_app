<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ホーム画面</title>
        @vite(['resources/css/dashboard.css', 'resources/js/app.js'])
    </head>
    <body>
        <x-app-layout>
            <div class="welcome_message">
                <p>ようこそ{{ Auth::user()->name }}さん</p>
            </div>
            <h1>Enter your Instagram and LINE URLs</h1>

            @if (session('success'))
                <div>
                    {{ session('success') }}
                </div>
            @endif
        
            <form action="/dashboard" method="POST">
                @csrf
                <div>
                    <label for="line">LINE URL:</label>
                    <input type="url" name="url[line]">
                </div>
                <div>
                    <label for="instagram">Instagram URL:</label>
                    <input type="url" name="url[instagram]">
                </div>
                <input type="submit" value="store">
            </form>
        
            <h2>Instagram URLs</h2>
            <ul>
                @foreach(App\Models\Url::where('user_id', auth()->id())->whereNotNull('instagram')->get() as $url)
                    <li>Instagram: {{ $url->instagram }}</li>
                @endforeach
            </ul>
        
            <h2>LINE URLs</h2>
            <ul>
                @foreach(App\Models\Url::where('user_id', auth()->id())->whereNotNull('line')->get() as $url)
                    <li>LINE: {{ $url->line }}</li>
                @endforeach
            </ul>
        </x-app-layout>
    </body>
</html>
