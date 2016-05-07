@extends('layouts.admin')

@section('admin.title', '编辑用户' . $user->name)

@section('admin.content')
    <div class="row">
        <div class="col-sm-12">
            @include('manage.users.partials.form', [
                'method' => 'PATCH',
                'button' => '确定更新',
                'new' => true
            ])
        </div>
    </div>
@stop