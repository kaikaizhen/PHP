@extends('layouts.Layouts')

@section('title')
    <title>行事曆</title>
@endsection

@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- CSRF 令牌 -->
    <link rel="stylesheet" href="{{ asset('css/Site/index.css') }}">
@endsection

@section('content')
<button onclick="window.location.href='{{ route('Site.create') }}'" class="create">新增</button>
@if(session('msg'))
    <div>{{ session('msg') }}</div>
@endif

<table>
    <thead>
        <tr class="table-header">
            <td>ID</td>
            <td>類型</td>
            <td>名稱</td>
            <td>期間</td>
            <td>地點</td>
            <td>描述</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </thead>
    <tbody>
        @foreach($Sites as $Site)
            <tr>
                <td>{{ $Site->Id }}</td>
                <td>{{ $Site->Type }}</td>
                <td>{{ $Site->Name }}</td>
                <td>{{ $Site->StartDate }} ~ {{ $Site->EndDate }}</td>
                <td>{{ $Site->Site }}</td>
                <td>{{ $Site->Description }}</td>
                <td><a href="{{ route('Site.edit', $Site->Id) }}">編輯</a></td>
                <td>
                    <form action="{{ route('Site.destroy', $Site->Id) }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <button type="submit">刪除</button>
                    </form>
                </td>
                
                @if($Site->Type === '環保')
                    @php $foundEF = false; @endphp
                    @foreach($EFs as $EF)
                        @if($EF->id === $Site->Id)
                            @php $foundEF = true; @endphp
                            @break
                        @endif
                    @endforeach
                    
                    <td>
                        <button type="button" id="EFbtn-{{ $Site->Id }}" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#EF-{{ $Site->Id }}">
                            {{$foundEF?'修改':'新增'}}
                        </button>
                    </td>
                    <div class="modal fade" id="EF-{{ $Site->Id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{$foundEF?'修改紀錄':'新增紀錄'}}</h5>
                                    <button id="cls" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="EF-form-{{ $Site->Id }}">
                                    <div class="mb-3">
    <label for="gen_recyclable_weight" class="col-form-label">可回收物的產生總重量:</label>
    <input type="text" class="form-control" id="gen_recyclable_weight" value="{{ $foundEF ? $EF->gen_recyclable_weight : '' }}">
</div>
<div class="mb-3">
    <label for="rec_recyclable_weight" class="col-form-label">可回收物的回收重量:</label>
    <input type="text" class="form-control" id="rec_recyclable_weight" value="{{ $foundEF ? $EF->rec_recyclable_weight : '' }}">
</div>
<div class="mb-3">
    <label for="gen_food_waste_weight" class="col-form-label">廚餘垃圾的產生總重量:</label>
    <input type="text" class="form-control" id="gen_food_waste_weight" value="{{ $foundEF ? $EF->gen_food_waste_weight : '' }}">
</div>
<div class="mb-3">
    <label for="rec_food_waste_weight" class="col-form-label">廚餘垃圾的回收重量:</label>
    <input type="text" class="form-control" id="rec_food_waste_weight" value="{{ $foundEF ? $EF->rec_food_waste_weight : '' }}">
</div>
<div class="mb-3">
    <label for="gen_general_waste_weight" class="col-form-label">一般垃圾的產生總重量:</label>
    <input type="text" class="form-control" id="gen_general_waste_weight" value="{{ $foundEF ? $EF->gen_general_waste_weight : '' }}">
</div>
<div class="mb-3">
    <label for="rec_general_waste_weight" class="col-form-label">一般垃圾的回收重量:</label>
    <input type="text" class="form-control" id="rec_general_waste_weight" value="{{ $foundEF ? $EF->rec_general_waste_weight : '' }}">
</div>
<div class="mb-3">
    <label for="gen_hazardous_weight" class="col-form-label">危險廢物的產生總重量:</label>
    <input type="text" class="form-control" id="gen_hazardous_weight" value="{{ $foundEF ? $EF->gen_hazardous_weight : '' }}">
</div>
<div class="mb-3">
    <label for="rec_hazardous_weight" class="col-form-label">危險廢物的回收重量:</label>
    <input type="text" class="form-control" id="rec_hazardous_weight" value="{{ $foundEF ? $EF->rec_hazardous_weight : '' }}">
</div>
                                        <div class="mb-3">
                                            <label for="collection_date" class="col-form-label">收集日期:</label>
                                            <input type="date" class="form-control" id="collection_date" value="{{ $foundEF ? $EF->collection_date : '' }}">
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">刪除紀錄</button>
                                    <button type="button" class="btn btn-primary" onclick="{{ $foundEF ? 'EditEF(' . $Site->Id . ')' : 'SaveEF(' . $Site->Id . ')' }}">儲存紀錄</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <td></td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>

<script src="{{ asset('js/Site.js') }}"></script>
@endsection
