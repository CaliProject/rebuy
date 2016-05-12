@extends('layouts.app')

@section('title', '注册帐号')

@section('content')
<div class="container">
    <div class="row">
        <div class="Register Auth">
            <div class="form-title">
                <span>注册帐号</span>
            </div>
            <form action="{{ url('register') }}" method="POST" class="Register__form">
                {!! csrf_field() !!}
                <span class="input input--rebuy{{ $errors->has('name') ? ' input--error' : '' }}">
					<input class="input__field input__field--rebuy" type="text" id="name" name="name" value="{{ old('name') }}" required />
					<label class="input__label input__label--rebuy" for="name">
                        <span class="input__label-content input__label-content--rebuy">昵称</span>
                    </label>
				</span>
                <span class="input input--rebuy{{ $errors->has('email') ? ' input--error' : '' }}">
					<input class="input__field input__field--rebuy" type="email" id="email" name="email" value="{{ old('email') }}" required />
					<label class="input__label input__label--rebuy" for="email">
                        <span class="input__label-content input__label-content--rebuy">邮箱</span>
                    </label>
				</span>
                <span class="input input--rebuy{{ $errors->has('tel') ? ' input--error' : '' }}">
					<input class="input__field input__field--rebuy" type="tel" id="tel" name="tel" value="{{ old('tel') }}" required />
					<label class="input__label input__label--rebuy" for="tel">
                        <span class="input__label-content input__label-content--rebuy">手机</span>
                    </label>
				</span>
                <span class="input input--rebuy{{ $errors->has('password') ? ' input--error' : '' }}">
					<input class="input__field input__field--rebuy" type="password" id="password" name="password" required />
					<label class="input__label input__label--rebuy" for="password">
                        <span class="input__label-content input__label-content--rebuy">密码</span>
                    </label>
				</span>
                <span class="input input--rebuy">
					<input class="input__field input__field--rebuy" type="password" id="password_confirmation" name="password_confirmation" required />
					<label class="input__label input__label--rebuy" for="password_confirmation">
                        <span class="input__label-content input__label-content--rebuy">确认密码</span>
                    </label>
				</span>
                <div class="morph-button morph-button-modal morph-button-modal-terms morph-button-fixed">
                    <button type="button">Rebuy 用户注册条款</button>
                    <div class="morph-content">
                        <div>
                            <div class="content-style-text">
                                <span class="icon-close">关闭</span>
                                <h2>用户注册条款</h2>
                                <p>{!! Conf::termsConditions() !!}</p>
                                <p><input id="terms" name="terms" type="checkbox" required /><label for="terms">我已阅读 &amp; 接受该条款.</label></p>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn confirm-button">注册</button>
            </form>
            <div class="related">
                已有帐号, <a href="{{ url('login') }}">登录</a>
                <div class="pull-right">
                    <a href="{{ url('password/reset') }}">忘记密码?</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts.footer')
<script>
    (function() {
        var docElem = window.document.documentElement, didScroll, scrollPosition;

        // trick to prevent scrolling when opening/closing button
        function noScrollFn() {
            window.scrollTo( scrollPosition ? scrollPosition.x : 0, scrollPosition ? scrollPosition.y : 0 );
        }

        function noScroll() {
            window.removeEventListener( 'scroll', scrollHandler );
            window.addEventListener( 'scroll', noScrollFn );
        }

        function scrollFn() {
            window.addEventListener( 'scroll', scrollHandler );
        }

        function canScroll() {
            window.removeEventListener( 'scroll', noScrollFn );
            scrollFn();
        }

        function scrollHandler() {
            if( !didScroll ) {
                didScroll = true;
                setTimeout( function() { scrollPage(); }, 60 );
            }
        };

        function scrollPage() {
            scrollPosition = { x : window.pageXOffset || docElem.scrollLeft, y : window.pageYOffset || docElem.scrollTop };
            didScroll = false;
        };

        scrollFn();

        var UIBtnn = new UIMorphingButton( document.querySelector( '.morph-button' ), {
            closeEl : '.icon-close',
            onBeforeOpen : function() {
                // don't allow to scroll
                noScroll();
            },
            onAfterOpen : function() {
                // can scroll again
                canScroll();
            },
            onBeforeClose : function() {
                // don't allow to scroll
                noScroll();
            },
            onAfterClose : function() {
                // can scroll again
                canScroll();
            }
        } );

        document.getElementById( 'terms' ).addEventListener( 'change', function() {
            UIBtnn.toggle();
        } );
    })();
</script>
@endpush