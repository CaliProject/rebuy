<aside class="Sidebar">
    <ul class="sidebar-links">
        <li>
            <a href="{{ url('manage') }}" class="{{ request()->is('manage') ? 'selected' : '' }}"><i class="icon-speedometer icon-btn"></i>&nbsp;首页</a>
        </li>
        <li>
            <a href="{{ url('manage/posts') }}" class="{{ request()->is('manage/posts*') ? 'selected' : '' }}"><i class="icon-notebook icon-btn"></i>&nbsp;文章管理</a>
        </li>
        <li>
            <a href="{{ url('manage/users') }}" class="{{ request()->is('manage/users*') ? 'selected' : '' }}"><i class="icon-users icon-btn"></i>&nbsp;用户管理</a>
        </li>
        <li>
            <a href="{{ url('manage/comments') }}" class="{{ request()->is('manage/comments*') ? 'selected' : '' }}"><i class="icon-bubbles icon-btn"></i>&nbsp;评论管理</a>
        </li>
        <li>
            <a href="{{ url('manage/media') }}" class="{{ request()->is('manage/media*') ? 'selected' : '' }}"><i class="icon-picture icon-btn"></i>&nbsp;图片管理</a>
        </li>
        <li>
            <a href="{{ url('manage/markets') }}" class="{{ request()->is('manage/markets*') ? 'selected' : '' }}"><i class="icon-handbag icon-btn"></i>&nbsp;商品管理</a>
        </li>
        <li>
            <a href="{{ url('manage/extras') }}" class="{{ request()->is('manage/extras*') ? 'selected' : '' }}"><i class="icon-magic-wand icon-btn"></i>&nbsp;其他设置</a>
        </li>
    </ul>
</aside>