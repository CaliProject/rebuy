<form action="{{ url()->current() }}" method="POST" class="Form editor">
    {!! csrf_field() !!}
    {!! isset($method) ? method_field($method) : '' !!}
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="control-label" required>商品名称</label>
        <input type="text" class="form-control important" id="name" name="name"
               value="{{ old('name') ?: $product->name }}">
    </div>
    <div class="form-group">
        <div editor></div>
    </div>
    <div class="form-group">
        <label for="tags" class="control-label">标签</label>
        <select name="tags[]" id="tags" class="form-control" multiple tags>
            @foreach($product->tags as $tag)
                <option value="{{ $tag->name }}" selected>{{ $tag->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group{{ $errors->has('cover_id') ? ' has-error' : '' }}">
        <label class="control-label" for="cover_id">封面ID</label>
        <input type="number" class="form-control" id="cover_id" name="cover_id" value="{{ old('cover_id') ?: $product->cover_id }}">
    </div>
    <div class="form-group">
        <button class="confirm-button" type="submit">{{ $button }}</button>
        <button class="confirm-button delete" type="reset" redirect="{{ url('manage/posts') }}">删除</button>
    </div>
</form>