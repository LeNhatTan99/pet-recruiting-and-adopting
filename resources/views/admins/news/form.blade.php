<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="required">Title</label>
            <input type="text" name="title" class="form-control" placeholder="Enter title"
                value="{{ old('title', $data->title ?? '') }}">
            @if ($errors->first('title'))
                <div class="error">{{ $errors->first('title') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="" class="required">Content</label>
            <textarea name="content"  class="form-control" placeholder="Enter content" cols="30" rows="10">{{ old('content', $data->content ?? '') }}</textarea>
            @if ($errors->first('content'))
                <div class="error">{{ $errors->first('content') }}</div>
            @endif
        </div>
    </div>
</div>
