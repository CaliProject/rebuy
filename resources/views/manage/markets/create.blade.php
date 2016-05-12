@extends('layouts.admin')

@section('admin.title', '添加商品')

@section('admin.content')
    <div class="row">
        <div class="col-sm-12">
            @include('manage.markets.partials.form', [
                'method' => 'POST',
                'button' => '确定添加'
            ])
        </div>
    </div>
@stop