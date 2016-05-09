<li>
    <div class="comment-item" data-id="{{ $comment->id }}">
        <div class="avatar">
            <a href="{{ $comment->author->profileLink() }}">
                <img src="{{ $comment->author->avatarUrl() }}" alt="{{ $comment->author->name }}的头像">
            </a>
        </div>
        <div class="details">
            <div class="meta">
                <strong><a href="{{ $comment->author->profileLink() }}">{{ $comment->author->name }}</a></strong>
                @if($comment->author->isAdmin())
                    <span class="moderator">管理君</span>
                @endif
                <span class="time">{{ $comment->created_at->diffForHumans() }}</span>
            </div>
            <div class="body">
                <p>{!! $comment->body !!}</p>
            </div>
            <div class="actions">
                @if(Auth::check())
                    <ul class="action-list">
                        <li><a href="javascript:;" id="like-button" title="点赞"
                               class="{{ auth()->user()->likedComment($comment) ? "liked" : "" }}">{{ $comment->likesCount() }}</a>
                        </li>
                        <li><a href="javascript:;" id="reply-button" title="回复"><i class="fa fa-btn fa-reply"></i></a>
                        </li>
                        <li class="liked-users animated bounceIn"></li>
                    </ul>
                @endif
            </div>
        </div>
        @if($comment->children)
            @unless(isset($no_children))
                <ul class="comments-list">
                    @each('posts.partials.comment-list', $comment->children, 'comment')
                </ul>
            @endunless
        @endif
    </div>
</li>