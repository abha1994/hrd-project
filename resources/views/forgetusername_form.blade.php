
@extends('layouts.app')

@section('content')

<link href="{{ captcha_layout_stylesheet_url() }}" type="text/css" rel="stylesheet">
  <div class="content-wrapper">
    <div class="container-fluid">
	 <!-- Breadcrumbs--><br>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ URL('/') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">Forgot Password</li>
      </ol>
      <!-- Icon Cards-->
     <div class="card card-login mx-auto mt-5">
	 
						  
							  
      <div class="card-header text-center">Login</div>
      <div class="card-body">
        	 	<form action="{{ route('forgetusername-form-post') }}" autocomplete="off" class="appoint" method="POST" id="beautypress-booking-form">
						  <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
							
							
							<div class="form-group">
										<!--label>First Name<em style="color:red">*</em></label-->
										<input type="text" class="form-control onlyalpha" onkeyup="this.value = this.value.toUpperCase();"   value="<?php if(!empty($first_name)){ ?>{{$first_name}}<?php }else if(old('first_name')){ ?>{{ old('first_name')}} <?php } ?>" id="first_name" placeholder="First Name*" name="first_name">
										@if ($errors->has('first_name'))
											<span class="invalid-feedback " role="alert">
												<strong >{{ $errors->first('first_name') }}</strong>
											</span>
										@endif
							</div>
							<div class="form-group">
								<!--label>Date of Birth<em style="color:red">*</em></label-->
								<input class="date form-control" type="text" readonly value="<?php if(!empty($dob)){ ?>{{$dob}}<?php }else if(old('dob')){ ?>{{ old('dob')}} <?php } ?>" name="dob" placeholder="Date Of Birth*" id="datepicker">
								@if ($errors->has('dob'))
									<span class="invalid-feedback " role="alert">
										<strong>{{ $errors->first('dob') }}</strong>
									</span>
								@endif
							  </div>
									
							 &nbsp;&nbsp; <input type="radio" onclick="emailmobileCheck();" name="emailmobile" id="yesemail" checked> <strong>Email</strong>
							   <input type="radio" onclick="emailmobileCheck();" name="emailmobile" id="yesmobile"><strong>Mobile No.</strong>
							&nbsp;&nbsp;
							
							
							<!--div class="row">  
						<div id="ifemail" class="desc"  >
							<div class="form-group">
								<input type="text" class="form-control" value="<?php if(!empty($email_id)){ ?>{{$email_id}}<?php }else if(old('email_id')){ ?>{{ old('email_id')}} <?php } ?>"  id="email_id" placeholder="Email Id*" name="email_id">
								@if ($errors->has('email_id'))
									<span class="invalid-feedback " role="alert">
										<strong>{{ $errors->first('email_id') }}</strong>
									</span>
								@endif
								<div id="msg"></div>
								<div id="msg"></div>
							
						</div>
						</div>
						<div id="ifmobile" class="desc" style="display:none" >
						<div class="form-group">
								<input type="text"  pattern="^[6-9]\d{9}$" maxlength="10" title="Number should be start with 6,7,8,9" onkeypress="return isNumberKey(event)" class="form-control" value="<?php if(!empty($mobile_no)){ ?>{{$mobile_no}}<?php }else if(old('mobile_no')){ ?>{{ old('mobile_no')}} <?php } ?>"  id="mobile_no" placeholder="Mobile No.*" name="mobile_no">
								@if ($errors->has('mobile_no'))
									<span class="invalid-feedback " role="alert">
										<strong>{{ $errors->first('mobile_no') }}</strong>
									</span>
								@endif  
						 </div>
				       </div>
				       <div class="form-group button-group">
							<input type="button" id="sendotpfu" class="submit_btn" name="submit" value="Send OTP" onclick="change1()">
						</div>
						</div-->
						
						
						<div class="row">
							  <div class="col-md-9">
                            <div class="form-group">	
                            						   
						          <div id="ifemail" class="desc">
								      <input type="text" class="form-control" value="<?php if(!empty($email_id)){ ?>{{$email_id}}<?php }else if(old('email_id')){ ?>{{ old('email_id')}} <?php } ?>"  id="email_id" placeholder="Email Id*" name="email_id">
										@if ($errors->has('email_id'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('email_id') }}</strong>
											</span>
										@endif
								   </div>
								    <div id="ifmobile" class="desc" style="display:none" >
							           <input type="text"  pattern="^[6-9]\d{9}$" maxlength="10" title="Number should be start with 6,7,8,9" onkeypress="return isNumberKey(event)" class="form-control" value="<?php if(!empty($mobile_no)){ ?>{{$mobile_no}}<?php }else if(old('mobile_no')){ ?>{{ old('mobile_no')}} <?php } ?>"  id="mobile_no" placeholder="Mobile No.*" name="mobile_no">
										@if ($errors->has('mobile_no'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('mobile_no') }}</strong>
											</span>
										@endif  
							        </div>
								   <div id="msg"></div>
							</div>
						  </div>
						  <div class="col-md-3">
							<div class="form-group button-group">  
								<input type="button" id="sendotpfu" class="submit_btn" name="submit" value="Send OTP" onclick="change1()">
							</div>
						 </div>
						
						</div>
						
						
						
						<div id="enterotpfu" >
							<div class="form-group" >
								
								<input type="text" class="form-control" value="{{old('fu_otp')}}" id="fu_otp" placeholder="Enter OTP" name="fu_otp">
								@if ($errors->has('fu_otp'))
									<span class="invalid-feedback " role="alert">
										<strong>{{ $errors->first('fu_otp') }}</strong>
									</span>
								@endif
							  </div>
							</div>
					
						
							 <div class="form-group{{ $errors->has('CaptchaCode') ? ' has-error' : '' }}">
								<div class="row">
									<div class="col-md-6">
										{!! captcha_image_html('ContactCaptcha') !!}
									</div>
									
									<div class="col-md-6">
										<input class="form-control" type="text" value="" id="CaptchaCode" name="CaptchaCode" placeholder="Enter your captcha here..*" >
										
										
										@if ($message = Session::get('captcha'))
										 <div class="alert" style="color:red">
										   <strong>{{ $message }}</strong>
										 </div>
									   @endif
									</div>
								</div> 
							</div>
							<input class="btn btn-primary btn-block" type="submit"  name="submit" value="Submit">
								@if ($message = Session::get('error'))
                                 <div class="alert alert-danger alert-block">
	                               <button type="button" class="close" data-dismiss="alert">×</button>	
                                   <strong>{{ $message }}</strong>
                                 </div>
                               @endif
                               @if ($message = Session::get('success'))
                               <div class="alert alert-success alert-block">
	                           <button type="button" class="close" data-dismiss="alert">×</button>	
                                 <strong>{{ $message }}</strong>
                                </div>
                               @endif
						</form>
					<br>
						<div class="text-center">
							<a href="{{URL('forgetusername') }}">Forget Username</a>
						</div>
      </div>
    </div>
    </div>
	<style>
  
   .error{
       color: red;
      font-size: 12px;
   }
   </style>
@endsection