<!-- Navbar -->
<nav class="navbar navbar-fixed-top Nav">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ url('favicon.png') }}" alt="Rebuy Logo">
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li{{ request()->is('/') ? ' class=on' : '' }}><a href="{{ url('/') }}">主页</a></li>
                <li{{ request()->is('posts*') && !isset($video) ? ' class=on' : '' }}><a href="{{ url('posts') }}">文章</a></li>
                <li{{ request()->is('videos*') || (isset($video) && $video === true) ? ' class=on' : '' }}><a href="{{ url('videos') }}">视频</a></li>
                <li{{ request()->is('markets*') ? ' class=on' : '' }}><a href="{{ url('markets') }}">商城</a></li>
                <li>
                    <div class="search-bar">
                        <form :action="'{{ url('search') }}/'+searchText" role="search" novalidate @submit.prevent="search">
                            <input type="text" v-model="searchText" placeholder="搜索...">
                            <i class="fa fa-search"></i>
                        </form>
                    </div>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('login') }}">登录</a></li>
                    <li><a href="{{ url('register') }}">注册</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <img src="{{ Auth::user()->avatarUrl() }}" alt="{{ Auth::user()->name }}的头像" class="avatar">&nbsp;{{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            @if(Auth::user()->isAdmin())
                                <li><a href="{{ url('manage') }}"><i class="icon-speedometer icon-btn"></i>&nbsp;后台管理</a></li>
                            @endif
                            <li><a href="{{ Auth::user()->profileLink() }}"><i class="icon-compass icon-btn"></i>&nbsp;个人主页</a></li>
                            <li><a href="{{ url('profile') }}"><i class="icon-note icon-btn"></i>&nbsp;修改资料</a></li>
                            <li><a href="{{ url('logout') }}"><i class="icon-power icon-btn"></i>&nbsp;注销</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>