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
           <div class="uploads-container">
                <a href='/upload/create' class="create-button">
                    <div>新規作成する</div>
                </a>
            </div>
            <div class='uploads'>
                @foreach($uploads as $upload)
                    <div class="upload-item">
                        <h1 class="title">
                            {{ $upload->title }}
                        </h1>
                        <p class='description'>{{ $upload->description }}</p>
                        <audio controls src="{{ $upload->image_url }}"></audio>
                        <div class="actions">
                            <div class="edit"><a href="/upload/{{ $upload->id }}/edit">編集</a></div>
                            <form action="/upload/delete/{{ $upload->id }}" id="form_{{ $upload->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="deleteUpload({{ $upload->id }})">削除</button> 
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class='paginate'>
            </div>
        </x-app-layout>
    </body>
    <script>
        function deleteUpload(id) {
            'use strict'
            if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                document.getElementById(`form_${id}`).submit();
            }
        }
    </script>
</html>
