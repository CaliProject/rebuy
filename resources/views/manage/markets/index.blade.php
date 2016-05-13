@extends('layouts.admin')

@section('admin.title', '商品管理')

@section('admin.content')
    <div class="row">
        <div class="col-sm-12">
            <blockquote>
                <b>商品总数: {{ $products->total() }}</b>
                <a class="pull-right" href="{{ url('manage/markets/create') }}"><i class="icon-plus fa-2x"></i></a>
            </blockquote>
        </div>
        <div class="col-sm-12">
            <table class="products-table table table-responsive table-hover Table" action-url="{{ url('manage/markets') }}">
                <thead>
                <tr>
                    <th>标题</th>
                    <th>库存</th>
                    <th>价格</th>
                    <th>更新时间</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr data-id="{{ $product->id }}">
                        <td>
                            <a href="{{ $product->link() }}" target="_blank">{{ $product->shortName() }}</a>
                        </td>
                        <td>{{ $product->inventoryForView() }}</td>
                        <td>￥{{ $product->priceForView() }}</td>
                        <td>{{ $product->updated_at->diffForHumans() }}</td>
                        <td class="text-center">
                            <a href="#" class="edit-btn">
                                <i class="icon-pencil"></i>
                            </a>
                            <a href="#" class="delete-btn">
                                <i class="icon-close"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="text-center row">
                {!! $products->links() !!}
            </div>
        </div>
    </div>
@stop