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
                        <li class="breadcrumb-item active">Update</li>
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
                            <h3 class="card-title">Update</h3>
                        </div>
                        <form id="quickForm" method="post" action="{{route('users.update' , $user ->id)}}" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Name</label>
                                            <input type="name" name="name" value="{{old('name',$user->name)}}" class="form-control" placeholder="Enter name">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Date</label>
                                            <input type="date" name="date" value="{{old('date',$user->date)}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Phone</label>
                                            <input type="phone" name="phone" value="{{old('phone',$user->phone)}}" class="form-control" placeholder="Enter phone">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input type="email" name="email" value="{{old('email',$user->email)}}" class="form-control" placeholder="Enter email">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="khoa_select">Khoa</label>
                                            <select id="khoa_select" class="form-control select2" style="width: 100%;" name="khoa_id">
                                                <option value="" disabled selected>Chọn khoa</option>
                                                @foreach ($khoas as $khoa)
                                                <option value="{{ $khoa->id }}" {{ old('khoa_id', $user->khoa_id) == $khoa->id ? 'selected' : '' }}>
                                                    {{ $khoa->name }}
                                                </option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lop_select">Lớp</label>
                                            <select id="lop_select" class="form-control select2" style="width: 100%;" name="lop_id">
                                                @if(!is_null($user->lop_id))
                                                <option value="{{old('lop_id',$user->lop_id)}}">{{$user->lop->name}}</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{old('password',$user->password)}}" placeholder="Password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Avatar</label>
                                        <input type="file" onchange="readURL(this);" class="form-control @error('avatar') is-invalid @enderror" name="avatar" placeholder="Avatar">
                                        @if ($user->avatar)
                                        <img src="{{ asset('storage/img/' . $user->avatar) }}" alt="Avatar" class="mx-auto d-block" style="max-width: 360px; padding-top:20px">
                                        @else
                                        <img id="ImdID" src="{{ asset('img/no-img.jpg') }}" alt="Image" class="mx-auto d-block" style="max-width: 360px; padding-top:20px" />
                                        @endif
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