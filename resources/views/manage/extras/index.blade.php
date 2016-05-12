@extends('layouts.admin')

@section('admin.title', '其他设置')

@section('admin.content')
    <div class="row">
        <div class="col-sm-12">
            <form action="{{ url()->current() }}" method="POST" class="Form">
                {!! csrf_field() !!}
                {!! method_field('PATCH') !!}
                <div class="form-group{{ $errors->has('terms_conditions') ? ' has-error' : '' }}">
                    <label class="control-label" for="terms_conditions">注册条款（支持HTML）</label>
                    <textarea class="form-control" id="terms_conditions" name="terms_conditions">{!! old('terms_conditions') ?: $conf->termsConditions() !!}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="confirm-button">确定更新</button>
                </div>
            </form>
        </div>
    </div>
@stop