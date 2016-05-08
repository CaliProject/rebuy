<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>

        @yield('title') | Rebuy

    </title>

    <link rel="icon" href="{{ url('assets/logo.png') }}">
    <link rel="shortcut icon" href="{{ url('assets/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ url('assets/logo.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ url('assets/logo.png') }}">

    <!-- Fonts -->
    <link href="//cdn.bootcss.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ url('assets/css/app.css') }}" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <script src="{{ url('assets/js/modernizr.custom.js') }}"></script>

    @stack('head')

</head>
<body id="app">

    @include('layouts.partials.app-navbar')

    <main class="Main">
        @yield('content')
    </main>

    @include('layouts.partials.app-footer')

    <!-- JavaScripts -->
    <script src="{{ url('assets/js/app.js') }}"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    @stack('scripts.footer')

    @if(isset($errors))
        <script>
            @foreach($errors->all() as $error)
                toastr.error("{!! addslashes($error) !!}");
            @endforeach
        </script>
    @endif
    @if(session('status'))
        <script>
            toastr['{{ session('status') }}']("{!! addslashes(session('message')) !!}");
        </script>
    @endif
</body>
</html>
