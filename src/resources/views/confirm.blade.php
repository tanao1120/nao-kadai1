@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endsection

@section('content')

<div class="contact-form__content">
    <div class="contact__heading">
        <h2>Confirm</h2>
    </div>

    @php
    // 性別表示
    $genderText = '';
    if (($contact['gender'] ?? '') == '1') $genderText = '男性';
    if (($contact['gender'] ?? '') == '2') $genderText = '女性';
    if (($contact['gender'] ?? '') == '3') $genderText = 'その他';

    // 電話番号
    $tel1 = $contact['tel1'] ?? '';
    $tel2 = $contact['tel2'] ?? '';
    $tel3 = $contact['tel3'] ?? '';
    $tel = ($contact['tel'] ?? '') !== '' ? ($contact['tel'] ?? '') : ($tel1 . $tel2 . $tel3);

    // お問い合わせ種類
    $categoryMap = [
    '1' => '商品のお届けについて',
    '2' => '商品の交換について',
    '3' => '商品トラブル',
    '4' => 'ショップへのお問い合わせ',
    '5' => 'その他',
    ];

    $categoryId = (string)($contact['category_id'] ?? '');
    $categoryText = $categoryMap[$categoryId] ?? '';
    @endphp

    <form class="confirm-form" action="{{ route('contact.store') }}" method="post">
        @csrf

        <table class="confirm-table">
            <tr class="confirm-table__row">
                <th class="confirm-table__header">お名前</th>
                <td class="confirm-table__data">
                    {{ $contact['last_name'] ?? '' }} {{ $contact['first_name'] ?? '' }}
                </td>
            </tr>

            <tr class="confirm-table__row">
                <th class="confirm-table__header">性別</th>
                <td class="confirm-table__data">
                    {{ $genderText }}
                </td>
            </tr>

            <tr class="confirm-table__row">
                <th class="confirm-table__header">メールアドレス</th>
                <td class="confirm-table__data">
                    {{ $contact['email'] ?? '' }}
                </td>
            </tr>

            <tr class="confirm-table__row">
                <th class="confirm-table__header">電話番号</th>
                <td class="confirm-table__data">
                    {{ $tel }}
                </td>
            </tr>

            <tr class="confirm-table__row">
                <th class="confirm-table__header">住所</th>
                <td class="confirm-table__data">
                    {{ $contact['address'] ?? '' }}
                </td>
            </tr>

            <tr class="confirm-table__row">
                <th class="confirm-table__header">建物名</th>
                <td class="confirm-table__data">
                    {{ $contact['building'] ?? '' }}
                </td>
            </tr>

            <tr class="confirm-table__row">
                <th class="confirm-table__header">お問い合わせの種類</th>
                <td class="confirm-table__data">
                    {{ $categoryText }}
                </td>
            </tr>

            <tr class="confirm-table__row">
                <th class="confirm-table__header">お問い合わせ内容</th>
                <td class="confirm-table__data">
                    {!! nl2br(e($contact['detail'] ?? '')) !!}
                </td>
            </tr>
        </table>

        {{-- 送信用 hidden --}}
        <input type="hidden" name="last_name" value="{{ $contact['last_name'] ?? '' }}">
        <input type="hidden" name="first_name" value="{{ $contact['first_name'] ?? '' }}">
        <input type="hidden" name="gender" value="{{ $contact['gender'] ?? '' }}">
        <input type="hidden" name="email" value="{{ $contact['email'] ?? '' }}">

        <input type="hidden" name="tel" value="{{ $tel }}">

        <input type="hidden" name="tel1" value="{{ $tel1 }}">
        <input type="hidden" name="tel2" value="{{ $tel2 }}">
        <input type="hidden" name="tel3" value="{{ $tel3 }}">

        <input type="hidden" name="address" value="{{ $contact['address'] ?? '' }}">
        <input type="hidden" name="building" value="{{ $contact['building'] ?? '' }}">
        <input type="hidden" name="category_id" value="{{ $categoryId }}">
        <input type="hidden" name="detail" value="{{ $contact['detail'] ?? '' }}">

        <div class="confirm-form__buttons">
            {{-- 送信 --}}
            <button class="confirm-form__button confirm-form__button--submit" type="submit">
                送信
            </button>

            {{-- 修正 --}}
            <button
                <button type="button" onclick="history.back()">
                修正
            </button>
        </div>
    </form>
</div>

@endsection