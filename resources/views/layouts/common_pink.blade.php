<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'PiGLy')</title>
    <link rel="stylesheet" href="{{ asset('css/common_pink.css') }}">
    @if (Request::is('login'))
        <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    @endif
    @if (Request::is('register/step1'))
        <link rel="stylesheet" href="{{ asset('css/register_step1.css') }}">
    @endif
    @if (Request::is('register/step2'))
        <link rel="stylesheet" href="{{ asset('css/register_step2.css') }}">
    @endif
</head>

<body class="pink-bg">
    <main class="main-content">
        @yield('content')
    </main>
</body>

</html>
