@extends('layouts.master')
@section('container')
<body onload="showfield('<?php echo trim($student->course)?>')">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Registed Student</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('registerd-student')}}">Home</a></li>
              <li class="breadcrumb-item active">Registred Student </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="container-fluid border-top bg-white card-footer text-muted text-left" id="app">        
                      
        
        <br />
            <form  enctype="multipart/form-data"  action=" {{ route('registerd-student.update',$student->id) }}" class="" id="studentRegistrationForm" method="POST" >
				<input type="hidden" name="_method" value="PUT">
				{{csrf_field()}}
				<input type="hidden" name="redirectid" value="{{$ids}}">
				<div class="form-row">
			        <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }} col-md-4">
				     	<label for="firstName">First Name <span style="color: red">*</span></label>
				     	<input name="firstname" class="form-control" value="{{$student->firstname}}"></input>
				     	@if ($errors->has('firstname'))
            			<span class="help-block">
                			<strong>{{ $errors->first('firstname') }}</strong>
             			</span>
        				@endif
				   </div>
				   <div class="form-group{{ $errors->has('middlename') ? ' has-error' : '' }} col-md-4">
				     	<label for="middleName">Middle Name <span style="color: red">*</span></label>
				     	<input name="middlename" class="form-control" value="{{$student->middlename}}"></input>
				     	@if ($errors->has('middlename'))
            			<span class="help-block">
                			<strong>{{ $errors->first('middlename') }}</strong>
             			</span>
        				@endif
				   </div>
				   <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }} col-md-4">
				     	<label for="lastName">Last Name <span style="color: red">*</span></label>
				     	<input name="lastname" class="form-control" value="{{$student->lastname}}"></input>
				     	@if ($errors->has('lastname'))
            			<span class="help-block">
                			<strong>{{ $errors->first('lastname') }}</strong>
             			</span>
        				@endif
					</div>				  
		    	</div>
			    <div class="form-row">
			   		<div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }} col-md-4">
				     	<label for="mobile">Mobile <span style="color: red">*</span></label>
				     	<input name="mobile" class="form-control" value="{{$student->mobile}}"></input>
				     	@if ($errors->has('mobile'))
            			<span class="help-block">
                			<strong>{{ $errors->first('mobile') }}</strong>
             			</span>
        				@endif
				    </div>
				 
		    		<div class="form-group col-md-4">
				 		<label for="email">Email Id <span style="color: red">*</span></label><br />
				 		<input name="email_id" class="form-control" value="{{$student->email_id}}"></input>
				 		<br />
				 		@if ($errors->has('email_id'))
            			<span class="help-block">
                			<strong>{{ $errors->first('email_id') }}</strong>
             			</span>
        				@endif
				 	</div>
				 	
		    		<div class="form-group col-md-4">
				 		<label for="gender">Gender <span style="color: red">*</span></label><br />
				 		<input type="radio" name="gender" value="male" {{$student->gender == "male" ? 'checked' : '' }}> Male &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				 		<input type="radio" name="gender" value="female" {{$student->gender == "female" ? 'checked' : '' }} > Female
				 		<br />
				 		@if ($errors->has('gender'))
            			<span class="help-block">
                			<strong>{{ $errors->first('gender') }}</strong>
             			</span>
        				@endif
				 	</div>				 	
		    	</div>

		     	<div class="form-row">
					<div class="form-group col-md-12">
				    	<label for="address">Address <span style="color: red">*</span></label>
				       	<textarea name="address" class="form-control">{{$student->address}}</textarea>
				     	@if ($errors->has('address'))
            			<span class="help-block">
                			<strong>{{ $errors->first('address') }}</strong>
             			</span>
        				@endif
				    </div>
				 	 
		   		</div> 
		    	<div class="form-row">
					<div class="form-group col-md-4">
				     	<label for="dob">DOB <span style="color: red">*</span></label>				     	 
				     	<input type="text" name="dob"  class="form-control" value="{{$student->dob}}" id="datepicker">
				     	@if ($errors->has('dob'))
            			<span class="help-block">
                			<strong>{{ $errors->first('dob') }}</strong>
             			</span>
        				@endif
				    </div>
				  	<div class="form-group col-md-4">
				     	<label for="pincode">Pincode <span style="color: red">*</span></label>				     	 
				     	<input type="text" name="pincode"  class="form-control" value="{{$student->pincode}}">
				     	@if ($errors->has('pincode'))
            			<span class="help-block">
                			<strong>{{ $errors->first('pincode') }}</strong>
             			</span>
        				@endif
				  	</div>
				  	<div class="form-group col-md-4">
				     	<label for="couseApplied">Course Applied For<span style="color: red">*</span></label>				     	 
				     	<select name="course" id="course" class="form-control" onchange="showfield(this.options[this.selectedIndex].value)">
				     		@foreach($courses as $course)
				     		<option value="{{$course->course_name}}" @if ($student->course == $course->course_name) {{ 'selected' }} @endif>{{$course->course_name}}</option>
				     		@endforeach
				     		 
				     	</select>
				  	</div>
			    </div>
			    <div class="form-row">
					<div class="form-group col-md-4">
				    	<label for="country">Country <span style="color: red">*</span></label>				     	 
				    	<select name="country" class="form-control">
				    		@foreach($country as $con)
				    			<option value="{{$con->name}}" {{ $con->name == 'INDIA' ? 'selected' : ''}}>{{$con->name}}</option>
				    		@endforeach
				   		</select>
				    	@if ($errors->has('country'))
            				<span class="help-block">
                				<strong>{{ $errors->first('country') }}</strong>
             				</span>
        				@endif
				  	</div>
				  	<div class="form-group col-md-4">
				     	<label for="state">State <span style="color: red">*</span></label>				     	 
				       	<select name="state" class="form-control" id="state">
				     		<option value="0"> Select </option>
				     		@foreach($states as $state)
				     		<option value="{{$state->statecd}}" @if ($student->state == $state->statecd) {{ 'selected' }} @endif>{{$state->state_name}}</option>
				     		@endforeach
				     	</select>
				     	@if ($errors->has('state'))
            			<span class="help-block">
                			<strong>{{ $errors->first('state') }}</strong>
             			</span>
        				@endif
				  	</div>  
				  	<div class="form-group col-md-4">
				     	<label for="distric">Distric <span style="color: red">*</span></label>		
				     	<select id="distric" name="distric" class="form-control">
				     		<option value="0"> Select </option>
				     		 @foreach($distric as $dis)
					          <option value="{{$dis->districtcd}}" @if($dis->districtcd == $student->state) selected="selected" @endif>{{$dis->district_name}}  </option>
					        @endforeach
				     	</select>		     	 
				     	@if ($errors->has('distric'))
            			<span class="help-block">
                			<strong>{{ $errors->first('distric') }}</strong>
             			</span>
        				@endif
				  	</div>				 	 
		    	</div> 
			    <!-- <div class="form-row">
					  <div class="form-group col-md-4">
					     	<label for="bankName">Bank Name <span style="color: red">*</span></label>				     	 
					     	<input type="text" name="bankName"  class="form-control" value="{{old('bankName')}}">
					     	@if ($errors->has('bankName'))
	            			<span class="help-block">
	                			<strong>{{ $errors->first('bankName') }}</strong>
	             			</span>
	        				@endif
					  </div>
					  <div class="form-group col-md-4">
					     	<label for="accountNo">Account Number <span style="color: red">*</span></label>				     	 
					     	<input type="text" name="accountNo"  class="form-control" value="{{old('accountNo')}}">
					     	@if ($errors->has('accountNo'))
	            			<span class="help-block">
	                			<strong>{{ $errors->first('accountNo') }}</strong>
	             			</span>
	        				@endif
					  </div>
					  <div class="form-group col-md-4">
					     	<label for="ifsc">IFSC Code <span style="color: red">*</span></label>				     	 
					     	<input type="text" name="ifscCode"  class="form-control" value="{{old('ifscCode')}}">
					     	@if ($errors->has('ifscCode'))
	            			<span class="help-block">
	                			<strong>{{ $errors->first('ifscCode') }}</strong>
	             			</span>
	        				@endif
					  </div>
					 	 
			    </div> -->

		    	<hr />
		     	<div class="form-row" >				 
				  	<div class="form-group col-md-4">
				     	<label for="exampleInputPassword1">Highest Qualification  <span style="color: red">*</span></label>				     	 
				     	<input type="file" name="highest_qulification"  class="form-control" value="{{$student->highest_qulification}}">
				     	@if ($errors->has('highest_qulification'))
            			<span class="help-block">
                			<strong>{{ $errors->first('highest_qulification') }}</strong>
             			</span>
        				@endif
				  	</div>
				    <div class="form-group col-md-4">
				     	<label for="exampleInputPassword1">Upload Bank Mandate Form <span style="color: red">*</span></label>				     	 
				     	<input type="file" name="bankMandate"  class="form-control" value="{{$student->bankMandate}}">
				     	@if ($errors->has('bankMandate'))
            			<span class="help-block">
                			<strong>{{ $errors->first('bankMandate') }}</strong>
             			</span>
        				@endif
					</div>
				  	<div class="form-group col-md-4">
				     	<label for="exampleInputPassword1">Aadhar Number of Student <span style="color: red">*</span></label>				     	 
				     	<input type="text" name="aadhar"  class="form-control" value="{{$student->aadhar}}" data-type="adhaar-number">
				     	@if ($errors->has('aadhar'))
            			<span class="help-block">
                			<strong>{{ $errors->first('aadhar') }}</strong>
             			</span>
        				@endif
				 	</div>				 	 
		    	</div>  
		    	<div class="form-row">
					<div class="form-group col-md-4">
				    	<label for="exampleInputPassword1">Upload Publication (In case of SRF) <span style="color: red">*</span></label>				     	 
				     	<input type="file" name="publication"  class="form-control" value="{{$student->publication}}">
				     	@if ($errors->has('publication'))
            			<span class="help-block">
                			<strong>{{ $errors->first('publication') }}</strong>
             			</span>
        				@endif
				    </div>
					<div class="form-group col-md-4" id="srf_jrf">
				    </div>
			    </div> 
				<div class="border-top bg-white card-footer text-muted text-left">
				<br />
				<button type="submit" name="editrole" value="Save" class="btn btn-primary font-weight-normal px-4">Update</button>
			<a href=" {{ url('get-instituteId/'.$ids)}}" class="btn btn-outline-secondary font-weight-normal mr-2">Cancle</a>
		</div>			
	    </form>
        </div> 
    </div>
