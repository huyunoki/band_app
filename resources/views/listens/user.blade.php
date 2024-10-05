<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>音楽聞くファイル(user別)</title>
        @vite(['resources/css/listen-user.css', 'resources/js/good.js'])
        <script src="https://kit.fontawesome.com/18f505b1d5.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <x-app-layout>
            <div class="chat-button">
                <a href="/chat/{{ $user->id }}">{{ $user->name }}とチャットする</a>
            </div>
            <div class="user-content-container">
                <div class="user-content">
                    <span>{{ $user->name }}</span>
                    の音楽
                </div>
                <div class="social-icons">
                    @if($line)
                        <a href="{{ $line }}" target="_blank">
                            <i class="fa-brands fa-line"></i>
                        </a>
                    @endif
                    @if($instagram)
                        <a href="{{ $instagram }}" target="_blank">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    @endif
                </div>
            </div>
            <form method="GET">
                <button type="submit" class="sort" name="order" value="{{ $order === 'desc' ? 'asc' : 'desc' }}">
                    {{ $order === 'desc' ? '古い順に表示' : '最新順に表示' }}
                </button>
            </form>
            <div class='listens'>
                @foreach($uploads as $upload)
                    <div class="listen-item">
                        @if($upload->isLikedByAuthUser())
                            <div class="flexbox">
                                <i class="fa-solid fa-thumbs-up like-btn liked" id={{$upload->id}}></i>
                                <p class="count-num">{{$upload->likes->count()}}</p>
                            </div>
                        @else
                            <div class="flexbox">
                                <i class="fa-solid fa-thumbs-up like-btn" id={{$upload->id}}></i>
                                <p class="count-num">{{$upload->likes->count()}}</p>
                            </div>
                        @endif
                        <h1 class="title">
                            {{ $upload->title }}
                        </h1>
                        <p class='description'>{{ $upload->description }}</p>
                        <audio controls src="{{ $upload->image_url }}"></audio>
                    </div>
                @endforeach
            </div>
            </x-app-layout>
        </body>
    <script>
        const likedUploads = @json($likedUploads);
    </script>
</html>
