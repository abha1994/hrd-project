@extends('layouts.master')
@section('container') 
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
              <li class="breadcrumb-item"><a href="{{url('student-registration')}}">Home</a></li>
              <li class="breadcrumb-item active">Student Registration</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="container-fluid border-top bg-white card-footer text-muted text-left " id="app">        
    <div class="col-md-12">
    <div class="card card-primary card-outline">
        <div class="card-body">              
     
        <br />
     <form  enctype="multipart/form-data"  action="{{ route('student-registration.store') }}" class="" id="studentRegistrationForm" method="POST" >
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
                <div id="bbb"></div>
          </div>
          <div class="form-group col-md-4">
            <label for="email">Email Id <span style="color: red">*</span></label><br />
            <input name="email_id" id="email_id" class="form-control" value="{{old('email_id')}}"></input>
            <br />
            @if ($errors->has('email_id'))
                  <span class="help-block" id="aaa">
                      <strong>{{ $errors->first('email_id') }}</strong>
                  </span>
                @endif
                <div id="aaa" class="error"></div>
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
          <div class="form-group col-md-4">
            <?php $categories_arr = array( '1'=>'General' ,'2'=>'OBC','3'=>'SC','4'=>'ST')?>
            <label for="student_image">Category<span style="color: red">*</span></label> 
              <select name="category" id="category" class="form-control">
                  <!-- <option value="">Select Category</option> -->
                  @foreach($categories_arr as $key=>$category)
                    <option value="{{ $key }}">{{ $category }}</option>
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
             <input type="file" name="student_image" class="form-control" value="{{old('student_image')}}">
              @if ($errors->has('student_image'))
                <span class="help-block">
                  <strong>{{ $errors->first('student_image') }}</strong>
                </span>
              @endif
          </div>
           <div class="form-group col-md-4">
             <label for="commiteedocument">Selection Committee Recommandation doc.  <span style="color: red">*</span></label>   
             <input type="file" name="commiteedocument" class="form-control" value="{{old('commiteedocument')}}">
              @if ($errors->has('commiteedocument'))
                <span class="help-block">
                  <strong>{{ $errors->first('commiteedocument') }}</strong>
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
          <div class="form-group col-md-4 " >
              <label for="dob">DOB <span style="color: red">*</span></label>               
              <input type="date" name="dob"  class="form-control" value="{{old('dob')}}" id="dob">
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
              <select name="country" class="form-control">
                @foreach($country as $con)
                <option value="{{$con->countrycd}}" {{ $con->name == 'INDIA' ? 'selected' : ''}}>{{$con->name}}</option>
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
              <label for="distric">District <span style="color: red">*</span></label>    
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
        
         <!--  <div class="form-group col-md-4">
              <label for="exampleInputPassword1">Upload Publication (In case of SRF) <span style="color: red">*</span></label>               
              <input type="file" name="publication"  class="form-control" value="{{old('publication')}}">
              @if ($errors->has('publication'))
                  <span class="help-block">
                      <strong>{{ $errors->first('publication') }}</strong>
                  </span>
                @endif
               <p style="color: red; font-style: italic; font-weight: 5px"><small>(File Format accepts: Doc, Docx, PDF & Maximum Size: 1MB)</small></p></span>
          </div> -->
          <div class="form-group col-md-4" id="srf_jrf">
              
          </div>
          <div class="form-group col-md-4" id="publication">
              
          </div>
         <div class="form-group col-md-4" id="experience">
              
          </div>

          <div class="form-group " id="gate">
              
          </div>

          <div class="form-group " id="net">
              
          </div>
           
        </div>
        <div class="border-top bg-white card-footer text-muted text-left">
        <br />
        <button type="submit" name="editrole" value="Save" class="btn btn-primary font-weight-normal px-4">Save</button>
        <a href="{{url('student-registration')}}" class="btn btn-outline-secondary">Cancel</a>
      <!-- <a href=" " class="btn btn-outline-secondary font-weight-normal mr-2">Add other students detail </a> -->
    </div>      
      </form>
        </div>
    </div>
