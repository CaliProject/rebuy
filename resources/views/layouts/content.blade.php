@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="Panel">
            <ol class="Breadcrumb">
                @yield('breadcrumb')
            </ol>
            @yield('content.main')
        </div>
    </div>
@stop