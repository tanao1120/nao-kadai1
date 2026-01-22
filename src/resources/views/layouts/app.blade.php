<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FashionablyLate')</title>

    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">

    @yield('css')
</head>

<body>
    @if (!isset($noHeader))
    <header class="header">
        <div class="header__inner">
            <div class="header__logo">
                <a href="{{ route('contact.index') }}">FashionablyLate</a>
            </div>

            <div class="header__btn">
                @if (Request::is('login'))
                <a class="header__btn-link" href="{{ route('register') }}">register</a>
                @elseif (Request::is('register'))
                <a class="header__btn-link" href="{{ route('login') }}">login</a>
                @elseif (Request::is('admin'))
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button class="header__btn-link" type="submit">logout</button>
                </form>
                @endif
            </div>
        </div>
    </header>
    @endif

    <main>
        @yield('content')
    </main>
</body>

</html>