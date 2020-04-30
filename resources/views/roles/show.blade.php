@extends('layouts.master')
@section('container')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Create Role</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{'/home'}}">Home</a></li>
              <li class="breadcrumb-item active">Role Management</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="container-fluid" id="app"> 
     <section class="content">
<div class="row">
  <div class="col-12">
    <div class="card ">
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
</div>
</div>
 
<a class="btn btn-secondary pull-right" href="{{ route('roles.index') }}">Back</a>
 </div>
</div>
</div>
</section>

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