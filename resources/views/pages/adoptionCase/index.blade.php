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
                                                <a href="{{route('showAnimalCase', $animal->id)}}">
                                                    @if ($animal->media_info && count(json_decode($animal->media_info)) > 0)
                                                        @php
                                                            $file = json_decode($animal->media_info)[0];
                                                        @endphp                                                  
                                                        @if ($file->type == 'image')
                                                            <img src="{{ asset('storage/' . $file->url) }}" class="img-fluid" alt="image">
                                                        @elseif($file->type == 'video')
                                                            <video class="img-fluid" controls>
                                                                <source src="{{ asset('storage/' . $file->url) }}" type="video/mp4">
                                                                Your browser does not support the video tag.
                                                            </video>
                                                        @endif
                                                    @endif
                                                    <div class="overlay"></div>
                                                </a>
                                            </div>
                                            <div class="animal-info py-3 px-3">
                                                <div class="pb-3">
                                                    <h5 class="animal-name font-weight-300"><strong>
                                                            {{ $animal->name }}</strong></h5>
                                                    <p class="animal-description">
                                                        {{ $animal->description }}
                                                    </p>
                                                </div>             
                                                <div class="text-align-center">
                                                    <button class="btn-adoption btn-set-adopt" data-id=" {{ $animal->id }}"
                                                        data-toggle="modal"
                                                        data-target="#showModal">Adoption</button>
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
                            <form class="create-form" method="post" enctype="multipart/form-data">
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
                                            <input id="inputFrontIDCard" accept="image/*" type="file" onchange="readURL(this, 'front');" class="form-control @error('front_side_ID_card') is-invalid @enderror" name="front_side_ID_card" style="display: none">
                                            <label for="inputFrontIDCard">
                                                <img id="frontIDPreview" class="imgID mx-auto d-block" src="{{asset('images/web/add-image.png') }}" alt="Image"/>
                                                <div class="overlay">
                                                    <span class="icon" onclick="document.getElementById('inputFrontIDCard').click();">
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
                                            <input id="inputBackIDCard" accept="image/*" type="file" onchange="readURL(this, 'back');" class="form-control @error('back_side_ID_card') is-invalid @enderror" name="back_side_ID_card" style="display: none">
                                            <label for="inputBackIDCard">
                                                <img id="backIDPreview" class="imgID mx-auto d-block" src="{{asset('images/web/add-image.png') }}" alt="Image"/>
                                                <div class="overlay">
                                                    <span class="icon" onclick="document.getElementById('inputBackIDCard').click();">
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
                                <button type="button" class="btn btn-info btn-adopt submit-form" style="margin: 12px 0">Adopt</button>
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
