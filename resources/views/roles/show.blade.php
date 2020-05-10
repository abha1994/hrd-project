@extends('layouts.master')
@section('container')
	<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb" >
        <li class="breadcrumb-item">
          <a href="{{url('home')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">View Role Management</li>
      </ol>
  <div class="card card-login mx-auto mt-5 ">     
   <div class="card-header text-center"><h4 class="mt-2">View Role Management</h4></div>
<div class="card-body">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="form-group">
            <h2 style="text-transform:capitalize;">{{ $role->name }}</h2>
            
        </div>
    </div>
    <div class="col-lg-12 margin-tb">
        <div class="form-group">
            <div class="mb-2">Assign Permissions of {{ $role->name }} :</div>
            @if(!empty($rolePermissions))
                @foreach($rolePermissions as $v)
                    <label class="img-thumbnail text-success p-3 mr-3 mb-3"><i class="fa fa-check" aria-hidden="true"></i> {{ $v->name }}</label>
                @endforeach
            @endif
        </div>
    </div>
	  <div class="col-xs-12 col-sm-12 col-md-12 text-center">
  <a class="btn btn-secondary" href="{{ route('roles.index') }}"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; Cancel</a>
 </div> </div>
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