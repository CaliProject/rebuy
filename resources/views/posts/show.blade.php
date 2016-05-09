@extends('layouts.content')

@section('title', $post->title)

@section('breadcrumb')
    <li><a href="{{ url('/') }}">首页</a></li>
    <li><a href="{{ url('posts') }}">文章</a></li>
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
                    <a href="#">{{ $post->author->name }}</a>
                </div>
                <div class="Right">
                    <ul class="post-metas">
                        <li>
                            <i class="icon-clock"></i>&nbsp;{{ $post->created_at->diffForHumans() }}
                        </li>
                        <li>
                            <i class="icon-eye"></i>&nbsp;{{ $post->viewsCount() }}次浏览
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
            <div class="Inner">
                <article>
                    {!! $post->body !!}
                </article>
            </div>
            <div class="Actions">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="icon-share"></i>&nbsp;分享</a>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="#"><i class="fa fa-qq"></i>&nbsp;QQ空间</a>
                        <a href="#"><i class="fa fa-weibo"></i>&nbsp;新浪微博</a>
                    </li>
                </ul>
                @if(Auth::check())
                    <div class="Right">
                        <ul>
                            <li>
                                <a href="javascript:;"><i class="icon-like"></i>&nbsp;点赞 ({{ $post->likesCount() }})</a>
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
<script>
    $(function () {
        var $reply_area = $('#reply-textarea'),
                $parent_id = 0,
                $_token = "{{ csrf_token() }}",
                $is_submitting = false,
                $submit_button = $('a#reply-submit'),
                $current_page = 1,
                $is_loading = false,
                $loading_text = "点击加载更多...";

        $($reply_area).each(function () {
            $(this).bind('DOMNodeInserted', function (e) {
                if ($(e.target).hasClass('textarea')) {
                    $reply_area.attr('data-placeholder', '');
                }
            });

            $(this).keydown(function (e) {
                if ((event.ctrlKey || event.metaKey) && e.which == 13) {
                    event.preventDefault();
                    $('a#reply-submit').trigger('click');
                }
            });
        });

        function initEvents() {
            // Like buttons
            $('a#like-button').each(function () {
                var parentItem = $(this).parents(".comment-item")[0],
                        commentID = $(parentItem).attr('data-id'),
                        commentLikes = $(this).html();

                $(this).click(function () {
                    if (!$(this).hasClass('liked')) {
                        // Like this
                        var el = $(this);

                        $.ajax({
                            url: "{{ url('comments/like') }}/" + commentID,
                            data: {_token: $_token},
                            dataType: "json",
                            type: "PUT",
                            success: function (data) {
                                if (data.status == "success") {
                                    // Succeeded
                                    commentLikes++;
                                    el.html(commentLikes).addClass('liked');
                                } else {
                                    showGenieMessage(data.message);
                                }
                            }
                        });
                    }
                });
            });

            // Reply buttons
            $('a#reply-button').each(function () {
                $(this).click(function () {
                    // Reply this
                    var parentItem = $(this).parents(".comment-item")[0],
                            parentNode = $(this).parents(".details")[0],
                            commentID = $(parentItem).attr('data-id');

                    $parent_id = commentID;
                    $(".comment-actions").appendTo($(parentNode)).addClass("replying");
                });
            });

            $('a#cancel-reply').each(function () {
                $(this).click(function () {
                    $(".comment-actions").prependTo($(".comments-wrap")).removeClass("replying");
                    $parent_id = 0;
                });
            });
        }

        // Load more comments
        $('a#load-more-button').click(function () {
            var $load_more = $("a#load-more-button");
            $load_more.html('<i class="fa fa-spin fa-spinner"></i>"');

            if (!$is_loading) {
                $is_loading = true;
                $.ajax({
                    url: "{{ url()->current() . '/comments' }}/" + $current_page,
                    data: {_token: $_token},
                    type: "POST",
                    dataType: "json",
                    success: function (data) {
                        $is_loading = false;
                        $load_more.html($loading_text);
                        if (data.html == "") {
                            $($load_more).remove();
                        }
                        $(data.html).appendTo($('ul.comments-list')[0]);
                        $current_page++;

                        initEvents();
                    }
                });
            }
        });

        $submit_button.on('click', function () {
            submitComment();
        });

        function submitComment() {
            if ($is_submitting) {
                return false;
            }
            // Submit comment
            $content = $reply_area.html();

            if ($content.trim() == "") {
                return false;
            }

            $is_submitting = true;
            $($submit_button).addClass('disabled');

            $.ajax({
                url: "{{ url()->current() . '/comment' }}",
                data: {_token: $_token, content: $content, origin: $parent_id},
                dataType: "json",
                type: "POST",
                success: function (data) {
                    $is_submitting = false;
                    $submit_button.removeClass('disabled');
                    if (data.status == "error") {
                        swal({title:data.message, type:"error",timer: 1500,showConfirmButton: false});
                    } else {
                        toastr.success(data.message);
                        addComment($parent_id, data.html);
                    }
                }
            });
        }

        function addComment($parent_id, $html) {
            $no_reulst = $('.comments-list h3');
            if (!$parent_id) {
                if ($no_reulst != null) {
                    $no_reulst.remove();
                }
                $($html).appendTo($('.comments-list')[0]).fadeIn();
            } else {
                var selector = '.comment-item[data-id=' + $parent_id + ']';
                $html = "<ul class=\"comments-list\">" + $html + "</ul>";
                $($html).appendTo($(selector)[0]).fadeIn();

                $('a#cancel-reply').trigger('click');
            }
            $reply_area.html('');
            initEvents();
        }

        initEvents();
    });
</script>
@endpush