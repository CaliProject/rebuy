@extends('layouts.app')

@section('title', '主页')

@section('content')
    @include('layouts.partials.app-carousel')

    <div class="container" id="content-wrapper">
        <section class="row videos">
            <div class="section-title">
                <h3><i class="icon-film"></i>&nbsp;Rebuy出品视频</h3>
                <div class="pull-right">
                    <a href="{{ url('videos') }}" class="more">查看更多</a>
                </div>
            </div>
            <div class="section-content">
                @foreach($videos as $video)
                    <div class="post video-post">
                        <a href="{{ $video->link() }}">
                            <div class="cover">
                                <div class="thumbnail-wrapper">
                                    <div class="thumbnail" style="background-image: url('{{ $video->coverImage() }}')"></div>
                                </div>
                                <div class="play-icon"></div>
                            </div>
                            <h4 class="post-title">{{ str_limit($video->title, 35) }}</h4>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
        <section class="row blogs">
            <div class="section-title">
                <h3><i class="icon-notebook"></i>&nbsp;Rebuy文章</h3>
                <div class="pull-right">
                    <a href="{{ url('posts') }}" class="more">查看更多</a>
                </div>
            </div>
            <div class="section-content">
                <div class="left-side">
                    <ul class="blog-list">
                        <li class="blog-item">
                            <div class="post blog-post sticky-post">
                                <a href="{{ ($left = array_pull($leftPosts, 0))->link() }}">
                                    <div class="thumbnail" style="background-image: url('{{ $left->coverImage() }}')"></div>
                                    <span class="post-title">{{ $left->title }}</span>
                                    <time class="pull-right">{{ $left->created_at->diffForHumans() }}</time>
                                </a>
                            </div>
                        </li>
                        @foreach($leftPosts as $post)
                            <li class="blog-item">
                                <div class="post blog-post">
                                    <a href="{{ $post->link() }}">
                                        <span class="post-title">{{ $post->title }}</span>
                                        <time class="pull-right">{{ $post->created_at->diffForHumans() }}</time>
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="right-side">
                    <ul class="blog-list">
                        <li class="blog-item">
                            <div class="post blog-post sticky-post">
                                <a href="{{ ($right = array_pull($rightPosts, 0))->link() }}">
                                    <div class="thumbnail" style="background-image: url('{{ $right->coverImage() }}')"></div>
                                    <span class="post-title">{{ $right->title }}</span>
                                    <time class="pull-right">{{ $right->created_at->diffForHumans() }}</time>
                                </a>
                            </div>
                        </li>
                        @foreach($rightPosts as $post)
                            <li class="blog-item">
                                <div class="post blog-post">
                                    <a href="{{ $post->link() }}">
                                        <span class="post-title">{{ $post->title }}</span>
                                        <time class="pull-right">{{ $post->created_at->diffForHumans() }}</time>
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>
        <section class="row markets">
            <div class="section-title">
                <h3><i class="icon-handbag"></i>&nbsp;Rebuy商城</h3>
                <div class="pull-right">
                    <a href="{{ url('markets') }}" class="more">查看更多</a>
                </div>
            </div>
            <div class="section-content">
                <div class="product-list">
                    @for($i = 1; $i <= 6; $i++)
                        <div class="product-item">
                            <a href="#">
                                <div class="cover">
                                    <div class="thumbnail" style="background-image: url('{{ url('assets/images/iphone' . $i . '.jpg') }}')"></div>
                                </div>
                                <div class="details">
                                    <div class="product-name">
                                        <span>iPhone 6s 64GB 银色</span>
                                    </div>
                                    <div class="product-price">
                                        5099.00
                                    </div>
                                    <div class="product-inventory">
                                        库存: 3
                                    </div>
                                    <div class="product-date">
                                        <time>{{ $i }}小时前</time>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endfor
                </div>
            </div>
        </section>
    </div>

@endsection
