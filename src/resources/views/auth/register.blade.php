@extends('layouts.app')

@section('title')
<title>register</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('button')
<button class="header__button" type="button" onclick="location.href='/login'">
    login
</button>
@endsection

@section('content')
<div class="register__content">
    <div class="register__heading">
        <h2>Register</h2>
    </div>
    <form action="/register" class="form" method="post">
        @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お名前</span>
            </div>
            <div class="form__input--text">
                <input type="text" name="name" placeholder="例: 山田　太郎" value="{{ old('name') }}">
            </div>
            <div class="form__error">
                @error('name')
                {{ $message }}
                @enderror
            </div>
            <div class="form__group-title">
                <span class="form__label--item">メールアドレス</span>
            </div>
            <div class="form__input--text">
                <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
            </div>
            <div class="form__error">
                @error('email')
                {{ $message }}
                @enderror
            </div>
            <div class="form__group-title">
                <span class="form__label--item">パスワード</span>
            </div>
            <div class="form__input--text">
                <input type="password" name="password" placeholder="例: coachtech1106">
            </div>
            <div class="form__error">
                @error('password')
                {{ $message }}
                @enderror
            </div>
            <div class="form__button">
                <button class="form__button-submit" type="submit">登録</button>
            </div>
        </div>
    </form>
</div>
@endsection