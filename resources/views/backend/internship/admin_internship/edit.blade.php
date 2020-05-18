@extends('layouts.master')

@section('container')
  <script src="{{ asset('public/js/internship_validation.js') }}"></script>
 <div class="content-wrapper" >
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ url('home')}}">Dashboard</a>
        </li>
         <li class="breadcrumb-item active">Internship Edit</li>
      </ol>
	     <div class="card mb-3">
	 <div class="card-header text-center"><h4 class="mt-2">Application - <?php if(!empty($data['internship_data']->application_cd)) { echo $data['internship_data']->application_cd;}?></h4></div>
      
	       <div class="container-fluid border-top bg-white card-footer text-muted text-left" id="app">   
 <?php 
    $all_data = Session::get('all_data');
 ?>
  @if ($success = Session::get('success'))
		 <div class="alert alert-success alert-block">
		   <button type="button" class="close" data-dismiss="alert">×</button>	
		   <strong>{{ $success }}</strong>
		 </div>
	     @endif
		 
		  @if ($error = Session::get('error'))
		 <div class="alert alert-danger  alert-block">
		   <button type="button" class="close" data-dismiss="alert">×</button>	
		   <strong>{{ $error }}</strong>
		 </div>
	     @endif
		 
     	<form  enctype="multipart/form-data"  action="{{ route('admin-internship-update',$id) }}" class=""   autocomplete="off" id="internship_form_edit" method="POST" >
			<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
		
