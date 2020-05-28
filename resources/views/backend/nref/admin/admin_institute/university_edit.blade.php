@extends('layouts.master')

@section('container')

 <div class="content-wrapper" >
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ url('home')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Edit Institute</li>
      </ol>
<div class="card card-login mx-auto mt-5 " style="max-width: 100rem;">
	
	  <script src="{{ asset('public/js/institute_validation.js') }}"></script>
<?php //dd($data['institute_data']);?>
<div class="card-header text-center"><h4 class="mt-2">Application - <?php if(!empty($data['institute_data']->application_cd)) { echo $data['institute_data']->application_cd;}?> </h4></div>
    
	  
    
      <div class="card-body">
     	<form  enctype="multipart/form-data"  action="{{ route('update-university',$data['institute_data']->institute_id) }}" class=""   autocomplete="off" id="institute_form" method="POST" >
			<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
			
				 <?php 
			$crseDtls=json_decode($data['institute_data']->course_offered_dept);
			$countArray=count((array)$crseDtls);
			
			//echo $countArray;
			?>
		<input type="hidden" id="counter" value="<?php if($countArray>0) { echo $countArray; } else { echo '1';} ?>">          

							<div class="form-group">
								<div class="row">
								    <div class="col-md-4">
									<label for="name"  style="font-size: 13px;" class="control-label">Name of the Institute</label>
										<input type="text" class="form-control" value="<?php if(!empty($data['institute_data'])) { echo $data['institute_data']->institute_name;} ?>" id="institute_name"  name="institute_name" placeholder="Institute Name*">
										@if ($errors->has('institute_name'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('institute_name') }}</strong>
											</span>
										@endif
								    </div>
									
									<div class="col-md-4">
									<label for="name"  style="font-size: 13px;" class="control-label">Name of the Department</label>
										<input type="text"  class="form-control" value="<?php if(!empty($data['institute_data'])) { echo $data['institute_data']->department_name;} ?>"  id="dept_name" placeholder="Name of the department*" name="dept_name">
									    @if ($errors->has('dept_name'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('dept_name') }}</strong>
											</span>
										@endif
								    </div>
									
									<div class="col-md-4">
									<label for="name"  style="font-size: 13px;" class="control-label">Coordinator of the Proposed Program</label>
										<input class="form-control" type="text" value="<?php if(!empty($data['institute_data'])) { echo $data['institute_data']->coordinate_prog;} ?>" name="coordinate_prog" placeholder="Coordinator of the Proposed Program" >
										@if ($errors->has('coordinate_prog'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('coordinate_prog') }}</strong>
											</span>
										@endif
									</div>
								</div> 
							</div>
							
							<div class="form-group">
								<div class="row">
									<div class="col-md-3">
									<label for="name"  style="font-size: 13px;" class="control-label">Type of Institution</label>
										<select class="form-control" name="type_of_institute"  id="type_of_institute">
										    <option value="">Type of Institution</option>
											@foreach($data['type_inst'] as $val)
											<option value="{{$val->institute_type_id}}"  
											<?php 
											if(!empty($data['institute_data']->institute_type_id)){
												if($data['institute_data']->institute_type_id == $val->institute_type_id){
													echo "Selected";
												}
											} 
											?>>{{$val->institute_desc}}</option>
											@endforeach
								   	    </select>
									</div>
									
									
									
									
									<div class="col-md-4">
									<label for="name"  style="font-size: 13px;" class="control-label">University/Institute Ranking as per UGC/NIRF</label>
										<input onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text"  min="0" maxlength="10" class="form-control"  value="<?php if(!empty($data['institute_data']->university_rank)){ ?>{{ $data['institute_data']->university_rank }} <?php } ?>" id="university_rank" placeholder="University Ranking as per UGC" name="university_rank">
									</div>
									
									<?php //$curse=explode(',',$data['institute_data']->lstCourse); ?>
									<!--<div class="col-md-3">
									<label for="name"  style="font-size: 13px;" class="control-label">Course offered by department</label>
										<select class="form-control" name="lstCourse[]"  id="lstCourse" multiple required>
										   @if(isset($data['courses_list']))
											@foreach($data['courses_list'] as $val)
											<option value="{{$val->course_id}}" <?php /* if(count($curse)>0) { for($k=0;$k<count($curse);$k++) { if($curse[$k]==$val->course_id) { echo "selected";} } } */ ?>>{{$val->course_name}}</option>
											@endforeach
											@endif
								   	    </select>
									</div>-->
									
									
								</div> 
							</div>
							
							<div class="form-group">
								<div class="row">
								
								<div class="col-md-4">
									<label for="name"  style="font-size: 13px;" class="control-label">Please enclosed a copy of last annual report</label>
										<input name="annual_report" type="file" class="form-control" value="{{ old('annual_report')}}" id="annual_report" >
                                        <label style="color:#FF0000; font-size:11px;"> (File Format accepts: PDF &amp; Maximum Size: 1MB)</label><br><span  style=" font-size: 12px;"id="annual_report_error"> </span>										
									    @if ($errors->has('annual_report'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('annual_report') }}</strong>
											</span>
										@endif
										@if ($annual_report_error = Session::get('ex_error'))
										 <div class="alert" style="color:red">
										   <strong>{{ $annual_report_error }}</strong>
										 </div>
									   @endif
									</div>
									
								@if(isset($data['institute_data']->annual_report))
								<div class="col-md-4">
								<p>&nbsp;</p>
								<a href="{{ asset('public/uploads/nref/'.$data['institute_data']->annual_report) }}" download><?php if($data['institute_data']->annual_report) { echo $data['institute_data']->annual_report; } ?></a>
								</div>
								<input type="hidden" name="attn_repo" id="attn_repo" value="<?php echo $data['institute_data']->annual_report;?>" />
								@endif
								
								<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;" class="control-label">Years of Establishment</label>
										<input class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text"  min="0" maxlength="4" value="<?php if(!empty($data['institute_data']->year_establishment)){ ?>{{$data['institute_data']->year_establishment}}<?php } ?>" id="yr_est" placeholder="Years of Establishment" name="yr_est">
										@if ($errors->has('yr_est'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('yr_est') }}</strong>
											</span>
										@endif
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">Approx. Number of Students in Proposed Program</label>
										<input class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text"  min="0" maxlength="5" value="<?php if(!empty($data['institute_data']->no_student)){ ?>{{$data['institute_data']->no_student}}<?php } ?>" id="apx_stdnt" placeholder="Approx. Number of Students" name="apx_stdnt">
										@if ($errors->has('apx_stdnt'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('apx_stdnt') }}</strong>
											</span>
										@endif
									</div>
								
								</div> 
							</div>
							
							<!--- NEW Functionality Add more -->
							
							<table border="0" class="table table-bordered table-striped table-hover" id="tab0">
                    <thead style="font-size: 14px; font-weight: 300;line-height: 0.9;">
						<tr>
                             
                            <th>Course Offered by department</th>
                            <th class="text-center">Approx. Number of Students</th>
                            <th class="text-center">Click Add Row for additional course</th>
                        </tr>
                    </thead>
                    <tbody id="table_append" class="table_append">
						<div> 
						
						<?php $p=0;						
							if(isset($crseDtls)) { foreach($crseDtls as $key=>$value)
							{ ?>
							
							<tr class="record">
							
				
                                 
                                <td class="text-center">
	                                <select class="form-control courseid_input required" name="courseid[]" id="courseid_<?php echo $p; ?>">
										<option value="">Select Course</option>
											@foreach($data['courses_offered'] as $val) 
										   		<option value="{{$val->course_id}}"  <?php if($key==$val->course_id) { echo "selected";} ?>>{{$val->course_name}}</option>
											@endforeach 
									</select>
									@if ($errors->has('course_id'))courses_offered
										<span class="invalid-feedback " role="alert">
											<strong>{{ $errors->first('course_id') }}</strong>
										</span>
									@endif
								</td>
                                <td class="text-center">
                                	<input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control required"  maxlength="50" value="<?php echo $crseDtls->$key; ?>"  id="student_<?php echo $p; ?>" placeholder="Enter No of student*" name="studentno[]">									   
									@if ($errors->has('studentno'))
										<span class="invalid-feedback " role="alert">
											<strong>{{ $errors->first('studentno') }}</strong>
										</span>
									@endif
								</td>
								
								
                                
                                <td>  
								
								@if($p==0)
								    <div class="form-group button-group ">
									    <input type="button" id="add_fields" class="add_button1" name="add_fields" value="+">
									    
						            </div>
									@else
										<button type="button" class="remove_fields">-</button>
									@endif
								</td>
								
									
								
								
							
								
								
                            </tr>
							
							<?php $p++;} } else {  ?>
							
							<tr>
                                 
                                <td class="text-center">
	                                <select class="form-control courseid_input required" name="courseid[]" id="courseid_0">
										<option value="">Select Course</option>
											@foreach($data['courses_offered'] as $val) 
										   		<option value="{{$val->course_id}}">{{$val->course_name}}</option>
											@endforeach 
									</select>
									@if ($errors->has('course_id'))courses_offered
										<span class="invalid-feedback " role="alert">
											<strong>{{ $errors->first('course_id') }}</strong>
										</span>
									@endif
								</td>
                                <td class="text-center">
                                	<input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control required"  maxlength="50" value="" id="student_0; ?>" placeholder="Enter No of student*" name="studentno[]">									   
									@if ($errors->has('studentno'))
										<span class="invalid-feedback " role="alert">
											<strong>{{ $errors->first('studentno') }}</strong>
										</span>
									@endif
								</td>
								
								
                                
                                <td>
								    <div class="form-group button-group ">
									    <input type="button" id="add_fields" class="add_button1" name="add_fields" value="+">
									    
						            </div>
								</td>
								
									
								
								
							
								
								
                            </tr>
							
							<?php } ?>
                        </div>
                    </tbody>
                </table>
							
							<!-- New Functionality ADD more -->
							
							<br>
							<h4><u>Details of the Course:-</u></h4>
							
							<div class="form-group">
								<div class="row">
									
									<div class="col-md-6">
									<label for="name"  style="font-size: 13px;" class="control-label">Name and Qualification of the Faculty Members attached to the course</label>
										<input name="file_course_proof" type="file" class="form-control" value="{{ old('file_course_proof')}}" id="file_course_proof">
                                        <label style="color:#FF0000; font-size:11px;"> (File Format accepts: PDF &amp; Maximum Size: 1MB)</label><br><span  style=" font-size: 12px;"id="file_id_proof_error"> </span>										
									    @if ($errors->has('file_course_proof'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('file_course_proof') }}</strong>
											</span>
										@endif
										@if ($file_course_proof_error = Session::get('ex_error'))
										 <div class="alert" style="color:red">
										   <strong>{{ $file_course_proof_error }}</strong>
										 </div>
									   @endif
									</div>
									
								@if(isset($data['institute_data']->faculty_details))
									
								<div class="col-md-6">
								<p>&nbsp;</p>
								<a href="{{ asset('public/uploads/nref/'.$data['institute_data']->faculty_details) }}" download><?php if($data['institute_data']->faculty_details) { echo $data['institute_data']->faculty_details; } ?></a>
								</div>
								<input type="hidden" name="fac_det" id="fac_det" value="<?php echo $data['institute_data']->faculty_details;?>" />
								@endif
									
									
									
									<div class="col-md-3">
									
             <label for="name"  style="font-size: 13px;" class="control-label">Any Collaborative Institute</label>
                                        <select name="collab_inst" id="collab_inst" class="form-control">
										    <option value="">----- Select -----</option>
											<option value="yes" <?php if(!empty($data['institute_data']->any_collaboration)) { ?> @if($data['institute_data']->any_collaboration=='yes') selected @endif <?php } ?>>Yes</option>
											<option value="no" <?php if(!empty($data['institute_data']->any_collaboration)) { ?> @if($data['institute_data']->any_collaboration=='no') selected @endif <?php } ?>>No</option>
											
										</select>
										
									</div>
									
									<div class="col-md-4" style="display:none;" id="prevstd1">
									<label for="name"  style="font-size: 13px;" class="control-label"> Name of Collaborate Institute</label>
										<input name="collab_institute" type="text" class="form-control" value="<?php if(!empty($data['institute_data']->collab_institute)){ ?>{{$data['institute_data']->collab_institute}}<?php } ?>" id="collab_institute" >										
									    @if ($errors->has('collab_institute'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('collab_institute') }}</strong>
											</span>
										@endif
			
									</div>
									
									<?php //echo '=='.$data['institute_data']->research_phd; ?>
									<div class="col-md-5 colab_inst_yes" style="padding:2em 0em 0em 1em">
									@if(isset($data['institute_data']->research_phd)) <?php $ss=explode(',',$data['institute_data']->research_phd); //echo '<pre>';print_r($ss); echo count($ss);die; ?>@endif
									<input name="resrch_phd[]" type="checkbox" value="Research" id="research" class="resrch_phd research" @if(isset(
									$data['institute_data']->research_phd)) <?php if(count($ss)>0) { for($i=0;$i<count($ss);$i++) { if($ss[$i]=='Research') { echo "checked";} } } ?> @endif> Research
									
									
									<input name="resrch_phd[]" type="checkbox" value="Ph. D Registration" id="phd" class="resrch_phd phd" @if(isset($data['institute_data']->research_phd)) <?php if(count($ss)>0) { for($i=0;$i<count($ss);$i++) { if($ss[$i]=='Ph. D Registration') { echo "checked";} } }  ?>@endif > Ph. D Registration
									
									
									<input name="resrch_phd[]" type="checkbox" value="Post Graduate Program" id="postgrad" class="resrch_phd postgrad" @if(isset($data['institute_data']->research_phd)) <?php if(count($ss)>0) { for($i=0;$i<count($ss);$i++) { if($ss[$i]=='Post Graduate Program') { echo "checked";} } }  ?>@endif> Post Graduate Program
                                        
									</div>
									
									
								</div>
							</div>
							
							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">Experience in Energy related courses</label>
										<input type="text" class="form-control" min="0" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php if(!empty($data['institute_data']->energy_experience)){ ?>{{$data['institute_data']->energy_experience}}<?php } ?>" id="exp_energy_course" placeholder="Experience in Energy related courses" name="exp_energy_course">
										@if ($errors->has('exp_energy_course'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('exp_energy_course') }}</strong>
											</span>
										@endif
									</div>
									</div>
									
									<div class="row">
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">A) Date of approximate course Start</label>
										<input type="text" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57 && event.charCode >= 65" value="<?php if(!empty($data['institute_data']->course_start_date)){ ?>{{date('Y-m-d',strtotime($data['institute_data']->course_start_date))}}<?php } ?>" id="course_run" placeholder="Since when the course being run" name="course_run">
										@if ($errors->has('course_run'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('course_run') }}</strong>
											</span>
										@endif
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">B) Number of Seats in each of the course</label>
										<input type="text" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php if(!empty($data['institute_data']->no_of_seat)){ ?>{{$data['institute_data']->no_of_seat}}<?php } ?>" id="no_seat_course" placeholder="Number of Seats in each of the course" name="no_seat_course">
										@if ($errors->has('no_seat_course'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('no_seat_course') }}</strong>
											</span>
										@endif
									</div>
									
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">C) Specialization offered</label>
										<input type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase();" value="<?php if(!empty($data['institute_data']->specialization_offered)){ ?>{{$data['institute_data']->specialization_offered}}<?php } ?>" id="spl_offer" placeholder="Specialization offered" name="spl_offer">
										@if ($errors->has('spl_offer'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('spl_offer') }}</strong>
											</span>
										@endif
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">D) If any industry collaboration is there, if so details thereof</label>
										<input type="text" class="form-control" value="<?php if(!empty($data['institute_data']->industry_collaboration)){ ?>{{$data['institute_data']->industry_collaboration}}<?php } ?>" id="indus_collab" placeholder="If any industry collaboration is there, if so details thereof" name="indus_collab">
										@if ($errors->has('indus_collab'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('indus_collab') }}</strong>
											</span>
										@endif
									</div>
									
									
									<div class="col-md-4">
									
                                  <label for="name"  style="font-size: 12px;" class="control-label">E) If placement service is being provided</label>
                                        <select name="place_service" id="place_service" class="form-control">
										    <option value="">----- Select -----</option>
											<option value="yes" <?php if(!empty($data['institute_data']->placement_details)){ ?>@if($data['institute_data']->placement_details=='yes') selected @endif <?php } ?>>Yes</option>
											<option value="no" <?php if(!empty($data['institute_data']->placement_details)){ ?>@if($data['institute_data']->placement_details=='no') selected @endif <?php } ?>>No</option>
											
										</select>
										
										@if ($errors->has('place_service'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('place_service') }}</strong>
											</span>
										@endif
										
									</div>
									
									
									<div class="col-md-4" style="display:none;" id="prevstd">
									<label for="name"  style="font-size: 13px;" class="control-label">F) Details of placement of previous students</label>
										<input name="file_prevStudent_proof" type="file" class="form-control" value="{{ old('file_id_proof')}}" id="file_prevStudent_proof">
                                        <label style="color:#FF0000; font-size:11px;"> (File Format accepts: PDF &amp; Maximum Size: 1MB)</label><br><span  style=" font-size: 12px;"id="file_id_proof_error"> </span>										
									    @if ($errors->has('file_prevStudent_proof'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('file_prevStudent_proof') }}</strong>
											</span>
										@endif
										
										@if(isset($data['institute_data']->file_prevStudent_proof))
										<a href="{{ asset('public/uploads/nref/'.$data['institute_data']->file_prevStudent_proof) }}" download><?php if($data['institute_data']->file_prevStudent_proof) { echo $data['institute_data']->file_prevStudent_proof; } ?></a>
										@endif
										
										@if ($file_prevStudent_proof_error = Session::get('ex_error'))
										 <div class="alert" style="color:red">
										   <strong>{{ $file_prevStudent_proof_error }}</strong>
										 </div>
									   @endif
									   
									   
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label"><span id='val1d'></span>) Any other details</label>
										<input type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase();" value="<?php if(!empty($data['institute_data']->other_details)){ ?>{{$data['institute_data']->other_details}}<?php } ?>" id="other_details" placeholder="Any other details" name="other_details">
										@if ($errors->has('other_details'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('other_details') }}</strong>
											</span>
										@endif
									</div>
									
									
									<div class="col-md-6">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">Sponsored Projects in the area of Energy, Environment and Renewable Energy</label>
										<input type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase();" value="<?php if(!empty($data['institute_data']->spon_project)){ ?>{{$data['institute_data']->spon_project}}<?php } ?>" id="spon_project" placeholder="Sponsored Projects in the area of Energy, Environment and Renewable Energy" name="spon_project">
										@if ($errors->has('spon_project'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('spon_project') }}</strong>
											</span>
										@endif
									</div>
									
								</div> 
							</div>
							
							<div class="form-group">
								<div class="row">
								<label for="name"  style="font-size: 13px;color:#000" class="control-label">Fellowship slot requirement :</label>
								</div>
								
								<div class="row">
								<div class="col-md-4">
									<label for="name"  style="font-size: 13px;" class="control-label">Fellowship slot requirement Period</label>
										<select class="form-control fellowship_period" name="fellowship_period"  id="fellowship_period" >
										    <option value="">Select Period</option>
											<option value="2020-2021" <?php if(isset($data['institute_data']->fellowship_period)) { if($data['institute_data']->fellowship_period=="2020-2021") { echo "selected"; } } ?>>2020-2021</option>
											<option value="2021-2022" <?php if(isset($data['institute_data']->fellowship_period)) { if($data['institute_data']->fellowship_period=="2021-2022") { echo "selected"; } }?>>2021-2022</option>
											<option value="2022-2023" <?php if(isset($data['institute_data']->fellowship_period)) { if($data['institute_data']->fellowship_period=="2022-2023") { echo "selected"; } } ?>>2022-2023</option>
											<option value="2023-2024" <?php if(isset($data['institute_data']->fellowship_period)) { if($data['institute_data']->fellowship_period=="2023-2024") { echo "selected"; } } ?>>2023-2024</option>
											<option value="2024-2025" <?php if(isset($data['institute_data']->fellowship_period)) { if($data['institute_data']->fellowship_period=="2024-2025") { echo "selected"; } } ?>>2024-2025</option>
											
								   	    </select>
									</div>
									</div>
									
								<div class="row">
								<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">M.Tech.</label>
										<input type="text" class="form-control fellow" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php if(!empty($data['institute_data']->fellowship_mtech)){ ?>{{$data['institute_data']->fellowship_mtech}}<?php } ?>" id="mtech" placeholder="M.Tech." name="mtech">
										@if ($errors->has('mtech'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('mtech') }}</strong>
											</span>
										@endif
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">JRF</label>
										<input type="text" class="form-control fellow" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php if(!empty($data['institute_data']->fellowship_jrf)){ ?>{{$data['institute_data']->fellowship_jrf}}<?php } ?>" id="jrf" placeholder="JRF" name="jrf">
										@if ($errors->has('jrf'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('jrf') }}</strong>
											</span>
										@endif
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">SRF</label>
										<input type="text" class="form-control fellow" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php if(!empty($data['institute_data']->fellowship_srf)){ ?>{{$data['institute_data']->fellowship_srf}}<?php } ?>" id="srf" placeholder="SRF" name="srf">
										@if ($errors->has('srf'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('srf') }}</strong>
											</span>
										@endif
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">M.SC. Renewable Energy</label>
										<input type="text" class="form-control fellow" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php if(!empty($data['institute_data']->fellowship_msc)){ ?>{{$data['institute_data']->fellowship_msc}}<?php } ?>" id="msc" placeholder="M.SC." name="msc">
										@if ($errors->has('msc'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('msc') }}</strong>
											</span>
										@endif
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">RA</label>
										<input type="text" class="form-control ra fellow" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php if(!empty($data['institute_data']->fellowship_ra)){ ?>{{$data['institute_data']->fellowship_ra}}<?php } ?>" id="ra" placeholder="RA" name="ra">
										@if ($errors->has('ra'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('ra') }}</strong>
											</span>
										@endif
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">PDF</label>
										<input type="text" class="form-control pdf fellow" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php if(!empty($data['institute_data']->fellowship_pdf)){ ?>{{$data['institute_data']->fellowship_pdf}}<?php } ?>" id="pdf" placeholder="PDF." name="pdf">
										@if ($errors->has('pdf'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('pdf') }}</strong>
											</span>
										@endif
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">Total</label>
										<input type="text" class="form-control ftotal" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php if(!empty($data['institute_data']->fellowship_total)){ ?>{{$data['institute_data']->fellowship_total}}<?php } ?>" id="ftotal" name="ftotal" readonly>
										
									</div>
									
								
								</div>
								</div>
								
								<div class="form-group">
								<div class="row">
								<div class="col-md-12">
								
								<input id="certified" name="certified" type="checkbox" value="1" <?php if(!empty($data['institute_data']->certified_status)){ if($data['institute_data']->certified_status==1) { echo 'checked'; } } ?> /> <span>We Certified that the information have been verified and correct</span>
					
								</div>
								
								
								</div>
								</div>


							
							<hr>
							
		<div class="col-xs-12 col-sm-12 col-md-12 text-center">
         <button type="submit" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i>&nbsp; Submit</button>
        <!--<a class="btn btn-secondary" href="{{ URL('university')}}"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; Cancel</a>-->
		
		<a class="btn btn-secondary" href="{{ url()->previous() }}"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; Cancel</a>
    </div>

				    </form>
                </div>
            </div>
         </div>
     </div>
	 
	 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	 <style>
	    .BDC_CaptchaIconsDiv{
		   margin-left: 241px;
           margin-top: -54px;
	    }
	    strong{
           color: red;
           font-size: 11px;
        }
	    .error{
		   color: red;
		   font-size: 12px;
	    }
		/*div.card-body {
			height: 450px;
			overflow: scroll;
		}*/
	</style>
	
		<script type="text/javascript">


