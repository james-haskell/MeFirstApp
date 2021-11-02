<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Me First</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <header>
            @include('layouts.inc.nav')
        </header>

        <main class="py-4">
            @if(str_contains(Request::url(), '/login') || str_contains(Request::url(), '/register'))
                @yield('content')
            @else
            <div class="d-flex flex-row justify-items-center">
                <div class="col-md-3">
                    @include('layouts.inc.sidebar', ['userId' => Auth::user()->id])
                </div>

                <div class="col-md-6">
                    @yield('content')
                </div>

                <div class="col-md-3">
                    @include('layouts.inc.topten', ['userId' => Auth::user()->id])
                </div>
            </div>
            @endif
        </main>
    </div>
</body>
</html>
