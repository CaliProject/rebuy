@extends('layouts.admin')

@section('admin.title', '首页')

@section('admin.content')
    <div class="row">
        <div class="col-md-4 col-sm-6">
            <div class="Overview Panel">
                <div class="Content overview-content">
                    <div class="overview-title">
                        <p class="counter">{{ Stat::users() }}</p>
                        <span>昨日新用户</span>
                    </div>
                    <div class="overview-icon">
                        <i class="icon-user-follow"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="Overview Panel">
                <div class="Content overview-content">
                    <div class="overview-title">
                        <p class="counter">{{ Stat::users('today') }}</p>
                        <span>今日新用户</span>
                    </div>
                    <div class="overview-icon">
                        <i class="icon-user-follow"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="Overview Panel">
                <div class="Content overview-content">
                    <div class="overview-title">
                        <p class="counter">{{ Stat::users('all') }}</p>
                        <span>用户总计</span>
                    </div>
                    <div class="overview-icon">
                        <i class="icon-users"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-6">
            <div class="Overview Panel">
                <div class="Content overview-content">
                    <div class="overview-title">
                        <p class="counter">{{ Stat::posts() }}</p>
                        <span>累计文章总数</span>
                    </div>
                    <div class="overview-icon">
                        <i class="icon-notebook"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="Overview Panel">
                <div class="Content overview-content">
                    <div class="overview-title">
                        <p class="counter">{{ Stat::comments() }}</p>
                        <span>累计评论总数</span>
                    </div>
                    <div class="overview-icon">
                        <i class="icon-bubbles"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="Overview Panel">
                <div class="Content overview-content">
                    <div class="overview-title">
                        <p class="counter">{{ Stat::medias() }}</p>
                        <span>累计图片总数</span>
                    </div>
                    <div class="overview-icon">
                        <i class="icon-picture"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="Overview Panel">
                <div class="Content overview-content">
                    <div class="overview-title">
                        <p class="counter">{{ Stat::products() }}</p>
                        <span>累计商品总数</span>
                    </div>
                    <div class="overview-icon">
                        <i class="icon-handbag"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="Overview Panel">
                <div class="Content overview-content">
                    <div class="overview-title">
                        <p class="counter">{{ Stat::likes() }}</p>
                        <span>累计点赞次数</span>
                    </div>
                    <div class="overview-icon">
                        <i class="icon-like"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="Overview Panel">
                <div class="Content overview-content">
                    <div class="overview-title">
                        <p class="counter">{{ Stat::views() }}</p>
                        <span>累计浏览次数</span>
                    </div>
                    <div class="overview-icon">
                        <i class="icon-eye"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop