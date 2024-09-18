<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>メッセージ画面</title>
        <!--<link rel="stylesheet" href="/../../css/index.css">-->
        <style>
            .welcome_message {
                font-size: 3em;
                font-weight: bold;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <x-app-layout>
            <div class="welcome_message">
                <div>メッセージ画面にようこそ{{ Auth::user()->name }}さん！！</div>
            </div>
            
            
            <div class='chat'>
                 
                @foreach($users as $user)
                    <div>
                        <a href="/chat/{{ $user->id }}">{{ $user->name }}とチャットする</a>
                    </div>
                @endforeach
                
            </div>
        </x-app-layout>
    </body>
</html>