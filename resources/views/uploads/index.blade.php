<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>音楽アップロード画面</title>
        @vite(['resources/css/upload.css', 'resources/js/app.js'])
    </head>
    <body>
        <x-app-layout>
            <div class="create-button">
                <a href='/upload/create'>新規作成</a>
            </div>
            <div class='uploads'>
                @foreach($uploads as $upload)
                    <div>
                        <audio controls src="{{ $upload->image_url }}"></audio>
                        <h1 class="title">
                            タイトル：{{ $upload->title }}
                        </h1>
                        <div class="edit"><a href="/upload/{{ $upload->id }}/edit">編集</a></div>
                        <p class='description'>{{ $upload->description }}</p>
                        <form action="/upload/delete/{{ $upload->id }}" id="form_{{ $upload->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="deleteUpload({{ $upload->id }})">削除</button> 
                        </form>
                    </div>
                @endforeach
            </div>
            <div class='paginate'>
            </div>
            <script>
                function deleteUpload(id) {
                    'use strict'
                    if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                        document.getElementById(`form_${id}`).submit();
                    }
                }
            </script>
        </x-app-layout>
    </body>
</html>
