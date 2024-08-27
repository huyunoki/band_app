<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>音楽聞くファイル(user別)</title>
        <!--<link rel="stylesheet" href="/../../css/index.css">-->
        @vite(['resources/css/index.css'])
    </head>
    <body>
        <x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('音楽聞く画面(user別)') }}
                </h2>
            </x-slot>
             <div class='uploads'>
                 
                @foreach($uploads as $upload)
                    <div>
                        <audio controls src="{{ $upload->image_url }}"></audio>
                        <h1 class="font-medium">
                            タイトル：{{ $upload->title }}
                        </h1>
                        <p class='description'>{{ $upload->description }}</p>
                        <p>投稿者:{{ $upload->user->name }}</p>
                    </div>
                @endforeach
            </div>
        </x-app-layout>
    </body>
</html>
