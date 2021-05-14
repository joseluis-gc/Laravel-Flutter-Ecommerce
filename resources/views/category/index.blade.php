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
                      <th>Category</th>
                      <th>Icon</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($category as $item)
                        <tr>
                            <td>{{$item->name}}</td>
                            <td><img class="img-fluid" src="{{$item->icon}}" width="150"></td>
                            <td>
                                <a class="btn btn-primary" href="{{URL::to('edit-category')}}/{{$item->id}}">Edit</a>

                                <a class="btn btn-danger" href="{{URL::to('delete-category')}}/{{$item->id}}">Delete</a>
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
@endsection
