@extends('auth.app')
@section('title')
   Login
@stop
@section('content')
@php
    $currentRoute = \Request::route()->getName();
@endphp
<div class="main">
    <div class="form " >
        <div class="tab-btn">
            <a href="{{ $currentRoute === 'admin.login' ? route('admin.login') : route('login') }}" class="btn-login active">
                {{ $currentRoute === 'admin.login' ? 'Admin Login' : 'Login' }}
            </a>
            <a href="{{$currentRoute === 'admin.login' ? '#' : route('register')}}" class="btn-register">Register</a>
        </div>  
        <div class="form-login form-item" >
            <form {{ $currentRoute === 'admin.login' ? route('post.admin.login') : route('post.login')}} method="post" id="form-login">
                @csrf   
                <div class="border-form">
                    <div class="form-group">
                        <label for="" class="form-label">Username</label>
                        <input type="text" id="user-name" name="username" class="form-control" >
                        @if ($errors->first('username'))
                            <div class="error">{{ $errors->first('username') }}</div>
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
                    @if(session('message'))
                        <div class="error">{{ session('message') }}</div>
                    @endif
                    <button id="formSubmit" class="form-submit">Login In</button>
                </div>
            </form>
        </div>
    </div>
</div>
@include('auth.script')
@endsection
