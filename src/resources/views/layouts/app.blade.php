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
            <div class="header__logo"><a href="{{ route('contact.index') }}">FashionablyLate</a></div>

            @hasSection('header_btn')
            <div class="header__btn">@yield('header_btn')</div>
            @endif
        </div>
    </header>
    @endif

    <main>
        @yield('content')
    </main>
</body>

</html>