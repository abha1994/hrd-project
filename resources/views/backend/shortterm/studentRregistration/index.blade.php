@extends('layouts.master')
@section('container')

 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ url('dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Participant Registarion
		 </li>
      </ol>
	 
      <!-- Example DataTables Card-->
      <div class="card mb-3">
	    <div class="card-header text-center"><h4 class="mt-2">Participant Registarion</h4></div>
	       <div class="container-fluid border-top bg-white card-footer text-muted text-left" id="app">   

        @include('includes/flashmessage')
            @if ($message = Session::get('success'))
				<div class="alert alert-success">
					<p>{{ $message }}</p>
				</div>
			@endif
			
			<div class="pull-right" style="float: right;">
					<a class="btn btn-success" href="{{ route('st-student-registration.create')  }}"> <i class="nav-icon fas fa-plus"></i> Participant Registration</a>
			</div>  
           <br />
			
			<br />
           <div class="table-responsive card-box">
                <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
										<th>Photo</th>
                                        <th style="width:30%;">Participant Name</th>
									    <th>Gender</th>
										<th>Email</th>
										<th>Mobile</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                              <?php ?>  
                                <tbody> 
								<?php $i =1; ?>
								   @foreach($students as $student)
									<tr>
										<td>{{$loop->iteration}}</td>
										<td><img src="{{asset('public/uploads/shortterm/student_registration/student_photo/'.$student->student_image)}}" width="50px; height:50px"></td>
										<td> <?php echo ucwords($student->firstname.' '.$student->middlename.' '.$student->lastname);?></td>
										<td><?php if($student->gender == "1"){echo "Male";}else if($student->gender == "2"){echo "Female";}else if($student->gender == "3"){echo "Others";} ?></td>
										<td>{{$student->email_id}}</td>
										<td>{{$student->mobile}}</td>
										<td>
										
						<a href="{{ url('st-student-registration/'.$student->id) }}"><i class="fa fa-eye"></i></a>
                     
                        <a href="{{ url('st-student-registration/'.$student->id.'/edit') }}"><i class="fa fa-edit"></i></a>
                       
                        <!--<a href="{{ url('st-student-registration/'.$student->id.'/destroy') }}" onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash"></i></a>-->
						
						{!! Form::open(['method' => 'DELETE','route' => ['st-student-registration.destroy', $student->id],'style'=>'display:inline']) !!}
						{!! Form::submit('Delete', ['class' => 'btn btn-danger confirmation','id'=>'delete']) !!}
												 
						{!! Form::close() !!} 
						 
                        
						
									
											 
											 <?php // if($student->is_bank_details_fill == "0"){ ?>
											  <!--a style="border: 1px solid red;padding: 4px 4px;background: red;color: white;" onclick="return alert('Please Upload Your bank details')">Upload Bank Mandate Form</a>
											 <?php  //}if($student->is_bank_details_fill == "1" ){ ?>
											 <button type="button"  stdID="<?php //echo $student->id;?>" insID="<?php //echo $student->institute_id;?>" style="border: 1px solid red;padding: 4px 4px;background: red;color: white;" data-toggle="modal" data-target="#myModal" class="uploadValue">Upload Bank Mandate Form</button>
											 <?php //}
											 // if($student->is_bank_details_fill == 2){ ?>
											 <a href="{{asset('public/uploads/nref/student_registration/bankMandate/'.$student->bankMandate)}}">Download</a-->
											 <?php //} ?>
										</td>
									</tr>
               
                              <?php     $i++;   ?>  @endforeach
                                
                                </tbody>
                            </table>
						</div>
        </div> 
    </div></div>
	
	
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog ">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
	  <h4 class="modal-title">Upload Bank Mandate Form</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
	  
	  <form enctype="multipart/form-data" action="{{ url('bankmandate-form-post') }}" autocomplete="off" id="bankmandate_form" method="POST" >
			{!! csrf_field() !!}
			
			<input type="hidden" name="student_id" id="Std_id"  />
			<input type="hidden" name="institute_id" id="insID" value=""  />
		    <input type="hidden" name="user_id" id="user_id" value="<?php echo Auth::id();?>" />
					<div class="form-group" >
					<label>Upload File</label>
					 <input type="file" name="bankMandate"  id="bankMandate" class="form-control">
					 <br>
					 <label style="color:#FF0000; font-size:11px;"> (File Format accepts: PDF &amp; Maximum Size: 1MB) 
					<br><span  style="font-size: 12px;"id="bankMandate_error"> </span>	 
					
					</div>
		
					<div class="form-group" >
					<input type="submit" id="uploadSubmit" class="btn btn-primary " />
					</div>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

</div>
     <script type="text/javascript">
 
 $(document).ready(function() { 
 
 $(document).on('click', ".uploadValue", function(){
var curVal= $(this).attr('stdID');
var insID= $(this).attr('insID');
$("#Std_id").val(curVal);
$("#insID").val(insID);

}); 
   $('#bankmandate_form').validate({
	   
     ignore: [],
     debug: false,
     rules: {
		bankMandate: {
           required: true, 
         },

		 
      },
          submitHandler: function(form) {
          if(form.submit()!==''){
           }
        }
		

	 }); 


	 	
	 
	 
	}); 


</script>
    <!--  <script src="{{ asset('js/app.js') }}"></script>  -->
@endsection