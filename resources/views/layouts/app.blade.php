<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="An authenticated Laravel point-of-sale account management project.">
    <title>@yield('title', 'POS Foundations')</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header class="site-header">
        <div class="container nav-wrap">
            <a class="brand" href="{{ route('home') }}" aria-label="POS Foundations home">
                <span class="brand-mark">PF</span>
                <span>POS Foundations</span>
            </a>
            <nav aria-label="Primary navigation">
                <a class="{{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                <a class="{{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
                @auth
                    <a class="{{ request()->routeIs('customers.*') ? 'active' : '' }}" href="{{ route('customers.index') }}">Customers</a>
                    <a class="{{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">Users</a>
                    <a class="{{ request()->routeIs('profile.*') ? 'active' : '' }}" href="{{ route('profile.edit') }}">Profile</a>
                    <form class="nav-form" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">Log out</button>
                    </form>
                @else
                    <a class="{{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">Log in</a>
                    <a class="{{ request()->routeIs('register') ? 'active' : '' }}" href="{{ route('register') }}">Register</a>
                @endauth
            </nav>
        </div>
    </header>

    @if (session('success'))
        <div class="container flash-success" role="status">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="container flash-error" role="alert">{{ session('error') }}</div>
    @endif

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="container footer-wrap">
            <span>POS Foundations</span>
            <span>Protected by Laravel Breeze authentication</span>
        </div>
    </footer>
</body>
</html>
