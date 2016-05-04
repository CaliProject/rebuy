@extends('layouts.app')

@section('title', '主页')

@section('content')
    @include('layouts.partials.app-carousel')

    <div class="container" id="content-wrapper">
        <section class="row videos">
            <div class="section-title">
                <h3><i class="icon-film"></i>&nbsp;Rebuy出品视频</h3>
                <div class="pull-right">
                    <a href="#" class="more">查看更多</a>
                </div>
            </div>
            <div class="section-content">
                <div class="post video-post">
                    <a href="#">
                        <div class="cover">
                            <div class="thumbnail-wrapper">
                                <div class="thumbnail" style="background-image: url('{{ url('assets/images/macbook.jpg') }}')"></div>
                            </div>
                            <div class="play-icon"></div>
                        </div>
                        <h4 class="post-title">在MacBook上访问</h4>
                    </a>
                </div>
                <div class="post video-post">
                    <a href="#">
                        <div class="cover">
                            <div class="thumbnail-wrapper">
                                <div class="thumbnail" style="background-image: url('{{ url('assets/images/huawei_p8.jpg') }}')"></div>
                            </div>
                            <div class="play-icon"></div>
                        </div>
                        <h4 class="post-title">正式登录华为P8</h4>
                    </a>
                </div>
                <div class="post video-post">
                    <a href="#">
                        <div class="cover">
                            <div class="thumbnail-wrapper">
                                <div class="thumbnail" style="background-image: url('{{ url('assets/images/android-1.jpg') }}')"></div>
                            </div>
                            <div class="play-icon"></div>
                        </div>
                        <h4 class="post-title">安卓客户端测试1</h4>
                    </a>
                </div>
                <div class="post video-post">
                    <a href="#">
                        <div class="cover">
                            <div class="thumbnail-wrapper">
                                <div class="thumbnail" style="background-image: url('{{ url('assets/images/android-2.jpg') }}')"></div>
                            </div>
                            <div class="play-icon"></div>
                        </div>
                        <h4 class="post-title">安卓客户端测试2</h4>
                    </a>
                </div>
                <div class="post video-post">
                    <a href="#">
                        <div class="cover">
                            <div class="thumbnail-wrapper">
                                <div class="thumbnail" style="background-image: url('{{ url('assets/images/android-4.jpg') }}')"></div>
                            </div>
                            <div class="play-icon"></div>
                        </div>
                        <h4 class="post-title">安卓客户端测试3</h4>
                    </a>
                </div>
                <div class="post video-post">
                    <a href="#">
                        <div class="cover">
                            <div class="thumbnail-wrapper">
                                <div class="thumbnail" style="background-image: url('{{ url('assets/images/android5.jpg') }}')"></div>
                            </div>
                            <div class="play-icon"></div>
                        </div>
                        <h4 class="post-title">安卓客户端测试4</h4>
                    </a>
                </div>
            </div>
        </section>
        <section class="row blogs">
            <div class="section-title">
                <h3><i class="icon-notebook"></i>&nbsp;Rebuy文章</h3>
                <div class="pull-right">
                    <a href="#" class="more">查看更多</a>
                </div>
            </div>
            <div class="section-content">
                <div class="left-side">
                    <ul class="blog-list">
                        <li class="blog-item">
                            <div class="post blog-post sticky-post">
                                <a href="#">
                                    <div class="thumbnail" style="background-image: url('{{ url('assets/images/android-3.jpg') }}')"></div>
                                    <span class="post-title">一个大大的标题</span>
                                    <time class="pull-right">35分钟前</time>
                                </a>
                            </div>
                        </li>
                        <li class="blog-item">
                            <div class="post blog-post">
                                <a href="#">
                                    <span class="post-title">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span>
                                    <time class="pull-right">5分钟前</time>
                                </a>
                            </div>
                        </li>
                        <li class="blog-item">
                            <div class="post blog-post">
                                <a href="#">
                                    <span class="post-title">Assumenda, at deserunt eius, et illum iusto magni.</span>
                                    <time class="pull-right">1小时前</time>
                                </a>
                            </div>
                        </li>
                        <li class="blog-item">
                            <div class="post blog-post">
                                <a href="#">
                                    <span class="post-title">Beatae esse molestias natus quaerat, quas sit.</span>
                                    <time class="pull-right">2天前</time>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="right-side">
                    <ul class="blog-list">
                        <li class="blog-item">
                            <div class="post blog-post sticky-post">
                                <a href="#">
                                    <div class="thumbnail" style="background-image: url('{{ url('assets/images/android-1.jpg') }}')"></div>
                                    <span class="post-title">一个小小的标题</span>
                                    <time class="pull-right">15分钟前</time>
                                </a>
                            </div>
                        </li>
                        <li class="blog-item">
                            <div class="post blog-post">
                                <a href="#">
                                    <span class="post-title">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span>
                                    <time class="pull-right">53分钟前</time>
                                </a>
                            </div>
                        </li>
                        <li class="blog-item">
                            <div class="post blog-post">
                                <a href="#">
                                    <span class="post-title">Assumenda, at deserunt eius, et illum iusto magni.</span>
                                    <time class="pull-right">3小时前</time>
                                </a>
                            </div>
                        </li>
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
