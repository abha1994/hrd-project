@extends('layouts.master')
@section('container') 


<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb"style="" >
        <li class="breadcrumb-item">
          <a href="">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Student Registration</li>
      </ol>
    <div class="card card-login mx-auto mt-5 " >
     	<div class="card-header text-center"><h4 class="mt-2">Student Registration</h4></div>
     	<!--div class="card-body text-center"><h4>Fellowship Program Application</h4><h4>Annexure 1A &nbsp;&nbsp;&nbsp;<input name="print" type="button" id="preview" class="btn btn-dark" value="Print this Application" onclick="JavaScript:window.print();"></h4></div-->
		<div class="card-body">
		
     
        <br />
     <form  enctype="multipart/form-data"  action="{{ route('student-registration.store') }}" class="" id="studentRegistrationForm" method="POST" >
      {{csrf_field()}}
<input type="hidden" id="hidden_id" value="">
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
              <input name="mobile" id="mobile" onblur="checkmobileStatus()" class="form-control" maxlength="10" value="{{old('mobile')}}"></input>
			  <div id="mobile_msg"></div>
              @if ($errors->has('mobile'))
                  <span class="help-block">
                      <strong>{{ $errors->first('mobile') }}</strong>
                  </span>
                @endif
                <div id="bbb"></div>
          </div>
          <div class="form-group col-md-4">
            <label for="email">Email Id <span style="color: red">*</span></label><br />
            <input name="email_id" onblur="checkMailStatus()" id="email_id" class="form-control" value="{{old('email_id')}}">
          <div id="email_msg"></div>
		
            @if ($errors->has('email_id'))
                  <span class="help-block" id="aaa">
                      <strong>{{ $errors->first('email_id') }}</strong>
                  </span>
                @endif
                <div id="aaa" class="error"></div>
          </div>
            <div class="form-group col-md-4">
            <label for="gender">Gender <span style="color: red">*</span></label><br />
            <input type="radio" name="gender" value="1" {{ old('gender') == "1" ? 'checked' : '' }}> Male &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="gender" value="2" {{ old('gender') == "2" ? 'checked' : '' }} > Female
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
                    <option value="{{ $key }}" @if (old('category') == $key) {{ 'selected' }} @endif>{{ $category }}</option>
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
             <input type="file" name="student_image" class="form-control" id="student_image" value="{{old('student_image')}}">
              @if ($errors->has('student_image'))
                <span class="help-block">
                  <strong>{{ $errors->first('student_image') }}</strong>
                </span>
              @endif
			  <label style="color:#FF0000; font-size:11px;"> (File Format accepts: img,png &amp; Maximum Size: 100kb) <br>
			<p id="file_photo_error"></p>
          </div>
           <div class="form-group col-md-4">
             <label for="commiteedocument">Selection Committee Recommandation doc.  <span style="color: red">*</span></label>   
             <input type="file" name="commiteedocument" id="commiteedocument" class="form-control" value="{{old('commiteedocument')}}">
              @if ($errors->has('commiteedocument'))
                <span class="help-block">
                  <strong>{{ $errors->first('commiteedocument') }}</strong>
                </span>
              @endif
			   <label style="color:#FF0000; font-size:11px;"> (File Format accepts: PDF &amp; Maximum Size: 1MB) <br>
			<p id="commiteedocument_error"></p>
          </div>
        </div>


        <div class="form-row">
          <div class="form-group col-md-6">
              <label for="address">Address <span style="color: red">*</span></label>
               
              <textarea name="address"  style="height: 36px;"  class="form-control">{{old('address')}}</textarea>
              @if ($errors->has('address'))
                  <span class="help-block">
                      <strong>{{ $errors->first('address') }}</strong>
                  </span>
                @endif
          </div>
		  <div class="form-group col-md-6 " >
              <label for="dob">DOB <span style="color: red">*</span></label>               
              <input type="date" name="dob"  class="form-control" value="{{old('dob')}}" id="dob">
              @if ($errors->has('dob'))
                  <span class="help-block">
                      <strong>{{ $errors->first('dob') }}</strong>
                  </span>
                @endif
          </div>
           
        </div>
        <div class="form-row">
          <div class="form-group col-md-4 " >
              <label for="doj">DOJ <span style="color: red">*</span></label>               
              <input type="date" name="doj"  class="form-control" value="{{old('doj')}}" id="doj">
              @if ($errors->has('doj'))
                  <span class="help-block">
                      <strong>{{ $errors->first('doj') }}</strong>
                  </span>
                @endif
          </div>
          <div class="form-group col-md-4">
              <label for="pincode">Pincode <span style="color: red">*</span></label>               
              <input type="text" name="pincode"  class="form-control" maxlength="6" value="{{old('pincode')}}">
              @if ($errors->has('pincode'))
                  <span class="help-block">
                      <strong>{{ $errors->first('pincode') }}</strong>
                  </span>
                @endif
          </div>
          <div class="form-group col-md-4">
              <label for="couseApplied">Fellowship <span style="color: red">*</span></label>              
              <select name="course" class="form-control" onchange="showfield(this.options[this.selectedIndex].value)">
                <option value="">Select</option>
                @foreach($courses as $course)
                <option value="{{$course->course_id}}" @if (old('course') == $course->course_name) {{ 'selected' }} @endif>{{$course->course_name}}</option>
                @endforeach
                 
              </select>
          </div>

         
           
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
              <label for="country">Country <span style="color: red">*</span></label>               
              <!-- <input type="text" name="country"  class="form-control" value="{{old('country')}}"> -->
              <select name="countrycd" class="form-control">
               
                <option value="99" >INDIA</option>
              
              </select>
              @if ($errors->has('countrycd'))
                  <span class="help-block">
                      <strong>{{ $errors->first('countrycd') }}</strong>
                  </span>
                @endif
          </div>
          <div class="form-group col-md-4">
              <label for="state">State <span style="color: red">*</span></label>               
              <!-- <input type="text" name="state"  class="form-control" value="{{old('state')}}"> -->
              <select name="statecd" class="form-control" id="state" size='1'>
                <option value=""> Select State</option>
                @foreach($states as $state)
                <option value="{{$state->statecd}}" @if (old('statecd') == $state->statecd) {{ 'selected' }} @endif>{{$state->state_name}}</option>
                @endforeach
              </select>
              @if ($errors->has('statecd'))
                  <span class="help-block">
                      <strong>{{ $errors->first('statecd') }}</strong>
                  </span>
                @endif
          </div>
          <div class="form-group col-md-4">
              <label for="distric">District <span style="color: red">*</span></label>    
              <select id="distric" name="districtcd" class="form-control">
                <option value=""> Select District</option>
              </select>          
              <!-- <input type="text" name="distric" id="distric"  class="form-control" value="{{old('distric')}}"> -->
              @if ($errors->has('districtcd'))
                  <span class="help-block">
                      <strong>{{ $errors->first('districtcd') }}</strong>
                  </span>
                @endif
          </div>
           
        </div>
   
        <div class="form-row" >
         
          <div class="form-group col-md-4">
              <label for="exampleInputPassword1">Highest Qualification  <span style="color: red">*</span></label>              
              <input type="file" name="highest_qulification"  id="highest_qulification" class="form-control" value="{{old('highest_qulification')}}" accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
              @if ($errors->has('highest_qulification'))
                  <span class="help-block">
                      <strong>{{ $errors->first('highest_qulification') }}</strong>
                  </span>
                @endif
                <label style="color:#FF0000; font-size:11px;"> (File Format accepts: PDF &amp; Maximum Size: 5MB) <br>
               <span  style="font-size: 12px;"id="highest_qulification_error"> </span>
          </div>
          <div class="form-group col-md-4">
              <label for="exampleInputPassword1">Aadhar Number of Student <span style="color: red">*</span></label>              
              <input type="text" name="aadhar" id="aadhar"  onblur="checkadharStatus()"   class="form-control" value="{{old('aadhar')}}" data-type="adhaar-number" maxlength="14">
			  <div id="aadhar_msg"></div>
              @if ($errors->has('aadhar'))
                  <span class="help-block">
                      <strong>{{ $errors->first('aadhar') }}</strong>
                  </span>
                @endif
          </div>
         
		    <div class="form-group col-md-4">
		    <p> First Download and Upload  <a href="./../resources/views/backend/nref/studentRregistration/nref_declation_form.pdf" download>Click</a></p>
			 
			  
              <label for="exampleInputPassword1">Candidate declaration form 
			 
			  <span style="color: red">*</span></label>	
			  <input type="file" name="candidate_declaration" id="candidate_declaration" class="form-control">
				@if ($errors->has('candidate_declaration'))
				<span class="help-block">
					<strong>{{ $errors->first('candidate_declaration') }}</strong>
				</span>
				@endif
				<label style="color:#FF0000; font-size:11px;"> (File Format accepts: PDF &amp; Maximum Size: 1MB) <br>
				 <span  style="font-size: 12px;"id="candidate_declaration_error"> </span>
		  </div> 
        </div>
       

        <div class="form-row">
        
            <div class="form-group col-md-4" id="publication" style="display:none">
		      <label for="exampleInputPassword1">Upload Publication <span style="color: red">*</span></label>	<input type="file" name="publication" id="publication_data" class="form-control" >
				@if ($errors->has('publication'))
				<span class="help-block">
					<strong>{{ $errors->first('publication') }}</strong>
				</span>
				@endif
				<label style="color:#FF0000; font-size:11px;"> (File Format accepts: PDF &amp; Maximum Size: 1MB) <br>
				 <span  style="font-size: 12px;"id="publication_data_error"> </span>
		</div>
		  

         <div class="form-group col-md-4" id="experience" style="display:none">
               <label for="exampleInputPassword1">Upload experience <span style="color: red">*</span></label>	<input type="file" name="experience" id="experience_data" class="form-control" >
				@if ($errors->has('experience'))
				<span class="help-block">
					<strong>{{ $errors->first('experience') }}</strong>
				</span>
				@endif
				<label style="color:#FF0000; font-size:11px;"> (File Format accepts: PDF &amp; Maximum Size: 1MB) <br>
				 <span  style="font-size: 12px;"id="experience_data_error"> </span>
			</div>

          <div class="form-group " id="gate" style="display:none">
              
			    <label for="exampleInputPassword1">GATE Score<span style="color: red">*</span></label>	<input type="file" name="gate" id="gate_data" class="form-control" >
				@if ($errors->has('gate'))
				<span class="help-block">
					<strong>{{ $errors->first('gate') }}</strong>
				</span>
				@endif
				<label style="color:#FF0000; font-size:11px;"> (File Format accepts: PDF &amp; Maximum Size: 1MB) <br>
				 <span  style="font-size: 12px;"id="gate_data_error"> </span>
				
				
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
		  </div>
        </div>
      
                  <center>
					<button type="submit" value="Submit" class="btn btn-primary">
					<i class="fa fa-check" aria-hidden="true"></i>&nbsp; Submit</button>
					<a href="{{url('student-registration')}}" class="btn btn-outline-secondary">
					<i class="fa fa-times" aria-hidden="true"></i>&nbsp; Cancel</a>
					</center>		
      </form>
        </div> </div>
		  
    </div>
