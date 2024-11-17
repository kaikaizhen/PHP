<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.2/axios.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.2.0/js/all.js"></script>
    <title>@yield('title','慈濟網站')</title>
    @if(View::hasSection('header'))
        @yield('header')
    @endif
</head>
<body>
<nav class="navbar navbar-expand-lg" style="background-color:#1B2D58;color:white;">
    <div class="container-fluid">
        <a href="/" class="navbar-brand d-flex align-items-center">
            <img src="{{ asset('img/Tzu_Chi.png') }}" style="height:50px">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto"></ul>
            <ul class="navbar-nav ms-auto">
                @if (Auth::check())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span>歡迎, {{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="{{Route('Site.index')}}">活動編輯</a></li>
                            <li><a class="dropdown-item" href="{{Route('log.index')}}">紀錄編輯</a></li>
                            <li>
                                <a class="dropdown-item" href="/"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    登出
                                </a>
                            </li>
                        </ul>
                        <form id="logout-form" action="{{ asset('logout')}}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" style="color:white" href="{{ asset('login')}}">登入</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>



    
        @if(View::hasSection('content'))
            @yield('content')
        @endif
    

    <footer>
       @if(View::hasSection('footer'))
            @yield('footer')
       @endif
    </footer>
</body>
</html>
