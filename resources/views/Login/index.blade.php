<!DOCTYPE html>
<html>
<head>
    <title>登入</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
</head>
<body>
    <div class="container"> 
<image class="background" src="https://www.tzuchiculture.org.tw/wp-content/uploads/2023/01/%E4%BA%BA%E6%96%87%E8%97%A5%E8%8D%89%E5%9C%92.jpg" alt="圖片載入失敗">
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="Content">
        <h1 class="Title">登入</h1>
        <div>
            <input type="text" id="account" name="account" placeholder='請輸入帳號' required>
        </div>
        <div>
            <input type="password" id="password" name="password" placeholder='請輸入密碼' required>
        </div>
        <button type="submit">登入</button>
        </div>
        
    </form>

    @if ($errors->any())
        <div>
            <strong>{{ $errors->first() }}</strong>
        </div>
    @endif
</div>
</body>
</html>
