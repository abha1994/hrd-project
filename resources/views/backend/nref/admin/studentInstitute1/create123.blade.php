@extends('layouts.master')
@section('container')
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script> -->
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/additional-methods.js"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Student Registration</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Student Registration</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="container-fluid border-top bg-white card-footer text-muted text-left " id="app">        
                    
     
        <br />
      <form  enctype="multipart/form-data"  action="{{ route('student-registration.store') }}" class="" id="studentRegistrationForm" method="POST" autocomplete="off">
			{{csrf_field()}}

			<div class="form-row">
				  <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }} col-md-4">
				     	<label for="firstName">First Name <span style="color: red">*</span></label>
				     	<input name="firstname" class="form-control" value="{{old('firstname')}}"></input>
				     	@if ($errors->has('firstname'))
            			<span class="help-block">
                			<strong>{{ $errors->first('firstname') }}</strong>
             			</span>
        				@endif
				  </div>
          <div class="form-group{{ $errors->has('middlename') ? ' has-error' : '' }} col-md-4">
              <label for="middleName">Middle Name <!-- <span style="color: red">*</span> --></label>
              <input name="middlename" class="form-control" value="{{old('middlename')}}"></input>
              @if ($errors->has('middlename'))
                  <span class="help-block">
                      <strong>{{ $errors->first('middlename') }}</strong>
                  </span>
                @endif
          </div>
          <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }} col-md-4">
              <label for="lastName">Last Name <!-- <span style="color: red">*</span> --></label>
              <input name="lastname" class="form-control" value="{{old('lastname')}}"></input>
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
              <input name="mobile" class="form-control" value="{{old('mobile')}}"></input>
              @if ($errors->has('mobile'))
                  <span class="help-block">
                      <strong>{{ $errors->first('mobile') }}</strong>
                  </span>
                @endif
          </div>
		    	<div class="form-group col-md-4">
				 		<label for="email">Email Id <span style="color: red">*</span></label><br />
				 		<input name="email_id" id="email_id" class="form-control" value="{{old('email_id')}}"></input>
				 		<br />
				 		@if ($errors->has('email_id'))
            			<span class="help-block">
                			<strong>{{ $errors->first('email_id') }}</strong>
             			</span>
        				@endif
				 	</div>
		    		<div class="form-group col-md-4">
				 		<label for="gender">Gender <span style="color: red">*</span></label><br />
				 		<input type="radio" name="gender" value="male" {{ old('gender') == "male" ? 'checked' : '' }}> Male &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				 		<input type="radio" name="gender" value="female" {{ old('gender') == "female" ? 'checked' : '' }} > Female
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
				     	 
				     	<textarea name="address" class="form-control">{{old('address')}}</textarea>
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
				     	<input type="text" name="dob"  class="form-control" value="{{old('dob')}}" id="datepicker">
				     	@if ($errors->has('dob'))
            			<span class="help-block">
                			<strong>{{ $errors->first('dob') }}</strong>
             			</span>
        				@endif
				  </div>
				  <div class="form-group col-md-4">
				     	<label for="pincode">Pincode <span style="color: red">*</span></label>				     	 
				     	<input type="text" name="pincode"  class="form-control" value="{{old('pincode')}}">
				     	@if ($errors->has('pincode'))
            			<span class="help-block">
                			<strong>{{ $errors->first('pincode') }}</strong>
             			</span>
        				@endif
				  </div>
				  <div class="form-group col-md-4">
				     	<label for="couseApplied">Course Applied For<span style="color: red">*</span></label>				     	 
				     	<select name="course" class="form-control" onchange="showfield(this.options[this.selectedIndex].value)">
				     		@foreach($courses as $course)
				     		<option value="{{$course->course_name}}" @if (old('course') == $course->course_name) {{ 'selected' }} @endif>{{$course->course_name}}</option>
				     		@endforeach
				     		 
				     	</select>
				  </div>

				 
				 	 
		    </div>
		    <div class="form-row">
				  <div class="form-group col-md-4">
				     	<label for="country">Country <span style="color: red">*</span></label>				     	 
				     	<!-- <input type="text" name="country"  class="form-control" value="{{old('country')}}"> -->
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
				     	<!-- <input type="text" name="state"  class="form-control" value="{{old('state')}}"> -->
				     	<select name="state" class="form-control" id="state" size='1'>
				     		<option value=""> Select </option>
				     		@foreach($states as $state)
				     		<option value="{{$state->statecd}}" @if (old('state') == $state->statecd) {{ 'selected' }} @endif>{{$state->state_name}}</option>
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
				     		<option value=""> Select </option>
				     	</select>		     	 
				     	<!-- <input type="text" name="distric" id="distric"  class="form-control" value="{{old('distric')}}"> -->
				     	@if ($errors->has('distric'))
            			<span class="help-block">
                			<strong>{{ $errors->first('distric') }}</strong>
             			</span>
        				@endif
				  </div>
				 	 
		    </div>
		     

		    <hr />
		    <div class="form-row" >
				 
				  <div class="form-group col-md-4">
				     	<label for="exampleInputPassword1">Highest Qualification  <span style="color: red">*</span></label>				     	 
				     	<input type="file" name="highest_qulification"  class="form-control" value="{{old('highest_qulification')}}" accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
				     	@if ($errors->has('highest_qulification'))
            			<span class="help-block">
                			<strong>{{ $errors->first('highest_qulification') }}</strong>
             			</span>
        				@endif
                <p style="color: red; font-style: italic;"><small>(File Format accepts: Doc, Docx, PDF & Maximum Size: 1MB)</small></p></span>
				  </div>
				    <div class="form-group col-md-4">
				     	<label for="exampleInputPassword1">Upload Bank Mandate Form <span style="color: red">*</span></label>				     	 
				     	<input type="file" name="bankMandate"  class="form-control" value="{{old('bankMandate')}}">
				     	@if ($errors->has('bankMandate'))
            			<span class="help-block">
                			<strong>{{ $errors->first('bankMandate') }}</strong>
             			</span>
        				@endif
                <p style="color: red; font-style: italic;"><small>(File Format accepts: Doc, Docx, PDF & Maximum Size: 1MB)</small></p></span>
				  </div>
				  <div class="form-group col-md-4">
				     	<label for="exampleInputPassword1">Aadhar Number of Student <span style="color: red">*</span></label>				     	 
				     	<input type="text" name="aadhar"  class="form-control" value="{{old('aadhar')}}" data-type="adhaar-number" maxlength="14">
				     	@if ($errors->has('aadhar'))
            			<span class="help-block">
                			<strong>{{ $errors->first('aadhar') }}</strong>
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
				<button type="submit" name="editrole" value="Save" class="btn btn-primary font-weight-normal px-4">Save</button>
				<a href="{{url('student-registration')}}" class="btn btn-outline-secondary">Cancle</a>
			<!-- <a href=" " class="btn btn-outline-secondary font-weight-normal mr-2">Add other students detail </a> -->
		</div>			
	    </form>
        </div> 
    </div>


@endsection
	
	