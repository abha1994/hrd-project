@extends('layouts.master')
@section('container')
	<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb" >
        <li class="breadcrumb-item">
          <a href="{{url('home')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Update Role Management</li>
      </ol>
  <div class="card card-login mx-auto mt-5 ">     
   <div class="card-header text-center"><h4 class="mt-2">Update Role Management</h4></div>
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

{!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Role Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
    
  <div class="col-xs-10 col-sm-10 col-md-12">
    <div class="form-group">
            <div class="text-success mb-2">Choose Permission:</div>
            <div class="row">
            @foreach($permission as $value)
                <div class="col-4"><label style="font-size:16px;font-weight:400;display:inline-block;">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                {{ $value->name }}</label>
                </div>
            <br />
            @endforeach
        </div>  
      </div>
  </div>


    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
	
        <button type="submit" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i>&nbsp; Save</button>
        <a class="btn btn-secondary" href="{{ route('roles.index') }}"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; Cancel</a>
    </div>
</div>
{!! Form::close() !!}
    </div>
    </div>
</div> 
</div>
 <script type="text/javascript">
 $(document).ready(function () {
      $(".nav-link").removeClass('active');
      $("#liRole").addClass('active');
    });
</script>
<!-- <script src="{{ asset('js/app.js') }}"></script> 
 -->@endsection

 
 