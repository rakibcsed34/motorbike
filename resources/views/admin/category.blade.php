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
                    <form action="{{ url('add-category') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                            <label>Category Name</label>
                              <input type="text" class="form-control" name="category_name" placeholder="Category Name" onkeyup="checkExist(this)">
                          </div>
                          <div class="form-group">
                            <label for="status">Status</label>
                            <select name="is_active" class="form-control">
                                <option value="">Select One</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                                option
                              </select>
                          </div>
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                </div>
            </div>
        </div>

            {{-- show category list --}}
        <div class="col-md-8" style="margin-top: 50px;">
            <div class="card">
                <div class="card-header">Category</div>

                <div class="card-body">
                    <table class="table" id="datatable-paginate">
                        <thead>
                            <tr>
                                <th class="text-center">S/N</th>
                                <th class="text-center">Category Name</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            // $i = $categories->perPage() * ($categories->currentPage() - 1);
                            $i = 0;
                            @endphp
                            @if(isset($categories))
                            @foreach($categories as $key => $category)
                            @php
                                $i++;
                            @endphp
                            
                                <tr>
                                    {{-- <td class="text-center">{{ $i + 1 }}</td> --}}
                                    <td class="text-center">{{ $i }}</td>
                                    <td class="text-center">{{ $category->category_name }}</td>
                                    <td class="text-center"><a href="javascript:(0)" onclick="checkStatus('{{ $category->cat_id }}')" class="btn btn-{{ ($category->is_active == 1)?'success':'secondary' }}" id="rowStatus-{{ $category->cat_id }}"><i class="fas fa-check-circle"></i></a>
                                        <input type="hidden" name="status" value="{{ $category->is_active }}" id="stat-{{ $category->cat_id }}">
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ url('edit-category/'.$category->cat_id) }}" class="btn btn-primary row-{{ $category->cat_id }}"title="Edit"><i class="fas fa-edit"></i></a>
                                        <a href="javascript:void(0)" class="btn btn-danger" title="Delete" onclick="deleteCategory({{ $category->cat_id }})"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                @php
                                    // $i++;
                                @endphp
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    {{-- {{ $categories->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function deleteCategory(category_id){
        var con = confirm('Do you want to delete it?');
        if(con){
            $.ajax({
                url: '{{ url('/delete-category') }}',
                method: 'POST',
                data: {'category_id': category_id},
                success: function(response){
                    if(response == '1'){
                        $(".row-"+category_id).parent().parent().remove();
                    }else{
                        alert('Request falied!');;
                    }
                }
            });
        }
    }

    function checkStatus(cat_id) {
        var con = confirm('Do you want to change this status?')
        var is_active = $("#stat-"+cat_id).val();        
        if(con){
            $.ajax({
                url:'{{ url('category-status') }}',
                method:'POST',
                data:{'is_active': is_active, 'cat_id': cat_id},
                success: function(response){
                    if(response == 1){
                        var status = (is_active == 1)?0:1;
                        if(is_active == 1){
                            $("#stat-"+cat_id).val(status);
                            $("#rowStatus-"+cat_id).removeClass('btn-success').addClass('btn-secondary');
                        }else {
                            $("#stat-"+cat_id).val(status);
                            $("#rowStatus-"+cat_id).removeClass('btn-secondary').addClass('btn-success');
                        }
                    }else{
                        alert('Request falied!!');
                    }
                    
                }
            });
        }
    }
</script>
@endsection
