@extends('layouts.master')
@section('container')
<!--script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/-->

				
				
				
				
    <div class="content-wrapper" >
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ url('dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Update Officer</li>
      </ol>
		  <div class="card card-login mx-auto mt-5 " style="max-width: 65rem; margin-bottom: 28px;">     
   <div class="card-header text-center"><h4 style="    color: #2384c6;">Update Officer</h4></div>
	  <div class="card-body">
        			<br />
        			
        			{!! Form::model($user, ['method' => 'PATCH','route' => ['user.update', $user->id]]) !!}
            		
					<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
						<div class="form-group">
							<div class="row">
							    <div class="col-md-4">
									<input type="text"  class="form-control  @error('officer_name') is-invalid @enderror" value="{{ $user->name }}" id="officer_name"  name="officer_name" placeholder="Officer Name*">

									@error('officer_name')
										<span class="invalid-feedback " role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
							    </div>
									
								<div class="col-md-4">
									<input type="text"  class="form-control @error('designation') is-invalid @enderror" value=" {{ $user->designation }}"  id="designation" placeholder="Designation*" name="designation">
									    @error('designation')
											<span class="invalid-feedback " role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
								</div>
								<div class="col-md-4 input-group date" data-provide="datepicker">
										<input class="date form-control @error('dob') is-invalid @enderror" type="text" readonly value="{{ date('d-m-Y', strtotime($user->dob)) }}" name="dob" placeholder="Date Of Birth*" id="dob">
										<div class="input-group-addon">
								        	<span class="glyphicon glyphicon-th"></span>
								    	</div>
										@error('dob')
											<span class="invalid-feedback " role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
								</div>
							</div> 
						</div>
							
						<div class="form-group">
							<div class="row">
							   <div class="col-md-6">
									<input type="text"  class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}"  id="email" placeholder="Email Id*" name="email">
									    @error('email')
											<span class="invalid-feedback " role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
								</div>
									
								
							    <div class="col-md-6">
									<input type="text"  class="form-control @error('mobile_no') is-invalid @enderror"  maxlength="10" value="{{ $user->mobile_no }}" id="mobile_no" placeholder="Mobile No*" name="mobile_no">
									    @error('mobile_no')
											<span class="invalid-feedback " role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
								    </div>
                            </div> 
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6 input-group date">
									<input type="text"  class="form-control @error('joining_date') is-invalid @enderror" value="{{ date('d-m-Y', strtotime($user->joining_date)) }}"  placeholder="Joining Date*" name="joining_date" id="datepicker_search_from">
									<div class="input-group-addon">
								        <span class="glyphicon glyphicon-th"></span>
								    </div>
									@error('joining_date')
										<span class="invalid-feedback " role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
								<div class="col-md-6 input-group date" >
									<input type="text"  class="form-control @error('transfer_date') is-invalid @enderror" value="{{ date('d-m-Y', strtotime($user->transfer_date)) }}"  placeholder="Transfer Date*" name="transfer_date" id="dt21">
									<div class="input-group-addon">
								        <span class="glyphicon glyphicon-th"></span>
								    </div>
									@error('transfer_date')
										<span class="invalid-feedback " role="alert">
											<strong>{{ $message}}</strong>
										</span>
									@enderror
								</div>
								
							</div> 
						</div>	
						<div class="form-group">
							<div class="row">
								   
								<div class="col-md-6">
									 

									 <select class="form-control" name="roles">  
									   <option>Select</option>
									   <?php foreach($roles as $k=>$v){?>
									   <option value="<?php echo $k;?>" <?php if($user->role == $k){ echo "Selected";}?>><?php echo $v;?></option>
									   <?php } ?>
									</select>
								    @error('roles')
										<span class="invalid-feedback " role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
							    </div>

									<div class="col-md-6">								
										<select class="form-control @error('status') is-invalid @enderror" name="status"  id="status" >
										    <option value="-1">Select Status*</option>	
										    <option value="1" {{ $user->status == 1 ? 'selected' : '' }} >Active</option>	
										    <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Inactive</option>											
								   	    </select>
									    @error('status')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
								    </div>
								</div> 
							</div>
							
						
						<hr>
						<center>
							<div class="form-group" >
							   <input class="btn btn-primary" type="submit"  name="submit" value="Update">
							   <a class="btn btn-secondary" href="{{ URL('user')}}">Cancel</a>
							</div> 
						</center>							
				    {!! Form::close() !!}
        		</div> 
    		</div>
		</div>
	</div>

@endsection




















