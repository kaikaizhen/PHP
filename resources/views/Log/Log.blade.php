@extends('layouts.Layouts')

@section('header')
    <title>日誌列表</title>
    <link rel="stylesheet" href="{{ asset('css/Log/LogT.css')}}">
@endsection

@section('content')
<div>分類：</div>
    <div>
        <select name="Type" id="filter" onchange="filter()">
            <option value="">種類</option>
            <option value="環保">環保</option>
            <option value="文教">文教</option>
            <option value="讀書會與講座">讀書會與講座</option>
            <option value="社區慈善">社區慈善</option>
            <option value="節慶活動">節慶活動</option>
        </select>
    </div>
    <div id="content" class="content">
       
    </div>
    <script src="{{ asset('js/Log.js')}}"></script>
@endsection