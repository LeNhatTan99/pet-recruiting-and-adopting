@extends('layouts.master')
@section('title')
    Adoption Cases
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('pages/css/gallery.css') }}">
    <link rel="stylesheet" href="{{ asset('pages/css/style.css') }}">
@stop
@section('content')
    <div class="gallery py-3">
        <div class="container">
            <div class="pdy-20">
                <h1 class="text-align-center font-weight-300">Adoption cases</h1>
            </div>
            <div class="gallery-main">
                <div class="siderbar-filter pdy-20 pdr-20">
                    <form id="myForm" action="{{ route('adoptionCases') }}" method="GET">
                        @include('pages.adoptionCase.search')
                    </form>
                </div>
                <div class="row pdy-20 gallery-item">
                    <div class="col-md-12 col-lg-12 order-md-last">
                        @if ($datas->count() < 1)
                            <h5 class="text-align-center pdt-20">No results found.</h5>
                        @else
                        <div class="row">
                            @foreach ($datas as $animal)
                                <div class="col-md-6 col-lg-3 ">
                                    <div class="animal">
                                        <div class="img-animal">
                                            <a>
                                                <img class="img-fluid" src="{{ asset('storage/'.$animal->image) }}" alt="Hình ảnh">
                                                <div class="overlay"></div>
                                            </a>
                                        </div>
                                        <div class="animal-info py-3 px-3">
                                            <div class="pb-3">
                                                <h5 class="animal-name font-weight-300"><strong> {{ $animal->name }}</strong></h5>
                                                <p class="animal-description">
                                                    {{ $animal->description }}
                                                </p>
                                            </div>
                                            <div class="text-align-center">
                                                {{-- <form method="post" action="{{route('user.adopt', $animal->id)}}">
                                                    @csrf
                                                    <a data-title="Are you sure you want to adopt it?"
                                                        data-text='Your request will be approved by the rescuer'
                                                        href="{{route('user.adopt', $animal->id)}}" 
                                                        class="btn btn-warning get-button">
                                                            Adoption
                                                      </a>
                                                </form> --}}
                                                <button class="btn-adoption" data-id=" {{ $animal->id }}" data-toggle="modal" data-target="#showModal">Adoption</button>
                                            </div>
                                        </div>
                                        <span class="animal-status">
                                            Can adopt
                                        </span>
                                        <span class="animal-gender">
                                            {{ $animal->gender }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{ $datas->links() }}
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document" style="margin: 6.75rem auto">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-align-center" id="showModalLabel">Are you sure you want to adopt it?</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <section class="section about-section gray-bg" id="about">
                    <div class="container">
                        <form class="create-form" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="" class="required">Enter the reason you want to adopt</label>
                                <input name="reason" type="text" class="form-control font-weight-300" placeholder="Enter the reason...">
                            </div>
                            <button type="button" class="btn btn-info btn-adopt" style="margin: 12px 0">Adopt</button>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
@stop
@section('js')
    @include('pages.adoptionCase.script')
@stop
