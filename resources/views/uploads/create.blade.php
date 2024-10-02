<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>音楽作成ページ</title>
        <!-- CSSとJavaScriptファイルをViteで読み込む -->
        @vite(['resources/css/upload-create.css', 'resources/js/app.js'])
    </head>
    <body>
        
        <x-app-layout>
            <!-- 音楽ファイルをアップロードするためのフォーム -->
            <form action="/upload/store" method="POST" enctype="multipart/form-data" class="upload-form">
                <!-- セキュリティのためのCSRFトークン -->
                @csrf
                <div class="form-group">
                    <h2>曲名</h2>
                    <!-- 曲名の入力フィールド -->
                    <input type="text" name="file[title]"/>
                    <!-- 曲名のエラーメッセージを表示 -->
                    <p class="title_error">{{ $errors->first('file.title') }}</p>
                </div>
                <div class="form-group">
                    <h2>説明</h2>
                    <!-- 説明の入力フィールド -->
                    <input type='text' name="file[description]">
                    <!-- 説明のエラーメッセージを表示 -->
                    <p class="body_error">{{ $errors->first('file.description') }}</p>
                </div>
                <div class="form-group">
                    <h2>音楽ファイル[mp3]</h2>
                    <!-- 音楽ファイルの入力フィールド -->
                    <input type="file" name="music">
                    <!-- 音楽ファイルのエラーメッセージを表示 -->
                    <p class="music_error">{{ $errors->first('music') }}</p>
                </div>
                <div class="form-submit">
                    <!-- フォームの送信ボタン -->
                    <input type="submit" value="投稿">
                </div>
            </form>
        </x-app-layout>
    </body>
</html>
