@extends('admins.layouts.app')
@section('title')
Edit news
@stop
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route ('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route ('admin.news')}}">Manage news</a></li>
                        <li class="breadcrumb-item active"><a href="#">Edit news</a></li>
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
                            <h3 class="card-title">Edit news</h3>
                        </div>
                        <div class="card-body">
                            <form class="form-create" id="quickForm" method="POST" action="{{route('update.news',$data->id)}}" enctype="multipart/form-data">
                                @csrf
                                @include('admins.news.form')
                                <div>
                                    <button type="submit" class="btn btn-primary d-block submit-form " style="margin: 12px 0">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                </div>
            </div>
        </div>
    </section>
</div>
@endsection