@extends('admin.layouts.app')
@section('title')
Manager animal cases
@stop
@section('content')
<div class="content-wrapper" style="min-height: 1113.69px;">
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
            <li class="breadcrumb-item active"><a href="#">List animal case</a></li>
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
              <h3 class="card-title"><a href="{{route('animal.cases')}}">Refresh <i class="fas fa-solid fa-rotate-right"></i></a></h3>
              <div class="card-tools">
                <div class="input-group input-group-sm">
                  <form method="GET" action="" class="input-group">
                    <input type="text" name="search" class="form-control" id="searchInput" placeholder="Search" value="{{ request('search') }}">
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                      <a class="btn btn-default" href="">
                        <i class="fas fa-solid fa-user-plus"></i>
                      </a>
                    </div>
                  </form>
                </div>

              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Breed</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @if($datas -> isEmpty())
                  <tr>
                    <td colspan="8" style="text-align: center;">Không Có Kết Quả Phù Hợp</td>
                  </tr>
                  @else
                  @foreach ($datas as $key => $animal)
                  <tr>
                    <td>{{$key + 1}}</td>
                    <td><img class="image-table" src="{{asset($animal->image)}}" alt="image"></td>
                    <td class="collumn">{{$animal->name}}</td>
                    <td class="collumn-text">{{$animal->description}}</td>
                    <td>{{$animal->breed}}</td>
                    <td>{{$animal->gender }}</td>
                    <td>{{$animal->age }}</td>
                    <td>{{$animal->status }}</td>
                  
                    <td>
                      <a href=""><i class="fas fa-solid fa-eye"></i></a>
                      <form action="" method="POST" style="display: inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit"> <i class="fas fa-solid fa-trash"></i></button>
                      </form>
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