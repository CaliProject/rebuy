@extends('layouts.admin')

@section('admin.title', '添加文章')

@section('admin.content')
    <div class="row">
        <div class="col-sm-12">
            @include('manage.posts.partials.form', [
                'method' => 'POST',
                'button' => '确定添加'
            ])
        </div>
    </div>
@stop

@include('manage.posts.partials.scripts')