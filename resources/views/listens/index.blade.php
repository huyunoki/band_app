<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>音楽聞く画面</title>
        @vite(['resources/css/listen.css', 'resources/js/app.js'])
        <script src="https://kit.fontawesome.com/18f505b1d5.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <x-app-layout>
            <div class='listens'>
                @foreach($uploads as $upload)
                    <div class="listen-item">
                        <a href="/listen/{{ $upload->user->id }}">投稿者:{{ $upload->user->name }}</a>
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
            <div class='paginate'>
                {{ $uploads->links() }}
            </div>
        </x-app-layout>
    </body>
    <script>
        const likedUploads = @json($likedUploads);

        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.like-btn').forEach(likeBtn => {
                const postId = likeBtn.id;
                if (likedUploads.includes(parseInt(postId))) {
                    likeBtn.classList.add('liked');
                }

                likeBtn.addEventListener('click', async (e) => {
                    const clickedEl = e.target;
                    clickedEl.classList.toggle('liked');
                    const postId = e.target.id;

                    try {
                        const res = await fetch('/upload/like', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({ upload_id: postId })
                        });
                        const data = await res.json();
                        clickedEl.nextElementSibling.innerHTML = data.likesCount;
                    } catch (error) {
                        alert('処理が失敗しました。画面を再読み込みし、通信環境の良い場所で再度お試しください。');
                    }
                });
            });
        });
    </script>
</html>
