<aside class="Sidebar">
    <ul class="sidebar-links">
        <li>
            <a href="{{ url('manage') }}" class="{{ request()->is('manage') ? 'selected' : '' }}"><i class="icon-speedometer icon-btn"></i>&nbsp;首页</a>
        </li>
        <li>
            <a href="#"><i class="icon-notebook icon-btn"></i>&nbsp;文章管理</a>
        </li>
        <li>
            <a href="#"><i class="icon-users icon-btn"></i>&nbsp;用户管理</a>
        </li>
        <li>
            <a href="#"><i class="icon-bubbles icon-btn"></i>&nbsp;评论管理</a>
        </li>
        <li>
            <a href="#"><i class="icon-picture icon-btn"></i>&nbsp;图片管理</a>
        </li>
        <li>
            <a href="#"><i class="icon-handbag icon-btn"></i>&nbsp;商品管理</a>
        </li>
    </ul>
</aside>