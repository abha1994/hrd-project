@extends('layouts.master')
@section('container')
   
   
    <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ url('home')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">List Officer
		 </li>
      </ol>
	 
      <!-- Example DataTables Card-->
      <div class="card mb-3">
	    <div class="card-header text-center"><h4 class="mt-2">List Officer</h4></div>
	       <div class="container-fluid border-top bg-white card-footer text-muted text-left" id="app">        
		   
		   @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
         @endif
		
			<div class="pull-right" style="float: right;">
				  @can('officer-create')
					<a class="btn btn-success" href="{{ URL('user/create ') }}"><i class="nav-icon fas fa-plus"></i> Officer</a>
				@endcan
            </div><br><br>
	
           <div class="table-responsive card-box">
                <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                
                <thead>
                <tr>
				  <th id="sort">S. No.</th>
                  <th>Officer Name</th>
                  <th>Designation</th>
                  <th>Role</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
                    
               @foreach ($data as $key => $user)
				  <tr>
				  <td> {{ $loop->iteration }} </td>
                  <td><?php echo $user->name;?></td>
                  <td><?php echo $user->designation;?></td>
                  <td>  @if(!empty($user->getRoleNames()))
							@foreach($user->getRoleNames() as $v)
							   <label class="badge badge-success">{{ $v }}</label>
							@endforeach
						@endif
				  </td>
                  <td>
				    

           <a href="{{url('changeStatus/'.$user->id)}}">
              <?php if($user->status==1){echo '<div class ="text-success text-toggle-color"><i class="fa fa-toggle-on fa-2x" aria-hidden="true"></i></div>';}else{echo '<div class="text-secondary"><i class="fa fa-toggle-off fa-2x" aria-hidden="true"></i></div>';}?>
              </a>

				  </td>
          <td style="width: 217px;">
            <form action="{{ route('user.destroy',$user->id) }}" method="POST">
				      <a class="btn btn-info" href="{{ url('user/'.$user->id) }}" style="color: white"><i class="fa fa-eye" aria-hidden="true"></i></a>
              @can('officer-edit')
              <a class="btn btn-primary" href="{{ url('user/'.$user->id.'/edit') }}"><i class="fa fa-edit" aria-hidden="true"></i></a>
             @endcan
                    @csrf
                    @method('DELETE')
                   @can('officer-delete')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash" aria-hidden="true"></i></button>
                    @endcan
                   
                </form>
				     
				  </td>
				  </tr>
				@endforeach
            </table>
             
        </div> 
    </div> </div> </div></div>

 @endsection
