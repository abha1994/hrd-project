@extends('layouts.app1')
@section('content')
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<div class="content-wrapper" style="margin-left: 13px;">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <!--<ol class="breadcrumb"><li class="breadcrumb-item"><a href="#">Dashboard</a></li>
      	<li class="breadcrumb-item active">Internship Form</li>
      </ol>
    	<div class="intern_title">
	    	Ministry will provide internship opportunity to facilitate students pursuing under graduate/graduate/post graduate degrees or research scholars enrolled in recognized institutes/universities with in India or abroad, as "Interns". The students of various Engineering, Science, Management, law and other streams may undertake internship in the Ministry and in organizations under its aegis to understand various activities of the Ministry to become Researchers/Managers in renewable energy area. These interns will be attached with the senior level officers of the Ministry in various Programme Divisions.
		</div>
		
		<marquee behavior="scroll" z-index:99;="" width="100%" height="30px" scrollamount="3" direction="left" style="background:rgba(0,0,0,.03)"><h3><span style="color:#FF0000;">The internship will be on unpaid basis. No stipend will be provided to interns. </span></h3></marquee>-->
     	<div class="card-header text-center"><h4 style="    color: #2384c6;">Internship Form</h4></div>
     	<div class="card-body text-center"><h4>Fellowship Program Application</h4><h4>Annexure 1A &nbsp;&nbsp;&nbsp;<input name="print" type="button" id="preview" class="btn btn-dark" value="Print this Application" onclick="JavaScript:window.print();"></h4></div>
		<div class="card-body">
    		<form  enctype="multipart/form-data"  action="{{route('fellowship-solar-form.store')}}" autocomplete="off" id="felloship_solar" method="POST" >
    			@csrf
    			<input type="hidden" id="counter" value="1">
    			<input type="hidden" id="counters" value="1">
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
				</div><!-- From Group End -->
				<div class="form-group">
					<div class="row">
						<div class="col-md-3">
                            <input type="text" readonly class="form-control" value="<?php if(!empty($loginuser_data->email_id)){ ?>{{ $loginuser_data->email_id }} <?php } ?>"  id="email_id"  name="email_id">
						</div>
						<div class="col-md-3">
							<input class="form-control"  type="text" readonly value="<?php if(!empty($loginuser_data->dob)){ ?>{{ $loginuser_data->dob }} <?php } ?>" name="dob" id="dob" >
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
						    <input type="text" readonly class="form-control"  value="<?php if(!empty($loginuser_data->mobile_no)){ ?>{{ $loginuser_data->mobile_no }} <?php } ?>"  id="mobile_no" placeholder="Mobile No.*" name="mobile_no" onkeypress="return isNumberKey(event)">
						 </div>
					</div> 
				</div><!-- End of From Group -->
				<div class="form-group">
					<div class="row">
						<div class="<?php if($loginuser_data->countrycd != "99"){?> col-md-12 <?php }else{ ?> col-md-4 <?php } ?>">
						@foreach($data['country_data'] as $val) 
						<?php if($loginuser_data->countrycd == $val->countrycd){ ?>
							<input type="hidden" readonly class="form-control"  value="<?php echo $val->name ?>"   name="countrycd" id="countryid">
							<input type="hidden" readonly class="form-control"  value="<?php echo $val->countrycd ?>"   name="country" id="country">
						<?php } ?>
						@endforeach 
						<select disabled class="form-control" name="countrycd" id="countrycd" > 
							<option value="">Select Country*</option>
							@foreach($data['country_data'] as $val) 
								<option value="{{$val->countrycd}}" 
									<?php 
									if(!empty($loginuser_data->countrycd)){
										if($loginuser_data->countrycd == $val->countrycd){
											echo "Selected";
										}	
									}?>
									>{{$val->name}}</option>
							@endforeach 
						</select>
					</div>
					<?php if($loginuser_data->countrycd == "99"){?>
				    <div class="col-md-4 statecd">
						@foreach($data['state_data'] as $val) 
						<?php if($loginuser_data->statecd == $val->statecd){?>
							<input type="hidden" readonly class="form-control"  value="<?php echo $val->state_name ?>"  id="stateid" name="statecd">
							<input type="hidden" readonly class="form-control"  value="<?php echo $val->statecd ?>"   name="state" id="state">
						<?php } ?>
						@endforeach 
						<select disabled class="form-control" name="statecd" id="statecd">
							<option value="">Select State*</option>
							@foreach($data['state_data'] as $val) 
								<option value="{{$val->statecd}}" 
								   <?php if(!empty($loginuser_data->statecd)){
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
						<input type="hidden" readonly class="form-control"  value="<?php echo $val->district_name ?>"  id="districtid" name="districtcd">
						<input type="hidden" readonly class="form-control"  value="<?php echo $val->districtcd ?>"   name="distric" id="distric">
						<?php } ?>
						@endforeach 
					   <select disabled class="form-control" name="districtcd" id="districtcd">
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
				</div><!-- End of Form Group -->
				<div class="form-group">
					<div class="row">
						<div class="col-md-4">
							<input type="text" class="form-control onlyalpha required" onkeyup="this.value = this.value.toUpperCase();" value="" id="father_name" placeholder="Father's Name*" name="father_name">
							@if ($errors->has('father_name'))
								<span class="invalid-feedback " role="alert">
									<strong>{{ $errors->first('father_name') }}</strong>
								</span>
							@endif
						</div>
						 
						<div class="col-md-3">
							<input name="std_code" maxlength="6" value="" class="form-control" type="text" id="std_code"  class="form-control" placeholder="STD code" onkeypress="return isNumberKey(event)" > 
						</div>
						<div class="col-md-1">
							<span class="input-group-addon">-</span>
						</div>
						<div class="col-md-4">
							<input name="landline" value="" class="form-control" type="text" id="landline" class="form-control" placeholder="Landline" onkeypress="return isNumberKey(event)">           
				        </div>
				    </div> 
				</div> <!-- End of form Group -->
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
                            <input type="text" class="form-control required" value="<?php if(!empty($all_data['pincode'])){ ?>{{$all_data['pincode']}}<?php }else if(old('pincode')){ ?>{{ old('pincode')}}<?php } ?>" onkeypress="return isNumberKey(event)"  maxlength="6"  id="pincode" placeholder="Pincode*" name="pincode">
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
							    <!-- <option value="">Select Category</option> -->
									@foreach($categories_arr as $key=>$category)
										<option value="{{ $key }}">{{ $category }}</option>
									@endforeach
							</select>
							@if ($errors->has('categories'))
								<span class="invalid-feedback " role="alert">
									<strong>{{ $errors->first('categories') }}</strong>
								</span>
							@endif
						</div>
						<div class="col-md-4">
							<textarea col="1" rows="1" class="form-control required" value="{{ old('address')}}" id="address" placeholder="Address*" name="address"></textarea>
							@if ($errors->has('address'))
								<span class="invalid-feedback " role="alert">
									<strong>{{ $errors->first('address') }}</strong>
								</span>
							@endif
						</div>
					</div> 
				</div><!-- end of form group -->
							
				<div class="form-group">			
					<b>Whether you are employed?*</b>
					<input type="radio" id="show" name="employed" value="Yes" checked><strong>Yes</strong>
					<input type="radio" id="hide" name="employed" value="No" > <strong>No</strong>
					
				</div>

				<div class="form-group" id="employediv">
					<div class="row">
						<div class="col-md-3">
						<?php $categories_arr = array( 'GOI' ,'State','Public Institution')?>
							<select name="employed_inst" id="employed_inst" class="form-control required">
							    <option value="">GOI/State/Public Institution*</option>
									@foreach($categories_arr as $val)
									<option value="{{ $val }}"> {{ $val }}</option>
								    @endforeach
							</select>
							@if ($errors->has('employed_inst'))
								<span class="invalid-feedback " role="alert">
									<strong>{{ $errors->first('employed_inst') }}</strong>
								</span>
							@endif
						</div>
						<div class="col-md-3">
							<input type="text"  class="form-control required" value="{{ old('organization') }}" id="organization" placeholder="Current employee*" name="organization" />
							@if ($errors->has('organization'))
							    <span class="invalid-feedback " role="alert">
								    <strong>{{ $errors->first('organization') }}</strong>
								</span>
							@endif
						</div>
						<div class="col-md-3">
							<input type="text"  class="form-control required" value="{{ old('organization_address') }}" id="organization_address" placeholder="Address of the current employee*" name="organization_address" />
							@if ($errors->has('organization_address'))
							    <span class="invalid-feedback " role="alert">
								    <strong>{{ $errors->first('organization_address') }}</strong>
								</span>
							@endif
						</div>
						<div class="col-md-3">  
						   	<input type="text" class="form-control required" maxlength="6" value="{{ old('salary') }}"  id="salary" placeholder="Salary" name="salary" onkeypress="return isNumberKey(event)">
						   	@if ($errors->has('salary'))
							    <span class="invalid-feedback " role="alert">
								    <strong>{{ $errors->first('salary') }}</strong>
								</span>
							@endif
						</div>
					</div>
				</div>   <!-- end of form group -->
				<h4>Education Details</h4>
                <table border="0" class="table table-bordered table-striped table-hover" id="tab0">
                    <thead style="font-size: 14px; font-weight: 300;line-height: 0.9;">
						<tr>
                             
                            <th>Education Qualification</th>
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
							<tr>
                                 
                                <td class="text-center">
	                                <select class="form-control courseid_input required" name="courseid[]" id="courseid_0">
										<option value="">Course</option>
											@foreach($data['courses_data'] as $val) 
										   		<option value="{{$val->course_name}}"  >{{$val->course_name}}</option>
											@endforeach 
									</select>
									@if ($errors->has('course_id'))courses_data
										<span class="invalid-feedback " role="alert">
											<strong>{{ $errors->first('course_id') }}</strong>
										</span>
									@endif
								</td>
                                <td class="text-center">
                                	<input type="text" class="form-control institute_input required"  maxlength="50" value=""  id="institute_0" placeholder="Enter Institute*" name="institute[]">									   
									@if ($errors->has('institute'))
										<span class="invalid-feedback " role="alert">
											<strong>{{ $errors->first('institute') }}</strong>
										</span>
									@endif
								</td>
                                <td class="text-center">
                                    <input type="text" class="form-control stream_input required"  maxlength="50" value="" placeholder="Stream*" name="stream[]" id="stream_0">									   
									@if ($errors->has('stream'))
										<span class="invalid-feedback " role="alert">
											<strong>{{ $errors->first('stream') }}</strong>
										</span>
									@endif
									
								</td>
                                <td class="text-center">
									<select class="form-control passstatus_input required" name="passstatus[]" id="passstatus_0" onchange="pass_status_check(0)">
									    <option value>Status*</option>
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
								    <input type="text" class="form-control yearcompletion_input required" maxlength="4"  placeholder="YOP*" name="yearcompletion[]" id="yearcompletion_0">									   
									@if ($errors->has('year_completion'))
										<span class="invalid-feedback " role="alert">
											<strong>{{ $errors->first('year_completion') }}</strong>
										</span>
									@endif
								</td -->
                                <td class="text-center">
                                    <input type="text" class="form-control markspercentage_input required" maxlength="5" placeholder="Percentage*" name="markspercentage[]" id="markspercentage_0">									   
									@if ($errors->has('marks_percentage'))
										<span class="invalid-feedback" role="alert">
											<strong>{{ $errors->first('marks_percentage') }}</strong>
										</span>
									@endif								
								</td>
                                <td>  
								    <div class="form-group button-group ">
									    <!-- <input type="button" id="addrow1" class="add_button1" name="addrow1" value="Add Row"> -->
									    <input type="button" id="add_fields" class="add_button1" name="add_fields" value="+">
									    
						            </div>
								</td>
                            </tr>
                        </div>
                    </tbody>
                </table>
                <div class="form-group">
					<div class="row">
					   	<div class="col-md-6">
                            <input type="text" class="form-control onlyalpha required" value="{{ old('ar_spc') }}" id="area_spc" placeholder="Area(s) of Specialization*" name="area_spc">
                            @if ($errors->has('area_spc'))
								<span class="invalid-feedback " role="alert">
									<strong >{{ $errors->first('area_spc') }}</strong>
								</span>
							@endif
						</div>
						<div class="col-md-6">
						    <input type="text" class="form-control required" value="{{ old('special_achievement') }}" placeholder="Special Achievement*" name="special_achievement" id="special_achievement">
						    @if ($errors->has('special_achievement'))
								<span class="invalid-feedback " role="alert">
									<strong >{{ $errors->first('special_achievement') }}</strong>
								</span>
							@endif
						</div>
					</div>
				</div>

				<div class="form-group">	  
					<div class="row">
                        <div class="col-md-6"> 
							<input class="form-control required"  type="text" value="{{ old('details_awards') }}"  name="details_awards" id="details_awards"  placeholder="Details of awards/ recognition received in the subject area at the national/international level*">
                           	@if ($errors->has('details_awards'))
								<span class="invalid-feedback " role="alert">
									<strong>{{ $errors->first('details_awards') }}</strong>
								</span>
							@endif
						</div>
						<div class="col-md-6">
							<input class="form-control required"  type="text" value="{{ old('book_published') }}"  name="book_published" id="book_published"  placeholder="Details of Books published*">
                           	@if ($errors->has('book_published'))
								<span class="invalid-feedback " role="alert">
									<strong>{{ $errors->first('book_published') }}</strong>
								</span>
							@endif
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
					    <div class="col-md-6">
					        <input class="form-control required"  type="text" value="{{ old('audio_video') }}"  name="audio_video" id="audio_video"  placeholder="Details of Films/audio-visuals published (if any)*">
                          	@if ($errors->has('audio_video'))
								<span class="invalid-feedback " role="alert">
									<strong>{{ $errors->first('audio_video') }}</strong>
								</span>
							@endif
						</div>
						<div class="col-md-6">
						    <input class="form-control required"  type="text" value="{{ old('details_scholar') }}"  name="details_scholar" id="details_scholar"  placeholder="Details of research scholors successfully guided and those currently pursuing MPhil/ Ph.D under your supervision*">
                           	@if ($errors->has('details_scholar'))
								<span class="invalid-feedback " role="alert">
									<strong>{{ $errors->first('details_scholar') }}</strong>
								</span>
							@endif
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
					    <div class="col-md-6">
					    	<label>Are you ready to give commitment to work at the selected host institute for full tenure of the fellowship granted</label>
					        <input type="radio" onclick="" name="commitment" id="commitment"   value="Yes" checked> Yes
						    <input type="radio" onclick="" name="commitment" id="commitment"  value="No">No
						</div>
						<div class="col-md-6">
						   	<label>Are you willing to submit a bond in this regard to the host institution?</label>
						    <input type="radio" onclick="" name="submit_bond" id="submit_bond" value="Yes" checked> Yes
						    <input type="radio" onclick="" name="submit_bond" id="submit_bond" value="No">No
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<textarea class="form-control required" value="{{ old('paper_published') }}"   id="paper_published" placeholder="List up details of scientific & Techinical Papers published*" name="paper_published"></textarea>
							<span style="font-size: 12px;color: red;float: right;" id='remainingL'></span>
							@if ($errors->has('paper_published'))
								<span class="invalid-feedback " role="alert">
									<strong>{{ $errors->first('paper_published') }}</strong>
								</span>
							@endif
									</div>
						<div class="col-md-6">
							<textarea name="why_selected" id="why_selected"  placeholder="Why you should be selected National Solar Science Fellow and how the proposed research project*" class="form-control onlyalpha required" >{{ old('why_selected') }}</textarea>
							<span style="font-size: 12px;color: red;float: right;" id='remainingK'></span>
								@if ($errors->has('why_selected'))
									<span class="invalid-feedback " role="alert">
										<strong>{{ $errors->first('why_selected') }}</strong>
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
                            <select name="id_proof" id="id_proof" class="form-control required">
								<option value="">Select Id Proof Type*</option>
								@foreach($id_proof as $key=>$val)
									<option value="{{ $key }}" >{{$val }}</option>
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
							<input name="file_id_proof" type="file" class="form-control required" value="{{ old('file_id_proof')}}" id="file_id_proof">
                            <label style="color:#FF0000; font-size:11px;"> (File Format accepts: PDF &amp; Maximum Size: 1MB)</label><br><span  style="    font-size: 16px;"id="file_id_proof_error"> </span>										
							@if ($errors->has('file_id_proof'))
								<span class="invalid-feedback " role="alert">
									<strong>{{ $errors->first('file_id_proof') }}</strong>
								</span>
							@endif
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label for="research_work"  style="font-size: 13px;" class="control-label">Upload one-page doc of Original, innovative and pioneering research work<span>*</span></label>
							<input name="research_work" type="file" class="form-control required" value="{{ old('research_work')}}" id="research_work">
                             <label style="color:#FF0000; font-size:12px;"> (File Format accepts: PDF &amp; Maximum Size: 1MB)</label><br><span  style="    font-size: 16px;"id="research_work_error"> </span>	
						    @if ($errors->has('research_work'))
								<span class="invalid-feedback " role="alert">
									<strong>{{ $errors->first('research_work') }}</strong>
								</span>
							@endif
						</div>
						<div class="col-md-6">
							<label for="candidate_photo"  style="font-size: 13px;" class="control-label">Candidate Photograph<span>*</span></label> 
							<input name="candidate_photo" type="file" class="form-control required" id="candidate_photo" value="{{ old('candidate_photo')}}">
							<label style="color:#FF0000; font-size:11px;"> (File Format accepts: JPEG/JPG &amp; Maximum Size: 200KB)</label><br><span  style="color:blue;font-size: 16px;"id="file_photo_error"> </span>		
							@if ($errors->has('candidate_photo'))
								<span class="invalid-feedback " role="alert">
									<strong>{{ $errors->first('candidate_photo') }}</strong>
								</span>
							@endif
						</div>
					</div> 
				</div>
				<table border="0" class="table table-bordered table-striped table-hover" id="tab0">
                    <thead style="font-size: 14px; font-weight: 300;line-height: 0.9;">
						<tr >
                            <th  colspan="4">Please provide three (3) references with complete contact details</th>
                        </tr>
                    </thead>
					 <tbody id="table_appends" class="table_appends">
						<div> 
							<tr id='ref0'> 
								<td>	
                                    <input type="text" class="form-control refname_input" placeholder="Name" name="refname[]" id="refname_0">
								</td>
								<td>	
                                    <input type="text" class="form-control refemail_input" placeholder="Email" name="refemail[]" id="refemail_0" >
                                    @if ($errors->has('reference_two'))
										<span class="invalid-feedback " role="alert" >
											<strong>{{ $errors->first('reference_two') }}</strong>
										</span>
									@endif
								</td>
								<td>
                                    <input type="text" maxlength="10" class="form-control refphone_input" placeholder="PhoneNo" name="refphone[]" id="refphone_0" pattern="[6-9]{1}[0-9]{9}" title="Phone number with 6-9 and remaing 9 digit with 0-9" onkeypress="return isNumberKey(event)">
                                      <span  style="font-size: 12px;"id="reference_three_error"> </span>
								</td>
								<td>  
								    <div class="form-group button-group ">
									    <input type="button" id="addref" class="add_button" name="addref" value="+">
						            </div>
								</td>
                            </tr>
                        </div>
                    </tbody>
				</table> 
				<hr />

       <center>
			<div class="form-group" >
				<span id="errmsg"></span>
				    <p style="padding-top:5px; color:#993333;font-weight: bold;">Your Registration details are non editable once submitted. Please Verify that the above details are correct.</p>
					<input class="btn btn-primary submit_bt" type="submit"  value="Submit" name="submit_bt">
					 
					 
					<input type="button" name="btn" value="Preview" id="submitBtn" data-toggle="modal" data-target="#confirm-submit" class="btn btn-success" />
			</div> 
		</center>        



    		</form>
   		</div>
    </div>
</div> 
 
 <div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" style="width:1100px; margin-right: 100px;">
            <div class="modal-header" style="color: #FFF"><h4>Internship Form <br />Fellowship Program Application Annexure 1A </h4></div>
            <div class="modal-body">
                <!-- We display the details entered by the user here -->
                <table class="table">
                	<thead>
                		 
                	</thead>
                    <tr>
                        <th colspan="2">First Name</th>
                        <th colspan="2">Middle Name</th>
                        <th colspan="2">Last Name</th>
                    </tr>
                    <tr>
                    	<td id="first_namev" colspan="2"></td>
                        <td id="middle_namev" colspan="2"></td>
                        <td id="last_namev" colspan="2"></td>
                    </tr>
                    <tr>
                        <th colspan="2">Email Id</th>
                        <th colspan="2">DOB</th>
                        <th colspan="1">Gender</th>
                        <th colspan="1">Mobile</th>
                    </tr>
                    <tr>
                    	<td id="email_idv" colspan="2"></td>
                        <td id="dobv" colspan="2"></td>
                        <td id="genderv" colspan="1"></td>
                        <td id="mobile_nov" colspan="1"></td>
                    </tr>

                     <tr>
                        <th colspan="2">Country</th>
                        <th colspan="2" >State</th>
                        <th colspan="2">Distric</th>
                        
                    </tr>
                    <tr>
                    	<td id="countrycdv" colspan="2"></td>
                        <td id="statecdv" colspan="2"></td>
                        <td id="districtcdv" colspan="2"></td>                         
                    </tr>
                    <tr><th><h4>Education Details</h4></th></tr>
                    <tr>
                        <th>Education Qualification	</th>
                        <th>University/Institute	</th>
                        <th>Stream</th>
                        <th>Pursuing/Passed	</th>
                        <th>Year of Passing	</th>
                        <th>Percentage/ CGPA/ Overall Percentage</th>
                    </tr>
                    <tr class="table-active">
                    	 <td id="c0"></td>
                    	 <td id="ins0"></td>
                    	 <td id="st0"></td>
                    	 <td id="pass0"></td>
                    	 <td id="yearcomp0"></td>
                    	 <td id="markspercen0"></td>
                    </tr>
                    <tr class="table-primary">
                    	 <td id="c1"></td>
                    	 <td id="ins1"></td>
                    	 <td id="st1"></td>
                    	 <td id="pass1"></td>
                    	 <td id="yearcomp1"></td>
                    	 <td id="markspercen1"></td>
                    </tr>
                    <tr class="table-secondary">
                    	 <td id="c2"></td>
                    	 <td id="ins2"></td>
                    	 <td id="st2"></td>
                    	 <td id="pass2"></td>
                    	 <td id="yearcomp2"></td>
                    	 <td id="markspercen2"></td>
                    </tr>
                    <tr class="table-success">
                    	 <td id="c3"></td>
                    	 <td id="ins3"></td>
                    	 <td id="st3"></td>
                    	 <td id="pass3"></td>
                    	 <td id="yearcomp3"></td>
                    	 <td id="markspercen3"></td>
                    </tr>
                    <tr class="table-info">
                    	 <td id="c4"></td>
                    	 <td id="ins4"></td>
                    	 <td id="st4"></td>
                    	 <td id="pass4"></td>
                    	 <td id="yearcomp4"></td>
                    	 <td id="markspercen4"></td>
                    </tr>
                    <tr class="table-light">
                    	 <td id="c5"></td>
                    	 <td id="ins5"></td>
                    	 <td id="st5"></td>
                    	 <td id="pass5"></td>
                    	 <td id="yearcomp5"></td>
                    	 <td id="markspercen5"></td>
                    </tr>

                    <tr>
                        <th colspan="3">Area(s) of Specialization</th>
                        <th colspan="3">Special Achievement	</th>                         
                    </tr>
                    <tr>
                        <td id="area_spce" colspan="3"></td>
                        <td id="special_ach" colspan="3"></td>                         
                    </tr>
                    <tr>
                        <th colspan="3">Details of awards/ recognition received in the subject area at the national/international level</th>
                        <th colspan="3">Details of Books published*</th>                         
                    </tr>
                    <tr>
                        <td id="details_award" colspan="3"></td>
                        <td id="book_publish" colspan="3"></td>                         
                    </tr>

                    <tr>
                        <th colspan="3">Details of Films/audio-visuals published (if any)</th>
                        <th colspan="3">Details of research scholors successfully guided and those currently pursuing MPhil/ Ph.D under your supervision</th>                         
                    </tr>
                    <tr>
                        <td id="audio_videos" colspan="3"></td>
                        <td id="details_scholars" colspan="3"></td>                         
                    </tr>


                    <tr>
                        <th colspan="3">Are you ready to give commitment to work at the selected host institute for full tenure of the fellowship granted</th>
                        <th colspan="3">Are you willing to submit a bond in this regard to the host institution? </th>                         
                    </tr>
                    <tr>
                        <td id="commitments" colspan="3"></td>
                        <td id="submit_bonds" colspan="3"></td>                         
                    </tr>

                    <tr>
                        <th colspan="3">List up details of scientific & Techinical Papers published</th>
                        <th colspan="3">Why you should be selected National Solar Science Fellow and how the proposed research project </th>                         
                    </tr>
                    <tr>
                        <td id="paper_publish" colspan="3"></td>
                        <td id="why_select" colspan="3"></td>                         
                    </tr>
                    <tr>
                        <th colspan="3">Selected ID Proof Type</th>
                        <th colspan="3"> ID Proof in PDF format </th>                         
                    </tr>
                    <tr>
                        <td id="id_proofs" colspan="3"></td>
                        <td id="file_id_proofs" colspan="3"></td>                         
                    </tr>

                     <tr>
                        <th colspan="3">Upload one-page doc of Original, innovative and pioneering research work</th>
                        <th colspan="3"> Candidate Photograph* </th>                         
                    </tr>
                    <tr>
                        <td id="research_works" colspan="3"></td>
                        <td id="candidate_photos" colspan="3"></td>                         
                    </tr>
                    <tr><th colspan="6"><h4>Please provide three (3) references with complete contact details</h4></th></tr>
                    <tr>
                        <th colspan="2">References Name</th>
                        <th colspan="2">References Email</th>
                        <th colspan="2">References Phone</th>
                         
                    </tr>
                    <tr class="table-active">
                    	 <td id="refname0" colspan="2"></td>
                    	 <td id="refemail0" colspan="2"></td>
                    	 <td id="refphone0" colspan="2"></td>
                    	  
                    </tr>
                     <tr class="table-success">
                    	 <td id="refname1" colspan="2"></td>
                    	 <td id="refemail1" colspan="2"></td>
                    	 <td id="refphone1" colspan="2"></td>
                    	  
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>  

            </div>
        </div>
    </div>
</div>
 <style type="text/css">
  ::placeholder {  
  	font-size: 0.8em;
  	color:#000000 !important;
  }
  .modal-header{
background-color: #334FFF;
  }

 #father_name::after,#pincode::after,#address::after,#ar_spc::after,#spcl_achvmnt::after,#details_awards::after,#book_published::after,#details_schola::after,#audio_video::after,#details_scholar::after,#paper_published::after,#why_selected::after {
  content:" *";
  display:block;
  color:red !important;
}
.form-control[readonly] {
    background-color:#fff !important;
 }
