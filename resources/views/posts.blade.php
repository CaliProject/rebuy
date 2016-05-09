@extends('layouts.content')

@section('title', $type ? '视频列表' : '文章列表')

@section('breadcrumb')
    <li class="active">{{ $type ? '视频' : '文章' }}</li>
@stop

@section('content.main')
    <div class="Posts">
        <ul class="posts-list">
            @foreach($posts as $post)
                <li>
                    <a href="{{ $post->link() }}">
                        <span class="title">{{ $post->title }}</span>
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
@stop