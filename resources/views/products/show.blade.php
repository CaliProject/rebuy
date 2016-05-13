@extends('layouts.content')

@section('title', $product->name)

@section('breadcrumb')
    <li><a href="{{ url('markets') }}">商城</a></li>
    <li class="active">「{{ $product->name }}」</li>
@stop

@section('content.main')
    <div class="Post Post--product">
        <div class="Header">
            <div class="Title">
                <h2>{{ $product->name }}</h2>
                <div class="pull-right">
                    <h3 class="price">￥{{ $product->priceForView() }}</h3>
                    <span>库存: {{ $product->inventoryForView() }}</span>
                </div>
            </div>
            <div class="Meta">
                <div class="Author">
                    <img src="{{ $product->author->avatarUrl() }}" alt="{{ $product->author->name }}的头像" class="avatar">
                    <a href="{{ $product->author->profileLink() }}">{{ $product->author->name }}</a>
                </div>
                <div class="Right">
                    <ul class="post-metas">
                        <li>
                            <i class="icon-clock"></i>&nbsp;{{ $product->created_at->diffForHumans() }}
                        </li>
                        <li>
                            <i class="icon-eye"></i>&nbsp;{{ $product->formattedViews() }}次浏览
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <hr>
        <div class="Article">
            <div class="Tags">
                <ul class="tag-list">
                    @foreach($product->tags as $tag)
                        <li>
                            <a href="{{ $tag->link('product') }}">{{ $tag->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="product-image">
                <img src="{{ $product->coverImage() }}" alt="{{ $product->name }}">
            </div>
            <div class="Product-Actions">
                <a href="#" class="buy-btn confirm-buy"><i class="icon-credit-card"></i>&nbsp;确认购买</a>
                <a href="#" class="buy-btn add-to-cart"><i class="icon-basket"></i>&nbsp;加入购物车</a>
            </div>
            <div class="Inner">
                <h3><i class="icon-pie-chart"></i>&nbsp;商品参数</h3>
                <hr>
                <ul class="product-metas">
                    @foreach($product->getMetaArray() as $meta)
                        <li class="col-sm-6 col-md-4">
                            <span>{{ $meta->key }}: &nbsp;{{ $meta->value }}</span>
                        </li>
                    @endforeach
                </ul>
                <h3><i class="icon-pin"></i>&nbsp;商品介绍</h3>
                <hr>
                <article>
                    {!! $product->description !!}
                </article>
            </div>
            <div class="Actions">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="icon-share"></i>&nbsp;分享</a>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="http://connect.qq.com/widget/shareqq/index.html?url={{ url()->current() }}&title={{ urlencode($product->name) }}&desc={{ urlencode(str_limit($product->description, 35)) }}"><i class="fa fa-qq"></i>&nbsp;QQ好友</a>
                        <a href="http://service.weibo.com/share/share.php?url={{ url()->current() }}&title={{ urlencode($product->name) }}&appkey=1343713053&searchPic=true"><i class="fa fa-weibo"></i>&nbsp;新浪微博</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@stop