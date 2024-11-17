@extends('layouts.Layouts')

@section('Title','慈濟首頁')

@section('header')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="content-top d-flex justify-content-center">
  <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active" data-bs-interval="3000">
        <img src="https://daai.tv/img/topVideo/3402-1GKwc.jpg" class="d-block mx-auto" alt="圖片載入失敗" style="width: 100%;">
      </div>
      <div class="carousel-item" data-bs-interval="3000">
        <img src="https://daai.tv/img/topVideo/1979-Gv7Fw.jpg" class="d-block mx-auto" alt="圖片載入失敗" style="width: 100%;">
      </div>
    </div>
  </div>
</div>

<div class="content-between">
    <div class="circel" onclick="window.location.href='/Map'">
        <div class="icon-content">
            <i class="fa-regular fa-map icon"></i>
            <p>慈濟地圖</p>
        </div>
    </div>
    
    <div class="circel" onclick="window.location.href='/LogT'">
        <div class="icon-content">
            <i class="fa-regular fa-pen-to-square icon"></i>
            <p>慈濟紀錄</p>
        </div>
    </div>
    
    <div class="circel" onclick="window.location.href='/About'">
        <div class="icon-content">
            <i class="fa-solid fa-eject icon"></i>
            <p>關於慈濟</p>
        </div>
    </div>
</div>


@endsection