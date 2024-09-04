<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>音楽聞くファイル(user別)</title>
        <!--<link rel="stylesheet" href="/../../css/index.css">-->
        @vite(['resources/css/index.css'])
        <script src="https://kit.fontawesome.com/18f505b1d5.js" crossorigin="anonymous"></script>
        <style>
            /* いいね押下時の星の色 */
            .liked{
                color:orangered;
                transition:.2s;
            }
            .flexbox{
                align-items: center;
                display: flex;
            }
            .count-num{
                font-size: 20px;
                margin-left: 10px;
            }
            .fa-star{
                font-size: 30px;
            }
        </style>
    </head>
    <body>
        <x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('音楽聞く画面(user別)') }}
                </h2>
            </x-slot>
             <div class='uploads'>
                <p>投稿者:{{ $user->name }}</p>
                @foreach($uploads as $upload)
                    <div>
                        <audio controls src="{{ $upload->image_url }}"></audio>
                        <h1 class="font-medium">
                            タイトル：{{ $upload->title }}
                        </h1>
                        <p class='description'>{{ $upload->description }}</p>
                    </div>
                    @if($upload->isLikedByAuthUser())
                            {{-- こちらがいいね済の際に表示される方で、likedクラスが付与してあることで星に色がつきます --}}
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
                @endforeach
            </div>
            <div class="back">
                <a href="/listen/index">戻る</a>
            </div>
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
        </x-app-layout>
    </body>
</html>
