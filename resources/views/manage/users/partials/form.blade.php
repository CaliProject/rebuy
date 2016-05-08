<form action="{{ url()->current() }}" method="POST" class="Form">
    {!! csrf_field() !!}
    {!! isset($method) ? method_field($method) : '' !!}
    <div class="form-group{{ $errors->has('name') ? ' has-error shaky' : '' }}">
        <label for="name" class="control-label" required>用户昵称</label>
        <input type="text" class="form-control" id="name" name="name"
               value="{{ old('name') ?: $user->name }}" required>
    </div>
    <div class="form-group{{ $errors->has('email') ? ' has-error shaky' : '' }}">
        <label class="control-label" for="email" required>邮箱地址</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') ?: $user->email }}" required>
    </div>
    <div class="form-group{{ $errors->has('tel') ? ' has-error shaky' : '' }}">
        <label class="control-label" for="tel" required>手机号码</label>
        <input type="tel" class="form-control" id="tel" name="tel" value="{{ old('tel') ?: $user->tel }}" required>
    </div>
    <hr>
    <div class="form-group{{ $errors->has('password') ? ' has-error shaky' : '' }}">
        <label class="control-label" for="password">{{ $new ? '新密码 (留空不修改)' : '密码' }}</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <div class="form-group">
        <label class="control-label" for="password_confirmation">{{ $new ? '确认新密码' : '确认密码' }}</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
    </div>
    @if(!request()->is('profile'))
    <hr>
    <div class="form-group{{ $errors->has('role') ? ' has-error shaky' : '' }}">
        <label class="control-label" for="role">角色权限</label>
        <div class="input-group">
            <label class="radio-inline">
                <input type="radio" name="role" value="member"{{ $user->isAdmin() ? '' : ' checked' }}>
                普通用户
            </label>
            <label class="radio-inline">
                <input type="radio" name="role" value="admin"{{ $user->isAdmin() ? ' checked' : '' }}>
                管理员
            </label>
        </div>
    </div>
    @endif
    <div class="form-group">
        <button class="confirm-button" type="submit">{{ $button }}</button>
        @if(!request()->is('profile'))
        <button class="confirm-button delete" type="reset" redirect="{{ url('manage/users') }}">删除</button>
        @endif
    </div>
</form>