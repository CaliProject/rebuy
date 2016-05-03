<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') | Rebuy</title>

    <link rel="icon" href="{{ url('assets/logo.png') }}">
    <link rel="shortcut icon" href="{{ url('assets/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ url('assets/logo.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ url('assets/logo.png') }}">

    <!-- Fonts -->
    <link href="//cdn.bootcss.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ url('assets/css/app.css') }}" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

</head>
<body id="app-layout">

    @include('layouts.partials.app-navbar')

    <main class="Main">
        @yield('content')
    </main>

    @include('layouts.partials.app-footer')

    <!-- JavaScripts -->
    <script src="//cdn.bootcss.com/jquery/2.2.1/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
