@extends('layout')
@section('dashboard-content')

@if (session('sucess'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('failed'))
    <div class="alert alert-danger">
        {{ session('failed') }}
    </div>
@endif

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Slider {{$slider->title}}</h4>
                <p class="card-description">
                    Edit a slider
                </p>
                <form action="{{URL::to('post-slider-edit-form')}}/{{$slider->id}}" method="POST" enctype="multipart/form-data">
                    @csrf


                    <div class="form-group">
                        <label>Slider Title</label>
                        <input class="form-control form-control-sm" value="{{$slider->title}}" name="slider_title">
                    </div>

                    <div class="form-group">
                        <label>Slider Message</label>
                        <input class="form-control form-control-sm" value="{{$slider->message}}" name="slider_message">
                    </div>

                    <div class="form-group">
                        <label>File upload</label>
                        <input type="file" class="file-upload-default" name="slider_image" onchange="loadPhoto(event)">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                          </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <img src="{{$slider->image_url}}" id="photo" class="img-thumbnail img-fluid mx-auto d-block">
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">Save Slider</button>

                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function loadPhoto(event){
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('photo');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

@endsection
