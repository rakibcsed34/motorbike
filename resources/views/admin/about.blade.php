@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">About</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h2>Add About</h2>
                    @include('includes.errors')
                    @include('includes.message')
                    <form action="{{ url('add-about') }}" method="POST" id="aboutFrm">
                            {{ csrf_field() }}
                            <div class="form-group">
                            <label>Descriptions</label>
                              <textarea name="descriptions" class="form-control" rows="4" id="descriptions"></textarea>
                              <span class="text-danger" id="descriptions_validate"></span>
                          </div>
                          <div class="form-group">
                            <label for="status">Status</label>
                            <select name="is_active" class="form-control" id="is_active">
                                <option value="">Select One</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                                option
                              </select>
                              <span class="text-danger" id="is_active_validate"></span>
                          </div>
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                </div>
            </div>
        </div>

            {{-- show abouts list --}}
        <div class="col-md-8" style="margin-top: 50px;">
            <div class="card">
                <div class="card-header">Abouts</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">S/N</th>
                                <th class="text-center">Descriptions</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($abouts))
                            @foreach($abouts as $key => $about)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td>{!! $about->descriptions !!}</td>
                                    <td class="text-center"><a href="javascript:(0)" onclick="checkStatus('{{ $about->id }}')" class="btn btn-{{ ($about->is_active == 1)?'success':'secondary' }}"  id="rowStatus-{{ $about->id }}"><i class="fas fa-check-circle"></i></a>
                                     <input type="hidden" name="status" value="{{ $about->is_active }}" id="stat-{{ $about->id }}">
                                     </td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" onclick="editAbout({{ $about->id }})" class="btn btn-primary row-{{ $about->id }}" title="Edit" ><i class="fas fa-edit"></i></a>
                                        <a href="javascript:void(0)" class="btn btn-danger" title="Delete" onclick="deleteabouts({{ $about->id }})"><i class="fas fa-trash"></i></a>
                                        {{-- data-toggle="modal" data-target="#exampleModal" --}}
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


{{-- modal --}}
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ url('update-about') }}" method="POST" id="aboutFrm">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="" id="aboutId">
            <div class="form-group">
            <label>Descriptions</label>
              <textarea name="descriptions" class="form-control" rows="4" id="descriptions-modal"></textarea>
              <span class="text-danger" id="descriptions_validate"></span>
          </div>
          <div class="form-group">
            <label for="status">Status</label>
            <select name="is_active" class="form-control" id="is_active-modal">
                <option value="">Select One</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
                option
              </select>
              <span class="text-danger" id="is_active_validate"></span>
          </div>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary" value="Save changes" />
        </form>
      </div>
      {{-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Save changes" />
      </div> --}}
    </div>
  </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {

        $("#aboutFrm").validate({
            rules: {
                descriptions: {
                    required: true
                },
                is_active: {
                    required: true
                }
            },
            errorPlacement: function (error, element) {
                var name = $(element).attr("name");
                error.appendTo($("#" + name + "_validate"));
            }
        });
    });

    CKEDITOR.replace( 'descriptions' );

    function editAbout(id) {
        $.ajax({
            url:'{{ url("edit-about") }}',
            method:'POST',
            data:{'id': id},
            success: function (response) {
                // console.log(response);
                var data = jQuery.parseJSON(response);
                // alert(data.result.id)
                if(data.result != null){
                    // document.getElementById('aboutId').value = data.result.id;
                    $("#aboutId").val(data.result.id)
                    $("#descriptions-modal").val(data.result.descriptions)
                    $('#is_active-modal').find('option[value="'+data.result.is_active+'"]').attr("selected",true);
                    $('#exampleModal').modal('show');                    
                }else{
                    alert('Sorry! No data found.')
                }
            }
        });
    }

    function deleteAbout(about_id){
        var con = confirm('Do you want to delete it?');
        if(con){
            $.ajax({
                url: '{{ url('/delete-about') }}',
                method: 'POST',
                data: {'about_id': about_id},
                success: function(response){
                    if(response == '1'){
                        $(".row-"+about_id).parent().parent().remove();
                    }else{
                        alert('Request falied!');;
                    }
                }
            });
        }
    }

    function checkStatus(about_id) {
        var con = confirm('Do you want to change this status?')
        var is_active = $("#stat-"+about_id).val();        
        if(con){

            if(is_active == 1){
                $.ajax({
                        url:'{{ url('about-status') }}',
                        method:'POST',
                        data:{'is_active': is_active, 'about_id': about_id},
                        success: function(response){
                            if(response == 1){
                                alert('Request completed successfully.')
                                var status = (is_active == 1)?0:1;
                                if(is_active == 1){
                                    $("#stat-"+about_id).val(status);
                                    $("#rowStatus-"+about_id).removeClass('btn-success').addClass('btn-secondary');
                                }else {
                                    $("#stat-"+about_id).val(status);
                                    $("#rowStatus-"+about_id).removeClass('btn-secondary').addClass('btn-success');
                                }
                            }else{
                                alert('Request falied!!');
                            }
                            
                        }
                    });
            }else {                
                $.ajax({
                    url:'{{ url('about-status-isactive') }}',
                    method:'POST',
                    data:'',
                    success: function(response){
                        console.log(response);
                        if(response > 0){
                            alert('Another status alreay activated. Please reset it first.');                        
                        }else{
                            $.ajax({
                                url:'{{ url('about-status') }}',
                                method:'POST',
                                data:{'is_active': is_active, 'about_id': about_id},
                                success: function(response){
                                    if(response == 1){
                                        alert('Request completed successfully.')
                                        var status = (is_active == 1)?0:1;
                                        if(is_active == 1){
                                            $("#stat-"+about_id).val(status);
                                            $("#rowStatus-"+about_id).removeClass('btn-success').addClass('btn-secondary');
                                        }else {
                                            $("#stat-"+about_id).val(status);
                                            $("#rowStatus-"+about_id).removeClass('btn-secondary').addClass('btn-success');
                                        }
                                    }else{
                                        alert('Request falied!!');
                                    }
                                    
                                }
                            });
                        }
                        
                    }
                });
            }
        }
    }
</script>
@endsection