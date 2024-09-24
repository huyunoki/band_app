<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ホーム画面</title>
        @vite(['resources/css/dashboard.css', 'resources/js/app.js'])
    </head>
    <body>
        <x-app-layout>
            <section class="home" id="home">
                <div class="home-content">
                    <h1>
                        ようこそ
                        <span>Band Man</span>
                    </h1>
                    <h2 class="text-animation">
                        <span>{{ Auth::user()->name }}</span>
                        の音楽をここで始めよう。
                    </h2>
                    
                    <div class="social-icons">
                        @if($lineUrl)
                            <a href="{{ $lineUrl }}" target="_blank">
                                <i class="fa-brands fa-line"></i>
                            </a>
                            @else
                            <a>
                                <i class="fa-brands fa-line"></i>
                            </a>
                        @endif
                        @if($instagramUrl)
                            <a href="{{ $instagramUrl }}" target="_blank">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                            @else
                            <a>
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        @endif
                    
                        <form action="/dashboard" method="POST">
                            @csrf
                            <div class="form">
                                <div class="form-group">
                                    <label for="line" class="input-label">LINE URL:</label>
                                    <input type="url" name="url[line]" class="input-field">
                                </div>
                                <div class="form-group">
                                    <label for="instagram">Instagram URL:</label>
                                    <input type="url" name="url[instagram]" class="input-field">
                                </div>
                                <input type="submit" value="store" class="submit-button">
                            </div>
                        </form>
                    </div>
            </section>
        </x-app-layout>
    </body>
</html>
