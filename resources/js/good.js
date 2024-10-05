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
