@extends('layouts.master')
@section('container')
<body onload="showfield('<?php echo trim($student->course)?>')">
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb" >
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Update Student</li>
      </ol>
  <div class="card card-login mx-auto mt-5 ">     
   <div class="card-header text-center"><h4 class="mt-2">Update Student</h4></div>
      <div class="card-body">
            <form  enctype="multipart/form-data"  action=" {{ route('student-registration.update',$student->id) }}" class="" id="studentRegistrationForm" method="POST" >
				<input type="hidden" name="_method" value="PUT">
				{{csrf_field()}}
				<div class="form-row">
			        <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }} col-md-4">
				     	<label for="firstName">First Name <span style="color: red">*</span></label>
				     	<input name="firstname" class="form-control" value="{{$student->firstname}}"></input>
				     	@if ($errors->has('firstname'))
            			<span class="help-block">
                			<strong class="error">{{ $errors->first('firstname') }}</strong>
             			</span>
        				@endif
				   </div>
				   <div class="form-group{{ $errors->has('middlename') ? ' has-error' : '' }} col-md-4">
				     	<label for="middleName">Middle Name <span style="color: red">*</span></label>
				     	<input name="middlename" class="form-control" value="{{$student->middlename}}"></input>
				     	@if ($errors->has('middlename'))
            			<span class="help-block">
                			<strong class="error">  {{ $errors->first('middlename') }}</strong>
             			</span>
        				@endif
				   </div>
				   <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }} col-md-4">
				     	<label for="lastName">Last Name <span style="color: red">*</span></label>
				     	<input name="lastname" class="form-control" value="{{$student->lastname}}"></input>
				     	@if ($errors->has('lastname'))
            			<span class="help-block">
                			<strong class="error">{{ $errors->first('lastname') }}</strong>
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
                			<strong class="error">{{ $errors->first('mobile') }}</strong>
             			</span>
        				@endif
				    </div>
				 
		    		<div class="form-group col-md-4">
				 		<label for="email">Email Id <span style="color: red">*</span></label><br />
				 		<input name="email_id" class="form-control" value="{{$student->email_id}}"></input>
				 		<br />
				 		@if ($errors->has('email_id'))
            			<span class="help-block">
                			<strong  class="error">{{ $errors->first('email_id') }}</strong>
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
                			<strong class="error">{{ $errors->first('gender') }}</strong>
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
                			<strong class="error">{{ $errors->first('address') }}</strong>
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
                			<strong class="error">{{ $errors->first('dob') }}</strong>
             			</span>
        				@endif
				    </div>
				  	<div class="form-group col-md-4">
				     	<label for="pincode">Pincode <span style="color: red">*</span></label>				     	 
				     	<input type="text" name="pincode"  class="form-control" value="{{$student->pincode}}">
				     	@if ($errors->has('pincode'))
            			<span class="help-block">
                			<strong class="error">{{ $errors->first('pincode') }}</strong>
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
                				<strong class="error">{{ $errors->first('country') }}</strong>
             				</span>
        				@endif
				  	</div>
				  	<div class="form-group col-md-4">
				     	<label for="state">State <span style="color: red">*</span></label>				     	 
				       	<select name="state" class="form-control" id="state">
				     		<option value="0"> Select State </option>
				     		@foreach($states as $state)
				     		<option value="{{$state->statecd}}" @if ($student->state == $state->statecd) {{ 'selected' }} @endif>{{$state->state_name}}</option>
				     		@endforeach
				     	</select>
				     	@if ($errors->has('state'))
            			<span class="help-block">
                			<strong class="error">{{ $errors->first('state') }}</strong>
             			</span>
        				@endif
				  	</div>  
				  	<div class="form-group col-md-4">
				     	<label for="distric">District <span style="color: red">*</span></label>		
				     	<select id="distric" name="distric" class="form-control">
				     		<option value="0"> Select District</option>
				     		 @foreach($distric as $dis)
					          <option value="{{$dis->districtcd}}" @if($dis->districtcd == $student->state) selected="selected" @endif>{{$dis->district_name}}  </option>
					        @endforeach
				     	</select>		     	 
				     	@if ($errors->has('distric'))
            			<span class="help-block">
                			<strong class="error">{{ $errors->first('distric') }}</strong>
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
                			<strong class="error">{{ $errors->first('highest_qulification') }}</strong>
             			</span>
        				@endif
				  	</div>
				    <div class="form-group col-md-4">
				     	<label for="exampleInputPassword1">Upload Bank Mandate Form <span style="color: red">*</span></label>				     	 
				     	<input type="file" name="bankMandate"  class="form-control" value="{{$student->bankMandate}}">
				     	@if ($errors->has('bankMandate'))
            			<span class="help-block">
                			<strong class="error">{{ $errors->first('bankMandate') }}</strong>
             			</span>
        				@endif
					</div>
				  	<div class="form-group col-md-4">
				     	<label for="exampleInputPassword1">Aadhar Number of Student <span style="color: red">*</span></label>				     	 
				     	<input type="text" name="aadhar"  class="form-control" value="{{$student->aadhar}}" data-type="adhaar-number">
				     	@if ($errors->has('aadhar'))
            			<span class="help-block">
                			<strong class="error">{{ $errors->first('aadhar') }}</strong>
             			</span>
        				@endif
				 	</div>				 	 
		    	</div>  
		    	<div class="form-row">
					 <div class="form-group col-md-4" id="srf_jrf">
              
					  </div>
					  <div class="form-group col-md-4" id="publication">
						  
					  </div>
			    </div> 
				<div class="border-top bg-white card-footer text-muted text-left">
				<br />
				    <center>
					<button type="submit" value="Save" class="btn btn-primary">
					<i class="fa fa-check" aria-hidden="true"></i>&nbsp; Save</button>
					<a href="{{url('student-registration')}}" class="btn btn-outline-secondary">
					<i class="fa fa-times" aria-hidden="true"></i>&nbsp; Cancel</a>
					</center>
		</div>			
	    </form>
        </div> 
    </div> </div> </div> 
</body>


<style>
  .error{
	    color: red;
	    font-size: 12px;
	}
	
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
	
	