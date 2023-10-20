@extends('admins.layouts.app')
@section('title')
    Manage animal cases
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
                                <h3 class="card-title"><a class="btn btn-info" href="{{ route('animal.cases') }}">Refresh <i
                                            class="fas fa-solid fa-rotate-right"></i></a></h3>
                                <div class="card-tools">
                                    <div class="input-group input-group-sm">
                                        <form method="GET" action="{{ route('animal.cases') }}" class="input-group">
                                            <input type="text" name="search" class="form-control" id="searchInput"
                                                placeholder="Enter name, type, breed" value="{{ request('search') }}">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                                <a class="btn btn-success" href="{{ route('create.animal-case') }}">
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
                                            <th class="align-middle">ID</th>
                                            <th class="align-middle">Image</th>
                                            <th class="align-middle">Name</th>
                                            <th class="align-middle">Description</th>
                                            <th class="align-middle">Breed</th>
                                            <th class="align-middle">Gender</th>
                                            <th class="align-middle">Age</th>
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
                                            @foreach ($datas as $key => $animal)
                                                <tr>
                                                    <td class="align-middle">{{ $key + 1 }}</td>
                                                    <td class="align-middle"><img class="image-table"
                                                            src="{{ asset('storage/' . $animal->image) }}" alt="image">
                                                    </td>
                                                    <td class="column align-middle">{{ $animal->name }}</td>
                                                    <td class="column-text break-word align-middle">
                                                        {{ $animal->description }}</td>
                                                    <td class="align-middle">{{ $animal->breed }}</td>
                                                    <td class="align-middle">{{ $animal->gender }}</td>
                                                    <td class="align-middle">{{ $animal->age }}</td>
                                                    <td class="align-middle">
                                                        <form id="myForm">
                                                            <select id="selectStatus" name="status"
                                                                data-animal-id="{{ $animal->id }}"
                                                                class="form-control search-slt font-weight-300">
                                                                @foreach ($status as $value)
                                                                    <option value="{{ $value }}"
                                                                        @if (old('status', $animal->status) == $value) selected @endif>
                                                                        {{ $value }}</option>
                                                                @endforeach
                                                            </select>
                                                        </form>
                                                    </td>
                                                    <td class="align-middle">
                                                        <div data-toggle="modal" data-target="#showModal" id="showButton"
                                                            class="btn btn-info" data-id="{{ $animal->id }}">
                                                            <i class="fas fa-solid fa-eye"></i>
                                                        </div>
                                                        <a href="{{ route('edit.animal-case', $animal->id) }}"
                                                            class="btn btn-warning"> <i class="fa-solid fa-pen-nib"></i></a>
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
                    <h5 class="modal-title" id="showModalLabel">Show detail animal</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <section class="section about-section gray-bg" id="about">
                        <div class="container">
                            <p class="result-status btn btn-info" style="margin: 0"></p>
                            <div class="row align-items-center flex-row-reverse" style="min-height: 200px">
                                <div class="col-lg-6">
                                    <div class="about-text go-to">
                                        <h3 class="dark-color">About Animal</h3>
                                        <h6 class="theme-color lead result-name"></h6>
                                        <p class="result-description"></p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="about-avatar">
                                        <img class="result-image" src="{{ asset('images/web/image-preview.png') }}"
                                            title="" alt="image" style="max-width: 100%">
                                    </div>
                                </div>
                            </div>
                            <div class="counter">
                                <div class="row">
                                    <div class="col-6 col-lg-3">
                                        <div class="count-data text-center">
                                            <h6 class="count h2">Breed</h6>
                                            <p class="m-0px font-w-600 result-breed"></p>
                                        </div>
                                    </div>
                                    <div class="col-6 col-lg-3">
                                        <div class="count-data text-center">
                                            <h6 class="count h2">Type</h6>
                                            <p class="m-0px font-w-600 result-type"></p>
                                        </div>
                                    </div>
                                    <div class="col-6 col-lg-3">
                                        <div class="count-data text-center">
                                            <h6 class="count h2">Gender</h6>
                                            <p class="m-0px font-w-600 result-gender"></p>
                                        </div>
                                    </div>
                                    <div class="col-6 col-lg-3">
                                        <div class="count-data text-center">
                                            <h6 class="count h2">Age</h6>
                                            <p class="m-0px font-w-600 result-age"></p>
                                        </div>
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
    @include('admins.animals.script')
@stop
