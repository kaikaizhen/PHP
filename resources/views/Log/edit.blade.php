@extends('layouts.Layouts')

@section('title')

@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- CSRF 令牌 -->
    <link rel="stylesheet" href="{{ asset('css/Site/index.css') }}">
    <title>編輯紀錄</title>
@endsection
@section('content')
<form action="{{ route('log.update',$log)}}" method="POST">
    @csrf
    @method('PUT')
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
        <label for="Date">日期</label>
        <input type="datetime-local" name="Date" value="{{ $log -> Date}}" require>
    </div>
    <div>
        <label for="Title">事件標題</label>
        <input type="text" name="Title" value="{{ $log -> Title}}" require>
    <div>
    <div>
        <label for="description">描述</label>
        <textarea name="description" require>{{$log -> description}}</textarea>
    </div>
    <div>
        <label for="image_url">事件標題</label>
        <input type="text" name="image_url" value="{{$log->image_url}}" require>
    <div>
    <button type="submit">確認更新</button>
</form>
@endsection('content')