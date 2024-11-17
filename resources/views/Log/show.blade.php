<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>日誌</title>
    <link rel="stylesheet" href="{{ asset('css/Log/show.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
    <div class="total_content">
    <div class="content">
        <img src="http://127.0.0.1:8000/img/Tzu_Chi.png" style="height:30px" class="icon">
        <div class="circle"></div>
        <div id="Line" class="line"></div>
        <div class="end_circle"></div>
    </div>
    </div>

    <div id="log" class="log"></div>

    
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('js/LogShow.js')}}"></script>
</body>
</html>
