<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="required">Username</label>
            <input type="text" name="username" class="form-control" placeholder="Enter username"
                value="{{ old('username', $data->username ?? '') }}">
            @if ($errors->first('username'))
                <div class="error">{{ $errors->first('username') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="" class="required">Firrt name</label>
            <input type="text" name="first_name" class="form-control" placeholder="Enter first name"
                value="{{ old('first_name', $data->first_name ?? '') }}">
            @if ($errors->first('first_name'))
                <div class="error">{{ $errors->first('first_name') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="" class="required">Address</label>
            <input type="text" name="address" class="form-control" placeholder="Enter address"
                value="{{ old('address', $data->address ?? '') }}">
            @if ($errors->first('address'))
                <div class="error">{{ $errors->first('address') }}</div>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="" class="required">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Enter email"
                value="{{ old('email', $data->email ?? '') }}">
            @if ($errors->first('email'))
                <div class="error">{{ $errors->first('email') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="" class="required">Last name</label>
            <input type="text" name="last_name" class="form-control" placeholder="Enter last name"
                value="{{ old('last_name', $data->last_name ?? '') }}">
            @if ($errors->first('last_name'))
                <div class="error">{{ $errors->first('last_name') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="" class="required">Phone number</label>
            <input type="text" name="phone_number" class="form-control" placeholder="Enter phone number"
                value="{{ old('phone_number', $data->phone_number ?? '') }}">
            @if ($errors->first('phone_number'))
                <div class="error">{{ $errors->first('phone_number') }}</div>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="" class="required">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Enter password">
            @if ($errors->first('password'))
                <div class="error">{{ $errors->first('password') }}</div>
            @endif
        </div>
    </div>
</div>
