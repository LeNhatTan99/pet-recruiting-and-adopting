@extends('layouts.master')
@section('title')
    Profile
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('pages/user/css/profile.css') }}">
@stop
@section('content')
    <div class="page-content page-container" id="page-content">
        <div class="padding">
            <div class="row container d-flex justify-content-center">
                <div class="col-xl-6 col-md-12">
                    <div class="card user-card-full">
                        <div class="row m-l-0 m-r-0">
                            <div class="col-sm-6 bg-c-lite-green user-profile">
                                <div class="card-block text-center text-white">
                                    <div class="m-b-25">
                                        <img src="https://img.icons8.com/bubbles/100/000000/user.png" class="img-radius"
                                            alt="User-Profile-Image">
                                    </div>
                                    <h6 id="username" class="f-w-600" style="color: #000">{{ $data['username'] }}</h6>
                                    <div data-toggle="modal" data-target="#editModal" id="editButton" class="btn btn-edit">
                                        <i class="fa-solid fa-pen-to-square"></i></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card-block">
                                    <h6 class="m-b-20 p-b-5 b-b-default f-w-600">INFORMATION</h6>
                                    <div>
                                        <p class="m-b-10 f-w-600">Full name</p>
                                        <h6 id="fullname" class="text-muted f-w-400">
                                            {{ $data['first_name'] . ' ' . $data['last_name'] }}</h6>
                                    </div>
                                    <div>
                                        <p class="m-b-10 f-w-600">Email</p>
                                        <h6 id="email" class="text-muted f-w-400">{{ $data['email'] }}</h6>
                                    </div>

                                    <div>
                                        <p class="m-b-10 f-w-600">Phone number</p>
                                        <h6 id="phone-number" class="text-muted f-w-400">{{ $data['phone_number'] }}</h6>
                                    </div>
                                    <div>
                                        <p class="m-b-10 f-w-600">Address</p>
                                        <h6 id="address" class="text-muted f-w-400">{{ $data['address'] }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-edit">
                        <div class="form-group pb-2">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="required">Username</label>
                                </div>
                                <div class="col-md-8">
                                    <input name="username" class="form-control" type="text"
                                        value="{{ old('username', $data['username']) }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group pb-2">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="required">First name</label>
                                </div>
                                <div class="col-md-8">
                                    <input name="first_name" class="form-control" type="text"
                                        value="{{ old('first_name', $data['first_name']) }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group pb-2">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="required">Last name</label>
                                </div>
                                <div class="col-md-8">
                                    <input name="last_name" class="form-control" type="text"
                                        value="{{ old('last_name', $data['last_name']) }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group pb-2">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="required">Email</label>
                                </div>
                                <div class="col-md-8">
                                    <input name="email" class="form-control" type="email"
                                        value="{{ old('email', $data['email']) }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group pb-2">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="required">Phone number</label>
                                </div>
                                <div class="col-md-8">
                                    <input name="phone_number" class="form-control" type="text"
                                        value="{{ old('phone_number', $data['phone_number']) }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group pb-2">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="required">Address</label>
                                </div>
                                <div class="col-md-8">
                                    <input name="address" class="form-control" type="text"
                                        value="{{ old('address', $data['address']) }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group pb-2">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Password</label>
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control" type="password" name="password">
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="saveButton" type="button" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@stop
@section('js')
    @include('users.profile.script')
@stop
