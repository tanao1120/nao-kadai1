@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endsection

@section('content')

<div class="contact-form__content">
    <div class="contact-form__heading">
        <h2>Confirm</h2>
    </div>

    <form class="confirm-form" action="{{ route('contact.store') }}" method="post">
        @csrf

        <table class="confirm-table">
            <tr class="confirm-table__row">
                <th class="confirm-table__header">お名前</th>
                <td class="confirm-table__data">
                    {{ $contact['last_name'] ?? '' }} {{ $contact['first_name'] ?? '' }}
                    <input type="hidden" name="last_name" value="{{ $contact['last_name'] ?? '' }}">
                    <input type="hidden" name="first_name" value="{{ $contact['first_name'] ?? '' }}">
                </td>
            </tr>

            <tr class="confirm-table__row">
                <th class="confirm-table__header">性別</th>
                <td class="confirm-table__data">
                    @php
                    $genderText = '';
                    if (($contact['gender'] ?? '') == '1') $genderText = '男性';
                    if (($contact['gender'] ?? '') == '2') $genderText = '女性';
                    if (($contact['gender'] ?? '') == '3') $genderText = 'その他';
                    @endphp
                    {{ $genderText }}
                    <input type="hidden" name="gender" value="{{ $contact['gender'] ?? '' }}">
                </td>
            </tr>

            <tr class="confirm-table__row">
                <th class="confirm-table__header">メールアドレス</th>
                <td class="confirm-table__data">
                    {{ $contact['email'] ?? '' }}
                    <input type="hidden" name="email" value="{{ $contact['email'] ?? '' }}">
                </td>
            </tr>

            <tr class="confirm-table__row">
                <th class="confirm-table__header">電話番号</th>
                <td class="confirm-table__data">
                    {{ $contact['tel'] ?? '' }}
                    <input type="hidden" name="tel" value="{{ $contact['tel'] ?? '' }}">
                </td>
            </tr>

            <tr class="confirm-table__row">
                <th class="confirm-table__header">住所</th>
                <td class="confirm-table__data">
                    {{ $contact['address'] ?? '' }}
                    <input type="hidden" name="address" value="{{ $contact['address'] ?? '' }}">
                </td>
            </tr>

            <tr class="confirm-table__row">
                <th class="confirm-table__header">建物名</th>
                <td class="confirm-table__data">
                    {{ $contact['building'] ?? '' }}
                    <input type="hidden" name="building" value="{{ $contact['building'] ?? '' }}">
                </td>
            </tr>

            <tr class="confirm-table__row">
                <th class="confirm-table__header">お問い合わせの種類</th>
                <td class="confirm-table__data">
                    @php
                    $categoryMap = [
                    '1' => '商品のお届けについて',
                    '2' => '商品の交換について',
                    '3' => '商品トラブル',
                    '4' => 'ショップへのお問い合わせ',
                    '5' => 'その他',
                    ];
                    $categoryText = $categoryMap[$contact['category_id'] ?? ''] ?? '';
                    @endphp
                    {{ $categoryText }}
                    <input type="hidden" name="category_id" value="{{ $contact['category_id'] ?? '' }}">
                </td>
            </tr>

            <tr class="confirm-table__row">
                <th class="confirm-table__header">お問い合わせ内容</th>
                <td class="confirm-table__data">
                    {!! nl2br(e($contact['detail'] ?? '')) !!}
                    <input type="hidden" name="detail" value="{{ $contact['detail'] ?? '' }}">
                </td>
            </tr>
        </table>

        <div class="confirm-form__buttons">
            <button class="confirm-form__button confirm-form__button--submit" type="submit">送信</button>

            {{-- 修正：前画面に戻る（入力値はhiddenで戻す or sessionで戻す） --}}
            <button class="confirm-form__button confirm-form__button--back" type="submit" formaction="{{ route('contact.index') }}" formmethod="get">
                修正
            </button>
        </div>
    </form>
</div>

@endsection