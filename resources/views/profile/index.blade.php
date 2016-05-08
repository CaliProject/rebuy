@extends('layouts.app')

@section('title', '主页')

@section('content')
    <div class="container">
        <div class="Profile">
            <div class="col-sm-3">
                <div class="profile-meta">
                    <div class="profile-avatar" @click="uploadAvatar">
                        <img src="{{ Auth::user()->avatarUrl() }}" alt="{{ Auth::user()->name }}的头像">
                        <span>修改头像</span>
                        <form action="{{ url('upload/avatar') }}" method="POST" class="hidden" enctype="multipart/form-data">
                            {!! csrf_field() !!}}
                            <input type="file" accept="image/*" id="avatar-uploader" name="image" required>
                        </form>
                    </div>
                    <div class="profile-essentials">
                        <h4>{{ Auth::user()->name }}</h4>
                        <h5>{{ Auth::user()->email }}</h5>
                    </div>
                    <span class="since">来Rebuy已经{{ Auth::user()->created_at->diffInDays() }}天了</span>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="row">
                    <h3>修改个人资料</h3>
                </div>
                @include('manage.users.partials.form', [
                    'user' => Auth::user(),
                    'method' => 'PATCH',
                    'new'  => false,
                    'button' => '确定更新'
                ])
            </div>
        </div>
    </div>
@stop