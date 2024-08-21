<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
    </head>
    <body>
        <h1>Blog Name</h1>
        
        
        <!-- formタグにenctypeを追加 -->
        <form action="/upload/store" method="POST" enctype="multipart/form-data"><!--enctypeはファイルを送信する際の形式を指定-->
            @csrf
            <h2>曲名</h2>
            <input type="text" name="file[title]" placeholder="曲名"/>
            <p class="title_error" style="color:red">{{ $errors->first('file.title') }}</p>
            <div class="image">
                <input type="file" name="music">
            </div>
            <h2>説明</h2>
            <input type='text' name="file[description]" placeholder="曲に込めた思いはなんですか">
            <p class="body_error" style="color:red">{{ $errors->first('file.description') }}</p>
            <input type="submit" value="保存"/>
        </form>
        
        <div class="footer">
            <a href="/upload/index">戻る</a>
        </div>
    </body>
</html>