@extends('layouts.app')

@section('title', '忘记密码')

<!-- Main Content -->
@section('content')
    <div class="container">
        <div class="row">
            <div class="Email Auth">
                <div class="form-title">
                    <span>忘记密码</span>
                </div>
                <form action="{{ url('password/email') }}" method="POST" class="Email__form">
                    {!! csrf_field() !!}
                    <span class="input input--rebuy{{ $errors->has('email') ? ' input--error' : '' }}">
                        <input class="input__field input__field--rebuy" type="email" id="email" name="email" required />
                        <label class="input__label input__label--rebuy" for="email">
                            <span class="input__label-content input__label-content--rebuy">邮箱</span>
                        </label>
                    </span>
                    <button type="submit" class="btn confirm-button">发送重置邮件</button>
                </form>
                <div class="related">
                    <a href="{{ url('login') }}">登录</a>
                    <div class="pull-right">
                        <a href="{{ url('register') }}">注册帐号</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
