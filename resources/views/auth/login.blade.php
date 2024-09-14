<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <title>ログイン画面</title>
        @vite(['resources/css/login.css', 'resources/js/app.js'])
    </head>
    <body>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="container">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <h1>Login</h1>
            <!-- Email Address -->
            <div class="input-box"> 
                <x-text-input id="email" class="block mt-1 w-full" 
                                placeholder="Email"
                                type="email" 
                                name="email" 
                                :value="old('email')" 
                                required autofocus autocomplete="username" />
                <i class="fa-solid fa-envelope"></i>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
    
            <!-- Password -->
            <div class="input-box">
                <x-text-input id="password" class="block mt-1 w-full"
                                placeholder="Password"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
                <i class="fa-solid fa-lock"></i>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
    
            <!-- Remember Me -->
            <div class="remember-forgot">
                <label for="remember_me">
                    <input id="remember_me" type="checkbox" name="remember">
                    <span>{{ __('Remember me') }}</span>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
            <x-primary-button>
                {{ __('Log in') }}
            </x-primary-button>
        </form>
        <div class="register-link">
            <p>Don't have an account?</p>
            <a href='/register' style="font-weight: bold;">［新規登録はこちら］</a>
        </div>
    </div>
  </body>
</html>
