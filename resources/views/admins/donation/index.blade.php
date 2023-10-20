@extends('admins.layouts.app')
@section('title')
Manage donation
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
            <li class="breadcrumb-item active"><a href="#">List donation</a></li>
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
              <h3 class="card-title"><a class="btn btn-info" href="{{route('admin.adoption-application')}}">Refresh <i class="fas fa-solid fa-rotate-right"></i></a></h3>
              <div class="card-tools">
                <div class="input-group input-group-sm">
                  <form method="GET" action="{{route('admin.adoption-application')}}" class="input-group">
                    <input type="text" name="search" class="form-control" id="searchInput" placeholder="Enter name for search" value="{{ request('search') }}">
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
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
                    <th class="align-middle">User</th>
                    <th class="align-middle">User phone number</th>
                    <th class="align-middle">User address</th>
                    <th class="align-middle">Amount</th>
                    <th class="align-middle">Donation date</th>
                  </tr>
                </thead>
                <tbody>
                  @if($datas -> isEmpty())
                  <tr>
                    <td colspan="8" style="text-align: center;">No data</td>
                  </tr>
                  @else
                  @foreach ($datas as $key => $value)
                  <tr class="item-row">
                    <td class="align-middle">{{$key + 1}}</td>
                    <td class="align-middle">{{$value->first_name . ' ' . $value->last_name}}</td>
                    <td class="align-middle">{{$value->phone_number}}</td>
                    <td class="align-middle">{{$value->address}}</td>
                    <td class="align-middle">{{number_format($value->amount)}} VND</td>
                    <td class="align-middle">{{$value->donation_date}}</td>
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
  @include('admins.adoptionApplication.script')
@stop
