@extends('layouts.app')

@section('title')
    @yield('admin.title') - 后台管理 -
@stop

@section('content')
    <div class="Admin">

        @include('layouts.partials.admin-sidebar')

        <main class="Container">

            @yield('admin.content')

        </main>

    </div>
@stop