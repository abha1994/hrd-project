@extends('layouts.master')
@section('container')

 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ url('dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Role Management
		 </li>
      </ol>
	 
      <!-- Example DataTables Card-->
      <div class="card mb-3">
	    <div class="card-header text-center"><h4 class="mt-2">Role Management</h4></div>
	       <div class="container-fluid border-top bg-white card-footer text-muted text-left" id="app">   

            @if ($message = Session::get('success'))
				<div class="alert alert-success">
					<p>{{ $message }}</p>
				</div>
			@endif
			
			<div class="pull-right" style="float: right;">
				@can('role-create')
				<a class="btn btn-success" href="{{ route('roles.create') }}"><i class="nav-icon fas fa-plus"></i> Role</a>
				@endcan
            </div>
			<br />
			
			<br />
           <div class="table-responsive card-box">
                <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th style="width:30%;">Name</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                              <?php //dd($roles); ?>  
                                <tbody> 
								<?php $i =1; ?>
								   @foreach ($roles as $key => $role)
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td>{{ $role->name }}</td>
                                        <td>
											<a class="btn btn-info" href="{{ route('roles.show',$role->id) }}" style="color: white">Show</a>

												@can('role-edit')
													<a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
												@endcan
												
												@can('role-delete')
													{!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
													{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
													{!! Form::close() !!}
												@endcan
										</td>
                                    </tr>
                              <?php     $i++;   ?>  @endforeach
                                
                                </tbody>
                            </table>
						</div>
        </div> 
    </div></div></div>
     <script type="text/javascript">

</script>
    <!--  <script src="{{ asset('js/app.js') }}"></script>  -->
@endsection