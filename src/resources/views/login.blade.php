@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('header_right')
<a class="header__link" href="{{ route('register') }}">register</a>
@endsection

@section('header_btn')
<a class="header__btn-link" href="{{ route('register') }}">register</a>
@endsection

@section('content')
<div class="auth">
    <h2 class="auth__heading">Login</h2>

    <div class="auth__card">
        <form class="auth__form" action="{{ route('login') }}" method="post">
            @csrf

            {{-- 全体エラー（認証失敗など） --}}
            @if ($errors->any())
                <div class="form__error">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="auth__group">
                <label class="auth__label" for="email">メールアドレス</label>
                <input
                    class="auth__input"
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="例: test@example.com"
                    required
                    autofocus
                >
                <div class="form__error">@error('email') {{ $message }} @enderror</div>
            </div>

            <div class="auth__group">
                <label class="auth__label" for="password">パスワード</label>
                <input
                    class="auth__input"
                    id="password"
                    type="password"
                    name="password"
                    placeholder="例: coachtech1106"
                    required
                    autocomplete="current-password"
                >
                <div class="form__error">@error('password') {{ $message }} @enderror</div>
            </div>

            <div class="auth__group">
                <label>
                    <input type="checkbox" name="remember">
                    ログイン状態を保持する
                </label>
            </div>

            <div class="auth__button">
                <button class="btn" type="submit">ログイン</button>
            </div>
        </form>
    </div>
</div>
@endsection
