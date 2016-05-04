@extends('layouts.app')

@section('title', '修改密码')

@section('content')
    <div class="container">
        <div class="row">
            <div class="Reset Auth">
                <div class="form-title">
                    <span>修改密码</span>
                </div>
                <form action="{{ url('password/reset') }}" method="POST" class="Reset__form">
                    {!! csrf_field() !!}
                    <span class="input input--rebuy{{ $errors->has('email') ? ' input--error' : '' }}">
                        <input class="input__field input__field--rebuy" type="email" id="email" name="email" value="{{ $email or old('email') }}" required/>
                        <label class="input__label input__label--rebuy" for="email">
                            <span class="input__label-content input__label-content--rebuy">邮箱</span>
                        </label>
                    </span>
                    <span class="input input--rebuy{{ $errors->has('password') ? ' input--error' : '' }}">
                        <input class="input__field input__field--rebuy" type="password" id="password" name="password"
                               required/>
                        <label class="input__label input__label--rebuy" for="password">
                            <span class="input__label-content input__label-content--rebuy">密码</span>
                        </label>
                    </span>
                    <span class="input input--rebuy">
                        <input class="input__field input__field--rebuy" type="password" id="password_confirmation"
                               name="password_confirmation" required/>
                        <label class="input__label input__label--rebuy" for="password_confirmation">
                            <span class="input__label-content input__label-content--rebuy">确认密码</span>
                        </label>
                    </span>
                    <button type="submit" class="btn confirm-button">确定修改</button>
                </form>
            </div>
        </div>
    </div>
@endsection
