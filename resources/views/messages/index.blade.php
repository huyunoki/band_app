<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>メッセージ画面</title>
    </head>
    <body>
        <x-app-layout>
            <div class="welcome_message">
                <p>メッセージ画面にようこそ{{ Auth::user()->name }}さん！！</p>
            </div>
            
            <div class='chat'>
                @foreach($users as $user)
                    <div>
                        <a href="/chat/{{ $user->id }}">{{ $user->name }}とチャットする</a>
                    </div>
                @endforeach
        </x-app-layout>
    </body>
</html>