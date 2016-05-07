@extends('layouts.admin')

@section('admin.title', '创建用户')

@section('admin.content')
    <div class="row">
        <div class="col-sm-12">
            @include('manage.users.partials.form', [
                'method' => 'POST',
                'button' => '确定创建',
                'new' => false
            ])
        </div>
    </div>
@stop