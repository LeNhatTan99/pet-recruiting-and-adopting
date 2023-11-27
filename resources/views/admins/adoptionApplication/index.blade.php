@extends('admins.layouts.app')
@section('title')
    Manage adoption application
@stop
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <!-- <h1>Simple Tables</h1> -->
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="#">List adoption application</a></li>
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
                                <h3 class="card-title"><a class="btn btn-info"
                                        href="{{ route('admin.adoption-application') }}">Refresh <i
                                            class="fas fa-solid fa-rotate-right"></i></a></h3>
                                <div class="card-tools">
                                    <div class="input-group input-group-sm">
                                        <form method="GET" action="{{ route('admin.adoption-application') }}"
                                            class="input-group">
                                            <input type="text" name="search" class="form-control" id="searchInput"
                                                placeholder="Enter name for search" value="{{ request('search') }}">
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
                                            <th class="align-middle">Name animal</th>
                                            <th class="align-middle">Reason</th>
                                            <th class="align-middle">User</th>
                                            <th class="align-middle">Application date</th>
                                            <th class="align-middle">Status</th>
                                            <th class="align-middle">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($datas->isEmpty())
                                            <tr>
                                                <td colspan="8" style="text-align: center;">No data</td>
                                            </tr>
                                        @else
                                            @foreach ($datas as $key => $value)
                                                <tr class="item-row">
                                                    <td class="align-middle">{{ $key + 1 }}</td>
                                                    <td class="align-middle">{{ $value->animal_name }}</td>
                                                    <td class="column-text break-word align-middle">{{ $value->reason }}
                                                    </td>
                                                    <td class="align-middle">
                                                        {{ $value->first_name . ' ' . $value->last_name }}</td>
                                                    <td class="align-middle">{{ $value->application_date }}</td>
                                                    <td class="align-middle">
                                                        <form id="myForm">
                                                            <select id="selectStatus" name="status"
                                                                data-value-id="{{ $value->id }}"
                                                                class="form-control search-slt font-weight-300">
                                                                @foreach ($status as $valueStatus)
                                                                    <option value="{{ $valueStatus }}"
                                                                        @if (old('status', $value->status) == $valueStatus) selected @endif>
                                                                        {{ $valueStatus }}</option>
                                                                @endforeach
                                                            </select>
                                                        </form>
                                                    </td>
                                                    <td class="align-middle">
                                                        <div data-toggle="modal" data-target="#showModal" id="showButton"
                                                            class="btn btn-info" data-id="{{ $value->id }}">
                                                            <i class="fas fa-solid fa-eye"></i>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                {{ $datas->links() }}
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
    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showModalLabel">Show profile user adoption application</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <section class="section about-section gray-bg" id="about">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" value="" class="form-control result-username" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Full name</label>
                                        <input type="text" value="" class="form-control result-fullname" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone number</label>
                                        <input type="text" value="" class="form-control result-phone" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" value="" class="form-control result-email" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Front side of ID card</label>
                                        <div>
                                            <img class="front-id-card" src="" alt="Front id- card">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Back side of ID card</label>
                                        <div>
                                            <img class="back-id-card" src="" alt="Back id card">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" value="" class="form-control result-address" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Link social</label>
                                        <input type="text" value="" class="form-control result-link-social" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    @include('admins.adoptionApplication.script')
@stop
