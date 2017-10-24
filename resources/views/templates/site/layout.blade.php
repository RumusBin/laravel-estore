<!doctype html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{--<meta name="csrf-token" content="{{ csrf_token() }}">--}}
    <title>@yield('title')</title>
    @include('templates.site.partials._styles')
</head>
<body>
        @yield('content')
    @include('templates.site.partials._scripts')
    @yield('scripts')
</body>
</html>