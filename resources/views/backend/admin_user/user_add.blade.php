@extends('layouts.master')
@section('container')

 <div class="content-wrapper" >
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ url('home')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Add Officer</li>
      </ol>
	  	  <div class="card card-login mx-auto mt-5">     
   <div class="card-header text-center"><h4 class="mt-2">Add Officer</h4></div>
	  <div class="card-body">
        			<br />
        			{!! Form::open(['route'=>'user.store','method'=>'post']) !!}
            		<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
						<div class="form-group">
							<div class="row">
							    <div class="col-md-4">
									<input type="text"  class="form-control  @error('officer_name') is-invalid @enderror" value="{{ old('officer_name') }}" id="officer_name"  name="officer_name" placeholder="Officer Name*">

									@error('officer_name')
										<span class="invalid-feedback " role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
							    </div>
									
								<div class="col-md-4">
									<input type="text"  class="form-control @error('designation') is-invalid @enderror" value="{{ old('designation') }}"  id="designation" placeholder="Designation*" name="designation">
									    @error('designation')
											<span class="invalid-feedback " role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
								</div>
								<div class="col-md-4 input-group date" data-provide="datepicker">
										<input class="date form-control @error('dob') is-invalid @enderror" type="text" readonly value="{{ old('dob') }}" name="dob" placeholder="Date Of Birth*" id="dob">
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
									<input type="text"  class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"  id="email" placeholder="Email Id*" name="email">
									    @error('email')
											<span class="invalid-feedback " role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
								</div>
									
								
							    <div class="col-md-6">
									<input type="text"  class="form-control @error('mobile_no') is-invalid @enderror"  maxlength="10" value="{{ old('mobile_no')}}" id="mobile_no" placeholder="Mobile No*" name="mobile_no">
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
								<div class="col-md-6 input-group date" >
									<input type="text"  class="form-control @error('joining_date') is-invalid @enderror" value="{{ old('joining_date') }}"  placeholder="Joining Date*" name="joining_date" id="datepicker_search_from">
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
									<input type="text"  class="form-control @error('transfer_date') is-invalid @enderror" value="{{ old('transfer_date')}}"  placeholder="Transfer Date*" name="transfer_date" id="dt21">
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
									   <option>Select Role*</option>
									   <?php foreach($roles as $k=>$v){?>
									   <option value="<?php echo $k;?>"><?php echo $v;?></option>
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
										    <option value="1">Active</option>	
										    <option value="0">Inactive</option>											
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
							<div class="form-group">
							   <button type="submit" value="Save" class="btn btn-primary">
		                       <i class="fa fa-check" aria-hidden="true"></i>&nbsp; Submit</button>
							   <a class="btn btn-secondary" href="{{ URL('user')}}"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; Cancel</a>
							</div> 
						</center>							
				    {!! Form::close() !!}
        		</div> 
    		</div>
		</div>
	</div>

@endsection




















