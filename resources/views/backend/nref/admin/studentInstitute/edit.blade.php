@extends('layouts.master')
@section('container')
<body onload="showfield('<?php echo trim($student->course)?>')">

<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb" >
        <li class="breadcrumb-item">
          <a href="{{url('home')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Registred Institute Student Edit</li>
      </ol>
  <div class="card card-login mx-auto mt-5 ">     
   <div class="card-header text-center"><h4 class="mt-2">Registred Institute Student Edit</h4></div>
 	
      <div class="card-body">
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
            <form  enctype="multipart/form-data"  action="{{ url('registerd-student-update',$student->id) }}" class="" id="studentRegistrationForm" method="POST" >
				<!--input type="hidden" name="_method" value="PUT"-->
				{{csrf_field()}}
				<?php  $current_url =  Request::segment(1); ?>
				<input type="hidden" name="redirectid" value="{{$ids}}">
				<input type="hidden" name="redirect_url" value="{{$current_url}}">
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
				     	<input name="mobile" maxlength="10" class="form-control" value="{{$student->mobile}}"></input>
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
				 		<input type="radio" name="gender" value="1" {{$student->gender == "1" ? 'checked' : '' }}> Male &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				 		<input type="radio" name="gender" value="2" {{$student->gender == "2" ? 'checked' : '' }} > Female
				 		<br />
				 		@if ($errors->has('gender'))
            			<span class="help-block">
                			<strong>{{ $errors->first('gender') }}</strong>
             			</span>
        				@endif
				 	</div>				 	
		    	</div>

		    	<div class="form-row">
          <div class="form-group col-md-4"> 
            <?php $categories_arr = array( '1'=>'General' ,'2'=>'OBC','3'=>'SC','4'=>'ST')?>
            <label for="student_image">Category<span style="color: red">*</span></label> 
              <select name="category" id="category" class="form-control">
                   <option value="">Select Category</option>
                  @foreach($categories_arr as $key=>$category)
                    <option value="{{ $key }}" {{$student->category == $key ? 'selected' : '' }}>{{ $category }}</option>
                  @endforeach
              </select>
              @if ($errors->has('category'))
                <span class="invalid-feedback " role="alert">
                  <strong>{{ $errors->first('category') }}</strong>
                </span>
              @endif
             
          </div>
           <div class="form-group col-md-4">
             <label for="student_image">Student Image <span style="color: red">*</span></label>   

             <input type="file" name="student_image" id="student_image" class="form-control" value="{{ $student->student_image }}">
              @if ($errors->has('student_image'))
                <span class="help-block">
                  <strong>{{ $errors->first('student_image') }}</strong>
                </span>
              @endif
			  
			   <label style="color:#FF0000; font-size:11px;"> (File Format accepts: img,png &amp; Maximum Size: 100kb) <br>
			<p id="file_photo_error"></p>
			<?php if(!empty($student->student_image)){ ?>
        	 <img src="{{asset('public/uploads/nref/student_registration/student_photo/'.$student->student_image)}}" width="30px;"> 
			<?php } ?> 
			<input type="hidden" name="student_image_value" value="{{$student->student_image }}">	
			
          </div>
           <div class="form-group col-md-4">
             <label for="commiteedocument">Selection Committee Recommandation doc.  <span style="color: red">*</span></label>   
             <input type="file" name="commiteedocument" id="commiteedocument" class="form-control" value="{{$student->commiteedocument }}">
              @if ($errors->has('commiteedocument'))
                <span class="help-block">
                  <strong>{{ $errors->first('commiteedocument') }}</strong>
                </span>
              @endif

            <label style="color:#FF0000; font-size:11px;"> (File Format accepts: PDF &amp; Maximum Size: 1MB) <br>
			<p id="commiteedocument_error"></p>
			<?php if(!empty($student->commiteedocument)){ ?>
        		<a href="{{asset('public/uploads/nref/student_registration/commitee_recommanded/'.$student->commiteedocument)}}">Download</a>
			<?php } ?>
					<input type="hidden" name="commiteedocument_value" value="{{$student->commiteedocument }}">	
						
			   
          </div>

        </div>
 

		     	<div class="form-row">
					<div class="form-group col-md-6">
				    	<label for="address">Address <span style="color: red">*</span></label>
				       	<textarea name="address" style="height: 36px;" class="form-control">{{$student->address}}</textarea>
				     	@if ($errors->has('address'))
            			<span class="help-block">
                			<strong>{{ $errors->first('address') }}</strong>
             			</span>
        				@endif
				    </div>
				 	 <div class="form-group col-md-6">
				     	<label for="dob">DOB <span style="color: red">*</span></label>				     	 
				     	<input type="date" name="dob"  class="form-control" value="{{$student->dob}}" >
				     	@if ($errors->has('dob'))
            			<span class="help-block">
                			<strong>{{ $errors->first('dob') }}</strong>
             			</span>
        				@endif
				    </div>
		   		</div> 
		    	<div class="form-row">
					
					<div class="form-group col-md-4">
				     	<label for="doj">DOJ <span style="color: red">*</span></label>				     	 
				     	<input type="date" name="doj"  class="form-control" value="{{$student->doj}}" >
				     	@if ($errors->has('doj'))
            			<span class="help-block">
                			<strong>{{ $errors->first('doj') }}</strong>
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
				     		<option value="{{$course->course_id}}" @if ($student->course == $course->course_id) {{ 'selected' }} @endif>{{$course->course_name}}</option>
				     		@endforeach
				     		 
				     	</select>
				     	<input type="hidden" name="course_id" value="{{$course->course_id}}">
				  	</div>
			    </div>
			    <div class="form-row">
					<div class="form-group col-md-4"> 
				    	<label for="country">Country <span style="color: red">*</span></label>				     	 
				    	<select name="country" class="form-control" readonly>
				    			<option value="91" <?php if($student->country == "91"){ echo "Selected";}?>>INDIA</option>
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
				     		<option value="0"> Select State </option>
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
				     	<label for="distric">District<span style="color: red">*</span></label>		
				     	<select id="distric" name="distric" class="form-control">
				     		<option value="0"> Select District</option>
				     		 @foreach($distric as $dis)
					          <option value="{{$dis->districtcd}}" @if($dis->districtcd == $student->distric ) selected="selected" @endif>{{$dis->district_name}}  </option>
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
				     	<input type="file" name="highest_qulification" id="highest_qulification" class="form-control" value="{{$student->highest_qulification}}">
				     	@if ($errors->has('highest_qulification'))
            			<span class="help-block">
                			<strong>{{ $errors->first('highest_qulification') }}</strong>
             			</span>
        				@endif
        				<label style="color:#FF0000; font-size:11px;"> (File Format accepts: PDF &amp; Maximum Size: 5MB) <br>
						 <span  style="font-size: 12px;"id="highest_qulification_error"> </span>
						 <?php if(!empty($student->highest_qulification)){ ?>
						 <a href="{{asset('public/uploads/nref/student_registration/qulification/'.$student->highest_qulification)}}">Download</a>
						 <?php } ?>
						 <input type="hidden" name="highest_qulification_value" value="{{$student->highest_qulification }}">
				  	</div>
				    <!--div class="form-group col-md-4">
				     	<label for="exampleInputPassword1">Upload Bank Mandate Form <span style="color: red">*</span></label>				     	 
				     	<input type="file" name="bankMandate" id="bankMandate" class="form-control" value="{{$student->bankMandate}}">
				     	@if ($errors->has('bankMandate'))
            			<span class="help-block">
                			<strong>{{ $errors->first('bankMandate') }}</strong>
             			</span>
        				@endif
						<label style="color:#FF0000; font-size:11px;"> (File Format accepts: PDF &amp; Maximum Size: 1MB) <br>
						 <span  style="font-size: 12px;"id="bankMandate_error"> </span>
						<?php //if(!empty($student->bankMandate)){ ?>
        				<a href="{{asset('public/uploads/nref/student_registration/bankMandate/'.$student->bankMandate)}}">Download</a>
						<?php //} ?>
						<input type="hidden" name="bankMandate_value" value="{{$student->bankMandate }}">
					</div-->
						<div class="form-group col-md-4">
				     <p> First Download and Upload  <a href="./resources/views/backend/nref/studentRregistration/nref_declation_form.pdf" download>Click</a></p>
			           <label for="exampleInputPassword1">Candidate declaration form 
			           <span style="color: red">*</span></label>				     	 
				     	<input type="file" name="candidate_declaration" id="candidate_declaration" class="form-control" value="{{$student->candidate_declaration}}">
				     	@if ($errors->has('candidate_declaration'))
            			<span class="help-block">
                			<strong>{{ $errors->first(candidate_declaration) }}</strong>
             			</span>
        				@endif
        				<label style="color:#FF0000; font-size:11px;"> (File Format accepts: PDF &amp; Maximum Size: 5MB) <br>
						 <span  style="font-size: 12px;"id="candidate_declaration_error"> </span>
						 <?php if(!empty($student->candidate_declaration)){ ?>
						 <a href="{{asset('public/uploads/nref/student_registration/candidate_declaration/'.$student->candidate_declaration)}}">Download</a>
						 <?php } ?>
						 <input type="hidden" name="candidate_declaration_value" value="{{$student->candidate_declaration }}">
				  	</div>	
				  	<div class="form-group col-md-4">
				     	<label for="exampleInputPassword1">Aadhar Number of Student <span style="color: red">*</span></label>				     	 
				     	<input type="text" name="aadhar"  class="form-control" value="{{$student->aadhar}}" data-type="adhaar-number" maxlength="14">
				     	@if ($errors->has('aadhar'))
            			<span class="help-block">
                			<strong>{{ $errors->first('aadhar') }}</strong>
             			</span>
        				@endif
				 	</div>				 	 
		    	</div>  

		    	<?php 

		    	$gatepath = 'public/uploads/nref/student_registration/gate/'.$student->gate;
		    	$netpath = 'public/uploads/nref/student_registration/net/'.$student->net;
		    	// $gate_neet = 'public/uploads/nref/student_registration/'.$student->gate_neet;
		    	$publication = 'public/uploads/nref/student_registration/publication/'.$student->publication;
		    	$experience = 'public/uploads/nref/student_registration/experience/'.$student->experience;
		    	 
		    	 
		    	?>
		    	<div class="form-row">
					 
					<!--div class="form-group col-md-4" id="srf_jrf">
              
          </div-->
          <div class="form-group col-md-4" id="publication" style="display:none">
		      <label for="exampleInputPassword1">Upload Publication <span style="color: red">*</span></label>	<input type="file" name="publication" id="publication_data" class="form-control" value="{{$student->publication}}">
				@if ($errors->has('publication'))
				<span class="help-block">
					<strong>{{ $errors->first('publication') }}</strong>
				</span>
				@endif
				<label style="color:#FF0000; font-size:11px;"> (File Format accepts: PDF &amp; Maximum Size: 1MB) <br>
				 <span  style="font-size: 12px;"id="publication_data_error"> </span>
				<?php if(!empty($student->publication)){ ?>
				<a href="{{asset('public/uploads/nref/student_registration/publication/'.$student->publication)}}">Download</a>
				<?php } ?>
				<input type="hidden" name="publication_value" id="publication_value" value="{{$student->publication }}">
		  </div>
		  

         <div class="form-group col-md-4" id="experience" style="display:none">
               <label for="exampleInputPassword1">Upload experience <span style="color: red">*</span></label>	<input type="file" name="experience" id="experience_data" class="form-control" value="{{$student->experience}}">
				@if ($errors->has('experience'))
				<span class="help-block">
					<strong>{{ $errors->first('experience') }}</strong>
				</span>
				@endif
				<label style="color:#FF0000; font-size:11px;"> (File Format accepts: PDF &amp; Maximum Size: 1MB) <br>
				 <span  style="font-size: 12px;"id="experience_data_error"> </span>
				<?php if(!empty($student->experience)){ ?>
				<a href="{{asset('public/uploads/nref/student_registration/experience/'.$student->experience)}}">Download</a>
				<?php } ?>
				<input type="hidden" name="experience_value" id="experience_value" value="{{$student->experience }}">
          </div>

          <div class="form-group " id="gate" style="display:none">
              
			    <label for="exampleInputPassword1">GATE Score<span style="color: red">*</span></label>	<input type="file" name="gate" id="gate_data" class="form-control" value="{{$student->gate}}">
				@if ($errors->has('gate'))
				<span class="help-block">
					<strong>{{ $errors->first('gate') }}</strong>
				</span>
				@endif
				<label style="color:#FF0000; font-size:11px;"> (File Format accepts: PDF &amp; Maximum Size: 1MB) <br>
				 <span  style="font-size: 12px;"id="gate_data_error"> </span>
				<?php if(!empty($student->gate)){ ?>
				<a href="{{asset('public/uploads/nref/student_registration/gate/'.$student->gate)}}">Download</a>
				<?php } ?>
				<input type="hidden" name="gate_value" id="gate_value" value="{{$student->gate }}">
				
          </div>

          <div class="form-group " id="net" style="display:none">
              <label for="exampleInputPassword1">NET Score<span style="color: red">*</span></label>	
			  <input type="file" name="net" id="net_data" class="form-control">
				@if ($errors->has('net'))
				<span class="help-block">
					<strong>{{ $errors->first('net') }}</strong>
				</span>
				@endif
				<label style="color:#FF0000; font-size:11px;"> (File Format accepts: PDF &amp; Maximum Size: 1MB) <br>
				 <span  style="font-size: 12px;"id="net_data_error"> </span>
				<?php if(!empty($student->net)){ ?>
				<a href="{{asset('public/uploads/nref/student_registration/net/'.$student->net)}}">Download</a>
				<?php } ?>
				<input type="hidden" name="net_value" id="net_value" value="{{$student->net }}">
          </div>
			    </div> 
		
