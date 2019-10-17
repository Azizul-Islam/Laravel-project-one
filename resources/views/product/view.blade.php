@extends('layouts/app')
@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-8">
        <div class="card mb-5">
          <div class="card-header bg-success">
              Product list
          </div>
          <div class="card-body">
            @if(session('deletestatus'))
            <div class="alert alert-danger">
              {{session('deletestatus')}}
            </div>
            @endif
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>SL.NO</th>
                  <th>Category Name</th>
                  <th>Product Name</th>
                  <th>Product Description</th>
                  <th>Product Price</th>
                  <th>Product Quantity</th>
                  <th>Alert Quantity</th>
                  <th>Product Image</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @forelse($products as $product)
                <tr>
                  <td>{{$loop->index +1}}</td>
                  <td>{{$product->relationtocategory->category_name}}</td>
                  <td>{{$product->product_name}}</td>
                  <td>{{$product->product_description}}</td>
                  <td>{{$product->product_price}}</td>
                  <td>{{$product->product_quantity}}</td>
                  <td>{{$product->alert_quantity}}</td>
                  <td>
                    <img src="{{asset('uploads/product_photos')}}/{{$product->product_image}}" alt="not found" width="50">
                  </td>
                  <td>
                    <div class="btn-group" role="group">
                      <a href="{{url('delete/product')}}/{{$product->id}}" type="button" class="btn btn-sm btn-danger">Delete</a>
                      <a href="{{url('edit/product')}}/{{$product->id}}" type="button" class="btn btn-sm btn-info">Edit</a>
                    </div>
                  </td>
                </tr>
                @empty
                <tr>
                  <td  class="text-center text-danger" colspan="7">No data availabale</td>
                </tr>
                @endforelse
              </tbody>
            </table>
            {{$products->links()}}
          </div>
        </div>
        <div class="card">
          <div class="card-header bg-danger">
              Deleted list
          </div>
          <div class="card-body">
            @if(session('restorestatus'))
              <div class="alert alert-success">
                {{session('restorestatus')}}
              </div>
            @endif

            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>SL.NO</th>
                  <th>Product Name</th>
                  <th>Product Description</th>
                  <th>Product Price</th>
                  <th>Product Quantity</th>
                  <th>Alert Quantity</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @forelse($deleted_products as $deleted_product)
                <tr>
                  <td>{{$loop->index +1}}</td>
                  <td>{{$deleted_product->product_name}}</td>
                  <td>{{$deleted_product->product_description}}</td>
                  <td>{{$deleted_product->product_price}}</td>
                  <td>{{$deleted_product->product_quantity}}</td>
                  <td>{{$deleted_product->alert_quantity}}</td>

                  <td>
                    <div class="btn-group" role="group">
                      <a href="{{url('restore/product')}}/{{$deleted_product->id}}" type="button" class="btn btn-sm btn-success">Restore</a>
                      <a href="{{url('parmanent/delete/product')}}/{{$deleted_product->id}}" type="button" class="btn btn-sm btn-danger">Permanent Delete</a>
                    </div>
                  </td>
                </tr>
                @empty
                <tr>
                  <td  class="text-center text-danger" colspan="7">No data availabale</td>
                </tr>
                @endforelse
              </tbody>
            </table>
            <!-- {{$products->links()}} -->
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

            <form action="{{url('add/product/insert')}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label>Add Category</label>
                <select class="form-control" name="category_id">
                  <option value="">-Select one-</option>
                  @foreach($categories as $category)
                  <option value="{{$category->id}}">{{$category->category_name}}</option>
                  @endforeach

                </select>
              </div>
              <div class="form-group">
                <label>Product Name</label>
                <input type="text" class="form-control" placeholder="Enter your name" name="product_name" value="{{old('product_name')}}">
              </div>
              <div class="form-group">
                <label>Product Description</label>
                <textarea rows="3" class="form-control" placeholder="Enter your description" name="product_description">{{old('product_description')}}</textarea>
              </div>
              <div class="form-group">
                <label>Product Price</label>
                <input type="text" class="form-control" placeholder="Enter your product price" name="product_price" value="{{old('product_price')}}">
              </div>
              <div class="form-group">
                <label>Product Quantity</label>
                <input type="text" class="form-control" placeholder="Enter your product quantity" name="product_quantity" value="{{old('product_quantity')}}">
              </div>
              <div class="form-group">
                <label>Alert Quantity</label>
                <input type="text" class="form-control" placeholder="Enter your alert quantity" name="alert_quantity" value="{{old('alert_quantity')}}">
              </div>
              <div class="form-group">
                <label>Product Image</label>
                <input type="file" class="form-control" name="product_image">
              </div>
              <button type="submit" class="btn btn-info">Add Prduct</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
