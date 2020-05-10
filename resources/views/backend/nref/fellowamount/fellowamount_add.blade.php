@extends('layouts.master')

@section('container')
 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ url('dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Fellow Amount</li>
      </ol>
 <div class="card card-login mx-auto mt-5 " style="max-width: 28rem;">
	
	

     <div class="card-header text-center"><h4 style="color: #2384c6;">Create Fellow Amount</h4></div>
      <div class="card-body">
     	<form  enctype="multipart/form-data"  action="{{ route('create-fellowamount') }}" class=""  onsubmit="this.elements['submit'].disabled=true;" autocomplete="off" id="internship_form" method="POST" >
			<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
			
				           

							<div class="form-group">
								<div class="row">
								    <div class="col-md-12">
										<select class="form-control" name="financial_year" id="financial_year" placeholder="Financial Year*">
										<option value="2019-2020">2019-2020</option>
										<option value="2020-2021">2020-2021</option>
										<option value="2021-2022">2021-2022</option>
										<option value="2021-2022">2022-2023</option>
										<option value="2021-2022">2023-2024</option>
										@if ($errors->has('financial_year'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('financial_year') }}</strong>
											</span>
										@endif
										</select>
								    </div>
								</div>
								<br>
                                <div class="row">
								    <div class="col-md-12">
										 <select class="form-control" name="course_id"  id="course_id">
									<option value="">Select Course</option>
									@foreach($data['courses_data'] as $val) 
									   <option value="{{$val->course_id}}"  >{{$val->course_name}}</option>
									@endforeach 
								  </select>
								    </div>
								</div>
								<br>
                                <div class="row">
								    <div class="col-md-12">
										<input type="text"  class="form-control" value="<?php if(!empty($all_data['amount'])){ ?>{{$all_data['amount']}}<?php }else if(old('amount')){ ?>{{ old('amount')}} <?php } ?>" id="amount"  name="amount" placeholder="Amount*">
										@if ($errors->has('amount'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('amount') }}</strong>
											</span>
										@endif
								    </div>
								</div>
								<br>
                                <div class="row">
								    <div class="col-md-12">
										<input type="text"  class="form-control" value="<?php if(!empty($all_data['validity_period'])){ ?>{{$all_data['validity_period']}}<?php }else if(old('validity_period')){ ?>{{ old('validity_period')}} <?php } ?>" id="validity_period"  name="validity_period" placeholder="Validity Period*">
										@if ($errors->has('role_name'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('role_name') }}</strong>
											</span>
										@endif
								    </div>
								</div>								
							</div>
							
							
						
							
						
							
							<hr>
							<center>
								<div class="form-group" >
								   <input class="btn btn-primary" type="submit"  name="submit" value="Submit">
								   <button class="btn btn-primary"style="background-color: #ffffff;" ><a href="{{ URL('fellowamount-list')}}">Cancel</a></button>
								</div> 
							</center>
							
				    </form>
                </div>
            </div>
         </div>
     </div>

@endsection
	
	