@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="Panel">
            <ol class="Breadcrumb">
                <li><a href="{{ url('/') }}">主页</a></li>
                @yield('breadcrumb')
            </ol>
            @yield('content.main')
        </div>
    </div>
@stop