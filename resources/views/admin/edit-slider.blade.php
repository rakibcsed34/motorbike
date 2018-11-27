@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Slider</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h2>Edit Slider</h2>
                    @include('includes.errors')
                    @include('includes.message')
                    <form action="{{ url('update-slider') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="slider_id" value="{{ $slider->slider_id }}">
                            <div class="form-group">
                                <label>Slider Title</label>
                                <input type="text" class="form-control" name="slider_title" value="{{ $slider->slider_title }}">
                           </div>
                           <div class="form-group">
                                <label>Slider Image</label>
                                <br />
                                <img src="{{ url('uploads/slider/'.$slider->slider_image) }}" width="150" height="120">

                                <input type="hidden" name="slider_image_old" value="{{ $slider->slider_image }}">
                                <input style="margin-top: 20px;" type="file" class="form-control" name="slider_image">
                           </div>
                          
                          <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection