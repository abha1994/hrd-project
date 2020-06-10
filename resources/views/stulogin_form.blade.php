@extends('layouts.app')

@section('content')
<script>
  var page_url = "{{url('api/sendotpstudent')}}";
</script>
	
<link href="{{ captcha_layout_stylesheet_url() }}" type="text/css" rel="stylesheet">
        			  
	 <?php   
			 $email_id = Session::get('email_id');
			 $otp = Session::get('otp');
             $CaptchaCode = Session::get('CaptchaCode');
	 ?>			  
  
<section class="register-cust">
<div class="container">
    <div class="row justify-content-center" style="width:60%;margin-left:22%">
        <div class="col-md-10">
           @if ($message = Session::get('error'))
		<strong style="color: red;">{{ $message }}</strong>
		  @endif
		   @if ($message = Session::get('success'))
			<div class="alert alert-success alert-block">
			  <button type="button" class="close" data-dismiss="alert">×</button>	
			  <strong>{{ $message }}</strong>
			</div>
		   @endif
            <div class="card">
                <div class="card-header">Student Login</div>

                <div class="card-body">
				
        	<form action="{{ route('stuLogin-form-post') }}" autocomplete="off" class="appoint" method="POST" id="stu_login_form">
						  <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
							  
							 &nbsp;&nbsp;
   							   <input type="radio" onclick="emailmobileCheck();" name="emailmobile" id="yesemail" checked> <strong>Email</strong>
							   <input  type="radio" onclick="emailmobileCheck();" name="emailmobile" id="yesmobile"><strong>Mobile No.</strong>
							&nbsp;&nbsp;
							
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
									  <div id="email_mob_error"></div>	
								     <div id="msg"></div>
							</div>
						  </div>
						  <div class="col-md-3">
						<div class="form-group button-group">  
							<input type="button" id="sendotpLogin" class="submit_btn" name="submit" value="Send OTP" >
							<div id="otp_error"></div>
						</div></div>
						
						</div>
						
						
						
						<div id="enterotp" >
							<div class="form-group" >
								
								<input type="text" class="form-control" onkeypress="return isNumberKey(event)" value="<?php if(!empty($otp)){ ?>{{$otp}}<?php }else if(old('otp')){ ?>{{ old('otp')}} <?php } ?>" id="otp" placeholder="Enter OTP" name="otp">
								@if ($errors->has('otp'))
									<span class="invalid-feedback " role="alert">
										<strong>{{ $errors->first('otp') }}</strong>
									</span>
								@endif
							  </div>
							</div>
					
					
             <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        {!! captcha_image_html('LoginCaptcha') !!}
                    </div>
					</div>
				</div>
                <div class="form-group">
                <div class="row">  
                    <div class="col-md-12">
                        <input class="form-control" type="text" value="{{old('CaptchaCode')}}" id="CaptchaCode" name="CaptchaCode" placeholder="Enter your captcha here..*"  required >
                        @if ($errors->has('CaptchaCode'))
                            <span class="help-block">
                                <strong style="color:red; font-size: 10px;">{{ $errors->first('CaptchaCode') }}</strong>
                            </span>
                        @endif
                         
                    </div>
                </div> 
            </div>
			
		 
							
								<input class="btn btn-primary btn-block" type="submit"  name="submit" value="Login">
								
								
						</form>
						<br>
					    <div class="text-center">
							<a class="head" href="{{URL('login') }}">Login</a> | 
							<a class="head" href="{{URL('register') }}">Register</a> | 
							<a class="head" href="{{URL('forgetpassword') }}">Forgot Password</a> |
							<a class="head" href="{{URL('forgetuser') }}">Forgot Username</a> |
							<a class="head" href="{{URL('stuLogin') }}">Student Login</a>
						</div>
      </div>
    </div>
    </div> </div> </section>

   <style type="text/css">
    .head{
 	   font-size: 18px;
      font-weight: bold;
   }
    .error{
       color: red;
      font-size: 12px;
   }
    .help-block{
        color: red;
    }
	.register-cust{
		    padding: 100px 0px 90px;
    }
</style>
<script>
$(document).ready(function(){
 
    $("a[title ~= 'BotDetect']").removeAttr("style");
    $("a[title ~= 'BotDetect']").removeAttr("href");
    $("a[title ~= 'BotDetect']").css('visibility', 'hidden');

});
</script>
@endsection


