@extends('layouts.master')
@section('container')


    
	 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ url('dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">All Rejected Student List</li>
      </ol>
	 
      <!-- Example DataTables Card-->
       <div class="card mb-3">
	    <div class="card-header text-center"><h4 class="mt-2">All Rejected Student List</h4></div>
	       <div class="container-fluid border-top bg-white card-footer text-muted text-left" id="app">
    @if ($success = Session::get('success'))
		 <div class="alert alert-success alert-block">
		   <button type="button" class="close" data-dismiss="alert">×</button>	
		   <strong>{{ $success }}</strong>
		 </div>
	     @endif
		 
		  @if ($error = Session::get('error'))
		 <div class="alert alert-danger  alert-block">
		   <button type="button" class="close" data-dismiss="alert">×</button>	
		   <strong>{{ $error }}</strong>
		 </div>
	     @endif	   	
		 
		 <table>
                <tr>
                    <td><form name="find" id="find" action="{{route('admin-student-rejected')}}" method="post">
                        @csrf

                        <select name="findStudentInst" id="findStudentInst"  class="form-control">
                            <option value="">Select Institute</option>
                            @foreach($inst as $val)
                            <option value="{{ $val->institute_id }}" @if($val->institute_id == $id) ? selected : '' @endif>{{$val->institute_name}}</option>
                             @endforeach
                        </select>

                         
                
                    </td>
                    <td>
                        <button class="btn btn-primary">Search</button>
                    </td>
                    </form>
                </tr>
            </table>
			<br><br>
	
             <div class="table-responsive card-box">
                <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                               
              <thead>
                <tr>
                    <th>S. No.</th>
					<th>Institute Name</th>
                    <th>Student Name</th>
                    <th>Gender</th>
                    <th>Email ID</th>
                    <th>Mobile</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tbody>
              
				  @foreach($students as $student)
                <tr>
                    <td>{{$loop->iteration}}</td>
					<td>
					<?php foreach($inst as $val){
						if($val->institute_id == $student->institute_id){
							 echo $val->institute_name;}
							 }
							?></td>
                    <td> <?php echo ucwords($student->firstname.' '.$student->middlename.' '.$student->lastname);?></td>
                    <td><?php if($student->gender == "1"){echo "Male";}else if($student->gender == "2"){echo "Female";} ?></td>
                    <td>{{$student->email_id}}</td>
                    <td>{{$student->mobile}}</td>
                    <td style="width: 250px">
                        <a href="{{ url('admin-student-rejected/'.$student->id.'/'.$student->institute_id) }}"><i class="fa fa-eye"></i></a>
                        @can('nref-rejected-student-edit')
                        <a href="{{ url('admin-student-rejected/'.$student->id.'/edit/'.$student->institute_id) }}"><i class="fa fa-edit"></i></a>
                        @endcan
                        @can('nref-rejected-student-delete')
                        <a onclick="return confirm('Are you sure you want to delete?')" href="{{ url('admin-student-rejected/'.$student->id.'/delete/'.$student->institute_id) }}"><i class="fa fa-trash"></i></a>
                        @endcan
                    </td>
                </tr>
                @endforeach
                
             
             
              </tbody>
            </table>
          </div>
        </div>
        <!--div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div-->
      </div>
    </div>  </div>

@endsection