<?php $current_url =  Request::segment(1); ;?>
		<div class="col-xs-12 col-sm-12 col-md-12 text-center">
         <button type="submit" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i>&nbsp; Save</button>
        <a class="btn btn-secondary" href="{{ url($current_url.'/'.$ids)}}"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; Cancel</a>
    </div>
	
	    </form>
        </div> 
    </div> </div> </div>
</body>


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
});   // End of ajax for Destic

//Aadhar Validation
$('[data-type="adhaar-number"]').keyup(function() {
  var value = $(this).val();
  value = value.replace(/\D/g, "").split(/(?:([\d]{4}))/g).filter(s => s.length > 0).join("-");
  $(this).val(value);
});
//End of Aadhar Validation

 function showfield(name){   
    // alert(name);
$('#course_id').val(name);
  if (name == '13'){
	  $('#publication').show();
	  $('#experience').show();
    // document.getElementById('publication').innerHTML = '<label for="exampleInputPassword1"> Upload Publication<span style="color: red">*</span></label><input type="file" name="publication"  class="form-control"><a href="{{asset($publication)}}">Download</a>@if ($errors->has("publication"))<span class="help-block"><strong>{{ $errors->first("publication") }}</strong></span> @endif <p style="color: red; font-style: italic;"><small>(File Format accepts: Doc,Docx,PDF & Maximum Size: 1MB)</small></p></span> ';

    // document.getElementById('experience').innerHTML = '<label for="exampleInputPassword1"> Upload experience <span style="color: red">*</span></label><input type="file" name="experience"  class="form-control"><a href="{{asset($experience)}}">Download</a>@if ($errors->has("experience"))<span class="help-block"><strong>{{ $errors->first("experience") }}</strong></span> @endif <p style="color: red; font-style: italic;"><small>(File Format accepts: Doc,Docx,PDF & Maximum Size: 1MB)</small></p></span> ';


    
  }else{
     $('#publication').hide();
     $('#experience').hide();
  }
   
   if(name == '6' || name == '12' || name == '13') {
	   $('#gate').show();
    // document.getElementById('gate').innerHTML = '<label for="exampleInputPassword1">GATE  Score <span style="color: red">*</span></label><input type="file" name="gate"  class="form-control"><a href="{{asset($gatepath)}}">Download</a>@if ($errors->has("gate"))<span class="help-block"><strong>{{ $errors->first("gate") }}</strong></span> @endif <p style="color: red; font-style: italic;"><small>(File Format accepts: Doc,Docx,PDF & Maximum Size: 1MB)</small></p></span>';
  }else{
	  $('#gate').hide();
    // document.getElementById('gate').innerHTML='';
  }
  if(name == '8'|| name == '12' || name == '13') {
	  $('#net').show();
    // document.getElementById('net').innerHTML = '<label for="exampleInputPassword1">NET Score<span style="color: red">*</span></label><input type="file" name="net"  class="form-control"><a href="{{asset($netpath)}}">Download</a>@if ($errors->has("net"))<span class="help-block"><strong>{{ $errors->first("net") }}</strong></span> @endif <p style="color: red; font-style: italic;"><small>(File Format accepts: Doc,Docx,PDF & Maximum Size: 1MB)</small></p></span>';
  }else{
	  $('#net').hide();
    // document.getElementById('net').innerHTML='';
  }
 }
  

 $(document).ready(function () {
  $.validator.addMethod("phoneStartingWith6", function(value, element) {
    return this.optional(element) || /^[6-9]\d{9}$/.test(value);
  }, "Phone number should start with 6,9");

	//***********Student Photo upload***************//
$('#student_image').bind('change', function() {
		var a=(this.files[0].size);///alert(a);
		if(a > 100000) {
		   $('#file_photo').val('');
		   $('#file_photo_error').html('Maximum allowed size for file is "100kb" ');
		   $('#file_photo_error').css('color','red');
		   return false;
		}else{
			 $('#file_photo_error').html('');
		};

        var fileExtension = ['jpeg', 'jpg'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
        	 $('#file_photo_error').html('Only jpg and jpeg allowed');
             $('#file_photo_error').css('color','red');  //file_photo_error
             $('#file_photo').val('');
		   return false;
        }
});
	//************Student Photo upload***************//
		   //************candidate_declaration   upload***************//
    $('#candidate_declaration').bind('change', function() {
		    var a=(this.files[0].size);
			if(a > 5000000) {
				$('#candidate_declaration').val('');
			    $('#candidate_declaration_error').html('Maximum allowed size for file is "5MB" ');
			    $('#candidate_declaration_error').css('color','red');
			   return false;
			}else{
				 $('#candidate_declaration_error').html('');
			};
			
			var fileExtension = ['pdf'];
			if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
				$('#candidate_declaration_error').html('Only pdf files allow');
				$('#candidate_declaration_error').css('color','red');
				 return false;
			}
		
	});
     //************candidate_declaration   upload***************//
	//************commiteedocument upload***************//
    $('#commiteedocument').bind('change', function() {
		    var a=(this.files[0].size);
			if(a > 1000000) {
				$('#commiteedocument').val('');
			   $('#commiteedocument_error').html('Maximum allowed size for file is "5MB" ');
			   $('#commiteedocument_error').css('color','red');
			   return false;
			}else{
				 $('#commiteedocument_error').html('');
			};
			
			var fileExtension = ['pdf'];
			if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
				$('#commiteedocument_error').html('Only pdf files allow');
				 $('#commiteedocument_error').css('color','red');
				 return false;
			}
		
	});
     //************commiteedocument upload***************//
	 //************Highest Qualification  upload***************//
    $('#highest_qulification').bind('change', function() {
		    var a=(this.files[0].size);
			if(a > 5000000) {
				$('#highest_qulification').val('');
			   $('#highest_qulification_error').html('Maximum allowed size for file is "5MB" ');
			   $('#highest_qulification_error').css('color','red');
			   return false;
			}else{
				 $('#highest_qulification_error').html('');
			};
			
			var fileExtension = ['pdf'];
			if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
				$('#highest_qulification_error').html('Only pdf files allow');
				 $('#highest_qulification_error').css('color','red');
				 return false;
			}
		
	});
     //************Highest Qualification  upload***************//
	 	 //************bankMandate  upload***************//
    $('#bankMandate').bind('change', function() {
		    var a=(this.files[0].size);
			if(a > 1000000) {
				$('#bankMandate').val('');
			   $('#bankMandate_error').html('Maximum allowed size for file is "5MB" ');
			   $('#bankMandate_error').css('color','red');
			   return false;
			}else{
				 $('#bankMandate_error').html('');
			};
			
			var fileExtension = ['pdf'];
			if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
				$('#bankMandate_error').html('Only pdf files allow');
				 $('#bankMandate_error').css('color','red');
				 return false;
			}
		
	});
     //************bankMandate  upload***************//
	 
	 	 	 //************publication  upload***************//
    $('#publication_data').bind('change', function() {
		    var a=(this.files[0].size);
			if(a > 1000000) {
				$('#publication_data').val('');
			   $('#publication_data_error').html('Maximum allowed size for file is "5MB" ');
			   $('#publication_data_error').css('color','red');
			   return false;
			}else{
				 $('#publication_data_error').html('');
			};
			
			var fileExtension = ['pdf'];
			if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
				$('#publication_data_error').html('Only pdf files allow');
				 $('#publication_data_error').css('color','red');
				 return false;
			}
		
	});
     //************publication  upload***************//
	 
	 	 
