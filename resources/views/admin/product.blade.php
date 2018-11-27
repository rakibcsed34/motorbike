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

                    <h2>Add Product</h2>
                    @include('includes.errors')
                    @include('includes.message')
                    <form action="{{ url('add-product') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Product Name</label>
                                <input type="text" class="form-control" name="product_name" placeholder="Product Name">
                            </div>
                                <div class="form-group">
                                    <label>Category</label>
                                  <select name="cat_id" class="form-control">
                                    <option value="">Select One</option>
                                    @if(isset($categories))
                                    @foreach($categories as $category)
                                    <option value="{{ $category->cat_id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                    @endif
                                  </select>
                                </div>
                    <div class="form-group">
                        <label for="model number">Model Number</label>
                        <input name="model_number" type="text" class="form-control" placeholder="Model Number">
                    </div>
                    <div class="form-group">
                        <label for="engine">Engine</label>
                        <input name="engine" type="text" class="form-control" placeholder="Engine">
                    </div>
                    <div class="form-group">
                        <label for="color">Color</label>
                        <input name="color" type="text" class="form-control" placeholder="Color">
                    </div>
                    <div class="form-group">
                        <label for="weight">Weight</label>
                        <input name="weight" type="text" class="form-control" placeholder="Weight">
                    </div>
                    <div class="form-group">
                        <label for="top speed">Top Speed</label>
                        <input name="top_speed" type="text" class="form-control" placeholder="Top Speed">
                    </div>
                    <div class="form-group">
                        <label for="mileage">Mileage</label>
                        <input name="mileage" type="text" class="form-control" placeholder="Mileage">
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input name="price" type="text" class="form-control" placeholder="Price">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="descriptions" class="form-control" rows="4" id="descriptions-modal"></textarea>
                    </div>
                    <div class="form-group">
                            <label>Product Image</label>
                              <input type="file" class="form-control" name="image">
                          </div>

                     <button type="submit" name="btnsave" class="btn btn-primary">Submit</button>
                        </form>
                </div>
            </div>
        </div>

            {{-- show product list --}}
        <div class="col-md-12" style="margin-top: 50px;">
            <div class="card">
                <div class="card-header">Product</div>

                <div class="card-body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">S/N</th>
                                <th class="text-center">Product Name</th>
                                <th class="text-center">Category</th>
                                <th class="text-center">Model Number</th>
                                <th class="text-center">Engine</th>
                                <th class="text-center">Color</th>
                                <th class="text-center">Weight</th>
                                <th class="text-center">Top Speed</th>
                                <th class="text-center">Mileage</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($products))
                            @foreach($products as $key => $product)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td class="text-center">{{ $product->product_name }}</td>
                                    <td class="text-center">{{ $product->cat_id }}</td>
                                    <td class="text-center">{{ $product->model_number }}</td>
                                    <td class="text-center">{{ $product->engine }}</td>
                                    <td class="text-center">{{ $product->color }}</td>
                                    <td class="text-center">{{ $product->weight }}</td>
                                    <td class="text-center">{{ $product->top_speed }}</td>
                                    <td class="text-center">{{ $product->mileage }}</td>
                                    <td class="text-center">{{ $product->price }}</td>
                                    <td class="text-center"><img src="{{ url('uploads/product/'.$product->image) }}" height="100" width="150"></td>
                                    
                                     <td class="text-center">
                                        <a href="{{ url('edit-product/'.$product->product_id) }}" class="btn btn-primary row-{{ $product->product_id }}"title="Edit"><i class="fas fa-edit"></i></a>
                                        <a href="javascript:void(0)" class="btn btn-danger" title="Delete" onclick="deleteProduct({{ $product->product_id }})"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection