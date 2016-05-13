@extends('layouts.admin')

@section('admin.title', '编辑商品')

@section('admin.content')
    <div class="row">
        <div class="col-sm-12">
            @include('manage.markets.partials.form', [
                'method' => 'PATCH',
                'button' => '确定更新'
            ])
        </div>
    </div>
@stop

@include('manage.markets.partials.scripts')