</div>
</div>
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
  // ajax for Destic
   $('#state').change(function(){    
   var stateID = $(this).val();    
   if(stateID){
       $.ajax({
          type:"GET",
          url:"{{url('api/get-distic-list')}}?statecd="+stateID,
          success:function(res){  
          //console.log(res);             
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
  
  //End of datetime picker

  function showfield(name){   
    //alert(name);
  if(name == '12' || name == '13') {
    document.getElementById('srf_jrf').innerHTML = '<label for="exampleInputPassword1">GATE or NEET Score (in case of SRF & JRF)<span style="color: red">*</span></label><input type="file" name="gate_neet"  class="form-control">@if ($errors->has("gate_neet"))<span class="help-block"><strong>{{ $errors->first("gate_neet") }}</strong></span> @endif <p style="color: red; font-style: italic;"><small>(File Format accepts: Doc,Docx,PDF & Maximum Size: 1MB)</small></p></span>';
  }else{
    document.getElementById('srf_jrf').innerHTML='';
  }
  if (name == '13'){
    document.getElementById('publication').innerHTML = '<label for="exampleInputPassword1"> Upload Publication(In sase of SRF) <span style="color: red">*</span></label><input type="file" name="publication"  class="form-control">@if ($errors->has("publication"))<span class="help-block"><strong>{{ $errors->first("publication") }}</strong></span> @endif <p style="color: red; font-style: italic;"><small>(File Format accepts: Doc,Docx,PDF & Maximum Size: 1MB)</small></p></span> ';

    document.getElementById('experience').innerHTML = '<label for="exampleInputPassword1"> Upload experience(In sase of SRF) <span style="color: red">*</span></label><input type="file" name="experience"  class="form-control">@if ($errors->has("experience"))<span class="help-block"><strong>{{ $errors->first("experience") }}</strong></span> @endif <p style="color: red; font-style: italic;"><small>(File Format accepts: Doc,Docx,PDF & Maximum Size: 1MB)</small></p></span> ';


    
  }else{
    document.getElementById('publication').innerHTML='';
     document.getElementById('experience').innerHTML='';
  }
   
   if(name == '6') {
    document.getElementById('gate').innerHTML = '<label for="exampleInputPassword1">GATE  Score <span style="color: red">*</span></label><input type="file" name="gate"  class="form-control">@if ($errors->has("gate"))<span class="help-block"><strong>{{ $errors->first("gate") }}</strong></span> @endif <p style="color: red; font-style: italic;"><small>(File Format accepts: Doc,Docx,PDF & Maximum Size: 1MB)</small></p></span>';
  }else{
    document.getElementById('gate').innerHTML='';
  }
  if(name == '7') {
    document.getElementById('net').innerHTML = '<label for="exampleInputPassword1">NEET Score<span style="color: red">*</span></label><input type="file" name="net"  class="form-control">@if ($errors->has("net"))<span class="help-block"><strong>{{ $errors->first("net") }}</strong></span> @endif <p style="color: red; font-style: italic;"><small>(File Format accepts: Doc,Docx,PDF & Maximum Size: 1MB)</small></p></span>';
  }else{
    document.getElementById('net').innerHTML='';
  }
 }
  

 $(document).ready(function () {
  $.validator.addMethod("phoneStartingWith6", function(value, element) {
    return this.optional(element) || /^[6-9]\d{9}$/.test(value);
  }, "Phone number should start with 6,9");

    
    $('#studentRegistrationForm').validate({
       ///alert('amresh');
        rules: {
          firstname:{
            required: true,
            minlength: 4,
            maxlength:50,
            
          },
          mobile : {
           //matches: "/[0-9]{10}/",
           phoneStartingWith6:true,
            required: true,
            number: true,
            minlength:10,
            maxlength:10,
            remote: {
              url: "{{url('validate_mobile')}}",
              type: "GET",
                data: {
              _token: function() {
                return "{{csrf_token()}}"
            }
          },
          // async: false,
              complete: function(data) {
                     
                    // console.log(data.responseText);
                      // if (data.responseText == "true") { //i.e. email is unique
                      // $(this).removeClass(".error");
                      // $('#bbb').html('<span style="color:green">Ready to go</span>');
                      //  } else{
                      //     $(this).addClass(".error");
                      //   $('#bbb').html('<span style="color:red">Mobile Number all ready exit in database</span>');
                      //  }
                  }
              }
          },
          email_id : {
            required: true,
            email: true ,

          remote: {
              url: "{{URL('validate_email')}}",
              type: "GET",
                data: {
              _token: function() {
                return "{{csrf_token()}}"
            }
          },
          // async: false,
              complete: function(data) {
                     
                     console.log(data.responseText);

                      // if (data.responseText === 'true') { //i.e. email is unique
                      // $(this).removeClass(".error");
                      // $('#aaa').html('<span style="color:green"> Email id all ready exit in database</span>');
                      //  } else{
                      //     $(this).addClass(".error");
                      //   $('#aaa').html('<span style="color:red">Ready to go</span>');
                      //  }
                  }
              }
             
          }, 

          gender : {
            required: true,
          }, 
          aadhar: {
            required: true,
            remote: {
              url: "{{URL('validate_aadhar')}}",
              type: "GET",
                data: {
              _token: function() {
                return "{{csrf_token()}}"
            }
          },
          // async: false,
              complete: function(data) {
                     
                     console.log(data.responseText);

                      // if (data.responseText === 'true') { //i.e. email is unique
                      // $(this).removeClass(".error");
                      // $('#aaa').html('<span style="color:green"> Email id all ready exit in database</span>');
                      //  } else{
                      //     $(this).addClass(".error");
                      //   $('#aaa').html('<span style="color:red">Ready to go</span>');
                      //  }
                  }
              }
          },
          address : {
            required: true,
            minlength:20,
            maxlength:150
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
          student_image: {
              required: true,
              extension: "jpg|jpeg|png"
          },
          commiteedocument:{
            required:true
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
            highest_qulification: {
                required: true,
                extension: "docx|rtf|doc|pdf"
            },
            bankMandate: {
              required: true,
                extension: "docx|rtf|doc|pdf"
            },
            publication: {
              required: true,
                extension: "docx|rtf|doc|pdf"
            },
             gate_neet: {
              required: true,
                extension: "docx|rtf|doc|pdf"
            },

        },
        messages: {
          firstname: {
                required: "First name is required. Please enter your first name!",                
            },
            mobile:{
              required:"Mobile file is required. Please enter your mobile number!",
            },
            email_id:{
              required:"Email id is required. Please enter your email id!",
            },
            address: {
              required: "Address field is required. Please enter your address!"
            },
            dob: {
              required: "Date of birth is required. Please select your DOB!"
            },
            pincode:{
              required: "Pincode is required. Please enter pincode!"
            },
            state:{
              required: "State field is required. Please select your state!"
            },
            distric: {
              required: "Destic filed is required. Please select your distric!"
            },
            student_image: {
                required: "Please upload Student Image ",
                extension: "Please upload valid file formats jpg|jpeg|png"
            },
            highest_qulification: {
                required: "Please upload Highest Qualification",
                extension: "Please upload valid file formats"
            },
            bankMandate: {
                required: "Please upload Bank Mandate",
                extension: "Please upload valid file formats"
            },
            publication: {
                required: "Please upload publication",
                extension: "Please upload valid file formats"
            },
            gate_neet: {
              required: "Please upload Gate or NEET Score",
                extension: "Please upload valid file formats"
            }
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
  
  