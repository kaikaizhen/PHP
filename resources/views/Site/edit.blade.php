@extends('layouts.Layouts')

@section('title')

@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- CSRF 令牌 -->
    <link rel="stylesheet" href="{{ asset('css/Site/create.css') }}">
    <title>行事曆</title>
@endsection

@section('content')
<form id="create" action="{{ route('Site.update',$Site->Id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="">
        <div>
            <label for="Type">種類</label>
            <select name="Type">
                <option value="環保">環保</option>
                <option value="文教">文教</option>
                <option value="讀書會與講座">讀書會與講座</option>
                <option value="社區慈善">社區慈善</option>
                <option value="節慶活動">節慶活動</option>
            </select>
        </div>
        <div>
            <label for="Name">名稱</label>
            <input type="text" name="Name" value="{{$Site ->Name}}" require>
        </div>
        <div>
            <label for="Site">地址</label>
            <input type="text" Id="Site" name="Site" value="{{$Site ->Site}}" require>
        </div>
        <div>
            <input type="hidden" name="Lat" id="Lat">
            <input type="hidden" name="Lng" Id="Lng">
        </div>
        <div>
            <label for="Description">描述</label>
            <input type="text" name="Description" value="{{$Site ->Description}}" require>
        </div>
        <div>
            <label for="StartDate">描述</label>
            <input type="datetime-local" name="StartDate" value="{{$Site ->StartDate}}" require>
        </div>
        <div>
            <label for="EndDate">描述</label>
            <input type="datetime-local" name="EndDate" value="{{$Site ->EndDate}}" require>
        </div>
        <button onclick="call()" type="button" class="">確認</button>
    </div>
</form>

    <script src="{{ asset('js/create.js') }}"></script>
@endsection

