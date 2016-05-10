@extends('layouts.content')

@section('title', $keyword . '的相关内容')

@section('breadcrumb')
    <li class="active">搜索 『{{ $keyword }}』 的相关内容</li>
@stop

@section('content.main')
    <div class="Search">
        <div class="row">
            <h3 class="text-center">文章结果</h3>
        </div>
        <div class="Posts">
            <ul class="posts-list">
                @foreach($posts as $post)
                    <li>
                        <a href="{{ $post->link() }}">
                            <span class="title">
                                {{ $post->title }}
                                <span class="post-type" post-type="{{ $post->readableType() }}">{{ $post->readableType() }}</span>
                            </span>
                            <div class="pull-right">
                                <span class="author">{{ $post->author->name }}</span>
                                <span class="views"><i class="icon-eye icon-btn"></i>&nbsp;{{ $post->formattedViews() }}</span>
                                <time>{{ $post->created_at->diffForHumans() }}</time>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
            <div class="row text-center">
                {!! $posts->links() !!}
            </div>
        </div>
        <div class="row">
            <h3 class="text-center">商品结果</h3>
        </div>
        <div class="Products">
            {{-- TODO: Product list --}}
        </div>
    </div>
@stop