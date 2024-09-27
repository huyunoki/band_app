        <!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <title>新規登録画面</title>
        @vite(['resources/css/forgot.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="container">
            <h1>
                {{ __('メールアドレスを') }}
            </h1>
            <h1>
                {{ __('入力してください') }}
            </h1>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
        
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
        
                <!-- Email Address -->
                <div class="input-box">
                    <x-text-input id="email" placeholder="Email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <x-primary-button>
                    {{ __('リンクを送る') }}
                </x-primary-button>
            </form>
        </div>
    </body>
</html>
