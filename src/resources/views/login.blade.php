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
        <form class="auth__form" action="#" method="post">
            @csrf

            <div class="auth__group">
                <label class="auth__label" for="email">メールアドレス</label>
                <input class="auth__input" id="email" type="email" name="email" placeholder="例: test@example.com">
            </div>

            <div class="auth__group">
                <label class="auth__label" for="password">パスワード</label>
                <input class="auth__input" id="password" type="password" name="password" placeholder="例: coachtech1106">
            </div>

            <div class="auth__button">
                <button class="btn" type="submit">ログイン</button>
            </div>
        </form>
    </div>
</div>
@endsection