<!-----------user_id (Login table primary key id)-------->
		
		<input type="hidden" readonly class="form-control" value="<?php if(!empty($data['internship_data']->user_id)){ ?>{{ $data['internship_data']->user_id }} <?php } ?>" id="user_id"  name="user_id">
			
				            <div class="form-group">
								<div class="row">
									<div class="col-md-4">
										<input type="text" readonly class="form-control"   
										value="<?php if(!empty($data['internship_data']->first_name)){ ?>{{ $data['internship_data']->first_name }} <?php } ?>" id="first_name"  name="first_name">
									</div>
									
									<div class="col-md-4">
										<input type="text"   readonly class="form-control" value="<?php if(!empty($data['internship_data']->middle_name)){ ?>{{ $data['internship_data']->middle_name }} <?php } ?>"  id="middle_name" placeholder="Middle Name" name="middle_name">
									</div>
									<div class="col-md-4">
										<input type="text"   readonly class="form-control"  value="<?php if(!empty($data['internship_data']->last_name)){ ?>{{ $data['internship_data']->last_name }} <?php } ?>" id="last_name" placeholder="Last Name" name="last_name">
									</div>
								</div> 
							</div>

							
							<div class="form-group">
								<div class="row">
									<div class="col-md-3">
                                      <input type="text"  class="form-control" value="<?php if(!empty($data['internship_data']->email)){ ?>{{ $data['internship_data']->email }} <?php } ?>"  id="email"  name="email">
									</div>
									<div class="col-md-3">
										<input class="date form-control"  type="text"  value="<?php if(!empty($data['internship_data']->date_birth)){ ?>{{ $data['internship_data']->date_birth }} <?php } ?>" name="date_birth" id="datepicker">
									</div>
									<div class="col-md-3">
									<?php $gender_arr = array( '1'=>'Male' ,'2'=>'Female','0'=>'Others')?>
										<select  class="form-control" name="gender"  id="gender">
										    <option value="">Select Gender*</option>
											@foreach($gender_arr as $key=>$val)
											<option value="{{$key}}"  
											<?php 
											if(!empty($data['internship_data']->gender)){
												if($data['internship_data']->gender == $key){
													echo "Selected";
												}
											}
											?>>{{$val}}</option>
											@endforeach
								   	    </select>
									</div>
									<div class="col-md-3">
							           <input type="text"  class="form-control"  value="<?php if(!empty($data['internship_data']->mob_number)){ ?>{{ $data['internship_data']->mob_number }} <?php } ?>"  id="mob_number" placeholder="Mobile No.*" name="mob_number">
								    </div>
								</div> 
							</div>
							 <div class="form-group">
								<div class="row">
									<?php //dd($all_data['countrycd']) ?>
									<div class="col-md-4">
										<select name="countrycd" id="countrycd" class="form-control" onchange="hide_state_district(this);" > 
											<option value="">Select Country*</option>
												@foreach($data['country_data'] as $val) 
													<option value="{{$val->countrycd}}" 
													 <?php 
														 if(!empty($data['internship_data']->countrycd)){
															if($data['internship_data']->countrycd == $val->countrycd){
																echo "Selected";
															}	
														}else if(!empty($all_data['countrycd'])){
															if($all_data['countrycd'] == $val->countrycd){
															   echo "Selected";
															   if("99" != $val->countrycd){
															     $a = "display:none";
																}
														   }
														 }elseif(!empty(old('countrycd'))){
																if(old('countrycd') == $val->countrycd){ 
															   echo "Selected";
															   if("99" != $val->countrycd){
															     $a = "display:none"; 
															   }
														  } 
														} else  if("99" == $val->countrycd){
														   echo "Selected";
														 
														 }
														?>
														 >{{$val->name}}</option>
												@endforeach 
											
										</select>
										@if ($errors->has('countrycd'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('countrycd') }}</strong>
											</span>
										@endif
									</div>
									<?php //if($all_data['countrycd'] == null){ ?>
							         <div class="col-md-4 statecd" style="<?php if(!empty($a)){ echo $a ;}?>">
										<select class="form-control" name="statecd"  id="statecd" onchange="fetch_district(this);">
											<option value="">Select State*</option>
												@foreach($data['state_data'] as $val) 
												<option value="{{$val->statecd}}" 
												   <?php 
														if(!empty($data['internship_data']->statecd)){
															if($data['internship_data']->statecd == $val->statecd){
																echo "Selected";
															}	
														}else if(!empty($all_data['statecd'])){
														   if($all_data['statecd'] == $val->statecd){
															   echo "Selected";
														   }else{
															   echo "";
														   }
														}else{
															if(old('statecd') == $val->statecd){
															   echo "Selected";
															}else{
															   echo "";
															}	
														}   
													?>>{{$val->state_name}}</option>
												@endforeach 
											</select>
											
											@if($errors->has('statecd'))
												<span class="invalid-feedback " role="alert">
													<strong>{{ $errors->first('statecd') }}</strong>
												</span>
											@endif
									</div>
								
									<div class="col-md-4 statecd" style="<?php if(!empty($a)){ echo $a ;}?>">
									
										 <?php //if(!empty($all_data['districtcd'])){ ?>
										 	<?php //dd($data['internship_data']->districtcd);?>	
											<select class="form-control" name="districtcd" id="districtcd" >
												<option value="">Select District*</option>
												@foreach($data['district_data'] as $val) 
												   <option value="{{$val->districtcd}}" 
												    <?php 
														if(!empty($data['internship_data']->districtcd)){
															if($data['internship_data']->districtcd == $val->districtcd){
																echo "Selected";
															}	
														}else if(!empty($all_data['districtcd'])){
														   if($all_data['districtcd'] == $val->districtcd){
															   echo "Selected";
														   }else{
															   echo "";
														   }
														}elseif(!empty(old('districtcd'))){
															if(old('districtcd') == $val->districtcd){
															   echo "Selected";
															}else{
															   echo "";
															}	
														}   
													?>>{{$val->district_name}}</option>
												@endforeach 
											</select>
										  <?php //}else{ ?>
											  <!--select name="districtcd" id="districtcd" class="form-control" >
												<option value="">Select District*</option>
												<?php //if(!empty(old('districtcd'))){ ?>
												@foreach($data['district_data'] as $val) 
												   <option value="{{$val->districtcd}}" 
												    <?php 	//if(!empty($data['internship_data']->districtcd)){
															//if($data['internship_data']->districtcd == $val->districtcd){
															//	echo "Selected";
															//}	
														   //}elseif(old('districtcd') == $val->districtcd){
															//   echo "Selected";
															//}else{
															//   echo "";
															//}	
													  
													?>>{{$val->district_name}}</option>
												@endforeach 
												<?php //} ?>
											  </select-->
										  <?php //} ?>
										 
											
											@if ($errors->has('districtcd'))
												<span class="invalid-feedback " role="alert">
													<strong>{{ $errors->first('districtcd') }}</strong>
												</span>
											@endif
									</div>
									<?php // } ?>
							</div>
							</div>
							
							
							
							<div class="form-group">
								<div class="row">
									
									 <div class="col-md-4">
										<input type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase();" value="<?php if(!empty($data['internship_data']->father)){ echo $data['internship_data']->father;}elseif(!empty($all_data['father'])){ ?>{{$all_data['father']}}<?php }else if(old('father')){ ?>{{ old('father')}} <?php } ?>" id="father_name" placeholder="Father's Name*" name="father">
										@if ($errors->has('father'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('father') }}</strong>
											</span>
										@endif
									</div>
									<?php $phone = explode("-", $all_data['phone']);$db_phone = explode("-", $data['internship_data']->phone); ?>
							        <div class="col-md-3">
										<input name="std_code" maxlength="6" value="<?php if(!empty($data['internship_data']->phone)){ echo $db_phone['0'];}elseif(!empty($all_data['phone'])){ ?>{{$phone[0]}}<?php }else if(old('std_code')){ ?>{{ old('std_code')}}<?php } ?>" onkeypress="return isNumberKey(event)"  class="form-control" type="text" id="std_code"  class="form-control" placeholder="STD code" > 
									</div>
								    <div class="col-md-1">
										<span class="input-group-addon">-</span>
									</div>
									<div class="col-md-4">
										<input name="landline" value="<?php if(!empty($data['internship_data']->phone)){ echo $db_phone['1'];}elseif(!empty($all_data['phone'])){ ?>{{$phone[1]}}<?php }else if(old('landline')){ ?>{{ old('landline')}}<?php } ?>" onkeypress="return isNumberKey(event)"  maxlength="10" class="form-control" type="text" id="landline" class="form-control" placeholder="Landline" >           
				                    </div>
				                </div> 
							</div>
				

                             <div class="form-group">
								<div class="row">
								   
									<?php if($data['internship_data']->countrycd != "99"){?>
									<div class="col-md-4">
                                      <input type="text" class="form-control" value="<?php if(!empty($data['internship_data']->pincode)){ echo $data['internship_data']->pincode;}elseif(!empty($all_data['sipcode'])){ ?>{{$all_data['sipcode']}}<?php }else if(old('sipcode')){ ?>{{ old('sipcode')}}<?php } ?>" onkeypress="return isNumberKey(event)" id="sipcode" placeholder="Sipcode*" name="sipcode">
										@if ($errors->has('sipcode'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('sipcode') }}</strong>
											</span>
										@endif
									</div>
									
									<?php }else{ ?>
									<div class="col-md-4">
                                      <input type="text" class="form-control" value="<?php if(!empty($data['internship_data']->pincode)){ echo $data['internship_data']->pincode;}elseif(!empty($all_data['pincode'])){ ?>{{$all_data['pincode']}}<?php }else if(old('pincode')){ ?>{{ old('pincode')}}<?php } ?>" onkeypress="return isNumberKey(event)"  maxlength="6"  id="pincode" placeholder="Pincode*" name="pincode">
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
														  if(!empty($data['internship_data']->categories)){
															  if($data['internship_data']->categories == $key){
																   echo "Selected";
															   }else{
																   echo "";
															   }
														 
														  }elseif(!empty($all_data['categories'])){
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
										<textarea col="1" rows="1" onkeyup="this.value = this.value.toUpperCase();" class="form-control" value="" id="address" placeholder="Address*" name="address"><?php if(!empty($data['internship_data']->address)){ echo $data['internship_data']->address;}elseif(!empty($all_data['address'])){ ?>{{$all_data['address']}}<?php }else if(old('address')){ ?>{{ old('address')}} <?php } ?></textarea>
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
									 <input type="radio" onclick="" name="catg" id="emp_no"   value="1"  <?php if($data['internship_data']->work_status == "") { echo "checked";}else{ echo"";}?>> <strong>No</strong>
									 <input type="radio" onclick="" name="catg" id="emp_yes"  value="2"  <?php if($data['internship_data']->work_status != "") { echo "checked";}else{ echo"";}?>><strong>Yes</strong>
							   
								</div>
								
							  
							   <div id="<?php if($data['internship_data']->work_status == "" ){echo "exp";}else {echo "";}?>" style="border: 1px solid #d3d7da; padding: 14px;">
							   <div class="form-group">
									
							    <b>Whether you are Govt. employee?*</b>
								<input type="radio" onclick="" name="work_status" id="govtemp_no" value="1"  <?php if($data['internship_data']->work_status == "1") { echo "checked";}else{ echo"checked";}?> > <strong>No</strong>
							    <input type="radio" onclick="" name="work_status" id="govtemp_yes" value="2"  <?php if($data['internship_data']->work_status == "2") { echo "checked";}else{ echo"";}?> ><strong>Yes</strong>
								
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-4">
											<input type="text" class="form-control"    value="<?php if(!empty($data['internship_data']->organization)){ echo $data['internship_data']->organization;}elseif(!empty($all_data['organization'])){ ?>{{$all_data['organization']}}<?php }else if(old('organization')){ ?>{{ old('organization')}} <?php } ?>" id="organization" placeholder="Organization Name*" name="organization">
 	
											</select>
											@if ($errors->has('organization'))
												<span class="invalid-feedback " role="alert">
													<strong>{{ $errors->first('organization') }}</strong>
												</span>
											@endif
										</div>
										
										<div class="col-md-8">
											<textarea col="1" rows="1"  class="form-control" value="" id="organization_address" placeholder="Organization Address*" name="organization_address"><?php if(!empty($data['internship_data']->organization_address)){ echo $data['internship_data']->organization_address;}elseif(!empty($all_data['organization_address'])){ ?>{{$all_data['organization_address']}}<?php }else if(old('organization_address')){ ?>{{ old('organization_address')}} <?php } ?></textarea>
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
										<input type="text" class="form-control"  value="<?php if(!empty($data['internship_data']->designation)){ echo $data['internship_data']->designation;}elseif(!empty($all_data['designation'])){ ?>{{$all_data['designation']}}<?php }else if(old('designation')){ ?>{{ old('designation')}} <?php } ?>" id="designation" placeholder="Designation*" name="designation">
										@if ($errors->has('designation'))
											<span class="invalid-feedback " role="alert">
												<strong >{{ $errors->first('designation') }}</strong>
											</span>
										@endif
									
									</div>
									
									<div class="col-md-4">
										<!--label>Middle Name</label-->
                                         <input type="text" class="form-control"   value="<?php if(!empty($data['internship_data']->nature_area)){ echo $data['internship_data']->nature_area;}elseif(!empty($all_data['nature_area'])){ ?>{{$all_data['nature_area']}}<?php }else if(old('nature_area')){ ?>{{ old('nature_area')}} <?php } ?>" id="nature_area" placeholder="Nature of Area*" name="nature_area">	
											@if ($errors->has('nature_area'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('nature_area') }}</strong>
											</span>
										@endif
									</div>
									<div class="col-md-5">
										<!--label>Last Name</label-->
                                          <input type="text" class="form-control"  value="<?php if(!empty($data['internship_data']->focus_work)){ echo $data['internship_data']->focus_work;}elseif(!empty($all_data['focus_work'])){ ?>{{$all_data['focus_work']}}<?php }else if(old('focus_work')){ ?>{{ old('focus_work')}} <?php } ?>" id="focus_work" placeholder="Prime Focus of Work*" name="focus_work">									   
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
							
							<?php if(!empty($data['intern_course_details'])){?>
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
								 
								 <?php $i=0; $j=1; foreach($data['intern_course_details'] as $v){?> 
								 
								 <tr id='addr<?php echo $v->id?>'>
								 
								
								 
								 
                                     <td class="text-center serial"><?php echo $j;?></td>
                                     <td class="text-center">
									 
                                   <select class="form-control courseid_input" name="course_id[<?php echo $i?>]"  id="course_id<?php echo $i?>">
									<option value="">Select Course</option>
									@foreach($data['courses_data'] as $val) 
									   <option value="{{$val->course_id}}" <?php if($v->course_id == $val->course_id){ echo "Selected";}?>>{{$val->course_name}}</option>
									@endforeach 
								  </select>
										@if ($errors->has('course_id'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('course_id') }}</strong>
											</span>
										@endif
									
									</td>
                                     <td class="text-center">
									
                                          <input type="text" class="form-control institute_input"  maxlength="50"  value="<?php echo $v->institute;?>" id="institute<?php echo $i?>" placeholder="Enter Institute*" name="institute[<?php echo $i?>]">									   
											@if ($errors->has('institute'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('institute') }}</strong>
											</span>
										@endif
									</td>
                                     <td class="text-center">
                                     
                                          <input type="text" class="form-control stream_input"  maxlength="50" value="<?php echo $v->stream;?>" id="stream<?php echo $i?>" placeholder="Enter Stream*" name="stream[<?php echo $i?>]">									   
											@if ($errors->has('stream'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('stream') }}</strong>
											</span>
										@endif
									
									</td>
                                     <td class="text-center">
											<select class="form-control passstatus_input" name="pass_status[<?php echo $i?>]"  id="pass_status0" onchange="pass_status_check(<?php echo $i?>)">
											    <option value>Select Status*</option>
												<option value="1" <?php if($v->pass_status == '1'){ echo "Selected";}?> >Pursuing</option>
												<option value="2" <?php if($v->pass_status == '2'){ echo "Selected";}?>>Passed</option>
											</select>
											@if ($errors->has('pass_status'))
												<span class="invalid-feedback " role="alert">
													<strong>{{ $errors->first('pass_status') }}</strong>
												</span>
											@endif
										
												</td>
                                     <td class="text-center">
										
                                          <input type="text" class="form-control yearcompletion_input" maxlength="4" onkeypress="return isNumberKey(event)"   value="<?php echo $v->year_completion;?>" id="year_completion<?php echo $i?>" placeholder="Year of Passing*" name="year_completion[<?php echo $i?>]">									   
											@if ($errors->has('year_completion'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('year_completion') }}</strong>
											</span>
										@endif
									</td>
                                     <td class="text-center">
                                    
										
                                          <input type="text" class="form-control percentage" maxlength="5" value="<?php echo $v->marks_percentage;?>"   id="marks_percentage<?php echo $i?>" placeholder="Percentage*" name="marks_percentage[<?php echo $i?>]">									   
											@if ($errors->has('marks_percentage'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('marks_percentage') }}</strong>
											</span>
										@endif
									
									</td>
									<?php if($i==0){?>
                                     <td class="text-center">  
									    <div class="form-group button-group ">
									     <input type="button" id="addrow" class="add_button" name="addrow" value="Add Row">
						                </div>
									</td>
									<?php }else{ ?>
									<td class="text-center">  
									    <a  onclick="remove_data('<?php echo $v->id?>')"><i class="fa fa-trash"></i></a>
									</td>
									<?php }?>
                                 </tr> 
								<?php $i++;$j++;} ?>
                              </div>
                            </tbody>
                        </table>
							
							<?php } ?>
							
							
							
							
							
							
							
							
							
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
														if(!empty($data['internship_data']->area_interest)){ 
														   if($data['internship_data']->area_interest ==  $val){
															   echo "Selected";
														   }
														}else if(!empty($all_data['area_interest'])){
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
														if(!empty($data['internship_data']->intern_place)){ 
														   if($data['internship_data']->intern_place ==  $val){
															   echo "Selected";
														   }
														}else if(!empty($all_data['intern_place'])){
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
														if(!empty($data['internship_data']->intern_duration)){ 
														   if($data['internship_data']->intern_duration ==  $key){
															   echo "Selected";
														   }
														}elseif(!empty($all_data['intern_duration'])){
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
	  
									// $month_two = date('Y-m', strtotime("+2 months", strtotime($date)));
									// $month_two1 = date('M-Y', strtotime("+2 months", strtotime($date)));
									
									// $month_three = date('Y-m', strtotime("+3 months", strtotime($date)));
									// $month_three1 = date('M-Y', strtotime("+3 months", strtotime($date)));
									
									// $month_four = date('Y-m', strtotime("+4 months", strtotime($date)));
									// $month_four1 = date('M-Y', strtotime("+4 months", strtotime($date)));
									
									$month_one = "2020-01";
									$month_two = "2020-02";
									$month_three = "2020-03";
									$month_four = "2020-04";
									$month_five = "2020-05";
									$month_six = "2020-06";
									$month_seven = "2020-07";
									
									
									
									
									$desired_month_year = array($month_one=>$month_one ,$month_two=>$month_two,$month_three=>$month_three,$month_four=>$month_four,$month_five=>$month_five,$month_six=>$month_six,$month_seven=>$month_seven)?>

                                        <select name="desired_month_year" id="desired_month_year" class="form-control">
										    <option value="">Select Desired Month & Year of Internship*</option>
											@foreach($desired_month_year as $key=>$val)
											<option value="{{ $key }}"  <?php 
														if(!empty($data['internship_data']->intern_start_month)){
														   if($data['internship_data']->intern_start_year.'-0'.$data['internship_data']->intern_start_month == $key){
															  echo "Selected";
														   }
														}else if(!empty($all_data['desired_month_year'])){
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
										 <textarea name="writeup_interest" id="interestedareainfo" placeholder="Writeup on Interested Area in Internship (maximum 1000 Characters)*" class="form-control" ><?php if(!empty($data['internship_data']->writeup_interest)){ 
										      echo $data['internship_data']->writeup_interest;
										 }else if(!empty($all_data['writeup_interest'])){ ?>{{$all_data['writeup_interest']}}<?php }else if(old('writeup_interest')){ ?>{{ old('writeup_interest')}} <?php } ?></textarea>
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
										<textarea name="remarks" id="anyotherinfo" class="form-control"  placeholder="Any Other Information (Experience/ Publications/ Patents/ Awards etc.) (maximum 1000 Characters)*"><?php  if(!empty($data['internship_data']->remarks)){ 
										      echo $data['internship_data']->remarks;
										 }elseif(!empty($all_data['remarks'])){ ?>{{$all_data['remarks']}}<?php }else if(old('remarks')){ ?>{{ old('remarks')}} <?php } ?></textarea><span style="font-size: 12px;color: red;float: right;" id='remainingCh'></span>
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

                                        <select name="id_proof" id="id_proof" class="form-control">
										    <option value="">Select Id Proof Type*</option>
											@foreach($id_proof as $key=>$val)
											<option value="{{ $key }}"  <?php 
														 if(!empty($data['internship_data']->id_proof_type)){ 
															 if($data['internship_data']->id_proof_type == $key){
															   echo "Selected";
														   }else{
															   echo "";
														   }
														 }elseif(!empty($all_data['id_proof_type'])){
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
										<input name="file_id_proof" type="file" class="form-control" value="{{ old('file_id_proof')}}" id="file_id_proof">
                                        <label style="color:#FF0000; font-size:11px;"> (File Format accepts: PDF &amp; Maximum Size: 1MB) 
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<!--
										<?php //if($data['internship_data']->id_proof_type == "1"){?>
											<a href="{{asset('public/uploads/id_proof/voter_id/'.$data['internship_data']->file_id_proof)}}">Download Voter ID</a>
										<?php //}else if($data['internship_data']->id_proof_type == "2"){?>
											<a href="{{asset('public/uploads/id_proof/driving_licence/'.$data['internship_data']->file_id_proof)}}">Download Driving Licence</a>
										<?php //}else if($data['internship_data']->id_proof_type == "3"){?>
											<a href="{{asset('public/uploads/id_proof/passport/'.$data['internship_data']->file_id_proof)}}">Download Passport</a>
										<?php //}else if($data['internship_data']->id_proof_type == "4"){?>
											<a href="{{asset('public/uploads/id_proof/college_id_card/'.$data['internship_data']->file_id_proof)}}">Download College Id Card</a>
										<?php //} ?>
										-->
										<?php  if(!empty($data['internship_data']->file_id_proof)){ ?>
										<a href="{{asset('public/uploads/internship/id_proof/'.$data['internship_data']->file_id_proof)}}">Download Id Proof</a>
										</label><br><span  style="font-size: 12px;"id="file_id_proof_error"> </span>				
                                        <input type="hidden" name="file_id_proof" value="{{$data['internship_data']->file_id_proof }}">
									    <?php  }else{ ?><a style="color:green;  font-size:12px">N/A</a> <?php  }?> 		
									  
									</div>
								</div>
							<div>
									
							<div class="form-group">
								<div class="row">
									<div class="col-md-6">
									<label for="name" class="control-label" style="font-size: 13px;">If Any(Experience/ Publication/ Patents/ Awards etc.)</label>
									<input name="file_experience" type="file" class="form-control" value="{{ old('file_experience')}}" id="file_experience">
									<span style="color:#FF0000; font-size:11px;"> (File Format accepts: PDF &amp; Maximum Size: 5MB)
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									
									<?php  if(!empty($data['internship_data']->file_experience)){ ?>
									<a href="{{asset('public/uploads/internship/experience/'.$data['internship_data']->file_experience)}}">Download Experience</a></span><br><span  style="    font-size: 12px;"id="file_experience_error"> </span>		
									<input type="hidden" name="file_experience" value="{{$data['internship_data']->file_experience }}">
									<?php  }else{?><a style="color:green; font-size:12px">N/A</a> <?php  }?> 		
                                    </div>
									
			
									<div class="col-md-6">
										<label for="name"  style="font-size: 13px;" class="control-label">Candidate Photograph<span>*</span></label> 
										<input name="file_photo" type="file" class="form-control" id="file_photo" value="{{ old('file_photo')}}">
										<label style="color:#FF0000; font-size:11px;"> (File Format accepts: JPEG/JPG &amp; Maximum Size: 100KB)
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										 <img src="{{asset('public/uploads/internship/photo/'.$data['internship_data']->file_photo)}}" style="height:50px; width:50px">
										 </label><br><span  style="font-size: 12px;"id="file_photo_error"> </span>		
									
										 <input type="hidden" name="file_photo" value="{{$data['internship_data']->file_photo }}">
									</div>
			
			
								</div> 
							</div>
							
							<hr>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
         <button type="submit" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i>&nbsp; Save</button>
        <a class="btn btn-secondary" style="color:white" onClick="javascript:history.go(-1)"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; Cancel</a>
    </div>

													
				    </form>
                </div>
            </div>
         </div>
     </div></div></div>
</style>
    <!-- /.container-fluid-->
	
	<script>
	$(document).ready(function(){

	$('#internship_form_edit').on('submit', function(event) {
    
	  $( "#pincode" ).rules( "add", {
    	required: true,
        minlength: 6,
        maxlength: 6,
        digits: true
  		 
	});
	$( "#address" ).rules( "add", {
    	required: true,         
        maxlength: 220,
         
  		 
	});
	$( "#sipcode" ).rules( "add", {
			required: true,
	});
	$( "#categories" ).rules( "add", {
			required: true,
	});
	$( "#area_interest" ).rules( "add", {
			required: true,
	});
	$( "#intern_place" ).rules( "add", {
			required: true,
	});
	$( "#desired_month_year" ).rules( "add", {
			required: true,
	});
	$( "#writeup_interest" ).rules( "add", {
			required: true,maxlength:1000,
	});
	$( "#remarks" ).rules( "add", {
			required: true,maxlength:1000,
	});
	$( "#id_proof" ).rules( "add", {
			required: true,
	});
	
	$( "#father_name" ).rules( "add", {
			required: true,
	});
	$( "#statecd" ).rules( "add", {
			required: true,
	});
	$( "#districtcd" ).rules( "add", {
			required: true,
	});
	$( "#intern_duration" ).rules( "add", {
			required: true,
	});
	
	
	 
		 $( "#organization" ).rules( "add", {
			required: function(element) {
				return $("input:radio[name='catg']:checked").val() == '2';
			}
		 });
		  $( "#organization_address" ).rules( "add", {
		        required: function(element) {
				return $("input:radio[name='catg']:checked").val() == '2';
			}
		  });
		   $( "#designation" ).rules( "add", {
		        required: function(element) {
				return $("input:radio[name='catg']:checked").val() == '2';
			}
		  });
		  $( "#nature_area" ).rules( "add", {
		        required: function(element) {
				return $("input:radio[name='catg']:checked").val() == '2';
			}
		  });
		  $( "#focus_work" ).rules( "add", {
		        required: function(element) {
				return $("input:radio[name='catg']:checked").val() == '2';
			}
		  });
		 
	
	
	
	
    $('.courseid_input').each(function() {
        $(this).rules("add", 
            {
                required: true,
                messages: {
                    required: "Course is required",
                }
            });
    });
 $('.institute_input').each(function() {
    	 
        $(this).rules("add", 
            {
                required: true,
                maxlength: 120, 
                messages: {
                    required: "field is required",
                    
                  }
            });
    });

    $('.stream_input').each(function() {
    	 
        $(this).rules("add", 
            {
                required: true,
                maxlength: 120,

                messages: {
                    required: "field is required",
                    
                  }
            });
    });
    $('.passstatus_input').each(function() {
        $(this).rules("add", 
            {
                required: true,

                messages: {
                    required: "field is required",
                }
            });
    });
  
  
    // $('.yearcompletion_input').each(function() {
        // $(this).rules("add", 
            // {
                // required: true,
                // maxlength: 4,
                // digits: true,
                // messages: {
                    // required: "field is required",
                // }
            // });
    // });
    // $('.markspercentage_input').each(function() {
        // $(this).rules("add", 
            // {
                // required: true,
                // maxlength: 3,
                // digits: true,
                // messages: {
                    // required: "field is required",
                // }
            // });
    // });
	
	
  
});
$("#internship_form").validate();
	});
	</script>
@endsection
	
	