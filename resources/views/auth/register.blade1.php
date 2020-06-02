@extends('layouts.app')

@section('content')
<link href="{{ captcha_layout_stylesheet_url() }}" type="text/css" rel="stylesheet">
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
 <!--<script src="{{ asset('public/plugins/jquery/jquery.min.js') }}"></script>-->
 <!--<link href="{{ asset('public/plugins/jquery-ui/jquery-ui.css') }}" rel="stylesheet">-->
 <!--<script src="{{ asset('public/plugins/jquery-ui/jquery-ui.js') }}"></script> -->
 <script src="{{ asset('public/jquery-validation/dist/jquery.validate.min.js') }}"></script>

<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">-->
<!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->

<!--<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>-->
<body onload="populateDistic()">
<section class="register-cust">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" id="regiter">
                        @csrf
                        <div class="form-group" >
                            <div class="row">
                                <div class="col-md-4"> 
                                  <select class="form-control  @error('category_id') is-invalid @enderror" name="category_id"  id="category_id" onchange="showfield(this.options[this.selectedIndex].value)" required>
                                    <option value="0">Select Category*</option>
                                        @foreach($categories as $val) 
                                            <option value="{{$val->category_id}}" @if($val->category_id == old('category_id')) ? selected : '' @endif >{{$val->category_name}}</option>
                                        @endforeach 
                                    </select>
                                    
                                     
                                    @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <!---- Govt. & Autonomous Educational Institutes / University form control -->


                                <div class="form-group col-md-4 govtInst">
                                        <input class="form-control @error('institute_name') is-invalid @enderror " type="text" value="{{ old('institute_name') }}" name="institute_name" placeholder="Name Of Institute" id="institute_name">
                                        @error('institute_name')
                                            <span class="invalid-feedback " role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    
                                    <div class="form-group  col-md-4 commonpan">
                                        <input class="form-control @error('pan') is-invalid @enderror"  type="text" value="{{ old('pan') }}" name="pan" placeholder="Pan Number*" id="pan" > 
                                        @error('pan')
                                            <span class="invalid-feedback " role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    
                                    <div class="form-group col-md-6 govtInst">
                                        <input class="form-control @error('institute_reg_no') is-invalid @enderror" type="text"  value="{{ old('institute_reg_no') }}" name="institute_reg_no" placeholder="Institute Registration No." id="institute_reg_no">
                                        @error('institute_reg_no')
                                            <span class="invalid-feedback " role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group col-md-6 govtInst">
                                        
                                        <textarea class="form-control @error('institute_addres') is-invalid @enderror"  style="height: 37px;" name="institute_addres" placeholder="Institute Address." id="institute_addres" >{{old('institute_addres')}}</textarea>
                                        @if ($errors->has('institute_addres'))
                                            <span class="invalid-feedback " role="alert">
                                                <strong>{{ $errors->first('institute_addres') }}</strong>
                                            </span>
                                        @endif
                                    </div>  

                                <!---- Govt. & Autonomous Educational Institutes / University form control end -->

                                <div class="col-md-4 others">
                                <?php $gender_arr = array( '1'=>'Male' ,'2'=>'Female','0'=>'Others')?>
                                <select class="form-control @error('gender') is-invalid @enderror " name="gender"  id="gender" value="old('gender')">
                                <option value="">Select Gender*</option>
                                    @foreach($gender_arr as $key=>$val)
                                        <option value="{{ $key }}"  @if($key == old('gender')) ? selected : '' @endif>{{ $val }}</option>
                                            @endforeach
                                        </select>
                                        @error ('gender')
                                            <span class="invalid-feedback " role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>

                                <div class="col-md-4 others">
                                         <input type="date" class="form-control @error('dob') is-invalid @enderror"  value="{{ old('dob') }}" name="dob" placeholder="Date Of Birth*" id="datepicker">     @error('dob')
                                            <span class="invalid-feedback " role="alert">
                                                <strong>{{ $errors->first('dob') }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 ngo">
                                        <input type="text" class="form-control @error('ngo_name') is-invalid @enderror onlyalpha" onkeyup="this.value = this.value.toUpperCase();"   value="{{old('ngo_name')}}" id="ngo_name" placeholder="NGO Name*" name="ngo_name">
                                        @error('ngo_name')
                                            <span class="invalid-feedback " role="alert">
                                                <strong >{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 ngo">
                                        <input type="text" class="form-control @error('uin_no') is-invalid @enderror" onkeyup="this.value = this.value.toUpperCase();"   value="{{old('uin_no')}}" id="uin_no" placeholder="NGO UIN No.*" name="uin_no">
                                        @error('uin_no')
                                            <span class="invalid-feedback " role="alert">
                                                <strong >{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                     <div class="col-md-8 ngo">
                                        <textarea name="ngo_address" id="ngo_address" class="form-control @error('address') is-invalid @enderror" placeholder="Address" rows="1">{{old('ngo_address')}}</textarea>
                                        @error('ngo_address')
                                            <span class="invalid-feedback " role="alert">
                                                <strong >{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        
                                        
                                    </div>

                                     

                                    <div class="col-md-4 private">
                                        <input type="text" class="form-control @error('company_name') is-invalid @enderror onlyalpha" onkeyup="this.value = this.value.toUpperCase();"   value="{{old('company_name')}}" id="company_name" placeholder="Name Of Company*" name="company_name">
                                        @error('company_name')
                                            <span class="invalid-feedback " role="alert">
                                                <strong >{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-4 private">
                                        <input type="text" class="form-control @error('tin_number') is-invalid @enderror " value="{{old('tin_number')}}" id="tin_number" placeholder="Tin Number*" name="tin_number" maxlength="11">
                                        @error('tin_number')
                                            <span class="invalid-feedback " role="alert">
                                                <strong >{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                            </div>
                        </div>
<!--------------------------------------- NGO --------------------------------------->

 <div class="form-group ">
                                <div class="row ">
                                    <div class="col-md-4 private">
                                        <input type="text" class="form-control @error('gst_number') is-invalid @enderror"   value="{{old('gst_number')}}" id="gst_number" placeholder="GST Number*" name="gst_number">
                                        @error('gst_number')
                                            <span class="invalid-feedback " role="alert">
                                                <strong >{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-4 private">
                                        <input type="text" class="form-control @error('pin_code') is-invalid @enderror" value="{{old('pin_code')}}"  id="pin_code" placeholder="Pin Code" name="pin_code">
                                        @error('pin_code')
                                            <span class="invalid-feedback " role="alert">
                                                <strong >{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        
                                    </div>
                                    <div class="col-md-4 addresscommon">
                                        <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" placeholder="Address">{{old('address')}}</textarea>
                                        @error('address')
                                            <span class="invalid-feedback " role="alert">
                                                <strong >{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        
                                        
                                    </div>
                                </div> 
                            </div> 
<!----------------------------------------NGO END ----------------------------------->
                       

                        <div class="form-group others">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="text" class="form-control @error('first_name') is-invalid @enderror onlyalpha" onkeyup="this.value = this.value.toUpperCase();"   value="{{old('first_name')}}" id="first_name" placeholder="First Name*" name="first_name">
                                        @error('first_name')
                                            <span class="invalid-feedback " role="alert">
                                                <strong >{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-4 others">
                                        <input type="text" class="form-control onlyalpha" onkeyup="this.value = this.value.toUpperCase();" value="{{old('middle_name')}}"  id="middle_name" placeholder="Middle Name" name="middle_name">
                                        
                                    </div>
                                    <div class="col-md-4 others">
                                        <input type="text" class="form-control onlyalpha" onkeyup="this.value = this.value.toUpperCase();" value="{{ old('last_name') }}" id="last_name" placeholder="Last Name" name="last_name">
                                        
                                    </div>
                                </div> 
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                      <input type="text" class="form-control @error('email_id') is-invalid @enderror" value="{{ old('email_id') }}"  id="email_id" placeholder="Email Id*" name="email_id">
                                        @error('email_id')
                                            <span class="invalid-feedback"  role="alert" >
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        
                                    </div>
                                    
                                    <div class="col-md-6 othersmobile">
                                        <input type="text"   maxlength="10" class="form-control @error('mobile_no') is-invalid @enderror" value="{{ old('mobile_no')}}"  id="mobile_no" placeholder="Mobile No.*" name="mobile_no">
                                
                                        @error('mobile_no')
                                            <span class="invalid-feedback " role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    
                                     <div class="col-md-6 govtInst">
                                        <input type="text"   maxlength="10" class="form-control @error('pincode') is-invalid @enderror" value="{{ old('pincode')}}"  id="pincode" placeholder="Pincode.*" name="pincode">
                                
                                        @error('pincode')
                                            <span class="invalid-feedback " role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                     
                                </div> <br >
                                <p style='color:red' class="remainsFields"><br>Note:You cannot modify Email or Mobile later. So please be careful while entering.</p>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                           
                                            <select name="state" class="form-control @error('state') is-invalid @enderror" id="state" >
                                                <option value="0"> Select </option>
                                                    @foreach($states as $state)
                                                        <option value="{{$state->statecd}}" @if (old('state') == $state->statecd) {{ 'selected' }} @endif>{{$state->state_name}}</option>
                                                    @endforeach
                                            </select>
                                            @error('state')
                                            <span class="help-block" style="color: red">
                                                <strong>{{ $message}}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                                     
                                            <select id="distric" name="distric" class="form-control @error('distric') is-invalid @enderror">
                                               <option value="0"> Select </option>
                                            </select>                
                                            <!-- <input type="text" name="distric" id="distric"  class="form-control" value="{{old('distric')}}"> -->
                                            @error('distric')
                                            <span class="help-block" style="color: red">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('CaptchaCode') ? ' has-error' : '' }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        {!! captcha_image_html('RegisterCaptcha') !!}
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <input class="form-control @error('CaptchaCode') is-invalid @enderror" type="text" value="" id="CaptchaCode" name="CaptchaCode" placeholder="Enter your captcha here..*" >
                                        @error('CaptchaCode')
                                            <span class="help-block" style="color: red">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        
                                       
                                    </div>
                                </div> 
                            </div>
                            
                                    
                                <input class="btn btn-primary btn-block" type="submit"  name="submit" value="Submit">

                    </form>
                </div>
            </div>
        </div>
    </div>
</div></div></section>
</body>
<style type="text/css">
    .error{
        color: red;
        font-size: 10px;
        font-family:verdana, Helvetica;
    }
    .has-error .form-control {
        border-color: #a94442;
    }
    .register-cust{
            padding: 100px 0px 90px;
}
        
   
</style>
<script type="text/javascript">
    // ajax for Destic
   $('#state').change(function(){    
   var stateID = $(this).val();    
   //alert(stateID);
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

 function populateDistic(){    
   var stateID = $('#state').val();       
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
}


function showfield(id){   

    //alert(id);
    if(id == 3 )
    {                
        $(".govtInst").show();
        $('.others').hide();
        $(".ngo").hide();
        $(".private").hide();
        $(".othersmobile").hide();
        $(".addresscommon").hide();
        $(".commonpan").show();
    }else if(id==1){
        $(".govtInst").hide();
        $('.others').show();
        $(".ngo").hide();
        $(".private").hide();
        $(".addresscommon").hide();
    }else if(id ==2){

        $('.others').show();
        $(".ngo").hide();
        $(".govtInst").hide();
        $(".private").hide();
        $(".addresscommon").hide();
    }    
    else if(id == 4 )
    {    
        $(".ngo").show();
         $(".othersmobile").show();
        //$(".addresscommon").show();
        $(".commonpan").show();
        $(".govtInst").hide();
        $('.others').hide();
        $(".private").hide();
        $(".addresscommon").hide();
       
    }
    else if(id == 5 )
    {    
        $(".private").show();
        $(".ngo").hide();
        $(".govtInst").hide();
        $('.others').hide();
        $(".commonpan").hide();
        $(".othersmobile").show();
         $(".addresscommon").show();
    }else{
        alert(id);
        
    }
       
}
$( document ).ready(function() {
    $(".ngo").hide();
    $(".private").hide();
    $(".addresscommon").hide();
    $(".commonpan").hide();
    // $(".govtInst").hide();
   // $('.others').hide();
    var catid = $('#category_id').val();
   if(catid == 3 )
    {                
        $(".govtInst").show();
         $(".commonpan").show();
         $(".othersmobile").hide();
        $('.others').hide();
        $(".ngo").hide();
        $(".private").hide();
    }else if(catid==1){
        $(".govtInst").hide();
        $('.others').show();
        $(".ngo").hide();
        $(".private").hide();
    }else if(catid ==2){

        $('.others').show();
        $(".ngo").hide();
        $(".govtInst").hide();
        $(".private").hide();
    }    
    else if(catid == 4 )
    {    
        $(".ngo").show();
        $(".govtInst").hide();
        $('.others').hide();
        $(".private").hide();
         $(".addresscommon").hide();
          $(".commonpan").show();
    }
    else if(catid == 5 )
    {    
        //alert('amresh');
        $(".private").show();
        $(".ngo").hide();
        $(".govtInst").hide();
        $('.others').hide();
         $(".addresscommon").show();
    }else{
       // alert(id);
        
    }

    

});

$('input[name="tin_number"]').keyup(function(e)
                                {
  if (/\D/g.test(this.value))
  {
    // Filter non-digits from input value.
    this.value = this.value.replace(/\D/g, '');
  }
});

$('input[name="pin_code"]').keyup(function(e)
                                {
  if (/\D/g.test(this.value))
  {
    // Filter non-digits from input value.
    this.value = this.value.replace(/\D/g, '');
  }
});
</script>
@endsection
