<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>スケジュール画面</title>
        <!--<link rel="stylesheet" href="/../../css/index.css">-->
        @vite(['resources/css/app.css', 'resources/js/calendar.js'])
    </head>
    <body>
        <x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('スケジュール画面') }}
                </h2>
            </x-slot>
            <div id='calendar'></div>
        </x-app-layout>
    </body>
</html>