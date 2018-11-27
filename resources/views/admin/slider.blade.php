@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Slider</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h2>Add Slider</h2>
                    @include('includes.errors')
                    @include('includes.message')
                    <form action="{{ url('add-slider') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                            <label>Slider Title</label>
                              <input type="text" class="form-control" name="slider_title" placeholder="slider title">
                          </div>
                            <div class="form-group">
                            <label>Slider Image</label>
                              <input type="file" class="form-control" name="slider_image">
                          </div>
                        
                        
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                </div>
            </div>
        </div>

            {{-- show slider list --}}
        <div class="col-md-8" style="margin-top: 50px;">
            <div class="card">
                <div class="card-header">Slider</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">S/N</th>
                                <th class="text-center">Slider Title</th>
                                <th class="text-center">Slider Image</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($sliders))
                            @foreach($sliders as $key => $slider)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td class="text-center">{{ $slider->slider_title }}</td>
                                    <td class="text-center"><img src="{{ url('uploads/slider/'.$slider->slider_image) }}" height="150" width="200"></td>
                                  
                                    <td class="text-center">
                                        <a href="{{ url('edit-slider/'.$slider->slider_id) }}" class="btn btn-primary row-{{ $slider->slider_id }}" title="Edit"><i class="fas fa-edit"></i></a>
                                        <a href="javascript:void(0)" class="btn btn-danger" title="Delete" onclick="deleteSlider({{ $slider->slider_id }})"><i class="fas fa-trash"></i></a>
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

<script type="text/javascript">
    function deleteSlider(slider_id){
        var con = confirm('Do you want to delete it?');
        if(con){
            $.ajax({
                url: '{{ url('/delete-slider') }}',
                method: 'POST',
                data: {'slider_id': slider_id},
                success: function(response){
                    if(response == '1'){
                        $(".row-"+slider_id).parent().parent().remove();
                    }else{
                        alert('Request falied!');;
                    }
                }
            });
        }
    }
</script>
@endsection