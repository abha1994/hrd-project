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
				
        	<form action="{{ route('feedback-form-post') }}" autocomplete="off" class="appoint" method="POST">
						  <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
						  
<input type = "hidden" name = "studentID" value = "<?php if(isset($studentID)) { echo $studentID; } ?>">
<input type = "hidden" name = "studemail" value = "<?php if(isset($stdemail)) { echo $stdemail; } ?>">
<input type = "hidden" name = "studentotp" value = "<?php if(isset($stdotp)) { echo $stdotp; } ?>">
						  
						  <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
							  
							    
							   <div class="form-group">
								<div class="row">
									<div class="col-md-9">
									  <label for="name"  style="font-size: 13px;" class="control-label">The information I received about the training program prior to enrolment was accurate and useful</label>
										<input type="checkbox" name="tpe1" value="The information I received about the training program prior to enrolment was accurate and useful">
									</div>
									
									
								</div> 
							</div>
							
							<div class="form-group">
								<div class="row">
									<div class="col-md-9">
									  <label for="name"  style="font-size: 13px;" class="control-label">The training facilities and equipment's were accurate</label>
										<input type="checkbox" name="tpe2" value="The training facilities and equipment's were accurate">
									</div>
									
									
								</div> 
							</div>
							
							
							<div class="form-group">
								<div class="row">
									<div class="col-md-9">
									  <label for="name"  style="font-size: 13px;" class="control-label">The content of training program was easy to understand</label>
										<input type="checkbox" name="tpe3" value="The content of training program was easy to understand">
									</div>
									
									
								</div> 
							</div>
							
							<div class="form-group">
								<div class="row">
									<div class="col-md-9">
									  <label for="name"  style="font-size: 13px;" class="control-label">All written material was easy to follow and understand</label>
										<input type="checkbox" name="tpe4" value="All written material was easy to follow and understand">
									</div>
									
									
								</div> 
							</div>
							
							<div class="form-group">
								<div class="row">
									<div class="col-md-9">
									  <label for="name"  style="font-size: 13px;" class="control-label">I felt I achieved the learning outcome of the course</label>
										<input type="checkbox" name="tpe5" value="I felt I achieved the learning outcome of the course">
									</div>
									
									
								</div> 
							</div>
							
							<div class="form-group">
								<div class="row">
									<div class="col-md-9">
									  <label for="name"  style="font-size: 13px;" class="control-label">The trainer assigned to me was made my learning experience good
</label>
										<input type="checkbox" name="tpe6" value="The trainer assigned to me was made my learning experience good">
									</div>
									
									
								</div> 
							</div>
							
							<div class="form-group">
								<div class="row">
									<div class="col-md-9">
									  <label for="name"  style="font-size: 13px;" class="control-label">I found activities were relevant to my need</label>
										<input type="checkbox" name="tpe7" value="I found activities were relevant to my need">
									</div>
									
									
								</div> 
							</div>
							
							<hr>
							
							<div class="card-header">Trainer Evaluation</div>
							
							<div class="form-group">
								<div class="row">
									<div class="col-md-9">
									  <label for="name"  style="font-size: 13px;" class="control-label">The trainer gave an overview of the training program at the onset of each session and explained 
the assessment process adequately</label>
										<input type="checkbox" name="tpe8" value="The trainer gave an overview of the training program at the onset of each session and explained 
the assessment process adequately">
									</div>
									
									
								</div> 
							</div>
							
							<div class="form-group">
								<div class="row">
									<div class="col-md-9" id="rateBox">
									  
									</div>
									
									<input type="hidden" name="star_rating" id="t1" value="" /> 
									
								</div> 
							</div>
							
							
							<div class="form-group">
								<div class="row">
									<div class="col-md-9">
									  <label for="name"  style="font-size: 13px;" class="control-label">Your suggestions</label>
										<textarea type="checkbox" name="suggestion"></textarea>
									</div>
									
									
								</div> 
							</div>
							  
					
	<input class="btn btn-primary" type="submit"  name="submit" value="Submit">
								
								
						</form>
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

<script src="{{ asset('public/js/fxss-rate/jquery-3.3.1.slim.min.js') }}" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="fxss-rate/rate.js"></script>
<script src="{{ asset('public/js/fxss-rate/rate.js') }}"></script>
<script>
                $("#rateBox").rate({
                    length: 5,
                    value: 3.5,
                    readonly: false,
                    size: '25px',
                    selectClass: 'fxss_rate_select',
                    incompleteClass: 'fxss_rate_no_all_select',
                    customClass: 'custom_class',
                    callback: function(object){
                        console.log(object)
                    }
                });
            </script>
			
@endsection


