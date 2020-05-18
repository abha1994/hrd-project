@extends('layouts.master')
@section('container')
<body onload="showfield('<?php echo trim($student->course)?>')">
 

<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb"style="" >
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Student Registration</li>
      </ol>
    <div class="card card-login mx-auto mt-5 " style="max-width: 65rem; margin-bottom: 28px;">
     	<div class="card-header text-center"><h4 class="mt-2">Student Registration</h4></div>
     <div class="card-body">
		
           <form  enctype="multipart/form-data"  action=" {{ route('st-student-registration.update',$student->id) }}" class="" id="studentRegistrationForm" method="POST" >
		   <input type="hidden" id="hidden_id" value="{{$student->id}}">
				<input type="hidden" name="_method" value="PUT">
				{{csrf_field()}}
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
				     	<input name="mobile" maxlength="10"  id="mobile" onblur="checkmobileStatus()" class="form-control" value="{{$student->mobile}}"></input>
						  <div id="mobile_msg"></div>
				     	@if ($errors->has('mobile'))
            			<span class="help-block">
                			<strong>{{ $errors->first('mobile') }}</strong>
             			</span>
        				@endif
				    </div>
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
					<div class="form-group col-md-3">
				     	<label for="pincode">Pincode <span style="color: red">*</span></label>				     	 
				     	<input type="text" name="pincode"  class="form-control" value="{{$student->pincode}}">
				     	@if ($errors->has('pincode'))
            			<span class="help-block">
                			<strong>{{ $errors->first('pincode') }}</strong>
             			</span>
        				@endif
				  	</div>
				 	 <div class="form-group col-md-3">
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
					          <option value="{{$dis->districtcd}}" @if($dis->districtcd == $student->distric) selected="selected" @endif>{{$dis->district_name}}  </option>
					        @endforeach
				     	</select>		     	 
				     	@if ($errors->has('distric'))
            			<span class="help-block">
                			<strong>{{ $errors->first('distric') }}</strong>
             			</span>
        				@endif
				  	</div>				 	 
		    	</div> 
			    

		    	
		     	<div class="form-row" >				 
				  	
				    
				  	<div class="form-group col-md-4">
				     	<label for="exampleInputPassword1">Aadhar Number of Student <span style="color: red">*</span></label><input type="text" name="aadhar"  class="form-control" id="aadhar"  onblur="checkadharStatus()"  value="{{$student->aadhar}}" data-type="adhaar-number" maxlength="14">
						<div id="aadhar_msg"></div>
				     	@if ($errors->has('aadhar'))
            			<span class="help-block">
                			<strong>{{ $errors->first('aadhar') }}</strong>
             			</span>
        				@endif
				 	</div>		
 	                 <div class="form-group col-md-4">
				   
			           <label for="exampleInputPassword1">Upload Aadhar
			           <span style="color: red">*</span></label>				     	 
				     	<input type="file" name="upload_aadhar" id="upload_aadhar" class="form-control" value="{{$student->candidate_declaration}}">
				     	@if ($errors->has('upload_aadhar'))
            			<span class="help-block">
                			<strong>{{ $errors->first(upload_aadhar) }}</strong>
             			</span>
        				@endif
        				<label style="color:#FF0000; font-size:11px;"> (File Format accepts: PDF &amp; Maximum Size: 5MB) <br>
						 <span  style="font-size: 12px;"id="upload_aadhar_error"> </span>
						 <?php if(!empty($student->upload_aadhar)){ ?>
						 <a href="{{asset('public/uploads/shortterm/student_registration/upload_aadhar/'.$student->upload_aadhar)}}">Download</a>
						 <?php } ?>
						 <input type="hidden" name="upload_aadhar_value" value="{{$student->upload_aadhar }}">
				  	</div>	
                <div class="form-group col-md-4">
             <label for="student_image">Student Photo <span style="color: red">*</span></label>   

             <input type="file" name="student_image" id="student_image" class="form-control" value="{{ $student->student_image }}">
              @if ($errors->has('student_image'))
                <span class="help-block">
                  <strong>{{ $errors->first('student_image') }}</strong>
                </span>
              @endif
			  
			   <label style="color:#FF0000; font-size:11px;"> (File Format accepts: img,png &amp; Maximum Size: 100kb) <br>
			<p id="file_photo_error"></p>
			<?php if(!empty($student->student_image)){ ?>
        	 <img src="{{asset('public/uploads/shortterm/student_registration/student_photo/'.$student->student_image)}}" width="30px;"> 
			<?php } ?> 
			<input type="hidden" name="student_image_value" value="{{$student->student_image }}">	
			
          </div>					
		    	</div>  

		    	
		    	
			 <center>
					<button type="submit" value="Submit" class="btn btn-primary">
					<i class="fa fa-check" aria-hidden="true"></i>&nbsp; Submit</button>
					<a href="{{url('student-registration')}}" class="btn btn-outline-secondary">
					<i class="fa fa-times" aria-hidden="true"></i>&nbsp; Cancel</a>
					</center>	
	    </form>
        </div> 
    </div>  </div>  </div>
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


function checkmobileStatus(){
var mobile=$("#mobile").val();// value in field email
var hidden_id=$("#hidden_id").val();// value in field email
$.ajax({
    type:'get',
        url:"{{URL('validate_mobile')}}",// put your real file name 
        data:{mobile: mobile,hidden_id:hidden_id},
        success:function(msg){
            $('#mobile_msg').html(msg); // your message will come here.     
        }
 });
}

function checkadharStatus(){
var aadhar=$("#aadhar").val();// value in field email
var hidden_id=$("#hidden_id").val();// value in field email
$.ajax({
    type:'get',
        url:"{{URL('validate_aadhar')}}",// put your real file name 
        data:{aadhar: aadhar,hidden_id:hidden_id},
        success:function(msg){
            $('#aadhar_msg').html(msg); // your message will come here.     
        }
 });
}
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
		  student_image_value :{
				required :true
			},
         
			
			
			upload_aadhar: {
		required: function(element) {
				if($("#upload_aadhar_value").val()== '')
				{
			    return true;
				}
				else
				{
				return false;
				}
			},
			},	
			
			
			category :{
				required :true
			},
			
			  
			  
        }
    });


    
});

  </script>


@endsection
	
	