@extends('layouts.master')

@section('container')

  <script src="{{ asset('public/js/institute_validation.js') }}"></script>
  
 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb" >
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Institute Details Form</li>
      </ol>
	    <!-- Icon Cards-->
	   <div class="card card-login mx-auto mt-5 " style="max-width: 65rem; margin-bottom: 28px;" id="modalCont">
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
            $loginuser_data = $data['loginuser_data'];
			$type_institute = $data['type_institute'];
			$inst_data = $data['institute_details_data'];
			
			
			// echo "<pre>"; print_r($inst_data); echo count($inst_data); die; 
	 ?>
	 <!--<marquee behavior="scroll" z-index:99;="" width="100%" height="30px" scrollamount="3" direction="left" style="background:rgba(0,0,0,.03)"><h3><span style="color:#FF0000;">The internship will be on unpaid basis. No stipend will be provided to interns. </span></h3></marquee>-->
     <div class="card-header text-center"><h4 style="    color: #2384c6;">Institute Details Form</h4></div>
      <div class="card-body">
     	<form enctype="multipart/form-data" action="{{ route('institute-form-post') }}" autocomplete="off" id="institute_form" method="POST" >
			{!! csrf_field() !!}
		
			
				            <div class="form-group">
								<div class="row">
									<div class="col-md-4">
									  <label for="name"  style="font-size: 13px;" class="control-label">Name of the Institute</label>
										<input type="text" readonly class="form-control"   
										value="<?php if(!empty($loginuser_data->institute_name)){ ?>{{ $loginuser_data->institute_name }} <?php } ?>" id="institute_name"  name="institute_name">
									</div>
									
									<div class="col-md-4">
									<label for="name"  style="font-size: 13px;" class="control-label">Name of the Department</label>
										<input type="text"  class="form-control dept_name" value="<?php if(!empty($inst_data->department_name)){ ?>{{ $inst_data->department_name }} <?php } ?>"  id="dept_name" placeholder="Name of the department" name="dept_name" 
										@if(isset($inst_data->final_submit))<?php if($inst_data->final_submit==1) {  echo 'disabled'; } ?>@endif>
									</div>
									<div class="col-md-4">
									<label for="name"  style="font-size: 13px;" class="control-label">Coordinator of the Proposed Program</label>
										<input type="text"  class="form-control coordinate_prog"  value="<?php if(!empty($inst_data->coordinate_prog)){ ?>{{ $inst_data->coordinate_prog }} <?php } ?>" id="coordinate_prog" placeholder="Coordinator of the Proposed Program" name="coordinate_prog" @if(isset($inst_data->final_submit)) <?php if($inst_data->final_submit==1) {  echo 'disabled'; } ?>@endif>
									</div>
								</div> 
							</div>
						
							
							<div class="form-group">
								<div class="row">
									<div class="col-md-3">
									<label for="name"  style="font-size: 13px;" class="control-label">Type of Institution</label>
										<select class="form-control type_of_institute" name="type_of_institute"  id="type_of_institute" 
										@if(isset($inst_data->final_submit))<?php if($inst_data->final_submit==1) {  echo 'disabled'; } ?> @endif>
										    <option value="">Type of Institution</option>
											@foreach($type_institute as $val)
											<option value="{{$val->institute_type_id}}"  
											<?php 
											if(!empty($inst_data->institute_type_id)){
												if($inst_data->institute_type_id == $val->institute_type_id){
													echo "Selected";
												}
											} 
											?>>{{$val->institute_desc}}</option>
											@endforeach
								   	    </select>
									</div>
									
									
									<div class="col-md-4">
									<label for="name"  style="font-size: 13px;" class="control-label">University/Institute Ranking as per UGC/NIRF</label>
										<input onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text"  min="0" maxlength="10" class="form-control university_rank"  value="<?php if(!empty($inst_data->university_rank)){ ?>{{ $inst_data->university_rank }} <?php } ?>" id="university_rank" placeholder="University Ranking as per UGC" name="university_rank" @if(isset($inst_data->final_submit)) <?php if($inst_data->final_submit==1) {  echo 'disabled'; } ?> @endif>
									</div>
								</div> 
							</div>
							
							<div class="form-group">
								<div class="row">
								
								<div class="col-md-4">
									<label for="name"  style="font-size: 13px;" class="control-label">Please enclosed a copy of last annual report</label>
										<input name="annual_report" type="file" class="form-control annual_report" value="{{ old('annual_report')}}" id="annual_report" required @if(isset($inst_data->final_submit))<?php if($inst_data->final_submit==1) {  echo 'disabled'; } ?> @endif>
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
									
									@if(isset($inst_data->annual_report) && $inst_data->final_submit==1)
								<div class="col-md-4 hideannualReport">
								<p>&nbsp;</p>
								<a href="{{ asset('public/uploads/nref/annual_report/'.$inst_data->annual_report) }}" download><?php if($inst_data->annual_report) { echo $inst_data->annual_report; } ?></a>
								</div>
								@endif
								
								<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;" class="control-label">Years of Establishment</label>
										<input class="form-control yr_est" onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text"  min="0" maxlength="4" value="<?php if(!empty($inst_data->year_establishment)){ ?>{{$inst_data->year_establishment}}<?php } ?>" id="yr_est" placeholder="Years of Establishment" name="yr_est" @if(isset($inst_data->final_submit))<?php if($inst_data->final_submit==1) {  echo 'disabled'; } ?> @endif>
										@if ($errors->has('yr_est'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('yr_est') }}</strong>
											</span>
										@endif
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">Approx. Number of Students in Proposed Program</label>
										<input class="form-control apx_stdnt" onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text"  min="0" maxlength="10" value="<?php if(!empty($inst_data->no_student)){ ?>{{$inst_data->no_student}}<?php } ?>" id="apx_stdnt" placeholder="Approx. Number of Students" name="apx_stdnt" @if(isset($inst_data->final_submit))<?php if($inst_data->final_submit==1) {  echo 'disabled'; } ?> @endif>
										@if ($errors->has('apx_stdnt'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('apx_stdnt') }}</strong>
											</span>
										@endif
									</div>
								
								</div> 
							</div>
							
							<br>
							<h4><u>Details of the Course:-</u></h4>
							
							  <div class="form-group">
								<div class="row">
									
									<div class="col-md-6 file_course_proof">
									<label for="name"  style="font-size: 13px;" class="control-label">Name and Qualification of the Faculty Members attached to the course</label>
										<input name="file_course_proof" type="file" class="form-control" value="{{ old('file_course_proof')}}" id="file_course_proof" required @if(isset($inst_data->final_submit))<?php if($inst_data->final_submit==1) {  echo 'disabled'; } ?> @endif>
                                        <label style="color:#FF0000; font-size:11px;"> (File Format accepts: PDF &amp; Maximum Size: 1MB)</label><br><span  style=" font-size: 12px;"id="file_course_proof_error"> </span>										
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
									
								@if(isset($inst_data->faculty_details) && $inst_data->final_submit==1)
								<div class="col-md-6 file_course_proof">
								<p>&nbsp;</p>
								<a href="{{ asset('public/uploads/nref/'.$inst_data->faculty_details) }}" download><?php if($inst_data->faculty_details) { echo $inst_data->faculty_details; } ?></a>
								</div>
								@endif
									
									<div class="col-md-3">
									
             <label for="name"  style="font-size: 13px;" class="control-label">Any Collaborative Institute</label>
                                        <select name="collab_inst" id="collab_inst" class="form-control collab_inst" @if(isset($inst_data->final_submit))<?php if($inst_data->final_submit==1) {  echo 'disabled'; } ?> @endif>
										    <option value="">----- Select -----</option>
											<option value="yes" <?php if(!empty($inst_data->any_collaboration)) { ?> @if($inst_data->any_collaboration=='yes') selected @endif <?php } ?>>Yes</option>
											<option value="no" <?php if(!empty($inst_data->any_collaboration)) { ?> @if($inst_data->any_collaboration=='no') selected @endif <?php } ?>>No</option>
											
										</select>
										
									</div>
									
									<div class="col-md-5 colab_inst_yes" style="padding:2em 0em 0em 1em">
									@if(isset($inst_data->research_phd)) <?php $ss=explode(',',$inst_data->research_phd); //echo '<pre>';print_r($ss); echo count($ss);die; ?>@endif
									<input name="resrch_phd[]" type="checkbox" value="Research" id="research" class="resrch_phd research" @if(isset($inst_data->research_phd)) <?php if(count($ss)>0) { for($i=0;$i<count($ss);$i++) { if($ss[$i]=='Research') { echo "checked";} } } ?> @endif @if(isset($inst_data->final_submit))<?php if($inst_data->final_submit==1) {  echo 'disabled'; } ?> @endif> Research
									
									
									<input name="resrch_phd[]" type="checkbox" value="Ph. D Registration" id="phd" class="resrch_phd phd" @if(isset($inst_data->research_phd)) <?php if(count($ss)>0) { for($i=0;$i<count($ss);$i++) { if($ss[$i]=='Ph. D Registration') { echo "checked";} } }  ?>@endif @if(isset($inst_data->final_submit))<?php if($inst_data->final_submit==1) {  echo 'disabled'; } ?> @endif> Ph. D Registration
									
									
									<input name="resrch_phd[]" type="checkbox" value="Post Graduate Program" id="postgrad" class="resrch_phd postgrad" @if(isset($inst_data->research_phd)) <?php if(count($ss)>0) { for($i=0;$i<count($ss);$i++) { if($ss[$i]=='Post Graduate Program') { echo "checked";} } }  ?>@endif @if(isset($inst_data->final_submit))<?php if($inst_data->final_submit==1) {  echo 'disabled'; } ?> @endif> Post Graduate Program
                                        
									</div>


									
								</div>
							</div>
							
							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">Experience in Energy related courses</label>
										<input type="text" class="form-control exp_energy_course" onkeyup="this.value = this.value.toUpperCase();" value="<?php if(!empty($inst_data->energy_experience)){ ?>{{$inst_data->energy_experience}}<?php } ?>" id="exp_energy_course" placeholder="Experience in Energy related courses" name="exp_energy_course" @if(isset($inst_data->final_submit))<?php if($inst_data->final_submit==1) {  echo 'disabled'; } ?> @endif>
										@if ($errors->has('exp_energy_course'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('exp_energy_course') }}</strong>
											</span>
										@endif
									</div>
									</div>
									
									<div class="row" >
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">A) Date of approximate course Start</label>
										<input onkeypress="return event.charCode >= 48 && event.charCode <= 57 && event.charCode >= 65" type="text" class="form-control course_run" value="<?php if(!empty($inst_data->course_start_date)){ ?>{{date('Y-m-d',strtotime($inst_data->course_start_date))}}<?php } ?>" id="course_run" placeholder="Since when the course being run" name="course_run" @if(isset($inst_data->final_submit))<?php if($inst_data->final_submit==1) {  echo 'disabled'; } ?> @endif >
											@if ($errors->has('course_run'))
												<span class="invalid-feedback " role="alert">
													<strong>{{ $errors->first('course_run') }}</strong>
												</span>
											@endif
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">B) Number of Seats in each of the course</label>
										<input type="text" class="form-control no_seat_course" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php if(!empty($inst_data->no_of_seat)){ ?>{{$inst_data->no_of_seat}}<?php } ?>" id="no_seat_course" placeholder="Number of Seats in each of the course" name="no_seat_course" @if(isset($inst_data->final_submit))<?php if($inst_data->final_submit==1) {  echo 'disabled'; } ?> @endif>
										@if ($errors->has('no_seat_course'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('no_seat_course') }}</strong>
											</span>
										@endif
									</div>
									
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">C) Specialization offered</label>
										<input type="text" class="form-control spl_offer" onkeyup="this.value = this.value.toUpperCase();" value="<?php if(!empty($inst_data->specialization_offered)){ ?>{{$inst_data->specialization_offered}}<?php } ?>" id="spl_offer" placeholder="Specialization offered" name="spl_offer" @if(isset($inst_data->final_submit))<?php if($inst_data->final_submit==1) {  echo 'disabled'; } ?> @endif>
										@if ($errors->has('spl_offer'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('spl_offer') }}</strong>
											</span>
										@endif
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">D) If any industry collaboration is there, if so details thereof</label>
										<input type="text" class="form-control indus_collab" value="<?php if(!empty($inst_data->industry_collaboration)){ ?>{{$inst_data->industry_collaboration}}<?php } ?>" id="indus_collab" placeholder="If any industry collaboration is there, if so details thereof" name="indus_collab" @if(isset($inst_data->final_submit))<?php if($inst_data->final_submit==1) {  echo 'disabled'; } ?> @endif>
										@if ($errors->has('indus_collab'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('indus_collab') }}</strong>
											</span>
										@endif
									</div>
									
									<div class="col-md-4">
									
                                  <label for="name"  style="font-size: 12px;" class="control-label">E) If placement service is being provided</label>
                                        <select name="place_service" id="place_service" class="form-control place_service" @if(isset($inst_data->final_submit))<?php if($inst_data->final_submit==1) {  echo 'disabled'; } ?> @endif>
										    <option value="">----- Select -----</option>
											<option value="yes" <?php if(!empty($inst_data->placement_details)){ ?>@if($inst_data->placement_details=='yes') selected @endif <?php } ?>>Yes</option>
											<option value="no" <?php if(!empty($inst_data->placement_details)){ ?>@if($inst_data->placement_details=='no') selected @endif <?php } ?>>No</option>
											
										</select>
										
										@if ($errors->has('place_service'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('place_service') }}</strong>
											</span>
										@endif
										
									</div>
									
									
									<div class="col-md-4" style="display:none;" id="prevstd1">
									<label for="name"  style="font-size: 13px;" class="control-label">F) Name of Collaborate Institute</label>
										<input name="collab_institute" type="text" class="form-control" value="<?php if(!empty($inst_data->collab_institute)){ ?>{{$inst_data->collab_institute}}<?php } ?>" id="collab_institute" @if(isset($inst_data->final_submit))<?php if($inst_data->final_submit==1) {  echo 'disabled'; } ?> @endif>										
									    @if ($errors->has('collab_institute'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('collab_institute') }}</strong>
											</span>
										@endif
			
									</div>
									
									
									<div class="col-md-4" style="display:none;" id="prevstd">
									<label for="name"  style="font-size: 13px;" class="control-label">G) Details of placement of previous students</label>
										<input name="file_prevStudent_proof" type="file" class="form-control" value="{{ old('file_id_proof')}}" id="file_prevStudent_proof" @if(isset($inst_data->final_submit))<?php if($inst_data->final_submit==1) {  echo 'disabled'; } ?> @endif>
                                        <label style="color:#FF0000; font-size:11px;"> (File Format accepts: PDF &amp; Maximum Size: 1MB)</label><br><span  style=" font-size: 12px;"id="file_prevStudent_proof_error"> </span>										
									    @if ($errors->has('file_prevStudent_proof'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('file_prevStudent_proof') }}</strong>
											</span>
										@endif
										
										@if(isset($inst_data->file_prevStudent_proof) && $inst_data->final_submit==1)
										<a href="{{ asset('public/uploads/nref/'.$inst_data->file_prevStudent_proof) }}" download><?php if($inst_data->file_prevStudent_proof) { echo $inst_data->file_prevStudent_proof; } ?></a>
										@endif
										
										@if ($file_prevStudent_proof_error = Session::get('ex_error'))
										 <div class="alert" style="color:red">
										   <strong>{{ $file_prevStudent_proof_error }}</strong>
										 </div>
									   @endif
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label"><span id='val1d' class="val1d"></span>) Any other details</label>
										<input type="text" class="form-control other_details" onkeyup="this.value = this.value.toUpperCase();" value="<?php if(!empty($inst_data->other_details)){ ?>{{$inst_data->other_details}}<?php } ?>" id="other_details" placeholder="Any other details" name="other_details" @if(isset($inst_data->final_submit))<?php if($inst_data->final_submit==1) {  echo 'disabled'; } ?> @endif>
										@if ($errors->has('other_details'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('other_details') }}</strong>
											</span>
										@endif
									</div>
									
									
									<div class="col-md-6">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">Sponsored Projects in the area of Energy, Environment and Renewable Energy</label>
										<input type="text" class="form-control spon_project" onkeyup="this.value = this.value.toUpperCase();" value="<?php if(!empty($inst_data->spon_project)){ ?>{{$inst_data->spon_project}}<?php } ?>" id="spon_project" placeholder="Sponsored Projects in the area of Energy, Environment and Renewable Energy" name="spon_project" @if(isset($inst_data->final_submit))<?php if($inst_data->final_submit==1) {  echo 'disabled'; } ?> @endif>
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
										<select class="form-control fellowship_period" name="fellowship_period"  id="fellowship_period" 
										@if(isset($inst_data->final_submit))<?php if($inst_data->final_submit==1) {  echo 'disabled'; } ?> @endif>
										    <option value="">Select Period</option>
											<option value="2020-2021" <?php if(isset($inst_data->fellowship_period)) { if($inst_data->fellowship_period=="2020-2021") { echo "selected"; } } ?>>2020-2021</option>
											<option value="2021-2022" <?php if(isset($inst_data->fellowship_period)) { if($inst_data->fellowship_period=="2021-2022") { echo "selected"; } }?>>2021-2022</option>
											<option value="2022-2023" <?php if(isset($inst_data->fellowship_period)) { if($inst_data->fellowship_period=="2022-2023") { echo "selected"; } } ?>>2022-2023</option>
											<option value="2023-2024" <?php if(isset($inst_data->fellowship_period)) { if($inst_data->fellowship_period=="2023-2024") { echo "selected"; } } ?>>2023-2024</option>
											<option value="2024-2025" <?php if(isset($inst_data->fellowship_period)) { if($inst_data->fellowship_period=="2024-2025") { echo "selected"; } } ?>>2024-2025</option>
											
								   	    </select>
									</div>
									</div>
									
								<div class="row">
								
								<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">M.Tech.</label>
										<input type="text" class="form-control mtech fellow" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php if(!empty($inst_data->fellowship_mtech)){ ?>{{$inst_data->fellowship_mtech}}<?php } ?>" id="mtech" placeholder="M.Tech." name="mtech" @if(isset($inst_data->final_submit))<?php if($inst_data->final_submit==1) {  echo 'disabled'; } ?> @endif>
										@if ($errors->has('mtech'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('mtech') }}</strong>
											</span>
										@endif
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">JRF</label>
										<input type="text" class="form-control jrf fellow" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php if(!empty($inst_data->fellowship_jrf)){ ?>{{$inst_data->fellowship_jrf}}<?php } ?>" id="jrf" placeholder="JRF" name="jrf" @if(isset($inst_data->final_submit))<?php if($inst_data->final_submit==1) {  echo 'disabled'; } ?> @endif>
										@if ($errors->has('jrf'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('jrf') }}</strong>
											</span>
										@endif
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">SRF</label>
										<input type="text" class="form-control srf fellow" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php if(!empty($inst_data->fellowship_srf)){ ?>{{$inst_data->fellowship_srf}}<?php } ?>" id="srf" placeholder="SRF" name="srf" @if(isset($inst_data->final_submit))<?php if($inst_data->final_submit==1) {  echo 'disabled'; } ?> @endif>
										@if ($errors->has('srf'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('srf') }}</strong>
											</span>
										@endif
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">M.Sc. Renewable Energy</label>
										<input type="text" class="form-control msc fellow" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php if(!empty($inst_data->fellowship_msc)){ ?>{{$inst_data->fellowship_msc}}<?php } ?>" id="msc" placeholder="M.SC." name="msc" @if(isset($inst_data->final_submit))<?php if($inst_data->final_submit==1) {  echo 'disabled'; } ?> @endif>
										@if ($errors->has('msc'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('msc') }}</strong>
											</span>
										@endif
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">RA</label>
										<input type="text" class="form-control ra fellow" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php if(!empty($inst_data->fellowship_ra)){ ?>{{$inst_data->fellowship_ra}}<?php } ?>" id="ra" placeholder="RA" name="ra" @if(isset($inst_data->final_submit))<?php if($inst_data->final_submit==1) {  echo 'disabled'; } ?> @endif>
										@if ($errors->has('ra'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('ra') }}</strong>
											</span>
										@endif
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">PDF</label>
										<input type="text" class="form-control pdf fellow" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php if(!empty($inst_data->fellowship_pdf)){ ?>{{$inst_data->fellowship_pdf}}<?php } ?>" id="pdf" placeholder="PDF." name="pdf" @if(isset($inst_data->final_submit))<?php if($inst_data->final_submit==1) {  echo 'disabled'; } ?> @endif>
										@if ($errors->has('pdf'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('pdf') }}</strong>
											</span>
										@endif
									</div>
									
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">Total</label>
										<input type="text" class="form-control ftotal" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php if(!empty($inst_data->fellowship_total)){ ?>{{$inst_data->fellowship_total}}<?php } ?>" id="ftotal" name="ftotal" @if(isset($inst_data->final_submit))<?php if($inst_data->final_submit==1) {  echo 'disabled'; } ?> @endif  readonly>
										
									</div>
									
								
								</div>
								</div>
								
								<div class="form-group">
								<div class="row">
								<div class="col-md-12">
								
								<input id="certified" class="certified" name="certified" type="checkbox" value="1" <?php if(!empty($inst_data->certified_status)){ if($inst_data->certified_status==1) { echo 'checked'; } } ?> @if(isset($inst_data->final_submit))<?php if($inst_data->final_submit==1) {  echo 'disabled'; } ?> @endif /> <span>We Certified that the information have been verified and correct</span>
					
								</div>
								
								@if(isset($inst_data->file_upload_signature))
								<?php if($inst_data->file_upload_signature!="") { ?>
								<div class="col-md-4">
								
								<label for="name"  style="font-size: 13px;color:#000" class="control-label">Signed Uploaded Form : </label>
								<a href="{{ asset('public/uploads/nref/'.$inst_data->file_upload_signature) }}" download><?php if($inst_data->file_upload_signature) { echo $inst_data->file_upload_signature; } ?></a>
								</div>
									<?php } ?>
								@endif
								
								
								</div>
								</div>
								
							<div class="form-group">
							
							
							<hr>
							
							
							@if (empty((array) $inst_data))
									
							<center>
								<div class="form-group" >
									
									<input class="btn btn-primary buttonEvent" type="submit"  name ="submit" value="Submit">
									<button type="button" id="prevButton" class="btn btn-primary buttonEvent" data-toggle="modal" data-target="#myModal">Preview</button>
									
							</center>
							
							@else
								
							@if(isset($inst_data->final_submit)) <?php if($inst_data->final_submit!=1) { ?>
								
							<center>
								<div class="form-group" >
								
								<input type="hidden" name="editID" value="@if(isset($inst_data->institute_id)) {{$inst_data->institute_id }}@endif" />
									
									<input class="btn btn-primary buttonEvent" type="submit"  name ="submit" value="Update">
									
									<a href="{{url('/instituteFinal/'.$inst_data->institute_id)}}" class="btn btn-primary buttonEvent">Next</a>
									
							</center>
							<?php } ?>@endif
							
							@endif
							
							</form>
							
							
							
							
                
            
     </div>
	</div> 
 </div> </div> </div> 

 <!-- Modal Form -->
	 
	<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body" id="modalContent">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
	 
	 <!-- MOdal Form -->
	 <script>
	 $("#prevButton").on("click",function() { 
	 
	// $("#modalContent .form-control").attr('readonly',true);
	 
	 $("#modalContent").html($("#modalCont").html());
	 $("#modalContent .dept_name").val($("#modalCont .dept_name").val()).attr('readonly',true);
	 $("#modalContent .coordinate_prog").val($("#modalCont .coordinate_prog").val()).attr('readonly',true);
	 $("#modalContent .type_of_institute").val($("#modalCont .type_of_institute").val()).attr('disabled',true);
	 $("#modalContent .university_rank").val($("#modalCont .university_rank").val()).attr('readonly',true);
	 $("#modalContent .hideannualReport").remove();
	 $("#modalContent .yr_est").val($("#modalCont .yr_est").val()).attr('readonly',true);
	 $("#modalContent .apx_stdnt").val($("#modalCont .apx_stdnt").val()).attr('readonly',true);
	 $("#modalContent .file_course_proof").remove();
	 $("#modalContent .collab_inst").val($("#modalCont .collab_inst").val()).attr('disabled',true);
	 if ($("#research").is( ":checked")) { $(".research").prop('checked',true); }
	 if ($("#phd").is( ":checked")) { $(".phd").prop('checked',true); }
	 if ($("#postgrad").is( ":checked")) { $(".postgrad").prop('checked',true); }
	 $("#modalContent .resrch_phd").attr('disabled',true);
	 $("#modalContent .exp_energy_course").val($("#modalCont .exp_energy_course").val()).attr('readonly',true);
	 $("#modalContent .course_run").val($("#modalCont .course_run").val()).attr('readonly',true);
	 $("#modalContent .no_seat_course").val($("#modalCont .no_seat_course").val()).attr('readonly',true);
	 $("#modalContent .spl_offer").val($("#modalCont .spl_offer").val()).attr('readonly',true);
	 $("#modalContent .indus_collab").val($("#modalCont .indus_collab").val()).attr('readonly',true);
	 $("#modalContent .place_service").val($("#modalCont .place_service").val()).attr('disabled',true);
	 $("#modalContent #prevstd").remove();
	 $("#modalContent #prevstd1").remove();
	 
	 
	 
	 
	 if($("#modalContent #place_service option:selected").val() == 'yes'){ $(".val1d").text('F');}
	 
	 $("#modalContent .other_details").val($("#modalCont .other_details").val()).attr('disabled',true);
	 $("#modalContent .spon_project").val($("#modalCont .spon_project").val()).attr('disabled',true);
	 $("#modalContent .fellowship_period").val($("#modalCont .fellowship_period").val()).attr('readonly',true);
	 $("#modalContent .mtech").val($("#modalCont .mtech").val()).attr('readonly',true);
	 $("#modalContent .jrf").val($("#modalCont .jrf").val()).attr('readonly',true);
	 $("#modalContent .srf").val($("#modalCont .srf").val()).attr('readonly',true);
	 $("#modalContent .msc").val($("#modalCont .msc").val()).attr('readonly',true);
	 $("#modalContent .ra").val($("#modalCont .ra").val()).attr('readonly',true);
	 $("#modalContent .pdf").val($("#modalCont .pdf").val()).attr('readonly',true);
	 $("#modalContent .ftotal").val($("#modalCont .ftotal").val()).attr('readonly',true);
	 if ($("#certified").is( ":checked")) { $(".certified").prop('checked',true); }
	 $("#modalContent .buttonEvent").remove();
	 
					
					
	 });
	 </script>
	 
  <!--script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script-->

	 <style>
	   .error{
		   color: red;
		   font-size: 12px;
	    }
	</style>
	

    <!-- /.container-fluid-->
@endsection
	
	