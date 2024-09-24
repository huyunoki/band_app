<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>メッセージ画面</title>
        @vite(['resources/css/message.css', 'resources/js/app.js'])
    </head>
    <body>
        <x-app-layout>
            <div class="container">
                
                <div class="chat">
                    @foreach($users as $user)
                        <a href="/chat/{{ $user->id }}">
                            <div class="chat_user">
                                {{ $user->name }}とチャットする
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </x-app-layout>
    </body>
</html>
