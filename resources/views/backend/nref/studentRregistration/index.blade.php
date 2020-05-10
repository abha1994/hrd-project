@extends('layouts.master')
@section('container')

 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ url('dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Student Registarion
		 </li>
      </ol>
	 
      <!-- Example DataTables Card-->
      <div class="card mb-3">
	    <div class="card-header text-center"><h4 class="mt-2">Student Registarion</h4></div>
	       <div class="container-fluid border-top bg-white card-footer text-muted text-left" id="app">   

            @if ($message = Session::get('success'))
				<div class="alert alert-success">
					<p>{{ $message }}</p>
				</div>
			@endif
			
			<div class="pull-right" style="float: right;">
					<a class="btn btn-success" href="{{ route('student-registration.create')  }}"> <i class="nav-icon fas fa-plus"></i> Student Registration</a>
			</div>  
           <br />
			
			<br />
           <div class="table-responsive card-box">
                <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th style="width:30%;">Student Name</th>
									    <th>Gender</th>
										<th>Email ID</th>
										<th>Mobile</th>
                                        <th class="text-right">Action</th>
										
                  
                                    </tr>
                                </thead>
                              <?php //dd($roles); ?>  
                                <tbody> 
								<?php $i =1; ?>
								   @foreach($students as $student)
									<tr>
										<td>{{$loop->iteration}}</td>
										<td>{{$student->firstname}} {{ $student->middlename}} {{$student->lastname}}</td>
										<td>{{$student->gender}}</td>
										<td>{{$student->email_id}}</td>
										<td>{{$student->mobile}}</td>
										<td style="width: 230px">
										<a class="btn btn-info" href="{{ url('student-registration/'.$student->id) }}" style="color: white">Show</a>
										   
												<a class="btn btn-primary" href="{{ url('student-registration/'.$student->id.'/edit') }}">Edit</a>
											
											
												{!! Form::open(['method' => 'DELETE','route' => ['student-registration.destroy', $student->id],'style'=>'display:inline']) !!}
												{!! Form::submit('Delete', ['class' => 'btn btn-danger confirmation','id'=>'delete']) !!}
												 
												{!! Form::close() !!}   
											 
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