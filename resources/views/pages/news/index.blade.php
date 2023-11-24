@extends('layouts.master')
@section('title')
    News
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('pages/css/news.css') }}">
    <link rel="stylesheet" href="{{ asset('pages/css/style.css') }}">
@stop
@section('content')
    <div class="news py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-3 pdy-20">
                    <h1 class="text-align-center font-weight-300">Forum post</h1>
                </div>
                <div class="col-md-9">
                    @if ($datas->count() < 1)
                        <h5 class="text-align-center pdt-20">No results found.</h5>
                    @else
                    @foreach ($datas as $news)
                    <div class="thumbnail-news">
                        <div class="row">
                            <div class="col-md-4 news-media">
                                <div id="mediaCarousel-{{ $news->id }}" class="carousel slide" data-ride="false" data-wrap="false">
                                    <div class="carousel-inner">
                                        @if ($news->media_info)
                                            @foreach (json_decode($news->media_info) as $key => $file)
                                                <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                                    @if ($file->type == 'image')
                                                        <img src="{{ asset('storage/' . $file->url) }}" class="d-block w-100" alt="image">
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
                                    @if(count(json_decode($news->media_info)) > 1)
                                        <a class="carousel-control-prev text-hidden">
                                            <span class="carousel-control-prev-icon" href="#mediaCarousel-{{ $news->id }}" role="button" data-slide="prev" aria-hidden="true">
                                            </span>
                                            <span class="sr-only visually-hidden">Previous</span>
                                        </a>
                                        <a class="carousel-control-next text-hidden">
                                            <span class="carousel-control-next-icon" href="#mediaCarousel-{{ $news->id }}" role="button" data-slide="next" aria-hidden="true"></span>
                                            <span class="sr-only visually-hidden">Next</span>
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h5 class="news-title">{{$news->title}}</h5>
                                    </div>
                                    <div class="col-md-2">
                                        <span style="display: flex; align-items: center;">
                                            <i class="fa-solid fa-user-pen" style="margin-right: 4px"></i>
                                            <span>{{$news->username}}</span>
                                        </span>
                                    </div>
                                    <div class="col-md-2">
                                        <span style="display: flex; align-items: center;">
                                            <i class="fa-regular fa-clock" style="margin-right: 4px"></i>
                                            <span>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $news->post_date)->format('d/m/Y')}}</span>
                                          </span>
        
                                    </div>
                                </div>
                                <p class="news-content">
                                    {{$news->content}}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="pdy-20">
                        {{ $datas->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    @include('pages.news.script')
    <script>
        $(document).ready(function(){
            $('#mediaCarousel').carousel();
        });
    </script>
@stop