<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>音楽編集ページ</title>
        @vite(['resources/css/upload-edit.css', 'resources/js/app.js'])
    </head>
    <body>
        <x-app-layout>
            <form action="/upload/{{ $uploads->id }}" method="POST" enctype="multipart/form-data" class="upload-form">
                @csrf
                @method('PUT')
                <div class='form-group'>
                    <h2>曲名</h2>
                    <input type='text' name='file[title]' value="{{ $uploads->title }}">
                    <p class="title_error">{{ $errors->first('file.title') }}</p>
                </div>
                <div class='form-group'>
                    <h2>説明</h2>
                    <input type='text' name='file[description]' value="{{ $uploads->description }}">
                    <p class="body_error">{{ $errors->first('file.description') }}</p>
                </div>
                <div class="form-group">
                    <h2>音楽ファイル[mp3]</h2>
                    <input type="file" name="music">
                </div>
                <div class="form-group">
                    <input type="submit" value="更新">
                    <p class="music_error">{{ $errors->first('file.music') }}</p>
                </div>
            </form>
        </x-app-layout>
    </body>
</html>