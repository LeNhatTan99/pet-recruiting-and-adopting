@extends('admins.layouts.app')
@section('title')
Manage news
@stop
@section('content')
<div class="content-wrapper" >
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <!-- <h1>Simple Tables</h1> -->
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="#">List news</a></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- /.row -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><a class="btn btn-info" href="{{route('admin.news')}}">Refresh <i class="fas fa-solid fa-rotate-right"></i></a></h3>
              <div class="card-tools">
                <div class="input-group input-group-sm">
                  <form method="GET" action="{{route('admin.news')}}" class="input-group">
                    <input type="text" name="search" class="form-control" id="searchInput" placeholder="Enter title for search" value="{{ request('search') }}">
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                      <a class="btn btn-success" href="{{route('create.news')}}">
                        <i class="fa-solid fa-file-circle-plus"></i> Add
                      </a>
                    </div>
                  </form>
                </div>

              </div>
            </div>
            <!-- /.card-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-striped ">
                <thead>
                  <tr>
                    <th class="align-middle">STT</th>
                    <th class="align-middle">Author</th>
                    <th class="align-middle">Title</th>
                    <th class="align-middle">Content</th>
                    <th class="align-middle">Post date</th>
                    <th class="align-middle">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @if($datas -> isEmpty())
                  <tr>
                    <td colspan="8" style="text-align: center;">No data</td>
                  </tr>
                  @else
                  @foreach ($datas as $key => $news)
                  <tr class="item-row">
                    <td class="align-middle">{{$key + 1}}</td>
                    <td class="align-middle">{{$news->first_name . ' ' . $news->last_name}}</td>
                    <td class="align-middle">{{$news->title}}</td>
                    <td class="align-middle column-text">{{$news->content}}</td>
                    <td class="align-middle">{{$news->post_date }}</td>
                    <td class="align-middle">
                      <a href="{{route('edit.news', $news->id)}}" class="btn btn-warning"> <i class="fa-solid fa-pen-nib"></i></a>
                      <a data-id="{{$news->id}}" href="{{route('delete.news', $news->id)}}" class="btn btn-danger delete-button">
                        <i class="fa-solid fa-trash-can"></i>
                      </a>
                  </td>
                  </tr>
                  @endforeach
                  @endif
                </tbody>
              </table>
              {{$datas->links()}}
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>

@endsection

@section('js')
  @include('common.popupDelete')
@stop
