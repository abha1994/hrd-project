@extends('layouts.master')

@section('container')

 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Internship List</li>
      </ol>
	  <div class="card card-login mx-auto mt-5 " style="max-width: 88rem;">
	  <div class="card-body">
	
	
<?php if($data['internship_data'] != NULL){?>

<div>
  <input type="button" value="print" onclick="PrintDiv();" />
</div>
<div class="card-body" id="divToPrint">
<center>
     <div class="card-header text-center"><h2 style="color: #2384c6;"><Strong>Application Submitted for Internship in MNRE</Strong></h2></div>
     </center>  

                        <div class="form-group">
								<div class="row">
							       <div class="col-md-3">
									    <label><b>Application No. : </b></label>
									    <?php if(!empty($data['internship_data']->application_cd)) { echo $data['internship_data']->application_cd;}?> 
								    </div>
									<div class="col-md-3">
									<label><b>Name : </b></label>
									    <?php
										if(!empty($data['internship_data'])) { 
											if(!empty($data['internship_data']->first_name) || !empty($data['internship_data']->middle_name) || !empty($data['internship_data']->last_name)){
												  echo $data['internship_data']->first_name.' '.$data['internship_data']->middle_name.' '.$data['internship_data']->last_name;
										   }else if(!empty($data['internship_data']->first_name)  || !empty($data['internship_data']->last_name)){
												  echo $data['internship_data']->first_name.' '.$data['internship_data']->last_name;
										   }else{
												 echo $data['internship_data']->first_name;
										   }
										}?> 
								    </div>
									
									<div class="col-md-3">
									    <label><b>Email : </b></label>
									    <?php if(!empty($data['internship_data']->email)) { echo $data['internship_data']->email;}else{echo "N/A";}?> 
								    </div>
									
                                    <div class="col-md-3"><span class=""> <?php
										  if(!empty($data['internship_data']->file_photo)){ ?>
                                           <img src="{{asset('public/uploads/internship/photo/'.$data['internship_data']->file_photo)}}" style="height:100px; width:100px;    ">
                                        <?php
										 }else{
											   echo "N/A";
										 }
										?></span></div>	
								  
								 
								</div> 
							</div>
                            
						    <hr>
							<div class="form-group">
								<div class="row">
								    
								   <div class="col-md-3">
									    <label><b>Mobile No. : </b></label>
									    <?php if(!empty($data['internship_data']->mob_number)) { echo $data['internship_data']->mob_number;}else{ echo "N/A";}?> 
								    </div>
									
								    <div class="col-md-3">
									    <label><b>Gender : </b></label>
									    <?php 
										if(!empty($data['internship_data']->gender)) { 
											  if($data['internship_data']->gender == "1"){
												  echo "Male";
											  }elseif($data['internship_data']->gender == "2"){
												  echo "Female";
											  }else if($data['internship_data']->gender == "0"){
												  echo "Others";
										  }
										}else{
											   echo "N/A";
										}
										?> 
								    </div>
								    
									<div class="col-md-3">
									    <label><b>DOB : </b></label>
									    <?php if(!empty($data['internship_data']->date_birth)) {  echo $data['internship_data']->date_birth;}else{  echo "N/A";} ?> 
								    </div>
									
								    <div class="col-md-3">
									    <label><b>Father Name : </b></label>
									    <?php if(!empty($data['internship_data']->father)) {  echo $data['internship_data']->father;}else{  echo "N/A";} ?> 
								    </div>
									
								</div> 
							</div>
						    <hr>
							<div class="form-group">
								<div class="row">
								    <div class="col-md-3">
									    <label><b>Category : </b></label>
										<?php $categories_arr = array( '1'=>'General' ,'2'=>'OBC','3'=>'SC','4'=>'ST')?>
									    <?php 
										if(!empty($data['internship_data']->categories)) { 
										    foreach($categories_arr as $key=>$val){
											    if($data['internship_data']->categories == $key){
													 echo $val;
												}
										    }
										}else{
											   echo "N/A";
										}   
										?> 
								    </div>
									
									<div class="col-md-3">
									<label><b>Landline No : </b></label>
									    <?php
										if(!empty($data['internship_data']->phone)) { 
											echo $data['internship_data']->phone;
										}else{
											   echo "N/A";
										}
										?> 
								    </div>
									
									<div class="col-md-3">
									    <label><b>Address : </b></label>
									    <?php if(!empty($data['internship_data']->address)) { echo $data['internship_data']->address;}else{ echo "N/A"; }?> 
								    </div>
									
									<?php if($data['internship_data']->countrycd == "99"){ ?>
									<div class="col-md-3">
									    <label><b>Pincode : </b></label>
									    <?php if(!empty($data['internship_data']->pincode)) { echo $data['internship_data']->pincode;}else{ echo "N/A";}?> 
								    </div>
									<?php }else { ?>
									<div class="col-md-3">
									    <label><b>Sipcode : </b></label>
									    <?php if(!empty($data['internship_data']->pincode)) { echo $data['internship_data']->pincode;}else{ echo "N/A";  }?> 
								    </div>
									<?php } ?>
									
								</div> 
							</div>
							<hr>
							 <div class="form-group">
								<div class="row">
								    <div class="col-md-3">
									    <label><b>Country : </b></label>
										<?php  
										   if(!empty($data['internship_data']->countrycd)){
											   foreach($data['country_data']  as $val){
												   if($val->countrycd == $data['internship_data']->countrycd){
													   echo $val->name;
												   }
											   }
										   }else{
											   echo "N/A";
										   }
										?> 
								    </div>
									
									<div class="col-md-3">
									<label><b>State : </b></label>
									    <?php
										  if(!empty($data['internship_data']->statecd)){
											   foreach($data['state_data']  as $val){
												   if($val->statecd == $data['internship_data']->statecd){
													   echo $val->state_name;
												   }
											   }
										   }else{
											   echo "N/A";
										   }
										?> 
								    </div>
									
									<div class="col-md-3">
									    <label><b>District : </b></label>
									    <?php
										 if(!empty($data['internship_data']->districtcd)){
											   foreach($data['district_data']  as $val){
												   if($val->districtcd == $data['internship_data']->districtcd){
													   echo $val->district_name;
												   }
											   }
									     }else{
										   echo "N/A";
									     }
										?> 
								    </div>
									
									<?php  if(empty($data['internship_data']->work_status)){  ?>
									<div class="col-md-3">
									    <label><b>Whether you are employed? : </b></label>
									    <?php
										  if(!empty($data['internship_data']->work_status)){ 
											   echo "Yes";
										   }else{
											   echo "No";
										   }
										?> 
								    </div>
									<?php } ?>
								</div> 
							</div>
							<hr>
							 <?php  if(!empty($data['internship_data']->work_status)){  ?>
							 <div class="form-group">
								<div class="row">
								    <div class="col-md-3">
									    <label><b>Whether you are employed? : </b></label>
										<?php  
										  if(!empty($data['internship_data']->work_status)){ 
											   echo "Yes";
										   }else{
											   echo "No";
										   }
										?> 
								    </div>
									
									<div class="col-md-6">
									<label><b>Whether you are Govt. employee? : </b></label>
									    <?php
										 if(!empty($data['internship_data']->work_status)){ 
										   if($data['internship_data']->work_status == "2"){
											   echo "Yes";
										   }else if($data['internship_data']->work_status == "1"){
											   echo "No";
										   }
										 }
										?> 
								    </div>
									<div class="col-md-3">
									    <label><b>Organization Name: </b></label>
										<?php  
										  if(!empty($data['internship_data']->organization)){ 
											   echo $data['internship_data']->organization;
										   }else{
											   echo "N/A";
										   }
										?> 
								    </div>
								</div> 
							</div>
							<hr>
							 <div class="form-group">
								<div class="row">
								   <div class="col-md-3">
									<label><b>Organization Address: </b></label>
									    <?php
										 if(!empty($data['internship_data']->organization_address)){ 
										      echo $data['internship_data']->organization_address;
										 }else{
											   echo "N/A";
										 }
										?> 
								    </div>
									<div class="col-md-3">
									<label><b>Designation: </b></label>
									    <?php
										  if(!empty($data['internship_data']->designation)){ 
										      echo $data['internship_data']->designation;
										 }else{
											   echo "N/A";
										 }
										?> 
								    </div>
									<div class="col-md-3">
									<label><b>Nature of Area : </b></label>
									    <?php
										  if(!empty($data['internship_data']->nature_area)){ 
										      echo $data['internship_data']->nature_area;
										 }else{
											   echo "N/A";
										 }
										?> 
								    </div>
									<div class="col-md-3">
									<label><b>Prime Focus of Work : </b></label>
									    <?php
										  if(!empty($data['internship_data']->focus_work)){ 
										      echo $data['internship_data']->focus_work;
										 }else{
											   echo "N/A";
										 }
										?> 
								    </div>
								</div> 
							</div>
							 <?php } ?>
							 
							 <hr>
							 
							 
							 <?php if(!empty($data['intern_course_details'])){?>
								<h4>Education Details</h4>

                             <table border="1" style="border-collapse:collapse;" class="table table-bordered table-striped table-hover" id="tab0" >
                                  <thead   style="font-size: 14px; font-weight: 300;line-height: 0.9;">
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
								 <tr  id='addr0'>
                                     <td class="text-center"><?php echo $i;?></td>
                                     <td class="text-center">
										@foreach($data['courses_data'] as $val) 
										    <?php if($v->course_id == $val->course_id){echo $val->course_name;}?> 
										@endforeach 
									 
									</td>
                                     <td class="text-center"><?php echo $v->institute;?></td>
                                     <td class="text-center"><?php echo $v->stream;?></td>
                                     <td class="text-center">
									  <?php if($v->pass_status == 1){echo "Pursuing";}else if($v->pass_status == 2){echo "Passed";}?>
									</td>
                                     <td class="text-center"><?php echo $v->year_completion;?></td>
                                     <td class="text-center"><?php echo $v->marks_percentage;?></td>
                                 </tr>
								<?php $i++;} //} ?>
								 
                              </div>
                            </tbody>
                        </table>
							<?php } ?>
							
							
							
							
							
							
							
							
							
							
							<!----------------------->
							
							<hr>
							 <div class="form-group">
								<div class="row">
								   <div class="col-md-3">
									<label><b>Area of Interest : </b></label>
									<?php $area_interest = array( '1'=>'Solar PV' ,'2'=>'Solar Thermal','3'=>'Wind','4'=>'Small Hydro','5'=>'Biomass','6'=>'Biogas'
									,'7'=>'Waste to Energy','8'=>'Hydrogen','9'=>'Energy Storage','10'=>'Policy','11'=>'Environment Aspect','12'=>'Hydrogen &amp; Fuel Cell','13'=>'Finance')?>
									    <?php
										 if(!empty($data['internship_data']->area_interest)) { 
										    foreach($area_interest as $key=>$val){
											    if($data['internship_data']->area_interest == $val){
													 echo $val;
												}
										    }
										}else{
											   echo "N/A";
										} 
										?> 
								    </div>
									<div class="col-md-3">
									<label><b>Desired Place of Internship : </b></label>
									<?php $intern_place = array( '1'=>'MNRE' ,'2'=>'NISE-Gurugram','3'=>'NIWE-Chennai','4'=>'NIBE-Kapurthala','5'=>'SECI','6'=>'IREDA')?>
									    <?php
										if(!empty($data['internship_data']->intern_place)) { 
										    foreach($intern_place as $key=>$val){
											    if($data['internship_data']->intern_place == $val){
													 echo $val;
												}
										    }
										}else{
											   echo "N/A";
										} 
										?> 
								    </div>
									<div class="col-md-3">
									<label><b>Duration of Internship : </b></label>
									<?php $intern_duration = array('2'=>'2 months','3'=>'3 months','4'=>'4 months','5'=>'5 months','6'=>'6 months')?>
									    <?php
										if(!empty($data['internship_data']->intern_duration)) { 
										    foreach($intern_duration as $key=>$val){
											    if($data['internship_data']->intern_duration == $val){
													 echo $val;
												}
										    }
										}else{
											   echo "N/A";
										} 
										?> 
								    </div>
									<div class="col-md-3">
									<label><b>Desired Month & Year of Internship : </b></label>
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
									
										foreach($desired_month_year as $key=>$val){
											if(!empty($data['internship_data']->intern_start_month)){
											   if($data['internship_data']->intern_start_year.'-0'.$data['internship_data']->intern_start_month == $key){
												   echo $val;
											   }
											}   
										}
										?> 
								    </div>
								</div> 
							</div>
						     <hr>
							 
							 <div class="form-group">
								<div class="row">
								   <div class="col-md-6">
									<label><b>Writeup on Interested Area in Internship : </b></label>
									    <?php
										 if(!empty($data['internship_data']->writeup_interest)){ 
										      echo $data['internship_data']->writeup_interest;
										 }else{
											   echo "N/A";
										 }
										?> 
								    </div>
									<div class="col-md-6">
									<label><b>Other Information (Experience/ Publications/ Patents/ Awards etc.) : </b></label>
									    <?php
										  if(!empty($data['internship_data']->remarks)){ 
										      echo $data['internship_data']->remarks;
										 }else{
											   echo "N/A";
										 }
										?> 
								   </div>
								</div> 
							</div>
							<hr>
							 <div class="form-group">
								<div class="row">
								<div class="col-md-4">
									<label><b>Documents Submitted - </b></label>
									     
								    </div>
								   <div class="col-md-4">
									<label><b>Experience : </b></label>
									    <?php
										 if(!empty($data['internship_data']->file_experience)){ ?>
										 <a href="{{asset('public/uploads/internship/experience/'.$data['internship_data']->file_experience)}}">Download Experience</a>
										 <?php 
										 }else{
											   echo "N/A";
										 }
										?> 
								    </div>
									<div class="col-md-4">
									<label><b>ID Proof : </b></label>
									
									 <?php if(!empty($data['internship_data']->file_experience)){ ?>
									<a style="cursor:pointer"; style="color:green" href="{{asset('public/uploads/internship/id_proof/'.$data['internship_data']->file_id_proof)}}" >Download ID Proof</a>
										 <?php 
										 }else{
											   echo "N/A";
										 }
										?> 
										
									  <!--  <?php //if($data['internship_data']->id_proof_type == "1"){?>
											<a href="{{asset('public/uploads/id_proof/voter_id/'.$data['internship_data']->file_id_proof)}}">Voter ID</a>
										<?php //}else if($data['internship_data']->id_proof_type == "2"){?>
											<a href="{{asset('public/uploads/id_proof/driving_licence/'.$data['internship_data']->file_id_proof)}}">Driving Licence</a>
										<?php //}else if($data['internship_data']->id_proof_type == "3"){?>
											<a href="{{asset('public/uploads/id_proof/passport/'.$data['internship_data']->file_id_proof)}}">Passport</a>
										<?php //}else if($data['internship_data']->id_proof_type == "4"){?>
											<a href="{{asset('public/uploads/id_proof/college_id_card/'.$data['internship_data']->file_id_proof)}}">College Id Card</a>
										<?php //} ?>
                                         -->
								   </div>
								   
								</div> 
							</div>
							             <?php
										  if(!empty($data['internship_data']->work_status)){ 
											   
										  }else{?> 
											   <br><br> <br><br>
							             <?php  }  ?>						
						    <hr>
						    <div>
								<p><strong>Ministry of New and Renewable Energy</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Designed & Developed by National Informatics Centre</strong></p>
                           </div>
					 
					
                 </div> 
<?php }else{ echo "No Data Found. Please fill the form first!!..";} ?>
			   </div>
            </div>
			 <br>
         </div>
     </div>


<script>
 function PrintDiv() 
{   
alert(); 
	var divToPrint = document.getElementById('divToPrint');
	var popupWin = window.open('', '_blank', 'width=300,height=300');
	popupWin.document.open();
	popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
	popupWin.document.close();
}
</script>
@endsection
	
	