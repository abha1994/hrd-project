@extends('layouts.master')

@section('container')
  <script src="{{ asset('public/js/internship_validation.js') }}"></script>
 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb"style="" >
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Internship Form</li>
      </ol>
	   <div class="intern_title">
	    Ministry will provide internship opportunity to facilitate students pursuing under graduate/graduate/post graduate degrees or research scholars enrolled in recognized institutes/universities with in India or abroad, as "Interns". The students of various Engineering, Science, Management, law and other streams may undertake internship in the Ministry and in organizations under its aegis to understand various activities of the Ministry to become Researchers/Managers in renewable energy area. These interns will be attached with the senior level officers of the Ministry in various Programme Divisions.
	 </div>
	 
	
      <!-- Icon Cards-->
	   <div class="card card-login mx-auto mt-5 " style="max-width: 65rem; margin-bottom: 28px;">
	     @if ($message = Session::get('success'))
		<div class="alert alert-success alert-block" style="">
	        <button type="button" class="close" data-dismiss="alert">×</button>	
			<strong style="color: #343a40;font-size: 12px;">{{ $message }}</strong>
		</div>
		@endif


		@if ($message = Session::get('error'))
		<div class="alert alert-danger alert-block">
	        <button type="button" class="close" data-dismiss="alert">×</button>	
			<strong>{{ $message }}</strong>
		</div>
		@endif
							
	 <?php 
            $file_experience_error = Session::get('ex_error');
            $all_data = Session::get('all_data');
		    $loginuser_data = $data['loginuser_data'];
	 ?>
	 <marquee behavior="scroll" z-index:99;="" width="100%" height="30px" scrollamount="3" direction="left" style="background:rgba(0,0,0,.03)"><h3><span style="color:#FF0000;">The internship will be on unpaid basis. No stipend will be provided to interns. </span></h3></marquee>
     <div class="card-header text-center"><h4 style="    color: #2384c6;">Internship Form</h4></div>
      <div class="card-body">
     	<form  enctype="multipart/form-data"  action="{{ url('internship-form-post') }}" class=""  autocomplete="off" id="internship_form" method="POST" >
			<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
		
			
				            <div class="form-group">
								<div class="row">
									<div class="col-md-4">
										<input type="text" readonly class="form-control"   
										value="<?php if(!empty($loginuser_data->first_name)){ ?>{{ $loginuser_data->first_name }} <?php } ?>" id="first_name"  name="first_name">
									</div>
									
									<div class="col-md-4">
										<input type="text" readonly class="form-control" value="<?php if(!empty($loginuser_data->middle_name)){ ?>{{ $loginuser_data->middle_name }} <?php } ?>"  id="middle_name" placeholder="Middle Name" name="middle_name">
									</div>
									<div class="col-md-4">
										<input type="text" readonly class="form-control"  value="<?php if(!empty($loginuser_data->last_name)){ ?>{{ $loginuser_data->last_name }} <?php } ?>" id="last_name" placeholder="Last Name" name="last_name">
									</div>
								</div> 
							</div>

							
							<div class="form-group">
								<div class="row">
									<div class="col-md-3">
                                      <input type="text" readonly class="form-control" value="<?php if(!empty($loginuser_data->email_id)){ ?>{{ $loginuser_data->email_id }} <?php } ?>"  id="email_id"  name="email_id">
									</div>
									<div class="col-md-3">
										<input class="date form-control"  type="text" readonly value="<?php if(!empty($loginuser_data->dob)){ ?>{{ $loginuser_data->dob }} <?php } ?>" name="dob" id="datepicker">
									</div>
									<div class="col-md-3">
									<?php $gender_arr = array( '1'=>'Male' ,'2'=>'Female','0'=>'Others')?>
										<select readonly class="form-control" name="gender"  id="gender">
										    <option value="">Select Gender*</option>
											@foreach($gender_arr as $key=>$val)
											<option value="{{$key}}"  
											<?php 
											if(!empty($loginuser_data->gender)){
												if($loginuser_data->gender == $key){
													echo "Selected";
												}
											}
											?>>{{$val}}</option>
											@endforeach
								   	    </select>
									</div>
									<div class="col-md-3">
							           <input type="text" readonly class="form-control"  value="<?php if(!empty($loginuser_data->mobile_no)){ ?>{{ $loginuser_data->mobile_no }} <?php } ?>"  id="mobile_no" placeholder="Mobile No.*" name="mobile_no">
								    </div>
								</div> 
							</div>
							<div class="form-group">
								<div class="row">
								<div class="<?php if($loginuser_data->countrycd != "99"){?> col-md-12 <?php }else{ ?> col-md-4 <?php } ?>">
								@foreach($data['country_data'] as $val) 
								<?php if($loginuser_data->countrycd == $val->countrycd){?>
								<input type="hidden" readonly class="form-control"  value="<?php echo $val->countrycd ?>"  id="countrycd" name="countrycd">
								<?php } ?>
								@endforeach 
									<select disabled class="form-control"  > 
										<option value="">Select Country*</option>
											@foreach($data['country_data'] as $val) 
												<option value="{{$val->countrycd}}" 
												 <?php 
												 if(!empty($loginuser_data->countrycd)){
													if($loginuser_data->countrycd == $val->countrycd){
														echo "Selected";
													}	
												}
												?>
													>{{$val->name}}</option>
											@endforeach 
										
									</select>
								</div>
								
								
								<?php if($loginuser_data->countrycd == "99"){?>
								    <div class="col-md-4 statecd">
									
									@foreach($data['state_data'] as $val) 
									<?php if($loginuser_data->statecd == $val->statecd){?>
									<input type="hidden" readonly class="form-control"  value="<?php echo $val->statecd ?>"  id="statecd" name="statecd">
									<?php } ?>
									@endforeach 
								
										<select disabled class="form-control" >
											<option value="">Select State*</option>
												@foreach($data['state_data'] as $val) 
												<option value="{{$val->statecd}}" 
												   <?php 
													 if(!empty($loginuser_data->statecd)){
														if($loginuser_data->statecd == $val->statecd){
															echo "Selected";
														}	
													}
													?>>{{$val->state_name}}</option>
												@endforeach 
											</select>
									</div>
										
									<div class="col-md-4 districtcd">
									@foreach($data['district_data'] as $val) 
									<?php if($loginuser_data->districtcd == $val->districtcd){?>
									<input type="hidden" readonly class="form-control"  value="<?php echo $val->districtcd ?>"  id="districtcd" name="districtcd">
									<?php } ?>
									@endforeach 
										   <select disabled class="form-control">
												<option value="">Select District*</option>
												@foreach($data['district_data'] as $val) 
												   <option value="{{$val->districtcd}}" 
												   <?php 
													 if(!empty($loginuser_data->districtcd)){
														if($loginuser_data->districtcd == $val->districtcd){
															echo "Selected";
														}	
													}
													?>>{{$val->district_name}}</option>
												@endforeach 
											</select>
									   </div>
								<?php } ?>
								</div> 
							</div>
							
							<div class="form-group">
								<div class="row">
									
									 <div class="col-md-4">
										<input type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase();" value="<?php  if(old('father_name')){ ?>{{ old('father_name')}} <?php } ?>" id="father_name" placeholder="Father's Name*" name="father_name">
										@if ($errors->has('father_name'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('father_name') }}</strong>
											</span>
										@endif
									</div>
									
							        <div class="col-md-3">
										<input name="std_code" maxlength="6" value="<?php if(old('std_code')){ ?>{{ old('std_code')}}<?php } ?>" onkeypress="return isNumberKey(event)"  class="form-control" type="text" id="std_code"  class="form-control" placeholder="STD code" > 
									</div>
								    <div class="col-md-1">
										<span class="input-group-addon">-</span>
									</div>
									<div class="col-md-4">
										<input name="landline" value="<?php if(old('landline')){ ?>{{ old('landline')}}<?php } ?>" onkeypress="return isNumberKey(event)"  maxlength="10" class="form-control" type="text" id="landline" class="form-control" placeholder="Landline" >           
				                    </div>
				                </div> 
							</div>
				

                             <div class="form-group">
								<div class="row">
								   
									<?php if($loginuser_data->countrycd != "99"){?>
									<div class="col-md-4">
                                      <input type="text" class="form-control" value="<?php if(!empty($all_data['sipcode'])){ ?>{{$all_data['sipcode']}}<?php }else if(old('sipcode')){ ?>{{ old('sipcode')}}<?php } ?>" onkeypress="return isNumberKey(event)" id="sipcode" placeholder="Sipcode*" name="sipcode">
										@if ($errors->has('sipcode'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('sipcode') }}</strong>
											</span>
										@endif
									</div>
									
									<?php }else{ ?>
									<div class="col-md-4">
                                      <input type="text" class="form-control" value="<?php if(!empty($all_data['pincode'])){ ?>{{$all_data['pincode']}}<?php }else if(old('pincode')){ ?>{{ old('pincode')}}<?php } ?>" onkeypress="return isNumberKey(event)"  maxlength="6"  id="pincode" placeholder="Pincode*" name="pincode">
										@if ($errors->has('pincode'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('pincode') }}</strong>
											</span>
										@endif
									</div>
									<?php } ?>
									
									<div class="col-md-4">
									<?php $categories_arr = array( '1'=>'General' ,'2'=>'OBC','3'=>'SC','4'=>'ST')?>
										<select name="categories" id="categories" class="form-control">
										    <option value="">Select Category*</option>
											@foreach($categories_arr as $key=>$val)
											<option value="{{ $key }}"  <?php 
														if(!empty($all_data['categories'])){
														   if($all_data['categories'] == $key){
															   echo "Selected";
														   }else{
															   echo "";
														   }
														}elseif(!empty(old('categories'))){
															if(old('categories') == $key){
															   echo "Selected";
															}else{
															   echo "";
															}	
														}   
													?>
													>{{ $val }}</option>
										    @endforeach
										</select>
										@if ($errors->has('categories'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('categories') }}</strong>
											</span>
										@endif
									</div>
									<div class="col-md-4">
										<textarea col="1" rows="1" onkeyup="this.value = this.value.toUpperCase();" class="form-control" value="" id="address" placeholder="Address*" name="address"><?php if(!empty($all_data['address'])){ ?>{{$all_data['address']}}<?php }else if(old('address')){ ?>{{ old('address')}} <?php } ?></textarea>
										@if ($errors->has('address'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('address') }}</strong>
											</span>
										@endif
									</div>
								</div> 
							</div>
							
							
							
								<!------------------------->
							
							    <div class="form-group">
										
									 <b>Whether you are employed?*</b>
									 <input type="radio" onclick="" name="catg" id="emp_no"   value="1" checked> <strong>No</strong>
									 <input type="radio" onclick="" name="catg" id="emp_yes"  value="2"><strong>Yes</strong>
							   
								</div>
							   <div id="exp" style="border: 1px solid #d3d7da; padding: 14px;">
							   <div class="form-group">
									
							    <b>Whether you are Govt. employee?*</b>
								<input type="radio" onclick="" name="work_status" id="govtemp_no" value="1" checked> <strong>No</strong>
							    <input type="radio" onclick="" name="work_status" id="govtemp_yes" value="2"><strong>Yes</strong>
								
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-4">
											<input type="text" class="form-control"    value="<?php if(!empty($all_data['organization'])){ ?>{{$all_data['organization']}}<?php }else if(old('organization')){ ?>{{ old('organization')}} <?php } ?>" id="organization" placeholder="Organization Name*" name="organization">
 	
											</select>
											@if ($errors->has('organization'))
												<span class="invalid-feedback " role="alert">
													<strong>{{ $errors->first('organization') }}</strong>
												</span>
											@endif
										</div>
										
										<div class="col-md-8">
											<textarea col="1" rows="1"  class="form-control" value="" id="organization_address" placeholder="Organization Address*" name="organization_address"><?php if(!empty($all_data['organization_address'])){ ?>{{$all_data['organization_address']}}<?php }else if(old('organization_address')){ ?>{{ old('organization_address')}} <?php } ?></textarea>
								         @if ($errors->has('organization_address'))
									     <span class="invalid-feedback " role="alert">
										      <strong>{{ $errors->first('organization_address') }}</strong>
									      </span>
								        @endif
										</div>
									</div> 
								</div>
								<div class="form-group">
								<div class="row">
									<div class="col-md-3">
										<!--label>First Name<em style="color:red">*</em></label-->
										<input type="text" class="form-control"  value="<?php if(!empty($all_data['designation'])){ ?>{{$all_data['designation']}}<?php }else if(old('designation')){ ?>{{ old('designation')}} <?php } ?>" id="designation" placeholder="Designation*" name="designation">
										@if ($errors->has('designation'))
											<span class="invalid-feedback " role="alert">
												<strong >{{ $errors->first('designation') }}</strong>
											</span>
										@endif
									
									</div>
									
									<div class="col-md-4">
										<!--label>Middle Name</label-->
                                         <input type="text" class="form-control"   value="<?php if(!empty($all_data['nature_area'])){ ?>{{$all_data['nature_area']}}<?php }else if(old('nature_area')){ ?>{{ old('nature_area')}} <?php } ?>" id="nature_area" placeholder="Nature of Area*" name="nature_area">	
											@if ($errors->has('nature_area'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('nature_area') }}</strong>
											</span>
										@endif
									</div>
									<div class="col-md-5">
										<!--label>Last Name</label-->
                                          <input type="text" class="form-control"  value="<?php if(!empty($all_data['focus_work'])){ ?>{{$all_data['focus_work']}}<?php }else if(old('focus_work')){ ?>{{ old('focus_work')}} <?php } ?>" id="focus_work" placeholder="Prime Focus of Work*" name="focus_work">									   
											@if ($errors->has('focus_work'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('focus_work') }}</strong>
											</span>
										@endif
									</div>
								</div> 
							</div>
							</div>
								
							<br>
							
							
								<h4>Education Details</h4>

                             <table border="0" class="table table-bordered table-striped table-hover" id="tab0">
                                  <thead style="font-size: 14px; font-weight: 300;line-height: 0.9;">
								  <tr>
                                     <th class="text-center" align="middle">Sr.No.</th>
                                     <th class="text-center">Education Qualification</th>
                                     <th class="text-center">University/Institute</th>
                                     <th class="text-center">Stream</th>
                                     <th class="text-center">Pursuing/Passed</th>
                                     <th class="text-center">Year of Passing</th>
                                     <th class="text-center">Percentage/ CGPA/ Overall Percentage <br><span style="color:#FF0000; font-size:14px;">(If Pursuing)</span></th>
                                     <th class="text-center">Click Add Row for additional qualification</th>
                                 </tr>
                                 </thead>
                                 <tbody id="table_append" class="table_append">
								 <div> 
								 <tr id='addr0'>
                                     <td class="text-center serial">1</td>
                                     <td class="text-center">
                                   <select class="form-control courseid_input" name="course_id[0]"  id="course_id0">
									<option value="">Select Course</option>
									@foreach($data['courses_data'] as $val) 
									   <option value="{{$val->course_id}}"  >{{$val->course_name}}</option>
									@endforeach 
								  </select>
										@if ($errors->has('course_id'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('course_id') }}</strong>
											</span>
										@endif
									
									</td>
                                     <td class="text-center">
									
                                          <input type="text" class="form-control institute_input"  maxlength="50"  value="" id="institute0" placeholder="Enter Institute*" name="institute[0]">									   
											@if ($errors->has('institute'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('institute') }}</strong>
											</span>
										@endif
									</td>
                                     <td class="text-center">
                                     
                                          <input type="text" class="form-control stream_input"  maxlength="50" value="" id="stream0" placeholder="Enter Stream*" name="stream[0]">									   
											@if ($errors->has('stream'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('stream') }}</strong>
											</span>
										@endif
									
									</td>
                                     <td class="text-center">
											<select class="form-control passstatus_input" name="pass_status[0]"  id="pass_status0" onchange="pass_status_check(0)">
											    <option value>Select Status*</option>
												<option value="1">Pursuing</option>
												<option value="2">Passed</option>
											</select>
											@if ($errors->has('pass_status'))
												<span class="invalid-feedback " role="alert">
													<strong>{{ $errors->first('pass_status') }}</strong>
												</span>
											@endif
										
												</td>
                                     <td class="text-center">
										
                                          <input type="text" class="form-control yearcompletion_input" maxlength="4" onkeypress="return isNumberKey(event)"   value="" id="year_completion0" placeholder="Year of Passing*" name="year_completion[0]">									   
											@if ($errors->has('year_completion'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('year_completion') }}</strong>
											</span>
										@endif
									</td>
                                     <td class="text-center">
                                    
										
                                          <input type="text" class="form-control markspercentage_input" maxlength="5" value=""   id="marks_percentage0" placeholder="Percentage*" name="marks_percentage[0]">									   
											@if ($errors->has('marks_percentage'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('marks_percentage') }}</strong>
											</span>
										@endif
									
									</td>
                                     <td class="text-center">  
									    <div class="form-group button-group ">
									     <input type="button" id="addrow" class="add_button" name="addrow" value="Add Row">
						                </div>
									</td>
                                 </tr>
                              </div>
                            </tbody>
                        </table>
							
							
							
							
							
							
							
							
							
							
							
							<!----------------------->
							
							
							  <div class="form-group">
								<div class="row">
									
									<div class="col-md-6">
									<?php $area_interest = array( '1'=>'Solar PV' ,'2'=>'Solar Thermal','3'=>'Wind','4'=>'Small Hydro','5'=>'Biomass','6'=>'Biogas'
									,'7'=>'Waste to Energy','8'=>'Hydrogen','9'=>'Energy Storage','10'=>'Policy','11'=>'Environment Aspect','12'=>'Hydrogen &amp; Fuel Cell','13'=>'Finance')?>
									
                                        <select class="form-control" name="area_interest"  id="area_interest">
										    <option value="">Select Area of Interest*</option>
											@foreach($area_interest as $key=>$val)
											<option value="{{$val}}"  <?php 
														if(!empty($all_data['area_interest'])){
														   if($all_data['area_interest'] == $val){
															   echo "Selected";
														   }else{
															   echo "";
														   }
														}elseif(!empty(old('area_interest'))){
															if(old('area_interest') == $val){
															   echo "Selected";
															}else{
															   echo "";
															}	
														}   
													?> >{{$val}}</option>
											@endforeach
								   	    </select>
										@if ($errors->has('area_interest'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('area_interest') }}</strong>
											</span>
										@endif
									</div>
									<div class="col-md-6">
									<?php $intern_place = array( '1'=>'MNRE' ,'2'=>'NISE-Gurugram','3'=>'NIWE-Chennai','4'=>'NIBE-Kapurthala','5'=>'SECI','6'=>'IREDA')?>

                                        <select name="intern_place" id="intern_place" class="form-control">
										    <option value="">Select Desired Place of Internship*</option>
											@foreach($intern_place as $key=>$val)
											<option value="{{ $val }}"  <?php 
														if(!empty($all_data['intern_place'])){
														   if($all_data['intern_place'] == $val){
															   echo "Selected";
														   }else{
															   echo "";
														   }
														}elseif(!empty(old('intern_place'))){
															if(old('intern_place') == $val){
															   echo "Selected";
															}else{
															   echo "";
															}	
														}   
													?>
													>{{ $val }}</option>
										    @endforeach
										</select>
										@if ($errors->has('intern_place'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('intern_place') }}</strong>
											</span>
										@endif
									</div>							
								</div>
							</div>	
							
						  <div class="form-group">
								<div class="row">
									
									<div class="col-md-6">
									<?php $intern_duration = array('2'=>'2 months','3'=>'3 months','4'=>'4 months','5'=>'5 months','6'=>'6 months')?>
									
                                        <select class="form-control" name="intern_duration"  id="intern_duration">
										    <option value="">Select Duration of Internship*</option>
											@foreach($intern_duration as $key=>$val)
											<option value="{{$key}}"  <?php 
														if(!empty($all_data['intern_duration'])){
														   if($all_data['intern_duration'] == $key){
															   echo "Selected";
														   }else{
															   echo "";
														   }
														}elseif(!empty(old('intern_duration'))){
															if(old('intern_duration') == $key){
															   echo "Selected";
															}else{
															   echo "";
															}	
														}   
													?> >{{$val}}</option>
											@endforeach
								   	    </select>
										@if ($errors->has('intern_duration'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('intern_duration') }}</strong>
											</span>
										@endif
									</div>
									<div class="col-md-6">
									<?php 
									date_default_timezone_set('Asia/Kolkata');
	                                $date = date('Y-m-d');
	  
									$month_two = date('Y-m', strtotime("+2 months", strtotime($date)));
									$month_two1 = date('M-Y', strtotime("+2 months", strtotime($date)));
									
									$month_three = date('Y-m', strtotime("+3 months", strtotime($date)));
									$month_three1 = date('M-Y', strtotime("+3 months", strtotime($date)));
									
									$month_four = date('Y-m', strtotime("+4 months", strtotime($date)));
									$month_four1 = date('M-Y', strtotime("+4 months", strtotime($date)));
									
									$desired_month_year = array($month_two=>$month_two1 ,$month_three=>$month_three1,$month_four=>$month_four1)?>

                                        <select name="desired_month_year" id="desired_month_year" class="form-control">
										    <option value="">Select Desired Month & Year of Internship*</option>
											@foreach($desired_month_year as $key=>$val)
											<option value="{{ $key }}"  <?php 
														if(!empty($all_data['desired_month_year'])){
														   if($all_data['desired_month_year'] == $key){
															   echo "Selected";
														   }else{
															   echo "";
														   }
														}elseif(!empty(old('desired_month_year'))){
															if(old('desired_month_year') == $key){
															   echo "Selected";
															}else{
															   echo "";
															}	
														}   
													?>
													>{{ $val }}</option>
										    @endforeach
										</select>
										@if ($errors->has('desired_month_year'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('desired_month_year') }}</strong>
											</span>
										@endif
									</div>							
								</div>
							</div>	
							
							
							
						
							<div class="form-group">
								<div class="row">
									<div class="col-md-12">
										 <textarea name="writeup_interest" id="writeup_interest" placeholder="Writeup on Interested Area in Internship (maximum 1000 Characters)*" class="form-control" ><?php if(!empty($all_data['writeup_interest'])){ ?>{{$all_data['writeup_interest']}}<?php }else if(old('writeup_interest')){ ?>{{ old('writeup_interest')}} <?php } ?></textarea>
										<span style="font-size: 12px;color: red;float: right;" id='remainingC'></span>
										@if ($errors->has('writeup_interest'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('writeup_interest') }}</strong>
											</span>
										@endif
									</div>
								</div> 
							</div>
							
							<div class="form-group">
								<div class="row">
									<div class="col-md-12">
										<textarea name="remarks" id="remarks" class="form-control"  placeholder="Any Other Information (Experience/ Publications/ Patents/ Awards etc.) (maximum 1000 Characters)*"><?php if(!empty($all_data['remarks'])){ ?>{{$all_data['remarks']}}<?php }else if(old('remarks')){ ?>{{ old('remarks')}} <?php } ?></textarea><span style="font-size: 12px;color: red;float: right;" id='remainingCh'></span>
										@if ($errors->has('remarks'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('remarks') }}</strong>
											</span>
										@endif
									</div>
								</div> 
							</div>
							
							<div class="form-group">
								<div class="row">
								<div class="col-md-6">
									<?php $id_proof = array( '1'=>'VoterID' ,'2'=>'Driving Licence','3'=>'Passport','4'=>'College Id Card')?>
                                       <label for="name" class="control-label" style="font-size: 13px;">Select ID Proof Type<span>*</span></label>
                                        <select name="id_proof" id="id_proof" class="form-control">
										 <option value="">Select Id Proof Type*</option>
											@foreach($id_proof as $key=>$val)
											<option value="{{ $key }}"  <?php 
														if(!empty($all_data['id_proof_type'])){
														   if($all_data['id_proof_type'] == $key){
															   echo "Selected";
														   }else{
															   echo "";
														   }
														}elseif(!empty(old('id_proof'))){
															if(old('id_proof') == $key){
															   echo "Selected";
															}else{
															   echo "";
															}	
														}   
													?>
													>{{ $val }}</option>
										    @endforeach
										</select>
										@if ($errors->has('id_proof'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('id_proof') }}</strong>
											</span>
										@endif
									</div>	
									<div class="col-md-6">
									<label for="name"  style="font-size: 13px;" class="control-label">ID Proof<span>*</span></label>
										<input name="file_id_proof" type="file" class="form-control" value="{{ old('file_id_proof')}}" id="file_id_proof">
                                        <label style="color:#FF0000; font-size:11px;"> (File Format accepts: PDF &amp; Maximum Size: 1MB)</label><br><span  style="    font-size: 12px;"id="file_id_proof_error"> </span>										
									    @if ($errors->has('file_id_proof'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('file_id_proof') }}</strong>
											</span>
										@endif
									</div>
								</div>
							<div>
									
							<div class="form-group">
								<div class="row">
									<div class="col-md-6">
									<label for="name" class="control-label" style="font-size: 13px;">If Any(Experience/ Publication/ Patents/ Awards etc.)</label>
									<input name="file_experience" type="file" class="form-control" value="{{ old('file_experience')}}" id="file_experience">
									<span style="color:#FF0000; font-size:11px;"> (File Format accepts: PDF &amp; Maximum Size: 5MB)</span><br><span  style="    font-size: 12px;"id="file_experience_error"> </span>		
										@if ($errors->has('file_experience'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('file_experience') }}</strong>
											</span>
										@endif
										@if ($file_experience_error = Session::get('ex_error'))
										 <div class="alert" style="color:red">
										   <strong>{{ $file_experience_error }}</strong>
										 </div>
									   @endif
                                    </div>
									
			
									<div class="col-md-6">
										<label for="name"  style="font-size: 13px;" class="control-label">Candidate Photograph<span>*</span></label> 
										<input name="file_photo" type="file" class="form-control" id="file_photo" value="{{ old('file_photo')}}">
										<label style="color:#FF0000; font-size:11px;"> (File Format accepts: JPEG/JPG &amp; Maximum Size: 100KB)</label><br><span  style="    font-size: 12px;"id="file_photo_error"> </span>		
										@if ($errors->has('file_photo'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('file_photo') }}</strong>
											</span>
										@endif
									</div>
			
			
								</div> 
							</div>
							
							<hr>
							<center>
								<div class="form-group" >
								    <p style="padding-top:5px; color:#993333;font-weight: bold;">Your Registration details are non editable once submitted. Please Verify that the above details are correct.</p>
									
									<input class="btn btn-primary " type="submit"  value="Submit">
									<input name="preview" type="button" id="preview" class="btn btn-primary" value="Preview" onclick="preview_display();">
								</div> 
							</center>
							
				    </form>
                </div>
            </div>
         </div>
     </div></div></div>


  <style>
  .error{
	  color:red;
  }
  </style>
    <!-- /.container-fluid-->
@endsection
	
	