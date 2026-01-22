@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('header_btn')
<a class="header__btn-link" href="{{ route('login') }}">login</a>
@endsection


@section('content')

<div class="auth">
    <div class="auth__heading">
        <h2>Register</h2>
    </div>

    <div class="auth__card">
        <form class="auth__form" action="{{ route('register') }}" method="post">
            @csrf

            <div class="auth__group">
                <label class="auth__label">お名前</label>
                <input class="auth__input" type="text" name="name" placeholder="例：山田 太郎" value="{{ old('name') }}">
                <p class="auth__error">@error('name') {{ $message }} @enderror</p>
            </div>

            <div class="auth__group">
                <label class="auth__label">メールアドレス</label>
                <input class="auth__input" type="email" name="email" placeholder="例：test@example.com" value="{{ old('email') }}">
                <p class="auth__error">@error('email') {{ $message }} @enderror</p>
            </div>

            <div class="auth__group">
                <label class="auth__label">パスワード</label>
                <input class="auth__input" type="password" name="password" placeholder="例：coachtech1106">
                <p class="auth__error">@error('password') {{ $message }} @enderror</p>
            </div>

            <div class="auth__button">
                <button class="auth__button-submit" type="submit">登録</button>
            </div>
        </form>
    </div>
</div>

@endsection