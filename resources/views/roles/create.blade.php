@extends('layouts.master')
@section('container')

	
	<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb" >
        <li class="breadcrumb-item">
          <a href="{{url('home')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Create Role Management</li>
      </ol>
  <div class="card card-login mx-auto mt-5 ">     
   <div class="card-header text-center"><h4 class="mt-2">Create Role Management</h4></div>
   
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif 
        <div class="card-body">
            {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
<div class="row">
    <div class="col-xs-10 col-sm-10 col-md-10">
        <div class="form-group">
            <strong>Role Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
	
	<?php //dd($permission);?>
     <div class="col-xs-10 col-sm-10 col-md-12">
    <div class="form-group">
            <div class="text-success mb-2">Choose Permission:</div>
            <div class="row">
            <?php foreach($permission as $value){ 
			?>
                <div class="col-3"><label style="font-size:16px;font-weight:400;display:inline-block;">{{ Form::checkbox ('permission[]', $value->id, false, array('class' => 'name')) }} 
                {{ $value->name }}</label>
                </div>
            <br />
            <?php } ?>
        </div>  
      </div>
  </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
         <button type="submit" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i>&nbsp; Submit</button>
        <a class="btn btn-secondary" href="{{ route('roles.index') }}"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; Cancel</a>
    </div>
</div>
{!! Form::close() !!} 
        </div>
    </div>
</div>  
</div>
<!-- <script src="{{ asset('js/app.js') }}"></script> -->
 <script type="text/javascript">
 $(document).ready(function () {
      $(".nav-link").removeClass('active');
      $("#liRole").addClass('active');
    });
</script>
@endsection