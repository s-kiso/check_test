@extends('layouts.app')
<style>
    svg.w-5.h-5 {
        /*paginateメソッドの矢印の大きさ調整のために追加*/
        width: 30px;
        height: 30px;
    }
</style>

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

<div class="admin__content">
    <div class="admin__heading">
        <h2>Admin</h2>
        <!-- <p>a</p>
         <table>
            <tr>
                <th>お名前</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>お問い合わせの種類</th>
            </tr>
            @foreach ($items as $item)
        <tr>
            <td> {{$item->last_name}} </td>
            <td> {{$item->gender}} </td>
            <td> {{$item->email}} </td>
            <td> {{$item->category_id}} </td>
        </tr>
        @endforeach -->
        <!-- </table>  -->

    </div>
    <!-- <form action="find" method="POST">
        @csrf
        <input type="text" name="input" value="{{$input ?? ''}}">
        <input type="submit" value="見つける">
    </form>
    @if (@isset($item)) -->
    <form action="find" method="POST">
        @csrf
        <input type="text" name="input" value="{{$input ?? ''}}">
        <input type="submit" value="見つける">
    </form>
    {{ $items->links() }}
    <div class="table">
        <table>
            <tr>
                <th>お名前</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>お問い合わせの種類</th>
            </tr>
            @foreach ($items as $item)
            <tr>
                <td> {{$item->last_name}}　{{$item->first_name}} </td>
                <td> {{$item->gender}} </td>
                <td> {{$item->email}} </td>
                <td> {{$item->category_id}} </td>
            </tr>
            @endforeach
        </table>
    </div>
    <!-- @endif -->
</div>

@endsection