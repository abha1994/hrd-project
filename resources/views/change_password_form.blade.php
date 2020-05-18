@extends('layouts.master')

@section('container')
=
	 
	 	<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb" >
        <li class="breadcrumb-item">
          <a href="{{url('home')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Change Password</li>
      </ol>
  <div class="card card-login mx-auto mt-5 ">     
   <div class="card-header text-center"><h4 class="mt-2">Change Password</h4></div>
   
   <?php 
   $all_data = Session::get('all_data');
   // ^f(2aw&mt_cs5$
   // dd($all_data);?>
   
      <div class="card-body">
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
     	     <form action="{{ route('changepassword-post') }}" autocomplete="off" id="changepassword_form" method="POST" id="changepassword">
			<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
              <div class="form-group">
				<input type="password" class="form-control password" value="<?php if(!empty($all_data['oldpassword'])){ ?>{{$all_data['oldpassword']}}<?php }else if(old('oldpassword')){ ?>{{ old('oldpassword')}} <?php } ?>" id="oldpassword" placeholder="Old Password" name="oldpassword">
				@if ($errors->has('oldpassword'))
					<span class="invalid-feedback " role="alert">
						<strong class="error">{{ $errors->first('oldpassword') }}</strong>
					</span>
				@endif
				
				@if ($password_error = Session::get('password_error'))
					 <div class="invalid-feedback">
					   <strong class="error">{{ $password_error }}</strong>
					 </div>
				 @endif
				 
			  </div>
			  <div class="form-group">
				<p style='color:green'><br>Note: Passwords must contain at least 8 characters, including one special character, one uppercase, one lowercase letters and one number.</p>
							</div>
			   <div class="form-group">
				<input type="password" class="form-control password" value="<?php if(!empty($all_data['newpassword'])){ ?>{{$all_data['newpassword']}}<?php }else if(old('newpassword')){ ?>{{ old('newpassword')}} <?php } ?>" id="newpassword" placeholder="New Password" name="newpassword">
				@if ($errors->has('newpassword'))
					<span class="invalid-feedback " role="alert">
						<strong class="error">{{ $errors->first('newpassword') }}</strong>
					</span>
				@endif
				
				@if ($password_error = Session::get('password_error'))
					 <div class="invalid-feedback">
					   <strong class="error">{{ $password_error }}</strong>
					 </div>
				 @endif
				 
			  </div>
			  
			   <div class="form-group">
				<input type="password" class="form-control password" value="<?php if(!empty($all_data['confirmpassword'])){ ?>{{$all_data['confirmpassword']}}<?php }else if(old('confirmpassword')){ ?>{{ old('confirmpassword')}} <?php } ?>" id="confirmpassword" placeholder="Confirm Password" name="confirmpassword">
				@if ($errors->has('confirmpassword'))
					<span class="invalid-feedback " role="alert">
						<strong class="error">{{ $errors->first('confirmpassword') }}</strong>
					</span>
				@endif
				
				@if ($password_error = Session::get('password_error'))
					 <div class="invalid-feedback">
					   <strong class="error">{{ $password_error }}</strong>
					 </div>
				 @endif
				 
			  </div>
			  
			  <center>
        <button type="submit" value="Save" class="btn btn-primary">
		<i class="fa fa-check" aria-hidden="true"></i>&nbsp; Save</button>
        <a href="{{url('home')}}" class="btn btn-outline-secondary">
		<i class="fa fa-times" aria-hidden="true"></i>&nbsp; Cancel</a>
		</center>
		
			
        </form> 

                </div>
            </div>
         </div>
     </div>

<style>
.invalid-feedback {
    display: block;
    width: 100%;
    margin-top: 0.25rem;
    font-size: 80%;
    color: #e3342f;
}
</style>
@endsection
	
	