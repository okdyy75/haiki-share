<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">

    <link rel="shortcut icon" href="/images/logo.ico">
</head>
<body class="l-form">
    <div class="l-form__content">
        {{-- コンテンツ部分 --}}
        <div class="l-row--middle">
            @yield('content')
        </div>
    </div>
    <!-- Scripts -->
    <script src="{{ mix('/js/app.js') }}" defer></script>
</body>
</html>
