@extends('layouts.app')

@section('title', $user->name)

@section('content')
    <div class="container">
        <div class="Profile">
            <div class="Details">
                <div class="Avatar">
                    <img src="{{ $user->avatarUrl() }}" alt="{{ $user->name }}的头像">
                </div>
                <div class="About text-center">
                    <h2>{{ $user->name }}</h2>
                    <p>来Rebuy已经{{ $user->created_at->diffInDays() }}天了</p>
                </div>
            </div>
            <div class="Posts">
                <div class="line-title">
                    <h3>Ta发布的文章 <i class="icon-notebook"></i></h3>
                </div>
                <ul class="posts-list">
                    @forelse($user->posts()->latest()->take(6)->get() as $post)
                        <li class="post-item">
                            <a href="{{ $post->link() }}">
                                <span class="title">{{ $post->title }}</span>
                                <div class="pull-right">
                                    <span class="views"><i class="icon-eye icon-btn"></i>&nbsp;{{ $post->formattedViews() }}</span>
                                    <span class="comments" style="margin-right: 1em"><i class="icon-bubbles icon-btn"></i>&nbsp;{{ $post->commentsCount() }}</span>
                                    <time>{{ $post->created_at->diffForHumans() }}</time>
                                </div>
                            </a>
                        </li>
                    @empty
                        <div class="row text-center">
                            <h4 class="grayed"><i class="fa fa-frown-o"></i>&nbsp;暂无发布任何文章</h4>
                        </div>
                    @endforelse
                </ul>
            </div>
            <div class="Comments">
                <div class="line-title">
                    <h3>Ta的评论 <i class="icon-bubbles"></i></h3>
                </div>
                <ul class="comments-list">
                    @forelse($user->comments()->latest()->take(6)->get() as $comment)
                        <li>
                            <div class="comment-item">
                                <div class="avatar">
                                    <a href="{{ $comment->author->profileLink() }}">
                                        <img src="{{ $comment->author->avatarUrl() }}}" alt="{{ $comment->author->name }}的头像">
                                    </a>
                                </div>
                                <div class="details">
                                    <div class="meta">
                                        <strong><a href="https://v.abletive.com/@Cali">Cali</a></strong>
                                        <time class="time">{{ $comment->created_at->diffForHumans() }}</time>
                                        <span class="in-series">发表在<a href="{{ $comment->post->link() }}">{{ $comment->post->title }}</a></span>
                                    </div>
                                    <div class="body">
                                        <p>{!! $comment->body !!}</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @empty
                        <div class="row text-center">
                            <h4 class="grayed"><i class="fa fa-frown-o"></i>&nbsp;暂无任何评论</h4>
                        </div>
                    @endforelse
                </ul>
            </div>
            <div class="Products">
                <div class="line-title">
                    <h3>Ta发布的商品 <i class="icon-handbag"></i></h3>
                </div>
                <div class="product-list">
                    @foreach($user->products()->latest()->take(4)->get() as $product)
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
            </div>
        </div>
    </div>
@stop

@push('footer')
<div class="overlay-wrapper">
    <div class="blurry">
        <div class="background-overlay" style="background-image: url('{{ $user->avatarUrl() }}')"></div>
    </div>
</div>
@endpush