@extends('auth.app')
@section('title')
   Register
@stop
@section('content')
<div class="main">
    <div class="form " >
        <div class="tab-btn">
            <a href="{{route('login')}}" class="btn-login">Login</a>
            <a href="{{route('register')}}" class="btn-register active">Register</a>
        </div>
        <div class="form-register form-item">
            <form action="{{ route('post.register')}}" method="post"  id="form-register">
                @csrf
                <div class="border-form">
                    <div class="form-group">
                        <label for="" class="form-label">Username</label>
                        <input type="text" id="user-name" name="username" class="form-control"
                            value="{{ old('username') }}">
                        @if ($errors->first('username'))
                            <div class="error">{{ $errors->first('username') }}</div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" style="padding: 0">
                                <label for="" class="form-label">First Name</label>
                                <input type="text" name="first_name" class="form-control"
                                    value="{{ old('first_name') }}">
                                @if ($errors->first('first_name'))
                                    <div class="error">{{ $errors->first('first_name') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="form-label">Last Name</label>
                                <input type="text" name="last_name" class="form-control"
                                    value="{{ old('last_name') }}">
                                @if ($errors->first('last_name'))
                                    <div class="error">{{ $errors->first('last_name') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Email</label>
                        <input type="email" id="email" name="email"  class="form-control"
                            value="{{ old('email') }}">
                        @if ($errors->first('email'))
                            <div class="error">{{ $errors->first('email') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Phone Number</label>
                        <input type="text" name="phone_number"  class="form-control"
                            value="{{ old('phone_number') }}">
                        @if ($errors->first('phone_number'))
                            <div class="error">{{ $errors->first('phone_number') }}</div>
                        @endif
                    </div>   
                    <div class="form-group">
                        <label for="" class="form-label">Address</label>
                        <input type="address" name="address"  class="form-control"
                            value="{{ old('address') }}">
                        @if ($errors->first('address'))
                            <div class="error">{{ $errors->first('address') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Password</label>
                        <input type="password" id="password" name="password"  class="form-control" >
                        <button type="button" id="togglePassword" class="btn-toggle-password">Show Password</button>
                        @if ($errors->first('password'))
                            <div class="error">{{ $errors->first('password') }}</div>
                        @endif
                    </div> 
                    <button type="submit"  class="form-submit">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>
@include('auth.script')
@endsection
