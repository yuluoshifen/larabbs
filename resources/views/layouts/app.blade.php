<!doctype html>
<html lang="{{ app()->getLocale() }}"> <!--读取配置项config/app.php中的locale选项-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!--CSRF TOKEN-->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title','LaraBBS') - Laravel 进阶教程</title>

    <!--Style-->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('styles')
</head>
<body>
<div id="app" class="{{ route_class() }}-page"> <!--自定义辅助函数，将当前请求的路由名称转换为CSS类名，使开发者可针对某页面做样式定制-->

    @include('layouts._header')

    <div class="container">
        @include('layouts._message')
        @yield('content')
    </div>

    @include('layouts._footer')
</div>

<!--Script-->
<script src="{{ asset('js/app.js') }}"></script>
@yield('scripts')
</body>
</html>