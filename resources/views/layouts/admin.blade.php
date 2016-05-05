@extends('layouts.app')

@section('title')@yield('admin.title') - 后台管理@stop

@section('content')
    <div class="Admin">

        @include('layouts.partials.admin-sidebar')

        <main class="Container">

            <h2 class="title">@yield('admin.title')</h2>

            @yield('admin.content')

        </main>

    </div>
@stop

@push('head')
<meta name="_token" content="{{ csrf_token() }}">
@endpush

@push('scripts.footer')
<script src="{{ url('assets/js/admin.js') }}"></script>
@endpush