@extends('layout')
@section('dashboard-content')

@if (session('success'))
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
                <h4 class="card-title">Edit Category <b class="text-primary">{{$category->name}}</b></h4>
                <p class="card-description">
                   Edit category data.
                </p>
                <form action="{{URL::to('update-category')}}/{{$category->id}}" method="POST" enctype="multipart/form-data">
                    @csrf


                    <div class="form-group">
                        <label>Category Name</label>
                        <input class="form-control form-control-sm" value="{{$category->name}}" name="category_name">
                    </div>

                    <div class="form-group">
                        <label>File upload</label>
                        <input type="file" class="file-upload-default" name="category_icon" onchange="loadPhoto(event)">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                          </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Current image</label>
                        <img id="photo" src="{{$category->icon}}" class="img-thumbnail img-fluid mx-auto d-block">
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">Save Category</button>

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
