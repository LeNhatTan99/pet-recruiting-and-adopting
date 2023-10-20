<div class="search pdb-20">
    <h5><i class="fas fa-search"></i> Search</h5>
    <div class="">
        <input id="textInput" name="name" type="text"
            class="form-control search-slt font-weight-300" placeholder="Enter name animal"
            value="{{ old('name', request()->input('name')) }}">
    </div>
</div>
<div class="search-filter">
    <h5><i class="fas fa-filter"></i> Search filters</h5>
    <h6>By type</h6>
    <div class="pb-2">
        <select id="selectInputType" name="type" class="form-control search-slt font-weight-300">
            <option value="">-- Select type --</option>
            @foreach ($types as $value)
                <option value="{{ $value }}"
                    @if (old('type', request()->input('type')) == $value) selected @endif>{{ $value }}</option>
            @endforeach
        </select>
    </div>

    <h6>By breed</h6>
    <div class="pb-2">
        <select id="selectInputBreed" name="breed"
            class="form-control search-slt font-weight-300">
            <option value="">-- Select breed --</option>
            @foreach ($breeds as $value)
                <option value="{{ $value }}"
                    @if (old('breed', request()->input('breed')) == $value) selected @endif>{{ $value }}</option>
            @endforeach
        </select>
    </div>
    <h6>By gender</h6>
    @foreach ($genders as $value => $label)
        <div class="form-check">
            <input id="checkboxInputGender" class="form-check-input" type="checkbox"
                name="genders[]" value="{{ $value }}"
                @if (is_array(old('genders', request()->input('genders'))) &&
                        in_array($value, old('genders', request()->input('genders')))) checked @endif>
            <label class="form-check-label">{{ $label }}</label>
        </div>
    @endforeach
    <h6>By age</h6>
    @foreach ($ages as $value => $label)
        <div class="form-check">
            <input id="checkboxInputAge" class="form-check-input" type="checkbox" name="ages[]"
                value="{{ $value }}" @if (is_array(old('ages', request()->input('ages'))) && in_array($value, old('ages', request()->input('ages')))) checked @endif>
            <label class="form-check-label">{{ $label }}</label>
        </div>
    @endforeach
</div>
