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
        <input type="file" name="media[]" id="file-input" multiple accept="image/*,video/*">
        @if ($errors->first('media'))
            <div class="error">{{ $errors->first('media') }}</div>
        @endif
        <div id="preview-container"></div>
        @if(!empty($media) && $media->count())
            <h5 style="padding-top: 20px">Old media:</h5>
            <div class="row">
                @foreach ($media as $item)
                    <div class="col-md-6">
                        <div class="preview-item-edit">
                            @if ($item->type == 'image')
                                <img src="{{ asset('storage/' . $item->url) }}" alt="image">
                            @else
                                <video src="{{ asset('storage/' . $item->url) }}" controls alt="video"></video>
                            @endif
                            <button type="button" data-media-id="{{ $item->id }}" class="btn-delete-media">x</button>
                        </div>
                    </div>
                @endforeach
            </div>
            <input type="hidden" id="delete_media_ids" name="delete_media_ids" value="">
        @endif
    </div>
</div>
@section('js')
  @include('admins.news.script')
@stop