//************Experience  upload***************//
    $('#experience_data').bind('change', function() {
		    var a=(this.files[0].size);
			if(a > 1000000) {
				$('#experience_data').val('');
			   $('#experience_data_error').html('Maximum allowed size for file is "5MB" ');
			   $('#experience_data_error').css('color','red');
			   return false;
			}else{
				 $('#experience_data_error').html('');
			};
			
			var fileExtension = ['pdf'];
			if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
				$('#experience_data_error').html('Only pdf files allow');
				 $('#experience_data_error').css('color','red');
				 return false;
			}
		
	});
     //************Experience  upload***************//

//************gate  upload***************//
    $('#gate_data').bind('change', function() {
		    var a=(this.files[0].size);
			if(a > 1000000) {
				$('#gate_data').val('');
			   $('#gate_data_error').html('Maximum allowed size for file is "5MB" ');
			   $('#gate_data_error').css('color','red');
			   return false;
			}else{
				 $('#gate_data_error').html('');
			};
			
			var fileExtension = ['pdf'];
			if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
				$('#gate_data_error').html('Only pdf files allow');
				 $('#gate_data_error').css('color','red');
				 return false;
			}
		
	});
     //************gate  upload***************//
	 
	 //************net  upload***************//
    $('#net_data').bind('change', function() {
		    var a=(this.files[0].size);
			if(a > 1000000) {
				$('#net_data').val('');
			   $('#net_data_error').html('Maximum allowed size for file is "5MB" ');
			   $('#net_data_error').css('color','red');
			   return false;
			}else{
				 $('#net_data_error').html('');
			};
			
			var fileExtension = ['pdf'];
			if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
				$('#net_data_error').html('Only pdf files allow');
				 $('#net_data_error').css('color','red');
				 return false;
			}
		
	});
     //************net  upload***************//
	 
    $('#studentRegistrationForm').validate({
       ///alert('amresh');
        rules: {
          firstname:{
            required: true,
            // minlength: 4,
            maxlength:50,
            
          },
           gender : {
            required: true,
          },  
           mobile : {
            phoneStartingWith6:true,
            required: true,
            number: true,
            minlength:10,
            maxlength:10,

          },
           email_id : {
            required: true,
            email: true ,
        },
          address : {
            required: true,
          }, 
          dob : {
            required: true,
            date:true
          }, 
          pincode: {
              required: true,
              minlength: 6,
              maxlength: 6,
              digits: true
          },
         
         state: {
              required: true
          },
          course:{
            required:true
          },
          distric:{
            required:true
          },
         
			// publication_value :{
				// required :true
			// },
			
		publication: {
		required: function(element) {
				if($("#publication_value").val()== '')
				{
			    return true;
				}
				else
				{
				return false;
				}
			},
			},
			
			// experience_value :{
				// required :true
			// },
			experience: {
		required: function(element) {
				if($("#experience_value").val()== '')
				{
			    return true;
				}
				else
				{
				return false;
				}
			},
			},
			
			// gate_value :{
				// required :true
			// },
			
		gate: {
		required: function(element) {
				if($("#gate_value").val()== '')
				{
			    return true;
				}
				else
				{
				return false;
				}
			},
			},
			
		net: {
		required: function(element) {
				if($("#net_value").val()== '')
				{
			    return true;
				}
				else
				{
				return false;
				}
			},
			},
			
			 	candidate_declaration: {
		required: function(element) {
				if($("#candidate_declaration_value").val()== '')
				{
			    return true;
				}
				else
				{
				return false;
				}
			},
			},	
			doj : {
            required: true,
            date:true
          }, 
			// net_value :{
				// required :true
			// },
			bankMandate_value :{
				required :true
			},
			highest_qulification_value :{
				required :true
			},
			commiteedocument_value :{
				required :true
			},
			student_image_value :{
				required :true
			},
			category :{
				required :true
			},
			
			  
			  
        }
    });


    
});

  </script>


@endsection
	
	