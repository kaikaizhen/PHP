@extends('layouts.Layouts')

@section('title')

@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- CSRF 令牌 -->
    <link rel="stylesheet" href="{{ asset('css/Site/index.css') }}">
    <title>行事曆</title>
@endsection

@section('content')
<button onclick="window.location.href='{{ route('log.create')}}'" class="create">新增</button>
@if(session('msg'))
    <div>{{session('msg')}}</div>
@endif
<table>
    <thead>
        <tr class="table-header">
            <td>種類</td>
            <td>日期</td>
            <td>標題</td>
            <td>描述</td>
            <td></td>
            <td></td>
            <td>詳細</td>
        </tr>
        <tbody>
            @foreach($Logs as $log)
                <tr>
                    <td>{{$log ->Type}}</td>
                    <td>{{$log ->Date}}</td>
                    <td>{{$log -> Title}}</td>
                    <td>{{$log -> description}}</td>
                    <td><a href="{{route ('log.edit',$log)}}">編輯</a></td>
                    <td>
                        <form action="{{route('log.destroy',$log)}}" method="POST">
                            @csrf
                            @method("DELETE")
                            <button type="submit">刪除</button>
                        </form>
                    </td> 
                    <td><a href="{{route ('logitem.show',$log->id)}}">編輯</a></td>
                </tr>
            @endforeach

        </tbody>
    </thead>
</table>
@endsection