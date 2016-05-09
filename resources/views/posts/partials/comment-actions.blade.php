<div class="comment-actions">
    <div class="myself">
        <img src="{{ auth()->check() ? auth()->user()->avatarUrl() : url('assets/images/default-avatar.png') }}" alt="" class="avatar">
    </div>
    <div class="reply">
        @if(Auth::guest())
            <div class="textarea guest">
                <h3>要想发表评论, 请先 <a href="{{ url('login') }}">登录</a> 或 <a href="{{ url('register') }}">注册</a></h3>
            </div>
        @else
            <div id="reply-textarea" class="textarea" contenteditable data-placeholder="说点什么吧..."></div>
            <div class="reply-actions">
                <a href="javascript:;" id="cancel-reply"><i class="fa fa-btn fa-times"></i>&nbsp;取消回复</a>
            </div>
            <div class="reply-button">
                <a href="javascript:;" id="reply-submit">提交评论</a>
            </div>
        @endif
    </div>
</div>