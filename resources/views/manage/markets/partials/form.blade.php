<form action="{{ url()->current() }}" method="POST" class="Form editor">
    {!! csrf_field() !!}
    {!! isset($method) ? method_field($method) : '' !!}
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="control-label" required>商品名称</label>
        <input type="text" class="form-control important" id="name" name="name"
               value="{{ old('name') ?: $product->name }}" required>
    </div>
    <div class="form-group{{ $errors->has('inventory') ? ' has-error' : '' }}">
        <label class="control-label" for="inventory" required>库存</label>
        <input type="number" class="form-control" id="inventory" name="inventory" value="{{ old('inventory') ?: $product->inventory }}" required>
    </div>
    <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
        <label class="control-label" for="price" required>价格</label>
        <input type="number" class="form-control" id="price" name="price" value="{{ old('price') ?: $product->price }}" required>
    </div>
    <div class="form-group">
        <label class="control-label">商品介绍</label>
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
        <a href="#" id="add_meta"><i class="icon-plus"></i> 新增其他信息</a>
        <div class="metas">
            <div class="row">
                <div class="col-sm-2">
                    <label class="control-label">信息名字</label>
                </div>
                <div class="col-sm-10">
                    <label class="control-label">详细内容</label>
                </div>
            </div>
            @forelse($product->getMetaArray() as $i => $meta)
            <div class="row">
                @unless($i === 0)
                    <a href="#" class="del"><i class="icon-close"></i></a>
                @endunless
                <div class="col-sm-2">
                    <input type="text" class="form-control" name="meta_key[]" value="{{ $meta->key }}">
                </div>
                <div class="col-sm-10">
                    <input type="text" class="form-control col-sm-6" name="meta_val[]" value="{{ $meta->value }}">
                </div>
            </div>
            @empty
                <div class="row">
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="meta_key[]">
                    </div>
                    <div class="col-sm-10">
                        <input type="text" class="form-control col-sm-6" name="meta_val[]">
                    </div>
                </div>
            @endforelse
        </div>
    </div>
    <div class="form-group">
        <button class="confirm-button" type="submit">{{ $button }}</button>
        <button class="confirm-button delete" type="reset" redirect="{{ url('manage/markets') }}">删除</button>
    </div>
</form>