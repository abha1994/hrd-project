
 <div class="content-wrapper" style="margin-left: 13px;">
    <div class="container-fluid">
	 
	
      <!-- Icon Cards-->
	   <div class="card card-login mx-auto mt-5 " style="max-width: 65rem; margin-bottom: 28px;">
							

     <div class="card-header text-center"><h4 style="    color: #2384c6;">Institute Details Form</h4></div>
      <div class="card-body">
		
			
				            <div class="form-group">
								<div class="row">
									<div class="col-md-4">
									  <label for="name"  style="font-size: 13px;" class="control-label">Name of the Institute : </label>
										<strong><?php if(!empty($logindetails->institute_name)){ ?>{{ $logindetails->institute_name }} <?php } ?></strong>
									</div>
									
									<div class="col-md-4">
									<label for="name"  style="font-size: 13px;" class="control-label">Name of the Department : </label>
										<strong><?php if(count($items)>0){ ?>{{ $items[0]->department_name }} <?php } ?></strong>
									</div>
									<div class="col-md-4">
									<label for="name"  style="font-size: 13px;" class="control-label">Coordinator of the Proposed Program : </label>
										<strong><?php if(count($items)>0){ ?>{{ $items[0]->coordinate_prog }} <?php } ?></strong>
									</div>
								</div> 
							</div>
							
							
							<div class="form-group">
								<div class="row">
									<div class="col-md-3">
									<label for="name"  style="font-size: 13px;" class="control-label">Type of Institution : </label>

											@foreach($type_institute as $val)
											<?php 
											if(count($items)>0){
												if($items[0]->institute_type_id == $val->institute_type_id){
													echo $val->institute_desc;
												}
											} 
											?>
											@endforeach
									</div>
									
									
									<div class="col-md-4">
									<label for="name"  style="font-size: 13px;" class="control-label">University/Institute Ranking as per UGC/NIRF : </label>
										<strong><?php if(count($items)>0){ ?>{{ $items[0]->university_rank }} <?php } ?></strong>
									</div>
								</div> 
							</div>
							
							<div class="form-group">
								<div class="row">
								
								<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;" class="control-label">Years of Establishment</label>
										<strong><?php if(count($items)>0){ ?>{{$items[0]->year_establishment}}<?php } ?></strong>
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">Approx. Number of Students in Proposed Program</label>
										<strong><?php if(count($items)>0){ ?>{{$items[0]->no_student}}<?php } ?></strong>
									</div>
								
								</div> 
							</div>
							
							<br>
							<h4><u>Details of the Course:-</u></h4>
							
							  <div class="form-group">
								<div class="row">
									
									<div class="col-md-4">
									
                                  <label for="name"  style="font-size: 13px;" class="control-label">Any Collaborative Institute</label>
								  <?php if(count($items)>0){ if($items[0]->any_collaboration=='yes') { echo 'Yes';} elseif($items[0]->any_collaboration=='no') { echo 'No';} } ?></div>

									<?php if(count($items)>0){ ?> @if($items[0]->any_collaboration=='yes')
                                    
									 <?php if(count($items)>0){  $ss=explode(',',$items[0]->research_phd); } ?>
									<input name="resrch_phd[]" type="checkbox" value="Research" id="research" class="resrch_phd" <?php for($i=0;$i<count($ss);$i++) { if($ss[$i]=='Research') { echo "checked";} }  ?>> Research
									<input name="resrch_phd[]" type="checkbox" value="Ph. D Registration" id="phd" class="resrch_phd" <?php for($i=0;$i<count($ss);$i++) { if($ss[$i]=='Ph. D Registration') { echo "checked";} }  ?>> Ph. D Registration
									
									<input name="resrch_phd[]" type="checkbox" value="Post Graduate Program" id="postgrad" class="resrch_phd" <?php for($i=0;$i<count($ss);$i++) { if($ss[$i]=='Post Graduate Program') { echo "checked";} }  ?>> Post Graduate Program
                                        
									
									@endif <?php } ?>
									
								</div>
							</div>
							
							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">Experience in Energy related courses : </label>
										<strong><?php if(count($items)>0){ ?>{{$items[0]->energy_experience}}<?php } ?></strong>
										
									</div>
									</div>
									
									<div class="row">
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">A) Date of approximate course Start : </label>
										<strong><?php if(count($items)>0){ ?>{{date('Y-m-d',strtotime($items[0]->course_start_date))}}<?php } ?></strong>
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">B) Number of Seats in each of the course : </label>
										<strong><?php if(count($items)>0){ ?>{{$items[0]->no_of_seat}}<?php } ?></strong>
									</div>
									
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">C) Specialization offered : </label>
										<strong><?php if(count($items)>0){ ?>{{$items[0]->specialization_offered}}<?php } ?></strong>
										
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">D) If any industry collaboration is there, if so details thereof : </label>
										<strong><?php if(count($items)>0){ ?>{{$items[0]->industry_collaboration}}<?php } ?></strong>
										
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">E) If placement service is being provided : </label>
										<strong><?php if(count($items)>0){ ?>{{$items[0]->placement_details}}<?php } ?></strong>
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">F) Name of Collaborate Institute : </label>
										<strong><?php if(count($items)>0){ ?>{{$items[0]->collab_institute}}<?php } ?></strong>
									</div>
									
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">G) Any other details : </label>
										<strong><?php if(count($items)>0){ ?>{{$items[0]->other_details}}<?php } ?></strong>
									</div>
									
									
									<div class="col-md-6">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">Sponsored Projects in the area of Energy, Environment and Renewable Energy : </label>
										<strong><?php if(count($items)>0){ ?>{{$items[0]->spon_project}}<?php } ?></strong>
									</div>
									
								</div> 
							</div>
							
							<div class="form-group">
								<div class="row">
								<label for="name"  style="font-size: 13px;color:#000" class="control-label">Fellowship slot requirement :</label>
								</div>
								<div class="row">
								
								 <div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">Fellowship slot requirement Period : </label>
										<strong><?php if(count($items)>0){ ?>{{$items[0]->fellowship_period}}<?php } ?></strong>
									</div>
									
								<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">M.Tech.</label>
										<strong><?php if(count($items)>0){ ?>{{$items[0]->fellowship_mtech}}<?php } ?></strong>
										
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">JRF</label>
										<strong><?php if(count($items)>0){ ?>{{$items[0]->fellowship_jrf}}<?php } ?></strong>
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">SRF</label>
										<strong><?php if(count($items)>0){ ?>{{$items[0]->fellowship_srf}}<?php } ?></strong>
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">M.SC. Renewable Energy</label>
										<strong><?php if(count($items)>0){ ?>{{$items[0]->fellowship_msc}}<?php } ?></strong>
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">RA</label>
										<strong><?php if(count($items)>0){ ?>{{$items[0]->fellowship_ra}}<?php } ?></strong>
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">PDF</label>
										<strong><?php if(count($items)>0){ ?>{{$items[0]->fellowship_pdf}}<?php } ?></strong>
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">Total</label>
										<strong><?php if(count($items)>0){ ?>{{$items[0]->fellowship_total}}<?php } ?></strong>
									</div>
									
								
								</div>
								</div>
								
								<div class="form-group">
								<div class="row">
								<div class="col-md-12">
								
								<input id="certified" name="certified" type="checkbox" value="1" <?php if(count($items)>0){ if($items[0]->certified_status==1) { echo 'checked'; } } ?> /> <span>We Certified that the information have been verified and correct</span>
					
								</div>
								
								
								</div>
								</div>
								
								<br>
								
								<div class="form-group">
								<div class="row">
								
								<div class="col-md-2" style="width: 20%;">
								<label for="name"  style="font-size: 12px;color:#000" class="control-label">Name and Signature of HOD with Seal</label>
										<!--<p style="background-color: brown;color: white;text-align:center">Signature</p>-->
										<hr>
									
								</div>
								
								<div class="col-md-2" style="width: 20%;position: relative;left: 10em;margin-top: -4em;">
								<label for="name"  style="font-size: 12px;color:#000" class="control-label">Name and Signature of Dean with Seal</label>
										<!--<p style="background-color: brown;color: white;text-align:center">Signature</p>-->
										<hr>
									
								</div>
								
								<div class="col-md-2" style="width: 20%;position: relative;margin-top: -4em;left: 22em;">
								
								
								<label for="name"  style="font-size: 12px;color:#000" class="control-label">Name and Signature of Registrar with Seal</label>
										<!--<p style="background-color: brown;color: white;text-align:center">Signature</p>-->
										<hr>
									
								</div>
								
								
								<div class="col-md-2" style="width: 20%;float: right;position: relative;margin-top: -6em;right: 10em;">
								
								<label for="name"  style="font-size: 12px;color:#000" class="control-label">Name and Signature of Proposed Program with Seal</label>
										<!--<p style="background-color: brown;color: white;text-align:center">Signature</p>-->
										<hr>
									
								</div>
								
								</div>
								</div>
         </div>
     </div>
	
	