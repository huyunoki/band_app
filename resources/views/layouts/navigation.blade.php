<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite(['resources/css/navigation.css', 'resources/js/app.js'])
    </head>
    <body>
        <!-- Primary Navigation Menu -->
        <div class="container">
            <!--<div class="flex">-->
            <!--上のflex消すと文字が消える-->
            <!-- Logo -->
            <header class="header">
                <a href="{{ route('dashboard') }}" class="logo">
                    Band
                    <span>Man</span>
                </a>
                <!-- Navigation Links -->
                <nav class="navbar">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Home') }}
                    </x-nav-link>
                    <x-nav-link :href="route('schedule')" :active="request()->routeIs('schedule')">
                        {{ __('Schedule') }}
                    </x-nav-link>
                    <x-nav-link :href="route('message')" :active="request()->routeIs('message')">
                        {{ __('Chat') }}
                    </x-nav-link>
                    <x-nav-link :href="route('upload')" :active="request()->routeIs('upload')">
                        {{ __('Upload') }}
                    </x-nav-link>
                    <x-nav-link :href="route('listen')" :active="request()->routeIs('listen')">
                        {{ __('Listen') }}
                    </x-nav-link>
                </nav>
            
            <!--</div>-->
    
            <!-- Settings Dropdown -->
                <div class="dropdown-container">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="dropdown-trigger">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="dropdown-icon">
                                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
                <div :class="{'block': open, 'hidden': ! open}" class="responsive-menu">
                    <div class="nav-links">
                        <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-responsive-nav-link>
                    </div>
                    <div class="settings-options">
                        <div class="user-info">
                            <div class="user-name">{{ Auth::user()->name }}</div>
                            <div class="user-email">{{ Auth::user()->email }}</div>
                        </div>
                        <div class="settings-links">
                            <x-responsive-nav-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-responsive-nav-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-responsive-nav-link>
                            </form>
                        </div>
                    </div>
                </div>
            </header>
        </div>
    </body>
</html>