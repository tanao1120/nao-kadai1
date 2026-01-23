@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endsection

@section('content')

<div class="contact-form__content">
    <div class="contact__heading">
        <h2>Contact</h2>
    </div>

    <form class="form" action="{{ route('contact.confirm') }}" method="post" novalidate>
        @csrf

        {{-- お名前 --}}
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お名前</span>
                <span class="required">※</span>
            </div>
            <div class="form__group-content">
                <div class="name-inputs">
                    <input
                        type="text"
                        name="last_name"
                        placeholder="例：山田"
                        value="{{ old('last_name', request('last_name')) }}">
                    <input
                        type="text"
                        name="first_name"
                        placeholder="例：太郎"
                        value="{{ old('first_name', request('first_name')) }}">
                </div>
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
                <span class="required">※</span>
            </div>
            <div class="form__group-content">
                @php
                $genderVal = old('gender', request('gender', ''));
                @endphp

                <label>
                    <input type="radio" name="gender" value="1" {{ (string)$genderVal === '1' ? 'checked' : '' }}>
                    男性
                </label>
                <label>
                    <input type="radio" name="gender" value="2" {{ (string)$genderVal === '2' ? 'checked' : '' }}>
                    女性
                </label>
                <label>
                    <input type="radio" name="gender" value="3" {{ (string)$genderVal === '3' ? 'checked' : '' }}>
                    その他
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
                <span class="required">※</span>
            </div>
            <div class="form__group-content">
                <input
                    type="email"
                    name="email"
                    placeholder="test@example.com"
                    value="{{ old('email', request('email')) }}">
                <div class="form__error">
                    @error('email') {{ $message }} @enderror
                </div>
            </div>
        </div>

        {{-- 電話番号 --}}
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">電話番号</span>
                <span class="required">※</span>
            </div>
            <div class="form__group-content">
                <div class="tel-inputs">
                    <input
                        type="text"
                        name="tel1"
                        placeholder="090"
                        value="{{ old('tel1', request('tel1')) }}">
                    <span class="tel-hyphen">-</span>
                    <input
                        type="text"
                        name="tel2"
                        placeholder="1234"
                        value="{{ old('tel2', request('tel2')) }}">
                    <span class="tel-hyphen">-</span>
                    <input
                        type="text"
                        name="tel3"
                        placeholder="5678"
                        value="{{ old('tel3', request('tel3')) }}">
                </div>
                <div class="form__error">
                    @error('tel1') {{ $message }} @enderror
                    @error('tel2') {{ $message }} @enderror
                    @error('tel3') {{ $message }} @enderror
                </div>
            </div>
        </div>

        {{-- 住所 --}}
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">住所</span>
                <span class="required">※</span>
            </div>
            <div class="form__group-content">
                <input
                    type="text"
                    name="address"
                    placeholder="東京都渋谷区..."
                    value="{{ old('address', request('address')) }}">
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
                <input
                    type="text"
                    name="building"
                    placeholder="〇〇マンション101"
                    value="{{ old('building', request('building')) }}">
            </div>
        </div>

        {{-- お問い合わせ種別 --}}
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせの種類</span>
                <span class="required">※</span>
            </div>
            <div class="form__group-content">
                @php
                $categoryVal = old('category_id', request('category_id'));
                @endphp

                <select name="category_id" required>
                    <option value="" disabled {{ $categoryVal ? '' : 'selected' }}>選択してください</option>

                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ (string)$categoryVal === (string)$category->id ? 'selected' : '' }}>
                        {{ $category->content }}
                    </option>
                    @endforeach
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
                <span class="required">※</span>
            </div>
            <div class="form__group-content">
                <textarea name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail', request('detail')) }}</textarea>
                <div class="form__error">
                    @error('detail') {{ $message }} @enderror
                </div>
            </div>
        </div>

        <div class="form__button">
            <button type="submit">確認画面</button>
        </div>
    </form>
</div>

@endsection