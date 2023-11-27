@extends('layouts.master')
@section('title')
    Detail Animal Case
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('pages/css/gallery.css') }}">
    <link rel="stylesheet" href="{{ asset('pages/css/style.css') }}">
@stop
@section('content')
    <div class="gallery py-3">
        <div class="container">
            <div class="pdy-20">
                <h1 class="text-align-center font-weight-300">Show detail animal case</h1>
            </div>
            <div class="row py-5">
                <div class="col-md-8" style="height: 500px">
                    <div id="mediaCarousel-{{ $animal->id }}" class="carousel slide" data-ride="false" data-wrap="false">
                        <div class="carousel-inner">
                            @if ($animal->media_info)
                                @foreach (json_decode($animal->media_info) as $key => $file)
                                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                        @if ($file->type == 'image')
                                            <img src="{{ asset('storage/' . $file->url) }}" class="d-block w-100"
                                                alt="image">
                                        @elseif($file->type == 'video')
                                            <video class="d-block w-100" controls>
                                                <source src="{{ asset('storage/' . $file->url) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        @if (count(json_decode($animal->media_info)) > 1)
                            <a class="carousel-control-prev text-hidden">
                                <span class="carousel-control-prev-icon" href="#mediaCarousel-{{ $animal->id }}"
                                    role="button" data-slide="prev" aria-hidden="true">
                                </span>
                                <span class="sr-only visually-hidden">Previous</span>
                            </a>
                            <a class="carousel-control-next text-hidden">
                                <span class="carousel-control-next-icon" href="#mediaCarousel-{{ $animal->id }}"
                                    role="button" data-slide="next" aria-hidden="true"></span>
                                <span class="sr-only visually-hidden">Next</span>
                            </a>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <h4>{{ $animal->name }}</h4>
                    <p>Status: {{ $animal->status }}</p>
                    <p>Type: {{ $animal->type }}</p>
                    <p>Breed: {{ $animal->breed }}</p>
                    <p>Age: {{ $animal->age }}</p>
                    <p>Gender: {{ $animal->gender }}</p>
                    <p>{{ $animal->description }}</p>

                    @if ($animal->status == 'available')
                        <div class="text-align-center pdy-20">
                            <button class="btn btn-primary btn-set-adopt" data-id=" {{ $animal->id }}" data-toggle="modal"
                                data-target="#showModal">Adoption</button>
                        </div>
                    @elseif ($animal->status == 'need donate')
                        <div class="text-align-center pdy-20">
                            <button class="btn btn-primary" data-id=" {{ $animal->id }}" data-toggle="modal"
                                data-target="#showModalDonation">Donation</button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal adoption -->
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
                            <form class="create-form" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="" class="required">Enter the reason you want to adopt</label>
                                    <input name="reason" type="text" class="form-control font-weight-300"
                                        placeholder="Enter the reason...">
                                </div>
                                <div class="form-group pdy-20">
                                    <label class="required">Identity card</label>
                                    <div class="row">
                                        <div class="col-md-6 align-items-center">
                                            <input id="inputFrontIDCard" accept="image/*" type="file"
                                                onchange="readURL(this, 'front');"
                                                class="form-control @error('front_side_ID_card') is-invalid @enderror"
                                                name="front_side_ID_card" style="display: none">
                                            <label for="inputFrontIDCard">
                                                <img id="frontIDPreview" class="imgID mx-auto d-block"
                                                    src="{{ asset('images/web/add-image.png') }}" alt="Image" />
                                                <div class="overlay">
                                                    <span class="icon"
                                                        onclick="document.getElementById('inputFrontIDCard').click();">
                                                        <p class="text-align-center">
                                                            Image front side ID card
                                                        </p>
                                                    </span>
                                                </div>
                                            </label>
                                            @if ($errors->first('front_side_ID_card'))
                                                <div class="error">{{ $errors->first('front_side_ID_card') }}</div>
                                            @endif
                                        </div>
                                        <div class="col-md-6 align-items-center">
                                            <input id="inputBackIDCard" accept="image/*" type="file"
                                                onchange="readURL(this, 'back');"
                                                class="form-control @error('back_side_ID_card') is-invalid @enderror"
                                                name="back_side_ID_card" style="display: none">
                                            <label for="inputBackIDCard">
                                                <img id="backIDPreview" class="imgID mx-auto d-block"
                                                    src="{{ asset('images/web/add-image.png') }}" alt="Image" />
                                                <div class="overlay">
                                                    <span class="icon"
                                                        onclick="document.getElementById('inputBackIDCard').click();">
                                                        <p class="text-align-center">
                                                            Image back side ID card
                                                        </p>
                                                    </span>
                                                </div>
                                            </label>
                                            @if ($errors->first('back_side_ID_card'))
                                                <div class="error">{{ $errors->first('back_side_ID_card') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="required">Link Social</label>
                                    <input name="link_social" type="text" class="form-control font-weight-300"
                                        placeholder="Enter link social...">
                                </div>
                                <button type="button" class="btn btn-info btn-adopt submit-form"
                                    style="margin: 12px 0">Adopt</button>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal donation -->
    <div class="modal fade" id="showModalDonation" tabindex="-1" role="dialog"
        aria-labelledby="showModalDonationLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showModalDonationLabel">Donate to animal cases</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <section class="section about-section gray-bg" id="about">
                        <div class="container">
                            <form class="create-form1" action="{{ route('user.donate') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Enter the amount</label>
                                    <input name="amount" type="number" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-info submit-form"
                                    style="margin: 12px 0">Donate</button>
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
    @include('pages.donationCase.script')
@stop