</body>


<style>
    .BDC_CaptchaIconsDiv{
        margin-left: 241px;
        margin-top: -54px;
	}
	strong{
        color: red;
        font-size: 11px;
    }
	.error{
	    color: red;
	    font-size: 12px;
	}
	.has-error .form-control {
    border-color: #a94442;
}
/*.highlight-error {
  border-color: red;
}*/
</style>
<!-- /.container-fluid-->
<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->


<script type="text/javascript">
	// ajax for Destic
   $('#state').change(function(){    
   var stateID = $(this).val();    
   if(stateID){
       $.ajax({
          type:"GET",
          url:"{{url('api/get-distic-list')}}?statecd="+stateID,
          success:function(res){  
          console.log(res);             
           if(res){
               $("#distric").empty();
               $("#distric").append('<option>Select</option>');
               $.each(res,function(key,value){
                   $("#distric").append('<option value="'+key+'">'+value+'</option>');
               });
          
           }else{
              $("#distric").empty();
           }
          }
       });
   }   
   });
   // End of ajax for Destic
   //Aadhar Validation
$('[data-type="adhaar-number"]').keyup(function() {
  var value = $(this).val();
  value = value.replace(/\D/g, "").split(/(?:([\d]{4}))/g).filter(s => s.length > 0).join("-");
  $(this).val(value);
});

