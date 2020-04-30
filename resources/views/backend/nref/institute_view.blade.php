@extends('layouts.master')

@section('container')

 <div class="content-wrapper" >
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb" style="margin-left: 14%; margin-top: 27px; margin-right: 8px;" >
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Internship View</li>
      </ol>
	   <div class="intern_title"  style="margin-left: 14%; margin-top: 27px; margin-right: 8px;" >
	    Ministry will provide internship opportunity to facilitate students pursuing under graduate/graduate/post graduate degrees or research scholars enrolled in recognized institutes/universities with in India or abroad, as "Interns". The students of various Engineering, Science, Management, law and other streams may undertake internship in the Ministry and in organizations under its aegis to understand various activities of the Ministry to become Researchers/Managers in renewable energy area. These interns will be attached with the senior level officers of the Ministry in various Programme Divisions.
	 </div>
	 
	
      <!-- Icon Cards-->
	   <div class="card card-login mx-auto mt-5 "  style="max-width: 65rem; margin-bottom:20px">
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
            $internship_data =  $data['internship_data']
      ?>
	 <marquee behavior="scroll" z-index:99;="" width="100%" height="30px" scrollamount="3" direction="left" style="background:rgba(0,0,0,.03)"><h3><span style="color:#FF0000;">The internship will be on unpaid basis. No stipend will be provided to interns. </span></h3></marquee>
           <div class="card-header text-center"><h4 style="    color: #2384c6;">Internship View</h4></div>
               <div class="card-body">
     	
				            <div class="form-group">
								<div class="row">
									<div class="col-md-4">
										<input type="text" disabled class="form-control"   
										value="<?php if(!empty($internship_data->first_name)){ echo $internship_data->first_name;}?>" id="first_name"  name="first_name">
									</div>
									
									<div class="col-md-4">
										<input type="text" disabled class="form-control" value="<?php if(!empty($internship_data->middle_name)){ echo $internship_data->middle_name;}?>"  id="middle_name" placeholder="Middle Name" name="middle_name">
									</div>
									<div class="col-md-4">
										<input type="text" disabled class="form-control"  value="<?php if(!empty($internship_data->last_name)){ echo $internship_data->last_name;}?>" id="last_name" placeholder="Last Name" name="last_name">
									</div>
								</div> 
							</div>

							
							<div class="form-group">
								<div class="row">
									<div class="col-md-3">
                                      <input type="text" disabled class="form-control"  value="<?php if(!empty($internship_data->email)){ echo $internship_data->email;}?>"  id="email_id"  name="email_id">
									</div>
									<div class="col-md-3">
										<input class="date form-control"  type="text" disabled value="<?php if(!empty($internship_data->date_birth)){ echo $internship_data->date_birth;}?>" name="dob" >
									</div>
									<div class="col-md-3">
									<?php $gender_arr = array( '1'=>'Male' ,'2'=>'Female','0'=>'Others');?>
										<select disabled class="form-control" name="gender"  id="gender">
										    <option value="">Select Gender*</option>
											@foreach($gender_arr as $key=>$val)
											<option value="{{$key}}" 
                                                    <?php 
														if(!empty($internship_data->gender)){
														   if($internship_data->gender == $key){
															   echo "Selected";
														   }
														}   
													?>>{{$val}}</option>
											@endforeach
								   	    </select>
									</div>
									<div class="col-md-3">
							           <input type="text" disabled class="form-control"  value="<?php if(!empty($internship_data->mob_number)){ echo $internship_data->mob_number;}?>"  name="mobile_no">
								    </div>
									
									
								</div> 
							</div>
							
							
							<div class="form-group">
								<div class="row">
									
									<div class="col-md-4">
										<input type="text" disabled class="form-control"  value="<?php if(!empty($internship_data->father)){ echo $internship_data->father;}?>"  name="father_name">
									</div>
									<?php if(!empty($internship_data->phone)){ $phone = explode("-", $internship_data->phone); }?>
							        <div class="col-md-3">
										<input name="std_code" disabled class="form-control"  value="<?php if(!empty($internship_data->phone)){ echo $phone['0'];}?>"  > 
									</div>
								    <div class="col-md-1">
										<span class="input-group-addon">-</span>
									</div>
									<div class="col-md-4">
										<input name="landline" disabled class="form-control"  value="<?php if(!empty($internship_data->phone)){ echo $phone['1'];}?>"  >           
				                    </div>
				                </div> 
							</div>
				
				
				             <div class="form-group">
								<div class="row">
								<div class="<?php if($internship_data->countrycd != "99"){?> col-md-12 <?php }else{ ?> col-md-4 <?php } ?>">
								@foreach($data['country_data'] as $val) 
								<?php if($internship_data->countrycd == $val->countrycd){?>
								<input type="hidden" readonly class="form-control"  value="<?php echo $val->countrycd ?>"  id="countrycd" name="countrycd">
								<?php } ?>
								@endforeach 
									<select disabled class="form-control"  > 
										<option value="">Select Country*</option>
											@foreach($data['country_data'] as $val) 
												<option value="{{$val->countrycd}}" 
												 <?php 
												 if(!empty($internship_data->countrycd)){
													if($internship_data->countrycd == $val->countrycd){
														echo "Selected";
													}	
												}
												?>
													>{{$val->name}}</option>
											@endforeach 
										
									</select>
								</div>
								
								
								<?php if($internship_data->countrycd == "99"){?>
								    <div class="col-md-4 statecd">
									
									@foreach($data['state_data'] as $val) 
									<?php if($internship_data->statecd == $val->statecd){?>
									<input type="hidden" readonly class="form-control"  value="<?php echo $val->statecd ?>"  id="statecd" name="statecd">
									<?php } ?>
									@endforeach 
								
										<select disabled class="form-control" >
											<option value="">Select State*</option>
												@foreach($data['state_data'] as $val) 
												<option value="{{$val->statecd}}" 
												   <?php 
													 if(!empty($internship_data->statecd)){
														if($internship_data->statecd == $val->statecd){
															echo "Selected";
														}	
													}
													?>>{{$val->state_name}}</option>
												@endforeach 
											</select>
									</div>
										
									<div class="col-md-4 districtcd">
									@foreach($data['district_data'] as $val) 
									<?php if($internship_data->districtcd == $val->districtcd){?>
									<input type="hidden" readonly class="form-control"  value="<?php echo $val->districtcd ?>"  id="districtcd" name="districtcd">
									<?php } ?>
									@endforeach 
										   <select disabled class="form-control">
												<option value="">Select District*</option>
												@foreach($data['district_data'] as $val) 
												   <option value="{{$val->districtcd}}" 
												   <?php 
													 if(!empty($internship_data->districtcd)){
														if($internship_data->districtcd == $val->districtcd){
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
                                      <input type="text" disabled  class="form-control" value="<?php if(!empty($internship_data->pincode)){ echo $internship_data->pincode;}?>" >
									</div>
								
									<div class="col-md-4">
									<?php $categories_arr = array( '1'=>'General' ,'2'=>'OBC','3'=>'SC','4'=>'ST')?>
										<select disabled name="categories" id="categories" class="form-control">
										    <option value="">Select Category*</option>
											@foreach($categories_arr as $key=>$val)
											<option value="{{ $key }}"  
											        <?php 
														if(!empty($internship_data->categories)){
														   if($internship_data->categories == $key){
															   echo "Selected";
														   }
														}   
													?>>{{ $val }}</option>
										    @endforeach
										</select>
									</div>
									<div class="col-md-4">
										<textarea disabled col="1" rows="1" onkeyup="this.value = this.value.toUpperCase();" class="form-control" value="" id="address" placeholder="Address*" name="address"><?php if(!empty($internship_data->address)){ echo $internship_data->address; } ?></textarea>
									</div>
								</div> 
							</div>
							
							
							
							
							
						
						
							    <div class="form-group">
									 <b>Whether you are employed?*</b>
									 <input type="radio" onclick="" name="catg" id="emp_no" value="1" <?php if($internship_data->work_status == "") { echo "checked";}else{ echo"";}?>> <strong>No</strong>
									 <input type="radio" onclick="" name="catg" id="emp_yes" value="2" <?php if($internship_data->work_status != "") { echo "checked";}else{ echo"";}?>><strong>Yes</strong>
							   
								</div>
							
							
							
							<?php if(!empty($internship_data->work_status)){ ?>
							<div  style="border: 1px solid #d3d7da; padding: 14px;">
							   <div class="form-group">
									<b>Whether you are Govt. employee?*</b>
									<input type="radio" onclick="" name="work_status" id="govtemp_no" value="1" <?php if($internship_data->work_status == "1") { echo "checked";}else{ echo"";}?> > <strong>No</strong>
									<input type="radio" onclick="" name="work_status" id="govtemp_yes" value="2" <?php if($internship_data->work_status == "2") { echo "checked";}else{ echo "";}?> ><strong>Yes</strong>
								</div>
								
								<div class="form-group">
									<div class="row">
										<div class="col-md-4">
											<input type="text" disabled class="form-control onlyalpha" onkeyup="this.value = this.value.toUpperCase();"   value="<?php if(!empty($internship_data->organization)){ echo $internship_data->organization; } ?>" id="org_name" placeholder="Organization Name*" name="organization">
 	                                    </div>
										
										<div class="col-md-8">
											<textarea col="1" disabled rows="1" onkeyup="this.value = this.value.toUpperCase();" class="form-control" value="" id="org_address" placeholder="Organization Address*" name="organization_address"><?php if(!empty($internship_data->organization_address)){ echo $internship_data->organization_address; } ?></textarea>
								       </div>
									</div> 
								</div>
								
								<div class="form-group">
									<div class="row">
										<div class="col-md-3">
											<!--label>First Name<em style="color:red">*</em></label-->
											<input type="text" disabled class="form-control onlyalpha" onkeyup="this.value = this.value.toUpperCase();"   value="<?php if(!empty($internship_data->designation)){ echo $internship_data->designation; } ?>" id="designation" placeholder="Designation*" name="designation">
										</div>
										
										<div class="col-md-4">
											<!--label>Middle Name</label-->
											 <input type="text" disabled class="form-control onlyalpha" onkeyup="this.value = this.value.toUpperCase();"   value="<?php if(!empty($internship_data->nature_area)){ echo $internship_data->nature_area; } ?>" id="natureofarea" placeholder="Nature of Area*" name="nature_area">	
										</div>
										<div class="col-md-5">
											<!--label>Last Name</label-->
											  <input type="text" disabled class="form-control onlyalpha" onkeyup="this.value = this.value.toUpperCase();"   value="<?php if(!empty($internship_data->focus_work)){ echo $internship_data->focus_work; } ?>" id="primework" placeholder="Prime Focus of Work*" name="focus_work">									   
										</div>
									</div>
							    </div>
							</div>
							<br>
							<?php } ?>	
							
							
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
                                 </tr>
                                 </thead>
                                 <tbody id="table_append" class="table_append">
								 <div> 
								 
								<?php $i=1; foreach($data['intern_course_details'] as $v){
                                       //  foreach($v as $value){									?> 
								 <tr id='addr0'>
                                     <td class="text-center"><?php echo $i;?></td>
                                     <td class="text-center">
									   <select disabled class="form-control" name="course_id[]"  id="course_id">
										<option value="">Select Course</option>
										@foreach($data['courses_data'] as $val) 
										   <option value="{{$val->course_id}}" <?php if($v->course_id == $val->course_id){echo "Selected";}?> >{{$val->course_name}}</option>
										@endforeach 
									  </select>
									</td>
                                     <td class="text-center">
									    <input type="text" disabled class="form-control"  maxlength="50"  value="<?php echo $v->institute;?>" id="institute" placeholder="Enter Institute*" name="institute[]">									   
									</td>
                                     <td class="text-center">
                                         <input type="text" disabled class="form-control"  maxlength="50" value="<?php echo $v->stream;?>" id="stream" placeholder="Enter Stream*" name="stream[]">
								    </td>
                                     <td class="text-center">
											<select disabled class="form-control" name="pass_status[]"  id="pass_status" >
											    <option value>Select Status*</option>
												<option value="1" <?php if($v->pass_status == 1){echo "Selected";}?>>Pursuing</option>
												<option value="2" <?php if($v->pass_status == 2){echo "Selected";}?>>Passed</option>
											</select>
									</td>
                                     <td class="text-center">
										<input type="text" disabled class="form-control" maxlength="4" onkeypress="return isNumberKey(event)"   value="<?php echo $v->year_completion;?>" id="year_completion" placeholder="Year of Passing*" name="year_completion[]">									   
									</td>
                                     <td class="text-center">
                                       <input type="text" disabled class="form-control" maxlength="5" value="<?php echo $v->marks_percentage;?>" onkeypress="return ValidateValue(event)"   id="marks_percentage" placeholder="Percentage*" name="marks_percentage[]">									   
									</td>
                                    
                                 </tr>
								<?php $i++;} //} ?>
								 
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
									
                                        <select disabled class="form-control" name="area_interest"  id="area_interest">
										    <option value="">Select Area of Interest*</option>
											@foreach($area_interest as $key=>$val)
											<option value="{{$val}}"  
											        <?php 
														if(!empty($internship_data->area_interest)){
														   if($internship_data->area_interest == $val){
															   echo "Selected";
														   }
														}   
													?>>{{$val}}</option>
											@endforeach
								   	    </select>
									</div>
									<div class="col-md-6">
									<?php $intern_place = array( '1'=>'MNRE' ,'2'=>'NISE-Gurugram','3'=>'NIWE-Chennai','4'=>'NIBE-Kapurthala','5'=>'SECI','6'=>'IREDA')?>

                                        <select disabled name="intern_place" id="intern_place" class="form-control">
										    <option value="">Select Desired Place of Internship*</option>
											@foreach($intern_place as $key=>$val)
											<option value="{{ $val }}" 
                                                    <?php 
														if(!empty($internship_data->intern_place)){
														   if($internship_data->intern_place == $val){
															   echo "Selected";
														   }
														}   
													?>
													>{{ $val }}</option>
										    @endforeach
										</select>
									</div>							
								</div>
							</div>	
							
						  <div class="form-group">
								<div class="row">
									
									<div class="col-md-6">
									<?php $intern_duration = array('2'=>'2 months','3'=>'3 months','4'=>'4 months','5'=>'5 months','6'=>'6 months')?>
									
                                        <select disabled class="form-control" name="intern_duration"  id="intern_duration">
										    <option value="">Select Duration of Internship*</option>
											@foreach($intern_duration as $key=>$val)
											<option value="{{$key}}" 
       											    <?php 
														if(!empty($internship_data->intern_duration)){
														   if($internship_data->intern_duration == $key){
															   echo "Selected";
														   }
														}   
													?> >{{$val}}</option>
											@endforeach
								   	    </select>
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
									
									$desired_month_year = array($month_two=>$month_two1 ,$month_three=>$month_three1,$month_four=>$month_four1);
									
									// dd($internship_data->intern_start_year.'-0'.$internship_data->intern_start_month);
									?>

                                        <select disabled name="desired_month_year" id="desired_month_year" class="form-control">
										    <option value="">Select Desired Month & Year of Internship*</option>
											@foreach($desired_month_year as $key=>$val)
											<option value="{{ $key }}"   
													<?php 
														if(!empty($internship_data->intern_start_month)){
														   if($internship_data->intern_start_year.'-0'.$internship_data->intern_start_month == $key){
															   echo "Selected";
														   }
														}   
													?> >{{ $val }}</option>
										    @endforeach
										</select>
									</div>							
								</div>
							</div>	
							
							<div class="form-group">
								<div class="row">
									<div class="col-md-12">
										 <textarea name="writeup_interest" id="writeup_interest" class="form-control" disabled><?php if(!empty($internship_data->writeup_interest)){ echo $internship_data->writeup_interest; } ?></textarea>
									</div>
								</div> 
							</div>
							
							<div class="form-group">
								<div class="row">
									<div class="col-md-12">
										<textarea name="remarks" id="remarks" class="form-control"  disabled><?php if(!empty($internship_data->remarks)){ echo $internship_data->remarks; } ?></textarea>
									</div>
								</div> 
							</div>
							<div class="form-group">
								<div class="row">
								<div class="col-md-4">
									<?php $id_proof = array( '1'=>'VoterID' ,'2'=>'Driving Licence','3'=>'Passport','4'=>'College Id Card')?>

                                        <select disabled name="id_proof" id="id_proof" class="form-control">
										    <option value="">Select Id Proof Type*</option>
											@foreach($id_proof as $key=>$val)
											<option value="{{ $key }}" 
											       <?php 
														if(!empty($internship_data->id_proof_type)){
														   if($internship_data->id_proof_type == $key){
															   echo "Selected";
														   }
														}   
													?>
													>{{ $val }}</option>
										    @endforeach
										</select>
									</div>	
									<div class="col-md-3">
										<b for="name" style="font-size: 13px;" class="control-label">ID Proof</b> 
										<?php  if(!empty($data['internship_data']->file_id_proof)){ ?>
										<a href="{{asset('public/uploads/id_proof/'.$internship_data->file_id_proof)}}">Download Id Proof</a>
										 <?php  }else{ ?><a style="color:green;  font-size:12px">N/A</a> <?php  }?> 		
										 
										<!--<?php //if($internship_data->id_proof_type == "1"){?>
											<a href="{{asset('public/uploads/id_proof/voter_id/'.$internship_data->file_id_proof)}}">{{ $internship_data->file_id_proof }}</a>
										<?php //}else if($internship_data->id_proof_type == "2"){?>
											<a href="{{asset('public/uploads/id_proof/driving_licence/'.$internship_data->file_id_proof)}}">{{ $internship_data->file_id_proof }}</a>
										<?php //}else if($internship_data->id_proof_type == "3"){?>
											<a href="{{asset('public/uploads/id_proof/passport/'.$internship_data->file_id_proof)}}">{{ $internship_data->file_id_proof }}</a>
										<?php //}else if($internship_data->id_proof_type == "4"){?>
											<a href="{{asset('public/uploads/id_proof/college_id_card/'.$internship_data->file_id_proof)}}">{{ $internship_data->file_id_proof }}</a>
										<?php //} ?>-->
                                         
									</div>
									<div class="col-md-3">
										<b for="name" class="control-label" style="font-size: 13px;">Experience</b>
										<?php  if(!empty($data['internship_data']->file_experience)){ ?>
										<a href="{{asset('public/uploads/experience/'.$internship_data->file_experience)}}">Download Experience</a>
										 <?php  }else{ ?><a style="color:green;  font-size:12px">N/A</a> <?php  }?> 		
									 </div>
									 <div class="col-md-2">
										<b for="name"  style="font-size: 13px;" class="control-label">Photograph</b> 
										<img src="{{asset('public/uploads/photo/'.$internship_data->file_photo)}}" style="height:50px; width:50px">
									</div>
								</div>
							</div>
							<hr>
                </div>
            </div>
         </div>
     </div>
	    <style>
	   /* div.card-body {
			height: 450px;
			overflow: scroll;
		}*/
		</style>
    <!-- /.container-fluid-->
@endsection
	
	