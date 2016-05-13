@extends('layouts.content')

@section('title', '标签' . $tag->name)

@section('breadcrumb')
    <li><a href="{{ url('markets') }}">商城</a></li>
    <li class="active">标签 「{{ $tag->name }}」</li>
@stop

@section('content.main')
    <div class="Tags">
        <ul class="tag-list">
            @foreach($tags as $tag)
                <li>
                    <a href="{{ $tag->link('product') }}">{{ $tag->name }}</a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="Products">
        <div class="product-list">
            @foreach(($products = $tag->paginatedProducts()) as $product)
                <div class="product-item">
                    <a href="{{ $product->link() }}">
                        <div class="cover">
                            <div class="thumbnail" style="background-image: url('{{ $product->coverImage() }}')"></div>
                        </div>
                        <div class="details">
                            <div class="product-name">
                                <span>{{ $product->name }}</span>
                            </div>
                            <div class="product-price">
                                {{ $product->priceForView() }}
                            </div>
                            <div class="product-inventory">
                                库存: {{ $product->inventoryForView() }}
                            </div>
                            <div class="product-date">
                                <time>{{ $product->created_at->diffForHumans() }}</time>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="row text-center">
            {!! $products->links() !!}
        </div>
    </div>
@stop