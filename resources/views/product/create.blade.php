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
                <h4 class="card-title">New Product</h4>
                <p class="card-description">
                    Create a new product
                </p>
                <form action="{{URL::to('post-product-form')}}" method="POST" enctype="multipart/form-data">
                    @csrf


                    <div class="form-group">
                        <label>Product Name</label>
                        <input class="form-control form-control-sm" name="product_name" placeholder="Enter your products name">
                    </div>

                    <div class="form-group">
                        <label>Price</label>
                        <input class="form-control form-control-sm" type="number" name="product_price" placeholder="0.0">
                    </div>

                    <div class="form-group">
                        <label>Discount</label>
                        <input class="form-control form-control-sm" type="number" name="product_discount" placeholder="0.0">
                    </div>

                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control form-control-sm" name="product_category" required>
                            <option value="">Select</option>
                            @foreach ($category as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group">
                        <label class="form-check-label" name="ishot">Is Hot Product</label>
                        <br>
                        <input style="margin-left: 5px;" type="checkbox" class="form-check-input" id="">
                    </div>


                    <div class="form-group">
                        <label class="form-check-label" name="isnew">New Arrival</label>
                        <br>
                        <input style="margin-left: 5px;" type="checkbox" class="form-check-input" id="">
                    </div>



                    <div class="form-group">
                        <label>Product Image</label>
                        <input type="file" class="file-upload-default" name="product_photo" onchange="loadPhoto(event)">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Image to upload">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-primary" type="button">Select Image</button>
                          </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <img id="photo" class="img-thumbnail img-fluid mx-auto d-block">
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">Save Product</button>

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
