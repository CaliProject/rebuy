@extends('layouts.admin')

@section('admin.title', '编辑《' . $post->title . '》')

@section('admin.content')
    <div class="row">
        <div class="col-sm-12">
            <form action="{{ url()->current() }}" method="POST" class="Form">
                {!! csrf_field() !!}
                {!! method_field('PATCH') !!}
                <div class="form-group">
                    <label for="title" class="control-label">文章标题</label>
                    <input type="text" class="form-control important" id="title" name="title" value="{{ old('title') ?: $post->title }}" required>
                </div>
                <div class="form-group">
                    <div editor></div>
                </div>
                <div class="form-group">
                    <button class="confirm-button" type="submit">确定更新</button>
                </div>
            </form>
        </div>
    </div>
@stop

@push('scripts.footer')
<script>
    $(function () {
        setTimeout(function () {
            $("[editor]").summernote("code", "{!! addslashes($post->body) !!}");
        }, 200);
    });
</script>
@endpush