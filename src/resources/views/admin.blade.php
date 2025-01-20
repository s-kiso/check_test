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
    </div>


    {{$items->links()}}

    <form action="" method="POST">
        @csrf
        <input type="text" name="name_email" value="{{old('name_email') }}" placeholder="名前やメールアドレスを入力してください">
        <select name="gender">
            <!-- 性別に何も入れず送信すると、「全て」表示になってしまう（全てではあるので良い気はするが…） -->
            <option value="" selected>性別</option>
            <option value="" {{old('gender')=='' ? 'selected' : '' }}>全て</option>
            <option value="1" {{old('gender')=='1' ? 'selected' : '' }}>男性</option>
            <option value="2" {{old('gender')=='2' ? 'selected' : '' }}>女性</option>
            <option value="3" {{old('gender')=='3' ? 'selected' : '' }}>その他</option>
        </select>
        <select name="content">
            <option value="" selected>お問い合わせの種類</option>
            <option value="1" {{old('content')=='1' ? 'selected' : '' }}>商品のお届けについて</option>
            <option value="2" {{old('content')=='2' ? 'selected' : '' }}>商品の交換について</option>
            <option value="3" {{old('content')=='3' ? 'selected' : '' }}>商品トラブル</option>
            <option value="4" {{old('content')=='4' ? 'selected' : '' }}>ショップへのお問い合わせ</option>
            <option value="5" {{old('content')=='5' ? 'selected' : '' }}>その他</option>
        </select>
        <input type="date" name="date" value="{{old('date') }}">
        <input type="submit" value="検索">
    </form>

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
                <td> {{$item->category->content}} </td>
            </tr>
            @endforeach
        </table>
    </div>

</div>

@endsection