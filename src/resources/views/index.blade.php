@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endsection

@section('content')

<div class="contact-form__content">
    <div class="contact-form__heading">
        <h2>Contact</h2>
    </div>

    <form class="form" action="{{ route('contact.confirm') }}" method="post">
        @csrf

        {{-- お名前 --}}
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お名前</span>
                <span class="form__label--required">必須</span>
            </div>
            <div class="form__group-content">
                <input type="text" name="last_name" placeholder="例：山田" value="{{ old('last_name') }}">
                <input type="text" name="first_name" placeholder="例：太郎" value="{{ old('first_name') }}">
                <div class="form__error">
                    @error('last_name') {{ $message }} @enderror
                    @error('first_name') {{ $message }} @enderror
                </div>
            </div>
        </div>

        {{-- 性別 --}}
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">性別</span>
                <span class="form__label--required">必須</span>
            </div>
            <div class="form__group-content">
                <label>
                    <input type="radio" name="gender" value="1" {{ old('gender', '1') == '1' ? 'checked' : '' }}> 男性
                </label>
                <label>
                    <input type="radio" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}> 女性
                </label>
                <label>
                    <input type="radio" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }}> その他
                </label>
                <div class="form__error">
                    @error('gender') {{ $message }} @enderror
                </div>
            </div>
        </div>

        {{-- メールアドレス --}}
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">メールアドレス</span>
                <span class="form__label--required">必須</span>
            </div>
            <div class="form__group-content">
                <input type="email" name="email" placeholder="test@example.com" value="{{ old('email') }}">
                <div class="form__error">
                    @error('email') {{ $message }} @enderror
                </div>
            </div>
        </div>

        {{-- 電話番号 --}}
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">電話番号</span>
                <span class="form__label--required">必須</span>
            </div>
            <div class="form__group-content">
                <input type="text" name="tel" placeholder="09012345678" value="{{ old('tel') }}">
                <div class="form__error">
                    @error('tel') {{ $message }} @enderror
                </div>
            </div>
        </div>

        {{-- 住所 --}}
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">住所</span>
                <span class="form__label--required">必須</span>
            </div>
            <div class="form__group-content">
                <input type="text" name="address" placeholder="東京都渋谷区..." value="{{ old('address') }}">
                <div class="form__error">
                    @error('address') {{ $message }} @enderror
                </div>
            </div>
        </div>

        {{-- 建物名 --}}
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">建物名</span>
            </div>
            <div class="form__group-content">
                <input type="text" name="building" placeholder="〇〇マンション101" value="{{ old('building') }}">
            </div>
        </div>

        {{-- お問い合わせ種別 --}}
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせの種類</span>
                <span class="form__label--required">必須</span>
            </div>
            <div class="form__group-content">
                <select name="category_id">
                    <option value="">選択してください</option>
                    <option value="1" {{ old('category_id') == '1' ? 'selected' : '' }}>商品のお届けについて</option>
                    <option value="2" {{ old('category_id') == '2' ? 'selected' : '' }}>商品の交換について</option>
                    <option value="3" {{ old('category_id') == '3' ? 'selected' : '' }}>商品トラブル</option>
                    <option value="4" {{ old('category_id') == '4' ? 'selected' : '' }}>ショップへのお問い合わせ</option>
                    <option value="5" {{ old('category_id') == '5' ? 'selected' : '' }}>その他</option>
                </select>
                <div class="form__error">
                    @error('category_id') {{ $message }} @enderror
                </div>
            </div>
        </div>

        {{-- お問い合わせ内容 --}}
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせ内容</span>
                <span class="form__label--required">必須</span>
            </div>
            <div class="form__group-content">
                <textarea name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
                <div class="form__error">
                    @error('detail') {{ $message }} @enderror
                </div>
            </div>
        </div>

        <div class="form__button">
            <button type="submit">確認画面へ</button>
        </div>
    </form>
</div>

@endsection