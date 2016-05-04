@extends('layouts.app')

@section('title', '登录')

@section('content')
    <div class="container">
        <div class="row">
            <div class="Login Auth">
                <div class="form-title">
                    <span>登录</span>
                </div>
                <form action="{{ url('login') }}" method="POST" class="Login__form">
                    {!! csrf_field() !!}
                    <span class="input input--rebuy{{ $errors->has('credential') ? ' input--error' : '' }}">
                        <input class="input__field input__field--rebuy" type="text" id="credential" name="credential" value="{{ old('credential') }}" required/>
                        <label class="input__label input__label--rebuy" for="credential">
                            <span class="input__label-content input__label-content--rebuy">邮箱/手机</span>
                        </label>
                    </span>
                    <span class="input input--rebuy{{ $errors->has('password') ? ' input--error' : '' }}">
                        <input class="input__field input__field--rebuy" type="password" id="password" name="password"
                               value="{{ old('password') }}" required/>
                        <label class="input__label input__label--rebuy" for="password">
                            <span class="input__label-content input__label-content--rebuy">密码</span>
                        </label>
                    </span>
                    <input type="hidden" name="remember" value="true">
                    <button type="submit" class="btn confirm-button">登录</button>
                </form>
                <div class="related">
                    没有帐号? <a href="{{ url('register') }}">注册</a>
                    <div class="pull-right">
                        <a href="{{ url('password/reset') }}">忘记密码?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
