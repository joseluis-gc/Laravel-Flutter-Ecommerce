@extends('layout')
@section('dashboard-content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <p class="card-title">Products</p>
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <table id="example1" class="display expandable-table table-striped table-hover" style="width:100%">
                  <thead>
                    <tr>
                      <th>Product</th>
                      <th>Category</th>
                      <th>Price</th>
                      <th>Discount</th>
                      <th>Hot</th>
                      <th>New</th>
                      <th>Image</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($product as $item)
                        <tr>
                            <td>{{$item->name}}</td>

                            <td>{{$item->category->name}}</td>

                            <td>{{$item->price}}</td>

                            <td>{{$item->discount}}</td>

                            <td>{{$item->is_hot_product}}</td>

                            <td>{{$item->is_new_product}}</td>

                            <td><img class="img-fluid" src="{{$item->photo}}" width="150"></td>


                            <td>
                                <a class="btn btn-primary" href="{{URL::to('edit-product')}}/{{$item->id}}">Edit</a>

                                <a class="btn btn-danger" href="{{URL::to('delete-product')}}/{{$item->id}}" onclick="checkDelete()">Delete</a>
                            </td>
                        </tr>
                      @endforeach
                  </tbody>
              </table>
              </div>
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>

    <script>

        function checkDelete(){
            var check = confirm('Are you sure you want to delete this category?');
            if(check){
                return true;
            }
            else{
                return false;
            }
        }

    </script>



@endsection
