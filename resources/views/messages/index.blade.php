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
                margin-top: 20px;
            }
        </style>
    </head>
    <body>
        <x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('メッセージ画面') }}
                </h2>
            </x-slot>
            <div class="welcome_message">
                <div>メッセージ画面にようこそ{{ Auth::user()->name }}さん！！</div>
            </div>
        </x-app-layout>
    </body>
</html>