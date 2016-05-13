@extends('layouts.content')

@section('title', '标签' . $tag->name)

@section('breadcrumb')
    <li>文章</li>
    <li class="active">标签 「{{ $tag->name }}」</li>
@stop

@section('content.main')
    <div class="Posts">
        <ul class="posts-list">
            @foreach(($posts = $tag->paginatedPosts()) as $post)
                <li>
                    <a href="{{ $post->link() }}">
                        <span class="title">{{ $post->title }}</span>
                        <div class="pull-right">
                            <span class="author">{{ $post->author->name }}</span>
                            <span class="views"><i
                                        class="icon-eye icon-btn"></i>&nbsp;{{ $post->formattedViews() }}</span>
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