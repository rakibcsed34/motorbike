@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Product</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h2>Edit Product</h2>
                    @include('includes.errors')
                    @include('includes.message')
                    <form action="{{ url('update-product') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                            <div class="form-group">
                                <label>Product Name</label>
                                <input type="text" class="form-control" name="product_name" value="{{ $product->product_name }}">
                            </div>
                            <div class="form-group">
                                <label>Category</label>
                              <select name="cat_id" class="form-control">
                                <option value="">Select One</option>
                                @if(isset($categories))
                                @foreach($categories as $category)
                                <option value="{{ $category->cat_id }}" {{ ($category->cat_id == $product->cat_id)?'selected':'' }}>{{ $category->category_name }}</option>
                                @endforeach
                                @endif
                              </select>
                            </div>
                    <div class="form-group">
                        <label for="model number">Model Number</label>
                        <input name="model_number" type="text" class="form-control"  value="{{ $product->model_number }}">
                    </div>
                    <div class="form-group">
                        <label for="engine">Engine</label>
                        <input name="engine" type="text" class="form-control"  value="{{ $product->engine }}">
                    </div>
                    <div class="form-group">
                        <label for="color">Color</label>
                        <input name="color" type="text" class="form-control"  value="{{ $product->color }}">
                    </div>
                    <div class="form-group">
                        <label for="weight">Weight</label>
                        <input name="weight" type="text" class="form-control" value="{{ $product->weight }}">
                    </div>
                    <div class="form-group">
                        <label for="top speed">Top Speed</label>
                        <input name="top_speed" type="text" class="form-control" value="{{ $product->top_speed }}">
                    </div>
                    <div class="form-group">
                        <label for="mileage">Mileage</label>
                        <input name="mileage" type="text" class="form-control" value="{{ $product->mileage }}">
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input name="price" type="text" class="form-control" value="{{ $product->price }}">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="descriptions" class="form-control" rows="4" id="descriptions-modal"></textarea>
                    </div>
                    <div class="form-group">
                            <label>Product Image</label>
                            <br/>
                            <img src="{{ url('uploads/product/'.$product->image) }}" width="150" height="120">

                            <input type="hidden" name="product_image_old" value="{{ $product->image }}">
                            <input style="margin-top: 20px;" type="file" class="form-control" name="image">
                             
                          </div>

                     <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection