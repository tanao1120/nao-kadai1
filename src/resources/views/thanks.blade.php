@extends('layouts.app')

@php
$noHeader = true;
@endphp

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endsection

@section('content')

<div class="thanks">
    <p class="thanks__bg-text">Thank you</p>

    <div class="thanks__message">
        <p>お問い合わせありがとうございました</p>
    </div>

    <div class="thanks__button">
        <a class="thanks__button-link" href="{{ route('contact.index') }}">HOME</a>
    </div>
</div>

@endsection