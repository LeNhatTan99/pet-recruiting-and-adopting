@extends('layouts.master')
@section('title')
    Donation Cases
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('pages/css/gallery.css') }}">
    <link rel="stylesheet" href="{{ asset('pages/css/style.css') }}">
@stop
@section('content')
    <div class="gallery py-3">
        <div class="container">
            <div class="pdy-20">
                <h1 class="text-align-center font-weight-300">Need donation cases</h1>
            </div>
            <div class="gallery-main">
                <div class="siderbar-filter pdy-20 pdr-20">
                    <form id="myForm" action="{{ route('donationCases') }}" method="GET">
                        @include('pages.adoptionCase.search')
                    </form>
                </div>
                <div class="row pdy-20 gallery-item">
                    <div class="col-md-12 col-lg-12 order-md-last">
                        @if ($datas->count() < 1)
                            <h5 class="text-align-center pdt-20">No results found.</h5>
                        @endif
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
                                                    {{$file->type, 123}}                                                  
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
                                                <h5 class="font-weight-300 animal-name"><strong> {{ $animal->name }}</strong></h5>
                                                <p class="animal-description">
                                                    {{ $animal->description }}
                                                </p>
                                            </div>
                                            <div class="text-align-center">
                                                <button class="btn-adoption" data-toggle="modal" data-target="#showModal">Donation</button>
                                            </div>
                                        </div>
                                        <span class="animal-status">
                                            Need donate
                                        </span>
                                        <span class="animal-gender">
                                            {{ $animal->gender }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showModalLabel">Donate to animal cases</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <section class="section about-section gray-bg" id="about">
                        <div class="container">
                            <form class="create-form1" action="{{route('user.donate')}}" method="post" >
                                @csrf
                                <div class="form-group">
                                    <label for="">Enter the amount</label>
                                    <input name="amount" type="number" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-info submit-form" style="margin: 12px 0">Donate</button>
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
