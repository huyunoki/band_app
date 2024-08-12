<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>表紙</title>
        <link rel="stylesheet" href="../../css/index.css">
        <style>
            body {
                /*display: flex;*/
                /*justify-content: center;*/
                /*align-items: center;*/
                /*height: 100vh;*/
                /*margin: 0;*/
                bg=#FF0000: 
                /*font-family: Arial, sans-serif;*/
            }
            
            .welcome-message {
                font-size: 3em;
                font-weight: bold;
                color: #333;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Index') }}
                </h2>
            </x-slot>
            <div class="welcome-message">
                <div>ようこそ{{ Auth::user()->name }}さん！！</div>
            </div>
        </x-app-layout>
    </body>
</html>