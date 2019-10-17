@extends('layouts/app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-8">
        <div class="card mb-5">
          <div class="card-header bg-success">
              Product list
          </div>
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>SL.NO</th>
                  <th>Category Name</th>
                  <th>Menu Status</th>
                  <th>Created At</th>
                  <th>Option</th>
                </tr>
              </thead>
              <tbody>
                @foreach($categories as $category)
                <tr>
                  <td>{{$loop->index +1}}</td>
                  <td>{{$category->category_name}}</td>
                  <td>{{($category->menu_status == 1) ? "YES":"NO"}}</td>
                  <td>{{$category->created_at->format('d-M-Y h:i:s A')}}
                    <br>
                  {{$category->created_at->diffForHumans()}}
                  </td>
                  <td> <a class="btn btn-sm btn-info" href="{{url('change/category/view')}}/{{$category->id}}">Change</a> </td>
                </tr>

                @endforeach
              </tbody>
            </table>

          </div>
        </div>

      </div>
      <div class="col-4">
        <div class="card">
          <div class="card-header bg-success">
            Add Product Form
          </div>
          <div class="card-body">
            @if(session('status'))
            <div class="alert alert-success">
              {{session('status')}}
            </div>
            @endif
              @if($errors->all())
              <div class="alert alert-danger">
              @foreach($errors->all() as $error)
                  <li>{{$error}}</li>
              @endforeach
              </div>
              @endif

            <form action="{{url('add/category/insert')}}" method="post">
              @csrf
              <div class="form-group">
                <label>Category Name</label>
                <input type="text" class="form-control" placeholder="Enter Category name" name="category_name" value="{{old('category_name')}}">
              </div>
              <div class="form-group">
                <label>Use as menu</label>
                <input type="checkbox" name="menu_status" value="1">
              </div>

              <button type="submit" class="btn btn-info">Add Prduct</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
