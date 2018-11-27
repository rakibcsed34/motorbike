@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Category</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h2>Add Category</h2>
                    @include('includes.errors')
                    @include('includes.message')
                    <form action="{{ url('update-category') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="cat_id" value="{{ $category->cat_id }}">
                            <div class="form-group">
                            <label>Category Name</label>
                              <input type="text" class="form-control" name="category_name" value="{{ $category->category_name }}">
                          </div>
                          <div class="form-group">
                            <label for="status">Status</label>
                            <select name="is_active" class="form-control">
                                <option value="">Select One</option>
                                <option value="1" {{ ($category->is_active == 1)?'selected':'' }}>Active</option>
                                <option value="0" {{ ($category->is_active == 0)?'selected':'' }}>Inactive</option>
                                option
                              </select>
                          </div>
                          <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection