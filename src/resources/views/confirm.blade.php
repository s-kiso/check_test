@extends('layouts.app')

@section('title')
<title>お問い合わせ</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('button')
<!-- <button class="header__button" type="button" onclick="location.href='/login'">
    login
</button> -->
@endsection

@section('content')
<div class="confirm__content">
    <div class="confirm__heading">
        <h2>Confirm</h2>
    </div>
    <!-- <form class="form" action="/" method="post">
        @csrf -->
    <div class="confirm-table">
        <table class="confirm-table__inner">
            <tr class="confirm-table__row">
                <th class="confirm-table__header">お名前</th>
                <td class="confirm-table__text">{{ $contact['last_name'] }}　{{ $contact['first_name'] }}</td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__header">性別</th>
                <td class="confirm-table__text">{{ $contact['gender'] }}</td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__header">メールアドレス</th>
                <td class="confirm-table__text">{{ $contact['email'] }}</td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__header">電話番号</th>
                <td class="confirm-table__text">{{ $contact['tel1'] }}{{ $contact['tel2'] }}{{ $contact['tel3'] }}</td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__header">住所</th>
                <td class="confirm-table__text">{{ $contact['address'] }}</td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__header">建物名</th>
                <td class="confirm-table__text">{{ $contact['building'] }}</td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__header">お問い合わせ種類</th>
                <td class="confirm-table__text">{{ $contact['content'] }}</td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__header">お問い合わせ内容</th>
                <td class="confirm-table__text">{{ $contact['detail'] }}</td>
            </tr>
        </table>
    </div>
    <div class="form__button">
        <a href="/thanks">送信</a>
        <a href="/">修正</a>
    </div>
    <!-- </form> -->
</div>
@endsection