</div>


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
label.error
{
  color:red;
  font-family:verdana, Helvetica;
}
 
</style>
<script type="text/javascript">
function checkMailStatus(){
var email_id=$("#email_id").val();
var hidden_id=$("#hidden_id").val();// value in field email
$.ajax({
    type:'get',
        url:"{{URL('validate_email')}}",// put your real file name 
        data:{email_id: email_id,hidden_id:hidden_id},
        success:function(msg){
            $('#email_msg').html(msg); // your message will come here.     
        }
 });
}

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

 function showfield(name){   
    //alert(name);

  if (name == '13'){
	  $('#publication').show();
	  $('#experience').show();

    
  }else{
     $('#publication').hide();
     $('#experience').hide();
  }
   
   if(name == '6' || name == '12' || name == '13') {
	   $('#gate').show();
  }else{
	  $('#gate').hide();
    // document.getElementById('gate').innerHTML='';
  }
  if(name == '8'|| name == '12' || name == '13') {
	  $('#net').show();
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
	// alert();
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
            // minlength: 2,
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
		   doj : {
            required: true,
            date:true
          }, 
           email_id : {
            required: true,
            email: true ,
			//remote: "{{URL('validate_email')}}"
        },
		
		// remote: {
                    // url: "includes/check_email.php",
                    // type: "post",
                    // complete: function(data){
                        // if( data.responseText == "false" ) {
                            // alert("Free");
                          // }
                     // }
                // },
				
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
         
			publication :{
				required :true
			},
			experience :{
				required :true
			},
			gate :{
				required :true
			},
			net :{
				required :true
			},
			// bankMandate :{
				// required :true
			// },
			highest_qulification :{
				required :true
			},
			commiteedocument :{
				required :true
			},
			candidate_declaration: {
				required :true
			},
			student_image :{
				required :true
			},
			category :{
				required :true
			},
			aadhar:{
				required:true
			},
			  
			  
        }
    });


    
});

  
</script>
<script type="text/javascript">
 $(document).ready(function () {

      $(".nav-link").removeClass('active');
      $("#listudent").addClass('active');
    });
</script>
@endsection
  
  