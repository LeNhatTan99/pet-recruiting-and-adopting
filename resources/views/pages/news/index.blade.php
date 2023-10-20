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
                <div class="col-md-4 pdy-20">
                    <h1 class="text-align-center font-weight-300">Forum post</h1>
                </div>
                <div class="col-md-8">
                    @if ($datas->count() < 1)
                        <h5 class="text-align-center pdt-20">No results found.</h5>
                    @else
                    @foreach ($datas as $news)
                    <div class="thumbnail-news">
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
                    @endforeach
                    <div class="pdy-20">
                        {{ $datas->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showModalLabel">Create post</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <section class="section model-news gray-bg" id="about">
                        <div class="container">
                            <form class="create-form" action="{{route('user.create.news')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Title post</label>
                                    <input name="title" type="text" class="form-control" value="{{old('title')}}" placeholder="Enter title post">
                                    @if ($errors->first('title'))
                                        <div class="error">{{ $errors->first('title') }}</div>
                                    @endif
                                </div>
                                <div class="form-group pdt-20">
                                    <label for="">Content post</label>
                                    <textarea name="content" class="form-control" placeholder="Enter content post"  cols="30" rows="5">{{old('content')}}</textarea>
                                    @if ($errors->first('content'))
                                        <div class="error">{{ $errors->first('content') }}</div>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-success submit-form" style="margin: 12px 0">Create</button>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    @include('pages.news.script')
@stop