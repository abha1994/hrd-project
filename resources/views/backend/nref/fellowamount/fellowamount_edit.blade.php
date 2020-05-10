@extends('layouts.master')

@section('container')
 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ url('dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Fellow Amount List</li>
      </ol>
	 
 <div class="card card-login mx-auto mt-5 " style="max-width: 28rem;">
	
	
<?php //dd($data['role_data']);?>
     <div class="card-header text-center"><h4 style="color: #2384c6;">Update Fellow Amount</h4></div>
      <div class="card-body">
     	<form  enctype="multipart/form-data"  action="{{ route('update-fellowamount',$data['fellow_amount_data']->fellow_amount_id) }}" class=""  onsubmit="this.elements['submit'].disabled=true;" autocomplete="off" id="internship_form" method="POST" >
			<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
			
				           

							<div class="form-group">
								<div class="row">
								    <div class="col-md-12">
										<input type="text"   class="form-control" value="<?php if(!empty($data['fellow_amount_data'])) { echo $data['fellow_amount_data']->financial_year;}elseif(!empty($all_data['financial_year'])){ ?>{{$all_data['financial_year']}}<?php }else if(old('financial_year')){ ?>{{ old('financial_year')}} <?php } ?>" id="financial_year"  name="financial_year" placeholder="Financial Year*" readonly>
										@if ($errors->has('financial_year'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('financial_year') }}</strong>
											</span>
										@endif
								    </div>
								</div>
<br>								
								<div class="row">
								    <div class="col-md-12">
										<input type="text"   class="form-control" value="<?php if(!empty($data['fellow_amount_data'])) { echo $data['fellow_amount_data']->course_name;}elseif(!empty($all_data['course_name'])){ ?>{{$all_data['course_name']}}<?php }else if(old('course_name')){ ?>{{ old('course_name')}} <?php } ?>" id="course_name"  name="course_name" placeholder="Course Name*" readonly>
										@if ($errors->has('course_name'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('course_name') }}</strong>
											</span>
										@endif
								    </div>
								</div> 
								<br>
								<div class="row">
								    <div class="col-md-12">
										<input type="text"   class="form-control" value="<?php if(!empty($data['fellow_amount_data'])) { echo $data['fellow_amount_data']->amount;}elseif(!empty($all_data['amount'])){ ?>{{$all_data['role_name']}}<?php }else if(old('amount')){ ?>{{ old('amount')}} <?php } ?>" id="amount"  name="amount" placeholder="Amount*">
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
										<input type="text"   class="form-control" value="<?php if(!empty($data['fellow_amount_data'])) { echo $data['fellow_amount_data']->validity_period;}elseif(!empty($all_data['validity_period'])){ ?>{{$all_data['validity_period']}}<?php }else if(old('validity_period')){ ?>{{ old('validity_period')}} <?php } ?>" id="validity_period"  name="validity_period" placeholder="Validity Period*">
										@if ($errors->has('validity_period'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('validity_period') }}</strong>
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
	
	