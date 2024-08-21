<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>編集画面</title>
        <!--<link rel="stylesheet" href="/../../css/index.css">-->
    </head>
    <body>
         <div class='content'>
            <form action="/upload/{{ $uploads->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class='content__title'>
                    <h2>タイトル</h2>
                    <input type='text' name='file[title]' value="{{ $uploads->title }}">
                    <p class="title_error" style="color:red">{{ $errors->first('file.title') }}</p>
                </div>
                <div class="image">
                    <input type="file" name="music">
                </div>
                <div class='content__body'>
                    <h2>本文</h2>
                    <input type='text' name='file[description]' value="{{ $uploads->description }}">
                    <p class="body_error" style="color:red">{{ $errors->first('file.description') }}</p>
                </div>
                <input type="submit" value="更新">
            </form>
        </div>
    </body>
</html>