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
        <label class="required">Image</label>
        <input id="inputImg" type="file" onchange="readURL(this);"
            class="form-control @error('image') is-invalid @enderror" name="image" style="display: none">
        <div> <label for="inputImg">
                <span class="btn btn-success">
                    <i class="fa-solid fa-image nav-icon"></i> Chọn hình ảnh
                </span>
            </label></div>
        <img id="ImdID"
            src="{{ isset($data) && $data->image ? asset('storage/' . $data->image) : asset('images/web/image-preview.png') }}"
            alt="Image" class="mx-auto d-block" style="max-width: 360px; max-height: 360px;padding-top:20px" />
        @if ($errors->first('image'))
            <div class="error">{{ $errors->first('image') }}</div>
        @endif
    </div>

</div>
