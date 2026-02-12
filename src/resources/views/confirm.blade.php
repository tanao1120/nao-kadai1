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
    $tel = $contact['tel'] ?? ($tel1 . $tel2 . $tel3);

    // お問い合わせ種類
    $categoryText = '';
    if (isset($categories)) {
    $category = $categories->firstWhere('id', $contact['category_id'] ?? null);
    $categoryText = $category->content ?? '';
    }

    // このサイトを知ったきっかけ
    $selectedChannels = $contact['channels'] ?? [];
    $channelTexts = [];

    if (isset($channels)) {
    foreach ($channels as $channel) {
    if (in_array($channel->id, $selectedChannels)) {
    $channelTexts[] = $channel->content;
    }
    }
    }
    @endphp

    <form class="confirm-form" action="{{ route('contact.store') }}" method="post">
        @csrf

        <table class="confirm-table">

            <tr>
                <th>お名前</th>
                <td>{{ $contact['last_name'] ?? '' }} {{ $contact['first_name'] ?? '' }}</td>
            </tr>

            <tr>
                <th>性別</th>
                <td>{{ $genderText }}</td>
            </tr>

            <tr>
                <th>メールアドレス</th>
                <td>{{ $contact['email'] ?? '' }}</td>
            </tr>

            <tr>
                <th>電話番号</th>
                <td>{{ $tel }}</td>
            </tr>

            <tr>
                <th>住所</th>
                <td>{{ $contact['address'] ?? '' }}</td>
            </tr>

            <tr>
                <th>建物名</th>
                <td>{{ $contact['building'] ?? '' }}</td>
            </tr>

            <tr>
                <th>このサイトを知ったきっかけ</th>
                <td>{{ implode('、', $channelTexts) }}</td>
            </tr>

            <tr>
                <th>お問い合わせの種類</th>
                <td>{{ $categoryText }}</td>
            </tr>

            <tr>
                <th>お問い合わせ内容</th>
                <td>{!! nl2br(e($contact['detail'] ?? '')) !!}</td>
            </tr>

            <tr>
                <th>画像</th>
                <td>
                    @if (!empty($contact['tmp_image_path']))
                    <img src="{{ \Storage::url($contact['tmp_image_path']) }}" alt="upload" style="max-width:200px;">
                    @endif
                </td>
            </tr>


        </table>

        <input type="hidden" name="last_name" value="{{ $contact['last_name'] ?? '' }}">
        <input type="hidden" name="first_name" value="{{ $contact['first_name'] ?? '' }}">
        <input type="hidden" name="gender" value="{{ $contact['gender'] ?? '' }}">
        <input type="hidden" name="email" value="{{ $contact['email'] ?? '' }}">
        <input type="hidden" name="tel" value="{{ $tel }}">
        <input type="hidden" name="address" value="{{ $contact['address'] ?? '' }}">
        <input type="hidden" name="building" value="{{ $contact['building'] ?? '' }}">
        <input type="hidden" name="category_id" value="{{ $contact['category_id'] ?? '' }}">
        <input type="hidden" name="detail" value="{{ $contact['detail'] ?? '' }}">

        @if (!empty($contact['tmp_image_path']))
        <input type="hidden" name="tmp_image_path" value="{{ $contact['tmp_image_path'] }}">
        @endif

        @foreach ($selectedChannels as $ch)
        <input type="hidden" name="channels[]" value="{{ $ch }}">
        @endforeach

        <div class="confirm-form__buttons">
            <button type="submit">
                送信
            </button>

            <button type="button" onclick="history.back()">
                修正
            </button>
        </div>

    </form>
</div>

@endsection