@extends('layouts.Layouts')

@section('title')

@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- CSRF 令牌 -->
    <link rel="stylesheet" href="{{ asset('css/Site/index.css') }}">
    <title>新增紀錄</title>
@endsection
@section('content')
<form action="{{ route('logitem.store')}}" method="POST">
    @csrf
    <div>
        <label for="Number">編號</label>
        <input type="number" name="Number"  value='{{$id}}' readonly>
    </div>
    <div>
        <label for="Date">日期</label>
        <input type="time" name="Date"  required>
    </div>
    <div>
        <label for="Title">事件標題</label>
        <input type="text" name="Title" required>
    <div>
    <div>
        <label for="description">描述</label>
        <textarea name="description" required></textarea>
    </div>
    <div>
        <label for="image_url">圖片網址</label>
        <input type="text" name="image_url" required>
    </div>
    <button type="submit">確認新增</button>
</form>
@endsection