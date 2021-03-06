@extends('layouts.master')

@section('container')

 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ url('dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Link Officer List</li>
      </ol>
	 
      <div class="card card-login mx-auto mt-5 " style="max-width: 34rem;">
	
     <div class="card-header text-center"><h4 style="color: #2384c6;">Create Link Officer</h4></div>
      <div class="card-body">
     	<form  enctype="multipart/form-data"  action="{{ route('link-officer.store') }}" class=""  onsubmit="this.elements['submit'].disabled=true;" autocomplete="off" id="internship_form" method="POST" >
			<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
			
				           

							<div class="form-group">
								<div class="row">
								   <div class="col-md-6">
										<select class="form-control" id="officer_id"  name="officer_id" onchange="get_officer_id(this)" >
											<option value="">Select Officer*</option>
											<?php foreach($data['officer_data'] as $v){?>
											<option value="<?php echo $v->id;?>"
                                                     <?php 
														if(old('officer_id') == $v->id){
															   echo "Selected";
															}else{
															   echo "";
															}	
													?>
													><?php echo $v->name;?></option>
											<?php } ?>
										</select>
										<div id="error_officer"></div>
									    @if ($errors->has('officer_id'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('officer_id') }}</strong>
											</span>
										@endif
								    </div>
									
									<div class="col-md-6">
										<select class="form-control" id="link_officer_id"  name="link_officer_id"  onchange="get_link_officer_id(this)">
											<option value="">Select Link Officer*</option>
											<?php foreach($data['link_officer_data'] as $v){?>
											<option value="<?php echo $v->id;?>" 
											<?php 
														if(old('link_officer_id') == $v->id){
															   echo "Selected";
															}else{
															   echo "";
															}	
													?>
													><?php echo $v->name;?></option>
											<?php } ?>
										</select>
										<div id="error_link_officer"></div>
									    @if ($errors->has('link_officer_id'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('link_officer_id') }}</strong>
											</span>
										@endif
								    </div>
									
								</div> 
							</div>
							
							
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<input type="text"  class="form-control" value="<?php if(!empty($all_data['valid_from'])){ ?>{{$all_data['valid_from']}}<?php }else if(old('valid_from')){ ?>{{ old('valid_from')}} <?php } ?>" id="datepicker_search_from" placeholder="Valid From*" name="valid_from">
									@if ($errors->has('valid_from'))
										<span class="invalid-feedback " role="alert">
											<strong>{{ $errors->first('valid_from') }}</strong>
										</span>
									@endif
								</div>
								<div class="col-md-6">
									<input type="text"  class="form-control" value="<?php if(!empty($all_data['valid_to'])){ ?>{{$all_data['valid_to']}}<?php }else if(old('valid_to')){ ?>{{ old('valid_to')}} <?php } ?>" id="dt21" placeholder="Valid To*" name="valid_to">
									@if ($errors->has('valid_to'))
										<span class="invalid-feedback " role="alert">
											<strong>{{ $errors->first('valid_to') }}</strong>
										</span>
									@endif
								</div>
							</div> 
						</div>
							
							<hr>
							<center>
								<div class="form-group" >
								   <input class="btn btn-primary" type="submit"  name="submit" value="Submit">
								   <button class="btn btn-primary"style="background-color: #ffffff;" ><a href="{{ URL('link-officer')}}">Cancel</a></button>
								</div> 
							</center>
							
				    </form>
                </div>
            </div>
         </div>
     </div>

@endsection
	
	