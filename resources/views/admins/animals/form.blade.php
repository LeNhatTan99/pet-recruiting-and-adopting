<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="required">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter name"
                value="{{ old('name', $data->name ?? '') }}">
            @if ($errors->first('name'))
                <div class="error">{{ $errors->first('name') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="" class="required">Type</label>
            <select name="type" class="form-control search-slt ">
                <option value="">-- Select type --</option>
                @foreach ($types as $value)
                    <option value="{{ $value }}" @if (old('type', $data->type ?? '') == $value) selected @endif>
                        {{ $value }}</option>
                @endforeach
            </select>
            @if ($errors->first('type'))
                <div class="error">{{ $errors->first('type') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="" class="required">Gender</label>
            <select name="gender" class="form-control search-slt ">
                <option value="">-- Select gender --</option>
                @foreach ($genders as $value)
                    <option value="{{ $value }}" @if (old('gender', $data->gender ?? '') == $value) selected @endif>
                        {{ $value }}</option>
                @endforeach
            </select>
            @if ($errors->first('gender'))
                <div class="error">{{ $errors->first('gender') }}</div>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="" class="required">Age</label>
            <input type="text" name="age" class="form-control" placeholder="Enter age"
                value="{{ old('age', $data->age ?? '') }}">
            @if ($errors->first('age'))
                <div class="error">{{ $errors->first('age') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label class="required">Breed</label>
            <select name="breed" class="form-control search-slt ">
                <option value="">-- Select breed --</option>
                @foreach ($breeds as $value)
                    <option value="{{ $value }}" @if (old('breed', $data->breed ?? '') == $value) selected @endif>
                        {{ $value }}</option>
                @endforeach
            </select>
            @if ($errors->first('breed'))
                <div class="error">{{ $errors->first('breed') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label class="required">Status</label>
            <select name="status" class="form-control search-slt ">
                <option value="">-- Select status --</option>
                @foreach ($status as $value)
                    <option value="{{ $value }}" @if (old('status', $data->status ?? '') == $value) selected @endif>
                        {{ $value }}</option>
                @endforeach
            </select>
            @if ($errors->first('status'))
                <div class="error">{{ $errors->first('status') }}</div>
            @endif
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label class="required">Description</label>
            <textarea class="form-control" name="description" rows="4" cols="50" placeholder="Enter description">{{ old('description', $data->description ?? '') }}</textarea>
            @if ($errors->first('description'))
                <div class="error">{{ $errors->first('description') }}</div>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label class="required">Images/Videos</label>
        <input type="file" name="media[]" id="file-input" multiple accept="image/*,video/*" style="display: none">
        <div> <label for="file-input">
            <span class="btn btn-success">
                <i class="fa-solid fa-image nav-icon"></i> Choose Images/Videos
            </span>
        </label></div>
        @if ($errors->first('media'))
            <div class="error">{{ $errors->first('media') }}</div>
        @endif
        <div id="preview-container"></div>
        @if(!empty($media) && $media->count())
            <h5 style="padding-top: 20px">Old Images/Videos:</h5>
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