span.input-group-addon {
  background-color:#fff !important;
 }
.form-control[disabled] {
    background-color:#fff !important;
}
.form-control[disabled] {
    border-color:#000 !important;
}
.form-control[readonly] {
    border-color:#000 !important;
}
#file_photo_error {
   font-size:16px; 
}
.error {
 	color:red;
   font-size:12px; 
}
 </style>	
<script type="text/javascript">

//$('#submitBtn').on('click', function() {
    //$("#felloship_solar").validate();
	//document.getElementById("felloship_solar").submit();
//});
	
$('#submitBtn').click(function () {
	
	//$('#submitBtn').attr('data-target','#testModal2');
	
	$("#felloship_solar").validate();
	
	if ($("#felloship_solar").valid()) {
		
		$('#submitBtn').attr('data-target','#confirm-submit');
	}
	else
	{
		alert("Please Fill all required fields");
		$('#submitBtn').attr('data-target','#');
	}
	

    /* when the button in the form, display the entered values in the modal */
   $('#first_namev').html($('#first_name').val());
    $('#middle_namev').html($('#middle_name').val());
    $('#last_namev').html($('#last_name').val());

    $('#email_idv').html($('#email_id').val());
    $('#dobv').html($('#dob').val());
    if($('#gender').val() == 1){
    	$('#genderv').html('Male');
    }
    if($('#gender').val() == 2){
    	$('#genderv').html('Female');
    }
    if($('#gender').val() == 0){
    	$('#genderv').html('Others');
    }
     
    $('#mobile_nov').html($('#mobile_no').val());

    $('#countrycdv').html($('#countryid').val());
    $('#statecdv').html($('#stateid').val());
    $('#districtcdv').html($('#districtid').val());

    //Education Detail
    $('#c0').html($('#courseid_0').val());
    $('#c1').html($('#courseid_1').val());
    $('#c2').html($('#courseid_2').val());
    $('#c3').html($('#courseid_3').val());
    $('#c4').html($('#courseid_4').val());
    $('#c5').html($('#courseid_5').val());
         
    $('#ins0').html($('#institute_0').val());
    $('#ins1').html($('#institute_1').val());
    $('#ins2').html($('#institute_2').val());
    $('#ins3').html($('#institute_3').val());
    $('#ins4').html($('#institute_4').val());
    $('#ins5').html($('#institute_5').val());
    
    $('#st0').html($('#stream_0').val());
    $('#st1').html($('#stream_1').val());
    $('#st2').html($('#stream_2').val());
    $('#st3').html($('#stream_3').val());
    $('#st4').html($('#stream_4').val());
    $('#st5').html($('#stream_5').val());
     
    $('#pass0').html($('#passstatus_0').val());
    $('#pass1').html($('#passstatus_1').val());
    $('#pass2').html($('#passstatus_2').val());
    $('#pass3').html($('#passstatus_3').val());
    $('#pass4').html($('#passstatus_4').val()); 
    $('#pass5').html($('#passstatus_5').val()); 
     
	$('#yearcomp0').html($('#yearcompletion_0').val());
	$('#yearcomp1').html($('#yearcompletion_1').val());
	$('#yearcomp2').html($('#yearcompletion_2').val());
	$('#yearcomp3').html($('#yearcompletion_3').val());
	$('#yearcomp4').html($('#yearcompletion_4').val());
	$('#yearcomp5').html($('#yearcompletion_5').val());
     
	$('#markspercen0').html($('#markspercentage_0').val());
	$('#markspercen1').html($('#markspercentage_1').val());
	$('#markspercen2').html($('#markspercentage_2').val());
	$('#markspercen3').html($('#markspercentage_3').val());
	$('#markspercen4').html($('#markspercentage_4').val());
	$('#markspercen5').html($('#markspercentage_5').val());
     
   $('#area_spce').html($('#area_spc').val());
   $('#special_ach').html($('#special_achievement').val());
   
   $('#details_award').html($('#details_awards').val());
   $('#book_publish').html($('#book_published').val()); 

   $('#audio_videos').html($('#audio_video').val());
   $('#details_scholars').html($('#details_scholar').val()); 


   $('#commitments').html($('#commitment').val());
   $('#submit_bonds').html($('#submit_bond').val()); 
   
   $('#paper_publish').html($('#paper_published').val());
   $('#why_select').html($('#why_selected').val());  

   $('#id_proofs').html($('#id_proof').val());
   $('#file_id_proofs').html($('#file_id_proof').val());  

   $('#research_works').html($('#research_work').val());
   $('#candidate_photos').html($('#candidate_photo').val());  

   $('#refname0').html($('#refname_0').val());
   $('#refemail0').html($('#refemail_0').val());
   $('#refphone0').html($('#refphone_0').val());

   $('#refname1').html($('#refname_[object HTMLInputElement]').val());
   $('#refemail1').html($('#refemail_[object HTMLInputElement]').val());
   $('#refphone1').html($('#refphone_[object HTMLInputElement]').val()); 

   
});

	$(document).ready( function(){

    $('#add_fields').click( function(){
        add_inputs()
    });
    
    $('#addref').click( function(){
        add_ref()
    });
    

    $(document).on('click', '.remove_fields', function() {
 
var counter = parseInt($('#counter').val());

$(this).closest('.record').remove();
counter = counter-1;	
//alert(counter);	
parseInt($('#counter').val(counter));

    });

    $(document).on('click', '.remove_field', function() {
        
var counters = parseInt($('#counters').val());

$(this).closest('.records').remove();
counters = counters-1;	
//alert(counters);	
parseInt($('#counters').val(counters));
    });

    function add_inputs(){
       var counter = parseInt($('#counter').val());    
        if(counter <=4){  
       var html = '<tr class="record"><td class="text-center"><select class="form-control courseid_input" name="courseid[]" id="courseid_' + counter + '"><option value="">Course</option><option value="Diploma level">Diploma level</option><option value="Graduation - BA / BSc etc.">Graduation - BA / BSc etc.</option><option value="Graduation - BE / BTech  etc">Graduation - BE / BTech  etc</option><option value="Junior Research Fellowship (JRF)">Junior Research Fellowship (JRF)</option><option value="Mphil - equivalent">Mphil - equivalent</option><option value="P G Diploma">P G Diploma</option><option value="PhD">PhD</option><option value="Post Graduation - M Tech etc.">Post Graduation - M Tech etc.</option><option value="Post Graduation - MA , MSc etc.">Post Graduation - MA , MSc etc.</option><option value="Post Graduation - MSc in Renewable Energy">Post Graduation - MSc in Renewable Energy </option><option value="Senior research fellowship (SRF)">Senior research fellowship (SRF)</option><option value="XIIth level">XIIth level</option><option value="Xth level">Xth level</option></select></td><td><input type="text" name="institute[]" id="institute_' + counter + '" placeholder="Enter Institute*" class="form-control institute_input"></td><td> <input type="text" class="form-control stream_input"  maxlength="50" value="" placeholder="Stream*" name="stream[]" id="stream_' + counter + '">	</td><td><select class="form-control passstatus_input" name="passstatus[]" id="passstatus_' + counter + '"  width=100px><option value>Status*</option><option value="1">Pursuing</option><option value="2">Passed</option></select></td><td><input type="text" class="form-control yearcompletion_input" maxlength="4"  placeholder="YOP*" name="yearcompletion[]" id="yearcompletion_'+ counter + '"></td><td><input type="text" class="form-control markspercentage_input" maxlength="5" placeholder="Percentage*" name="markspercentage[]"  id="markspercentage_'+ counter +'"></td><td><button type="button" class="remove_fields">-</button></td></tr>';         
        
        $('#table_append').append(html);
        $('#counter').val( counter + 1 );
    }else{
    	alert('Only five Education Details row is allowed');

    }
         
    }

    function add_ref(){
       var counters = parseInt($('#counters').val());	   
       if(counters <=2){
       var html = '<tr class="records"><td><input type="text" name="refname[]" id="refname_' + counter + '" placeholder="Name *" class="form-control refname_input"></td><td><input type="text" class="form-control refemail_input" value="" placeholder="Email*" name="refemail[]" id="refemail_' + counter + '">	</td><td><input type="text" class="form-control refphone_input" placeholder="Phone" name="refphone[]" id="refphone_'+ counter + '" pattern="[6-9]{1}[0-9]{9}" title="Phone number with 6-9 and remaing 9 digit with 0-9" onkeypress="return isNumberKey(event)"></td><td><button type="button" class="remove_field">-</button></td></tr>';         
        
        $('#table_appends').append(html);
        $('#counters').val( counters + 1 );
        }else{
    	alert('Only two references row is allowed');

    	}
    }

    $("#hide").click(function(){
 		$("#employediv").hide();
	});

	$("#show").click(function(){
  		$("#employediv").show();
	});
});


	 $('#felloship_solar').on('submit', function(event) {
        //Add validation rule for dynamically generated name fields
       // alert('hello');
	  	 
    $( "#pincode" ).rules( "add", {
    	required: true,
        minlength: 6,
        maxlength: 6,
        digits: true
  		 
	});
    $( "#landline" ).rules( "add", {
    	 
        minlength: 8,
        maxlength: 8,
        digits: true
  		 
	});


	$( "#address" ).rules( "add", {
    	required: true,         
        maxlength: 220,
         
  		 
	});

	$( "#salary" ).rules( "add", {
    	required: true,         
        maxlength: 6,
        digits: true,    
  		 
	});
	$( "#id_proof" ).rules( "add", {
    	required: true,         
          		 
	});

	 

	 $( "#organization" ).rules( "add", {
    	required: true,         
        maxlength: 220,
         
  		 
	 });
	 
	 $( "#organization_address" ).rules( "add", {
    	required: true,         
        maxlength: 220,
         
  		 
	 });

	$( "#area_spc" ).rules( "add", {
    	required: true,       
        maxlength: 220,
         
  		 
	});
	$( "#special_achievement" ).rules( "add", {   
		required: true, 	       
        maxlength: 220,  		 
	});

	$( "#details_awards" ).rules( "add", {   
		required: true, 	       
        maxlength: 220,  		 
	});

	$( "#book_published" ).rules( "add", {   
		required:true, 	       
        maxlength: 220,  		 
	});

	$( "#audio_video" ).rules( "add", {    
		required:true,	       
        maxlength: 220,  		 
	});
	$( "#details_scholar" ).rules( "add", {    
		required:true,	       
        maxlength: 220,  		 
	});
	$( "#paper_published" ).rules( "add", { 
		required:true,   	       
        maxlength: 999,  		 
	});
	$( "#why_selected" ).rules( "add", {   
		required:true,
        maxlength: 999,  		 
	});
	$( "#employed_inst" ).rules( "add", {    	       
        required: true,  	 
	});

	$( "#file_id_proof" ).rules( "add", {    	       
        required: true, 
        extension: "pdf" 	 
	});
	
	$( "#research_work" ).rules( "add", {    	       
        required: true, 
        extension: "pdf" 	 
	});  
	$( "#candidate_photo" ).rules( "add", {    	       
        required: true, 
        extension: "jpg" 	 
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
    //Add validation rule for dynamically generated email fields
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
    $('.yearcompletion_input').each(function() {
        $(this).rules("add", 
            {
                required: true,
                maxlength: 4,
                digits: true,
                messages: {
                    required: "field is required",
                }
            });
    });
    $('.markspercentage_input').each(function() {
        $(this).rules("add", 
            {
                required: true,
                maxlength: 3,
                digits: true,
                messages: {
                    required: "field is required",
                }
            });
    });
    $('.refname_input').each(function() {
        $(this).rules("add", 
            {
                //required: true,
                messages: {
                    required: "field is required",
                }
            });
    });
    $('.refemail_input').each(function() {
        $(this).rules("add", 
            {
                //required: true,
                email: true ,
                messages: {
                    required: "field is required",
                }
            });
    });
    $('.refphone_input').each(function() {
        $(this).rules("add", 
            {
               // required: true,
                 
                digits: true,

                messages: {
                    required: "field is required",
                }
            });
    });
}); 
$("#felloship_solar").validate(); 
</script>     
@endsection
	
	