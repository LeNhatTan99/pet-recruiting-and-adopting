@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper" style="min-height: 1113.69px;">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route ('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{route ('users.index')}}">Sinh Viên</a></li>
                        <li class="breadcrumb-item active">Thêm Mới</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Thêm Sinh Viên Mới</h3>
                        </div>
                        <form id="quickForm" method="post" action="{{route('users.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Name</label>
                                            <input type="text" name="name"  class="form-control @error('name') is-invalid @enderror" placeholder="Enter name">
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Date</label>
                                            <input type="date" name="date" class="form-control @error('date') is-invalid @enderror">
                                            @error('date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Phone</label>
                                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Enter phone">
                                            @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter email">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="khoa_select">Khoa</label>
                                            <select id="khoa_select" class="form-control select2" style="width: 100%;" name="khoa_id">
                                                <option value="" disabled selected>Chọn khoa</option>
                                                @foreach ($khoas as $khoa)
                                                <option value="{{ $khoa->id }}" data-khoa-id="{{ $khoa->id }}">{{ $khoa->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lop_select">Lớp</label>
                                            <select id="lop_select" class="form-control select2" style="width: 100%;" name="lop_id">
                                                <option value="" disabled selected>Chọn lớp</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Avatar</label>
                                        <input type="file" onchange="readURL(this);" class="form-control @error('avatar') is-invalid @enderror" name="avatar" placeholder="Avatar">
                                        <img id="ImdID" src="{{asset('img/no-img.jpg')}}" alt="Image" class="mx-auto d-block" style="max-width: 360px; padding-top:20px" />
                                        @error('avatar')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary mx-auto d-block ">Submit</button>
                                </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                </div>
            </div>
        </div>
    </section>
</div>
@include('admin.users.scripts')
@endsection