<form action="{{ url()->current() }}" method="POST" class="Form">
    {!! csrf_field() !!}
    {!! isset($method) ? method_field($method) : '' !!}
    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
        <label for="title" class="control-label" required>文章标题</label>
        <input type="text" class="form-control important" id="title" name="title"
               value="{{ old('title') ?: $post->title }}">
    </div>
    <div class="form-group">
        <label class="control-label">文章类型</label>
        <div class="input-group">
            <label class="radio-inline">
                <input type="radio" name="type" value="0"{{ $post->type !== 0 ? '' : ' checked' }}>
                文章
            </label>
            <label class="radio-inline">
                <input type="radio" name="type" value="1"{{ $post->type === 1 ? ' checked' : '' }}>
                视频
            </label>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label">是否置顶</label>
        <div class="input-group">
            <label class="radio-inline">
                <input type="radio" name="sticky" value="1"{{ $post->sticky === 1 ? ' checked' : '' }}>
                是
            </label>
            <label class="radio-inline">
                <input type="radio" name="sticky" value="0"{{ $post->sticky === 0 ? ' checked' : '' }}>
                否
            </label>
        </div>
    </div>
    <div class="form-group">
        <label for="video_src" class="control-label">视频链接（当文章类型为视频时填写）</label>
        <input type="url" class="form-control" value="{{ old('video_src') ?: $post->video_src }}" id="video_src" name="video_src">
    </div>
    <div class="form-group">
        <div editor></div>
    </div>
    <div class="form-group">
        <button class="confirm-button" type="submit">{{ $button }}</button>
        <button class="confirm-button delete" type="reset" redirect="{{ url('manage/posts') }}">删除</button>
    </div>
</form>