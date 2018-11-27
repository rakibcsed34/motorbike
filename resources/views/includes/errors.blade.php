@if(count($errors))
<div class="form-group">
	<div class="alert alert-danger alert-dismissible" role="alert"> 
		<p> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
		<ul>
			@foreach($errors->all() as $error)
			<li class="text-danger">{{ $error }}</li>
			@endforeach
		</ul>
	</div>
</div>
@endif