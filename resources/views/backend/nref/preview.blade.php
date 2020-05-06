@extends('layouts.master')

@section('container')

  
 <div class="content-wrapper" style="margin-left: 13px;">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb" >
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Institute Details Form</li>
      </ol>
	   <!--<div class="intern_title">
	    Ministry will provide internship opportunity to facilitate students pursuing under graduate/graduate/post graduate degrees or research scholars enrolled in recognized institutes/universities with in India or abroad, as "Interns". The students of various Engineering, Science, Management, law and other streams may undertake internship in the Ministry and in organizations under its aegis to understand various activities of the Ministry to become Researchers/Managers in renewable energy area. These interns will be attached with the senior level officers of the Ministry in various Programme Divisions.
	 </div>-->
	 
	
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
            $all_data = Session::get('all_data');
		    $loginuser_data = $data['loginuser_data'];
			$type_institute = $data['type_institute'];
			$inst_data = $data['institute_details_data'];
			
			
			//echo "<pre>"; print_r($inst_data); die;
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
										<input type="text"  class="form-control" value="<?php if(!empty($inst_data->department_name)){ ?>{{ $inst_data->department_name }} <?php } ?>"  id="dept_name" placeholder="Name of the department" name="dept_name">
									</div>
									<div class="col-md-4">
									<label for="name"  style="font-size: 13px;" class="control-label">Coordinator of the Proposed Program</label>
										<input type="text"  class="form-control"  value="<?php if(!empty($inst_data->coordinate_prog)){ ?>{{ $inst_data->coordinate_prog }} <?php } ?>" id="coordinate_prog" placeholder="Coordinator of the Proposed Program" name="coordinate_prog">
									</div>
								</div> 
							</div>
						
							
							<div class="form-group">
								<div class="row">
									<div class="col-md-3">
									<label for="name"  style="font-size: 13px;" class="control-label">Type of Institution</label>
										<select class="form-control" name="type_of_institute"  id="type_of_institute">
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
											<option value="other" <?php if(!empty($inst_data->institute_type_id)) { if($inst_data->institute_type_id=='other') { echo 'Selected'; } } ?>>Other</option>
								   	    </select>
									</div>
									
									
									<div class="col-md-4 inst_type" style="padding:2em">
									<input name="inst_other_type" type="radio" value="iit" <?php if(!empty($inst_data->inst_other_type)) { if($inst_data->inst_other_type=='iit') { echo 'checked'; } }  ?>> IIT
									<input name="inst_other_type" type="radio" value="nit" <?php if(!empty($inst_data->inst_other_type)) { if($inst_data->inst_other_type=='nit') { echo 'checked'; } }  ?>> NIT
									<input name="inst_other_type" type="radio" value="iiscer" <?php if(!empty($inst_data->inst_other_type)) { if($inst_data->inst_other_type=='iiscer') { echo 'checked'; } } ?>> IISCER
									<input name="inst_other_type" type="radio" value="iisc" <?php if(!empty($inst_data->inst_other_type)) { if($inst_data->inst_other_type=='iisc') { echo 'checked'; } } ?>> IISc
							</div>
									
									
									<div class="col-md-4">
									<label for="name"  style="font-size: 13px;" class="control-label">University Ranking as per UGC</label>
										<input onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text"  min="0" maxlength="10" class="form-control"  value="<?php if(!empty($inst_data->university_rank)){ ?>{{ $inst_data->university_rank }} <?php } ?>" id="university_rank" placeholder="University Ranking as per UGC" name="university_rank">
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;" class="control-label">Years of Establishment</label>
										<input class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text"  min="0" maxlength="4" value="<?php if(!empty($inst_data->year_establishment)){ ?>{{$inst_data->year_establishment}}<?php } ?>" id="yr_est" placeholder="Years of Establishment" name="yr_est">
										@if ($errors->has('yr_est'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('yr_est') }}</strong>
											</span>
										@endif
									</div>
									
								</div> 
							</div>
							
							<div class="form-group">
								<div class="row">
								
								
								
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">Approx. Number of Students</label>
										<input class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text"  min="0" maxlength="10" value="<?php if(!empty($inst_data->no_student)){ ?>{{$inst_data->no_student}}<?php } ?>" id="apx_stdnt" placeholder="Approx. Number of Students" name="apx_stdnt">
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
									
									<div class="col-md-3">
									
             <label for="name"  style="font-size: 13px;" class="control-label">Any Collaborative Institute</label>
                                        <select name="collab_inst" id="collab_inst" class="form-control">
										    <option value="">----- Select -----</option>
											<option value="yes" <?php if(!empty($inst_data->any_collaboration)) { ?> @if($inst_data->any_collaboration=='yes') selected @endif <?php } ?>>Yes</option>
											<option value="no" <?php if(!empty($inst_data->any_collaboration)) { ?> @if($inst_data->any_collaboration=='no') selected @endif <?php } ?>>No</option>
											
										</select>
										
									</div>


                                     <div class="col-md-3 colab_inst_yes" style="padding:2em 0em 0em 1em">
									 @if(!empty($inst_data->research_phd))<?php $ss=explode(',',$inst_data->research_phd); //echo '<pre>';print_r($ss); ?>@endif
									<input name="resrch_phd[]" type="checkbox" value="Research" id="research" class="resrch_phd" <?php if(!empty($inst_data->research_phd)) { ?>@if($ss[0]=='Research') checked @endif <?php } ?>> Research
									<input name="resrch_phd[]" type="checkbox" value="Ph. D Registration" id="phd" class="resrch_phd" <?php if(!empty($inst_data->research_phd)) { ?> @if($ss[1]=='Ph. D Registration') checked @endif <?php } ?>> Ph. D Registration
                                        
									</div>
									
								</div>
							</div>
							
							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">Experience in Energy related courses</label>
										<input type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase();" value="<?php if(!empty($inst_data->energy_experience)){ ?>{{$inst_data->energy_experience}}<?php } ?>" id="exp_energy_course" placeholder="Experience in Energy related courses" name="exp_energy_course">
										@if ($errors->has('exp_energy_course'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('exp_energy_course') }}</strong>
											</span>
										@endif
									</div>
									</div>
									
									<div class="row">
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">A) Since when the course being run</label>
										<input type="text" class="form-control" value="<?php if(!empty($inst_data->course_start_date)){ ?>{{date('Y-m-d',strtotime($inst_data->course_start_date))}}<?php } ?>" id="course_run" placeholder="Since when the course being run" name="course_run">
										@if ($errors->has('course_run'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('course_run') }}</strong>
											</span>
										@endif
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">B) Number of Seats in each of the course</label>
										<input type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase();" value="<?php if(!empty($inst_data->no_of_seat)){ ?>{{$inst_data->no_of_seat}}<?php } ?>" id="no_seat_course" placeholder="Number of Seats in each of the course" name="no_seat_course">
										@if ($errors->has('no_seat_course'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('no_seat_course') }}</strong>
											</span>
										@endif
									</div>
									
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">C) Specialization offered</label>
										<input type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase();" value="<?php if(!empty($inst_data->specialization_offered)){ ?>{{$inst_data->specialization_offered}}<?php } ?>" id="spl_offer" placeholder="Specialization offered" name="spl_offer">
										@if ($errors->has('spl_offer'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('spl_offer') }}</strong>
											</span>
										@endif
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">D) If any industry collaboration is there, if so details thereof</label>
										<input type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase();" value="<?php if(!empty($inst_data->industry_collaboration)){ ?>{{$inst_data->industry_collaboration}}<?php } ?>" id="indus_collab" placeholder="If any industry collaboration is there, if so details thereof" name="indus_collab">
										@if ($errors->has('indus_collab'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('indus_collab') }}</strong>
											</span>
										@endif
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">E) If placement service is being provided</label>
										<input type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase();" value="<?php if(!empty($inst_data->placement_details)){ ?>{{$inst_data->placement_details}}<?php } ?>" id="place_service" placeholder="If placement service is being provided" name="place_service">
										@if ($errors->has('place_service'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('place_service') }}</strong>
											</span>
										@endif
									</div>
								
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">F) Any other details</label>
										<input type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase();" value="<?php if(!empty($inst_data->other_details)){ ?>{{$inst_data->other_details}}<?php } ?>" id="other_details" placeholder="Any other details" name="other_details">
										@if ($errors->has('other_details'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('other_details') }}</strong>
											</span>
										@endif
									</div>
									
									
									<div class="col-md-6">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">Sponsored Projects in the area of Energy, Environment and Renewable Energy</label>
										<input type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase();" value="<?php if(!empty($inst_data->spon_project)){ ?>{{$inst_data->spon_project}}<?php } ?>" id="spon_project" placeholder="Sponsored Projects in the area of Energy, Environment and Renewable Energy" name="spon_project">
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
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">M.Tech.</label>
										<input type="text" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php if(!empty($inst_data->fellowship_mtech)){ ?>{{$inst_data->fellowship_mtech}}<?php } ?>" id="mtech" placeholder="M.Tech." name="mtech">
										@if ($errors->has('mtech'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('mtech') }}</strong>
											</span>
										@endif
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">JRF</label>
										<input type="text" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php if(!empty($inst_data->fellowship_jrf)){ ?>{{$inst_data->fellowship_jrf}}<?php } ?>" id="jrf" placeholder="JRF" name="jrf">
										@if ($errors->has('jrf'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('jrf') }}</strong>
											</span>
										@endif
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">SRF</label>
										<input type="text" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php if(!empty($inst_data->fellowship_srf)){ ?>{{$inst_data->fellowship_srf}}<?php } ?>" id="srf" placeholder="SRF" name="srf">
										@if ($errors->has('srf'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('srf') }}</strong>
											</span>
										@endif
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">M.SC.</label>
										<input type="text" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php if(!empty($inst_data->fellowship_msc)){ ?>{{$inst_data->fellowship_msc}}<?php } ?>" id="msc" placeholder="M.SC." name="msc">
										@if ($errors->has('msc'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('msc') }}</strong>
											</span>
										@endif
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">RA</label>
										<input type="text" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php if(!empty($inst_data->fellowship_ra)){ ?>{{$inst_data->fellowship_ra}}<?php } ?>" id="ra" placeholder="RA" name="ra">
										@if ($errors->has('ra'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('ra') }}</strong>
											</span>
										@endif
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">PDF</label>
										<input type="text" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php if(!empty($inst_data->fellowship_pdf)){ ?>{{$inst_data->fellowship_pdf}}<?php } ?>" id="pdf" placeholder="PDF." name="pdf">
										@if ($errors->has('pdf'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('pdf') }}</strong>
											</span>
										@endif
									</div>
									
								
								</div>
								</div>
								
								<div class="form-group">
								<div class="row">
								<div class="col-md-12">
								
								<input id="certified" name="certified" type="checkbox" value="1" <?php if(!empty($inst_data->certified_status)){ if($inst_data->certified_status==1) { echo 'checked'; } } ?> /> <span>We Certified that the information have been verified and correct</span>
					
								</div>
								
								
								</div>
								</div>
								
								<br><br><br>
								
								<div class="form-group">
								<div class="row">
								
								<div class="col-md-4">
								<label for="name"  style="font-size: 13px;color:#000" class="control-label">Name and Signature of Department with Seal</label>
										<p style="background-color: brown;color: white;text-align:center">Signature</p>
									
								</div>
								
								<div class="col-md-4">
								<label for="name"  style="font-size: 13px;color:#000" class="control-label">Name and Signature of Dean with Seal</label>
										<p style="background-color: brown;color: white;text-align:center">Signature</p>
									
								</div>
								
								<div class="col-md-4">
								
								
								<label for="name"  style="font-size: 13px;color:#000" class="control-label">Name and Signature of Registrar with Seal</label>
										<p style="background-color: brown;color: white;text-align:center">Signature</p>
									
								</div>
								</div>
								</div>
								
								<br><br><br>

							
							
							
							<div class="form-group">
								
							<div>
							
							
							<hr>
							<center>
								<div class="form-group" >
									<a href="{{ route('/institute') }}" class="btn btn-primary" >Back</a>
								</div> 
							</center>
							
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
    <!-- /.container-fluid-->
@endsection
	
	