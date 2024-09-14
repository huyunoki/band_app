<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ホーム画面</title>
        <link rel="stylesheet" href="././css/index.css">
        <style>
            .welcome_message {
                font-size: 3em;
                font-weight: bold;
                text-align: center;
                margin-top: 20px;
            }
        </style>
    </head>
    <body>
        <x-app-layout>
            <div class="welcome_message">
                <div>ホーム画面にようこそ{{ Auth::user()->name }}さん！！</div>
            </div>
        </x-app-layout>
    </body>
</html>