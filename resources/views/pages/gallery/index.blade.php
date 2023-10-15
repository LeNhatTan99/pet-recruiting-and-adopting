@extends('layouts.master')
@section('title')
    Gallery
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('pages/css/gallery.css') }}">
    <link rel="stylesheet" href="{{ asset('pages/css/style.css') }}">
@stop
@section('content')
<div class="gallery py-5">
    <div class="container">
        <div class="pdy-20">
            <h1 class="text-align-center font-weight-300">Animal Cases</h1>
        </div>
        <div class="gallery-main">
            <div class="siderbar-filter pdy-20">
                <form id="myForm" action="{{route('gallery')}}" method="GET">
                <div class="search pdb-20">
                    <h5><i class="fas fa-search"></i> Search</h5> 
                    <div class="">
                        <input id="textInput" name="name" type="text" class="form-control search-slt font-weight-300" placeholder="Enter name animal"
                        value="{{ old('name', request()->input('name'))}}">
                    </div>
                </div>
                <div class="search-filter">
                    <h5><i class="fas fa-filter"></i> Search filters</h5>                  
                    <h6>By type</h6>
                    <div class="pb-2">
                        <select id="selectInput" name="type" class="form-control search-slt font-weight-300">
                            <option value="">-- Select type --</option>
                            @foreach ($types as $value)
                                <option value="{{ $value->name }}"
                                @if(old('type', request()->input('type')) == $value->name) selected @endif>{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <h6>By breed</h6>
                    <div class="pb-2">
                        <select id="selectInput" name="breed" class="form-control search-slt font-weight-300">
                            <option value="">-- Select breed --</option>
                            @foreach ($breeds as $value)
                                <option value="{{ $value->name }}"
                                @if(old('breed', request()->input('breed')) == $value->name) selected @endif>{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <h6>By gender</h6>
                    @foreach ($genders as $value => $label)
                        <div class="form-check">
                            <input id="checkboxInput" class="form-check-input" type="checkbox" name="genders[]" value="{{ $value }}"
                                @if(is_array(old('genders', request()->input('genders'))) && in_array($value, old('genders', request()->input('genders')))) checked @endif>
                            <label class="form-check-label">{{ $label }}</label>
                        </div>
                    @endforeach
                    <h6>By age</h6>
                    @foreach ($ages as $value => $label)
                        <div class="form-check">
                            <input id="checkboxInputAge" class="form-check-input" type="checkbox" name="ages[]" value="{{ $value }}"
                                @if(is_array(old('ages', request()->input('ages'))) && in_array($value, old('ages', request()->input('ages')))) checked @endif>
                            <label class="form-check-label">{{ $label }}</label>
                        </div>
                    @endforeach
                </div>
                </form>
                <a href="{{route('gallery')}}" class="btn btn-primary wrn-btn my-4">Clear all</a>
            </div>
            <div class="row pdy-20 gallery-item">
                <div class="col-md-12 col-lg-12 order-md-last">
                    <div class="row">
                        @foreach ($datas as $animal)                   
                        <div class="col-md-6 col-lg-3 ">
                            <div class="animal">
                                <div  class="img-animal">
                                    <a href="#">
                                        <img class="img-fluid" src="{{asset($animal->image)}}" alt="Hình ảnh">
                                        <div class="overlay"></div>
                                    </a>
                                </div>
                                <div class="animal-info py-3 px-3">                       
                                    <div class="pb-3">                                 
                                        <span class="animal-status">
                                            {{$animal->status}}
                                        </span>
                                        <span class="animal-gender">
                                            {{$animal->gender}}
                                        </span>
                                        <h5 class="font-weight-300"><strong> {{$animal->name}}</strong></h5>
                                        <p class="animal-description">
                                            {{$animal->description}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
    
                    </div>
                </div>
    
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#textInput, #selectInput, #checkboxInputAge, #checkboxInput').on('change', function() {
                    $('#myForm').submit();
        });

    });
</script>

@stop
@section('js')
  
@stop
