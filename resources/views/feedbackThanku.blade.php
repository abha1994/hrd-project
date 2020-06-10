@extends('layouts.app')

@section('content')
	
<link href="{{ captcha_layout_stylesheet_url() }}" type="text/css" rel="stylesheet">
        			  
	 <?php   
			 $email_id = Session::get('email_id');
			 $otp = Session::get('otp');
             $CaptchaCode = Session::get('CaptchaCode');
	 ?>			  
  
<section class="register-cust">
<div class="container">
    <div class="row justify-content-center" style="width:100%;">
        <div class="col-md-12">
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
                <div class="card-header">Training Program Evaluation</div>

                <div class="card-body">
				<div class="form-group">
				<div class="row">
				<b><center>Thank You @if(isset($email_id)) {{$email_id}}  @endif for your valuable Feedback.</center></b>
				<span><a href="{{url('stuLogin')}}">Back</a></span>
				</div>
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


