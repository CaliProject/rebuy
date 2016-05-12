@extends('layouts.content')

@section('title', $post->title)

@section('breadcrumb')
    <li><a href="{{ isset($video) ? url('videos') : url('posts') }}">{{ isset($video) ? '视频' : '文章' }}</a></li>
    <li class="active">{{ $post->title }}</li>
@stop

@section('content.main')
    <div class="Post{{ $post->type === 1 ? ' Post--video' : '' }}">
        <div class="Header">
            <div class="Title">
                <h2>{{ $post->title }}</h2>
            </div>
            <div class="Meta">
                <div class="Author">
                    <img src="{{ $post->author->avatarUrl() }}" alt="{{ $post->author->name }}的头像" class="avatar">
                    <a href="{{ $post->author->profileLink() }}">{{ $post->author->name }}</a>
                </div>
                <div class="Right">
                    <ul class="post-metas">
                        <li>
                            <i class="icon-clock"></i>&nbsp;{{ $post->created_at->diffForHumans() }}
                        </li>
                        <li>
                            <i class="icon-eye"></i>&nbsp;{{ $post->formattedViews() }}次浏览
                        </li>
                        <li>
                            <i class="icon-bubbles"></i>&nbsp;{{ $post->commentsCount() }}评论
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <hr>
        <div class="Article">
            @if($post->type == 1)
                <div class="Video">
                    <video src="{{ $post->video_src }}" preload="auto" controls></video>
                </div>
            @endif
            <div class="Tags">
                <ul class="tag-list">
                    @foreach($post->tags as $tag)
                        <li>
                            <a href="{{ $tag->link() }}">{{ $tag->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="Inner">
                <article>
                    {!! $post->body !!}
                </article>
            </div>
            <div class="Actions">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="icon-share"></i>&nbsp;分享</a>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="http://connect.qq.com/widget/shareqq/index.html?url={{ url()->current() }}&title={{ urlencode($post->title) }}&desc={{ urlencode(str_limit($post->body, 35)) }}"><i class="fa fa-qq"></i>&nbsp;QQ好友</a>
                        <a href="http://service.weibo.com/share/share.php?url={{ url()->current() }}&title={{ urlencode($post->title) }}&appkey=1343713053&searchPic=true"><i class="fa fa-weibo"></i>&nbsp;新浪微博</a>
                    </li>
                </ul>
                @if(Auth::check())
                    <div class="Right">
                        <ul>
                            <li>
                                <a href="javascript:;" id="post-like-btn"{{ ($liked = Auth::user()->likedPost($post)) ? ' class=liked' : '' }}><i class="{{ $liked ? 'fa fa-thumbs-up' : 'icon-like' }}"></i>&nbsp;点赞 ({{ $post->likesCount() }})</a>
                            </li>
                        </ul>
                    </div>
                @endif
            </div>
        </div>
        <div class="Related">
            <h3 class="panel-heading">相关文章</h3>
            <div class="col-sm-6">
                @if(($prev = $post->previous()) != null)
                    <a href="{{ $prev->link() }}">
                        <div class="Related-post" style="background-image: url('{{ $prev->coverImage() }}')">
                            <div class="title">
                                <h4>{{ $prev->title }}</h4>
                            </div>
                        </div>
                    </a>
                @endif
            </div>
            <div class="col-sm-6">
                @if(($next = $post->next()) != null)
                    <a href="{{ $next->link() }}">
                        <div class="Related-post" style="background-image: url('{{ $next->coverImage() }}')">
                            <div class="title">
                                <h4>{{ $next->title }}</h4>
                            </div>
                        </div>
                    </a>
                @endif
            </div>
        </div>
        <div class="Comments">
            <h3 class="panel-heading">评论回复</h3>
            <div class="col-sm-12">
                <div class="comments-wrap">
                    @include('posts.partials.comment-actions')

                    <ul class="comments-list" style="margin-left: 0">
                        @include('posts.partials.comments')
                    </ul>
                </div>
                <div class="row text-center">
                    @if($comments->total() > $comments->count())
                        <a href="javascript:;" id="load-more-button" class="btn btn-default" style="padding: 10px 5em;">点击加载更多...</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts.footer')
@include('posts.partials.scripts')
@endpush