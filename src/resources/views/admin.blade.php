@extends('layouts.app')

@section('title')
<title>管理画面</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('button')
<form class="form" action="/logout" method="post">
    @csrf
    <button class="header__button">
        logout
    </button>
</form>
@endsection

@section('content')

<div class="login__content">
    <div class="login__heading">
        <h2>Login</h2>
    </div>
</div>

@endsection