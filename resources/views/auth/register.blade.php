<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <title>新規登録画面</title>
        @vite(['resources/css/register.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="container">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <h1>Register</h1>
                <!-- Name -->
                <div class="input-box"> 
                    <x-text-input id="name" class="" placeholder="Name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <i class="fa-solid fa-user"></i>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <!-- Email Address -->
                <div class="input-box">
                    <x-text-input id="email" class="" placeholder="Email" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <i class="fa-solid fa-envelope"></i>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <!-- Password -->
                <div class="input-box">
                    <x-text-input id="password" class=""
                                    placeholder="Password"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />
                    <i class="fa-solid fa-lock"></i>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <!-- Confirm Password -->
                <div class="input-box">
                    <x-text-input id="password_confirmation" class=""
                                    placeholder="Confirm Password"
                                    type="password"
                                    name="password_confirmation" required autocomplete="new-password" />
                    <i class="fa-solid fa-lock"></i>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
                <x-primary-button class="ms-4">
                    {{ __('Register') }}
                </x-primary-button>
            </form>
            <div class="login-link">
                <p>{{ __('Already registered?') }}</p>
                <a href='/login' style="font-weight: bold;">［ログイン画面はこちら］</a>
            </div>
        </div>
    </body>
</html>
