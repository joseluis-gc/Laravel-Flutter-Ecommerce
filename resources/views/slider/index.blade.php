@extends('layout')
@section('dashboard-content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <p class="card-title">Categories</p>
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <table id="example" class="display expandable-table table-striped table-hover" style="width:100%">
                  <thead>
                    <tr>
                      <th>Slider</th>
                      <th>Text</th>
                      <th>Image</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($sliders as $item)
                        <tr>
                            <td>{{$item->title}}</td>
                            <td>{{$item->message}}</td>
                            <td><img class="img-fluid" src="{{$item->image_url}}" width="150"></td>
                            <td>
                                <a class="btn btn-primary" href="{{URL::to('edit-slider')}}/{{$item->id}}">Edit</a>

                                <a class="btn btn-danger" href="{{URL::to('delete-slider')}}/{{$item->id}}" onclick="checkDelete()">Delete</a>
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