var courss = <?php echo json_encode($data['courses_offered']); ?>; 

var opt=[];

for(j=0;j<courss.length;j++)
{
	opt +='<option value="'+ courss[j]['course_id'] +'">'+ courss[j]['course_name']+'</option>';
}

	$(document).ready( function(){

    $('#add_fields').click( function(){
        add_inputs()
    });
    

$(document).on('click', '.remove_fields', function() {
 
var counter = parseInt($('#counter').val());

$(this).closest('.record').remove();
counter = counter-1;	
//alert(counter);	
parseInt($('#counter').val(counter));

    });

    function add_inputs(){
       var counter = parseInt($('#counter').val()); 
	   
	   //alert(counter);

        if(counter <=2){  
       var html = '<tr class="record"><td class="text-center"><select class="form-control courseid_input" name="courseid[]" id="courseid_' + counter + '"><option value="">Select Course</option>'+ opt +'</select></td><td><input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="studentno[]" id="student_' + counter + '" placeholder="Enter No. of student*" class="form-control"></td><td><button type="button" class="remove_fields">-</button></td></tr>';         
        
        $('#table_append').append(html);
        $('#counter').val( counter + 1 );
    }else{
    	alert('Only Three Course Details row is allowed');

    }
         
    }


});

</script>

<script>
$(document).ready(function() { 

var hash = location.hash;
var hash = location.hash.substr(1);

   // var getUrl = window.location;
	// var baseurl =  getUrl.origin + '/' +getUrl.pathname.split('/')[1];
	// var folderName= getUrl.pathname.split('/')[1];
	// var URL1= baseurl+'/'+ hash;
	
	
	// alert(hash);
	
	if(hash=="university")
	{
		$(".pending").addClass("active");
	}
	
	if(hash=="universityCons")
	{
		$(".consider1").addClass("active");
	}
	
	if(hash=="universityNocons")
	{
		$(".rejected").addClass("active");
	}
	
	if(hash=="universityConsAdmin")
	{
		$(".frwdComm").addClass("active");
	}
	
	if(hash=="universitySelected")
	{
		$(".recmndComm").addClass("active");
	}
	
	if(hash=="universityFinalSelected")
	{
		$(".selectdInst").addClass("active");
	}

});
</script>

@endsection
	
	