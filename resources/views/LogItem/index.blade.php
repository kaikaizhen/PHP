@extends('layouts.Layouts')

@section('title')

@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- CSRF 令牌 -->
    <link rel="stylesheet" href="{{ asset('css/Site/index.css') }}">
    <title>行事曆</title>
@endsection

@section('content')
<button onclick="window.location.href='{{ route('logitem.create',['id'=>$id])}}'" class="create">新增</button>
@if(session('msg'))
    <div>{{session('msg')}}</div>
@endif
<table>
    <thead>
        <tr class="table-header">
            <td>編號</td>    
            <td>時間</td>
            <td>標題</td>
            <td>描述</td>
            <td></td>
            <td></td>
        </tr>
        <tbody>
            @if($logItems->isEmpty())
            <tr>
                <td colspan="6">沒有找到任何資料。</td>
            </tr>
            @else
            @foreach($logItems as $logItem)
                <tr>
                    <td>{{$logItem ->Number}}</td>
                    <td>{{$logItem ->Date}}</td>
                    <td>{{$logItem -> Title}}</td>
                    <td>{{$logItem -> description}}</td>
                    <td><a href="{{route ('logitem.edit',$logItem->id)}}">編輯</a></td>
                    <td>
                        <form action="{{route('logitem.destroy',$logItem)}}" method="POST">
                            @csrf
                            @method("DELETE")
                            <button type="submit">刪除</button>
                        </form>
                    </td> 
                </tr>
            @endforeach
            @endif
        </tbody>
    </thead>
</table>
@endsection