$('[data-type="adhaar-number"]').on("change, blur", function() {
  var value = $(this).val();
  var maxLength = $(this).attr("maxLength");
  if (value.length != maxLength) {
    $(this).addClass("highlight-error");
  } else {
    $(this).removeClass("highlight-error");
  }
});

//End of Aadhar Validation
// Date time picker 
  $( function() {
    $( "#datepicker" ).datepicker();
  });
  //End of datetime picker

  function showfield(name){   
   
	if(name == 'Junior Research Fellowship (JRF)' || name == 'Senior research fellowship (SRF)') {
		document.getElementById('srf_jrf').innerHTML = '<label for="exampleInputPassword1">Gate or NEET Score (in case of SRF & JRF)<span style="color: red">*</span></label><input type="file" name="gate_neet"  class="form-control">@if ($errors->has("gate_neet"))<span class="help-block"><strong>{{ $errors->first("gate_neet") }}</strong></span>@endif';
	}
	else {
		document.getElementById('srf_jrf').innerHTML='';
	}	
}


  </script>

<!-- 
<script src="{{ asset('js/app.js') }}"></script> -->
<script type="text/javascript">
 $(document).ready(function () {
 	
      $(".nav-link").removeClass('active');
      $("#listudent").addClass('active');
    });
</script>
@endsection
	
	