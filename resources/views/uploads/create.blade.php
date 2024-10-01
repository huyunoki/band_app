<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>音楽作成ページ</title>
        @vite(['resources/css/upload-create.css', 'resources/js/app.js'])
    </head>
    <body>
        <x-app-layout>
            <form action="/upload/store" method="POST" enctype="multipart/form-data" class="upload-form">
                @csrf
                <div class="form-group">
                    <h2>曲名</h2>
                    <input type="text" name="file[title]"/>
                    <p class="title_error">{{ $errors->first('file.title') }}</p>
                </div>
                <div class="form-group">
                    <h2>説明</h2>
                    <input type='text' name="file[description]">
                    <p class="body_error">{{ $errors->first('file.description') }}</p>
                </div>
                <div class="form-group">
                    <h2>音楽ファイル[mp3]</h2>
                    <input type="file" name="music">
                    <p class="music_error">{{ $errors->first('file.music') }}</p>
                </div>
                <div class="form-submit">
                    <input type="submit" value="投稿">
                </div>
            </form>
        </x-app-layout>
    </body>
</html>
