@extends('layouts.master')
@section('container')
 <div class="content-wrapper" >
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ url('home')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Internship View</li>
      </ol>
	     <div class="card mb-3">
	  <div class="card-header text-center"><h4 class="mt-2">Application - <?php if(!empty($data['internship_data']->application_cd)) { echo $data['internship_data']->application_cd;}?></h4></div>
      
	       <div class="container-fluid border-top bg-white card-footer text-muted text-left" id="app">   	
	
        @if ($account = Session::get('success'))
		 <div class="alert alert-success alert-block">
		   <button type="button" class="close" data-dismiss="alert">×</button>	
		   <strong>{{ $account }}</strong>
		 </div>
	     @endif
		 
		  @if ($account = Session::get('error'))
		 <div class="alert alert-danger alert-block">
		   <button type="button" class="close" data-dismiss="alert">×</button>	
		   <strong>{{ $account }}</strong>
		 </div>
	     @endif
		 
		 
		 




   

<div class="" id="divToPrint">
	   <div class="form-group" style="margin-bottom: -1rem;    font-size: 13px;">
	   <div class="row">
   <div class="col-md-5">  	           
<table class = "">

    <tr> 
	    <td><b>Application No. :</b></td>
	    <td><?php if(!empty($data['internship_data']->application_cd)) { echo $data['internship_data']->application_cd;}?> </td>
    </tr>
    <tr> 
	    <td><b>Candidates Type :</b></td>
	    <td><?php 
			 // if(!empty($data['internship_data'])) {
			   // if(!empty($data['category_data'])){
				   // foreach($data['category_data'] as $val){
					   // if($val->category_id == $data['candidate_type']->category_id){
						   // echo $val->category_name;
					   // }
				   // }
			   // }
			 // }?>
	    </td>
    </tr>
    <tr> 
	    <td><b>Name :</b></td>
	    <td><?php
			if(!empty($data['internship_data'])) { 
				if(!empty($data['internship_data']->first_name) || !empty($data['internship_data']->middle_name) || !empty($data['internship_data']->last_name)){
					  echo ucwords(strtolower($data['internship_data']->first_name.' '.$data['internship_data']->middle_name.' '.$data['internship_data']->last_name));
			   }else if(!empty($data['internship_data']->first_name)  || !empty($data['internship_data']->last_name)){
					  echo ucwords(strtolower($data['internship_data']->first_name.' '.$data['internship_data']->last_name));
			   }else{
					 echo ucwords(strtolower(data['internship_data']->first_name));
			   }
			}?> 
	    </td>
    </tr>
	<tr> 
	    <td><b>Email :</b></td>
	    <td><?php if(!empty($data['internship_data']->email)) { echo $data['internship_data']->email;}else{echo "N/A";}?> 
	    </td>
    </tr>
	<tr> 
	    <td><b>Mobile No. :</b></td>
	    <td><?php if(!empty($data['internship_data']->mob_number)) { echo $data['internship_data']->mob_number;}else{ echo "N/A";}?>  
	    </td>
    </tr>
	<tr> 
	    <td><b>Gender :</b></td>
	    <td><?php 
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
	    </td>
    </tr>
	<tr> 
	    <td><b>DOB :</b></td>
	    <td><?php if(!empty($data['internship_data']->date_birth)) {  echo $data['internship_data']->date_birth;}else{  echo "N/A";} ?> 
	    </td>
    </tr>
	<tr> 
	    <td><b>Father Name :</b></td>
	    <td><?php if(!empty($data['internship_data']->father)) {  echo $data['internship_data']->father;}else{  echo "N/A";} ?> 
	    </td>
    </tr>
	<tr> 
	    <td><b>Category :</b></td>
	    <td><?php $categories_arr = array( '1'=>'General' ,'2'=>'OBC','3'=>'SC','4'=>'ST');
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
	    </td>
    </tr>
	<tr> 
	    <td><b>Address :</b></td>
	    <td><?php if(!empty($data['internship_data']->address)) { echo $data['internship_data']->address;}else{ echo "N/A"; }?> 
	    </td>
    </tr>

	  <tr> 
	    <td><b>Landline No :</b></td>
	    <td><?php //dd($data['internship_data']->phone);
				if(!empty($data['internship_data']->phone)) { 
                    if($data['internship_data']->phone != "-") { 
					  echo $data['internship_data']->phone;
					}else{
						   echo "N/A";
                    }
				}else{
					   echo "N/A";
				}
                   
		 	?> 
	    </td>
    </tr>
    <tr> 
	    <td><b><?php if($data['internship_data']->countrycd == "99"){ ?>Pincode<?php }else {?>Sipcode<?php } ?> :</b></td>
	    <td><?php if(!empty($data['internship_data']->pincode)) { echo $data['internship_data']->pincode;}else{ echo "N/A";}?> 
	    </td>
    </tr>
</table>	
</div>   
<div class="col-md-5">
<table class = "">

	
	

  	<tr> 
	    <td><b>Country :</b></td>
	    <td><?php  
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
	    </td>
    </tr>

	<tr> 
	    <td><b>State :</b></td>
	    <td><?php
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
	    </td>
    </tr>
	<tr> 
	    <td><b>District :</b></td>
	    <td><?php
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
	    </td>
    </tr>
	 <tr> 
	    <td><b>Area of Interest :</b></td>
	    <td><?php $area_interest = array( '1'=>'Solar PV' ,'2'=>'Solar Thermal','3'=>'Wind','4'=>'Small Hydro','5'=>'Biomass','6'=>'Biogas'
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
	    </td>
    </tr>
	<tr> 
	    <td><b>Desired Place of Internship :</b></td>
	    <td><?php $intern_place = array( '1'=>'MNRE' ,'2'=>'NISE-Gurugram','3'=>'NIWE-Chennai','4'=>'NIBE-Kapurthala','5'=>'SECI','6'=>'IREDA')?>
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
	    </td>
    </tr>
	<tr> 
	    <td><b>Duration of Internship :</b></td>
	    <td><?php $intern_duration = array('2'=>'2 months','3'=>'3 months','4'=>'4 months','5'=>'5 months','6'=>'6 months')?>
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
	    </td>
    </tr>
	
<tr> 
	    <td><b>Desired Month & Year of Internship :</b></td>
	    <td><?php
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
	    </td>
    </tr>
	<tr> 
       <td><b>Whether you are employed? :</b></td>
	    <td><?php if(!empty($data['internship_data']->work_status)){ 
		   echo "Yes";
	   }else{
		   echo "No";
	   } ?></td>
    </tr>
 <?php  if(!empty($data['internship_data']->work_status)){  ?>
 <tr>
						<td><b>Whether you are Govt. employee? : </b></td>
							<td><?php
							 if(!empty($data['internship_data']->work_status)){ 
							   if($data['internship_data']->work_status == "2"){
								   echo "Yes";
							   }else if($data['internship_data']->work_status == "1"){
								   echo "No";
							   }
							 }
							?> </td>
						</tr>
 <?php }?>
</table>				   
</div>	

<div class="col-md-2">
<table class = ""> 
       <?php
		  if(!empty($data['internship_data']->file_photo)){ ?>
		   <img src="{{asset('public/uploads/internship/photo/'.$data['internship_data']->file_photo)}}" style="height:49%; width: 75%;">
		<?php
		 }else{
			   echo "N/A";
		 }
		?> 
	    
 <div class="modal" id="mymodel_id_proof">
  <div class="modal-dialog">
  <div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" onclick="close_popup_id_proof()" data-dismiss="modal">&times;</button>
			<h4 class="modal-title"></h4>
		</div>
		<div class="modal-body">
              <embed id="embed" frameborder="0" src="{{asset('public/uploads/internship/id_proof/'.$data['internship_data']->file_id_proof)}}"  width="100%" height="400px">
			<div class="modal-footer">
				<button type="button" onclick="close_popup_id_proof()" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
  </div>
</div>
 <div class="modal" id="mymodel_experience">
  <div class="modal-dialog">
  <div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" onclick="close_popup_id_proof()" data-dismiss="modal">&times;</button>
			<h4 class="modal-title"></h4>
		</div>
		<div class="modal-body">
              <embed id="embed" frameborder="0" src="{{asset('public/uploads/internship/experience/'.$data['internship_data']->file_experience)}}"  width="100%" height="400px">
			<div class="modal-footer">
				<button type="button"  onclick="close_popup_id_proof()" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
  </div>
</div>
        <br><br>
	  <!--div align="center"-->
	    <b>View Document :</b>
	    <br><br>
		 
		<?php  if(!empty($data['internship_data']->file_id_proof)){ ?> 
		 <a style="color:green;cursor:pointer" style="color:green" onclick="func_open_file_id('<?php echo $data['internship_data']->file_id_proof; ?>')">ID Proof</a>
	     <?php  }else{  echo "N/A"; }?>   
        <br><br>
		<?php  if(!empty($data['internship_data']->file_experience)){ ?>
		 <a style="color:green;cursor:pointer" onclick="func_open_experience('<?php echo $data['internship_data']->file_experience; ?>')">Experience</a>
		 <?php  }else{  echo "N/A"; }?> 
		
		<br><br>
	   <?php $candidate_id = $data['internship_data']->candidate_id?>
							
</table>				   
</div>	
</div>			
</div>			
				
				<br>
			<hr>
	

<!-- The Modal For Considered -->

 <?php  if(!empty($data['internship_data']->work_status)){  ?>
				 <div class="form-group" style="margin-bottom: -1rem;    font-size: 13px;">
					<div class="row">
					  <div class="col-md-2">
							<label><b>Organization Name: </b></label>
							<div class="ex1"><?php  
							  if(!empty($data['internship_data']->organization)){ 
								   echo $data['internship_data']->organization;
							   }else{
								   echo "N/A";
							   }
							?></div> 
						</div>
						 <div class="col-md-3">
						<label><b>Organization Address: </b></label>
							<div class="ex1"><?php
							 if(!empty($data['internship_data']->organization_address)){ 
								  echo $data['internship_data']->organization_address;
							 }else{
								   echo "N/A";
							 }
							?></div> 
						</div>
					 <div class="col-md-2">
						<label><b>Designation: </b></label>
							<div class="ex1"><?php
							  if(!empty($data['internship_data']->designation)){ 
								  echo $data['internship_data']->designation;
							 }else{
								   echo "N/A";
							 }
							?></div> 
						</div>
						
						<div class="col-md-3">
						<label><b>Nature of Area : </b></label>
							<div class="ex1"><?php
							  if(!empty($data['internship_data']->nature_area)){ 
								  echo $data['internship_data']->nature_area;
							 }else{
								   echo "N/A";
							 }
							?></div> 
						</div>
						<div class="col-md-2">
						<label><b>Prime Focus of Work : </b></label>
							<div class="ex1"><?php
							  if(!empty($data['internship_data']->focus_work)){ 
								  echo $data['internship_data']->focus_work;
							 }else{
								   echo "N/A";
							 }
							?></div> 
						</div>
					</div> 
				</div>
				 <?php } ?>
				 <br>
				 <hr>
				 

	
	<div class="form-group" style="margin-bottom: -1rem; font-size: 13px;">
		<div class="row">
		  <div class="col-md-6">
				<label><b>Writeup on Interested Area in Internship: </b></label>
				
               <div class="ex2"><?php
				 if(!empty($data['internship_data']->writeup_interest)){ 
					  echo $data['internship_data']->writeup_interest;
				 }else{
					   echo "N/A";
				 }
				?></div>

				
			</div>
			 <div class="col-md-6">
			<label><b>Other Information (Experience/ Publications/ Patents/ Awards etc.): </b></label>
				
               <div class="ex2"><?php
				  if(!empty($data['internship_data']->remarks)){ 
					  echo $data['internship_data']->remarks;
				 }else{
					   echo "N/A";
				 }
				?></div>
			</div>
		
		</div> 
	</div>	


<br>
				 <?php if(!empty($data['intern_course_details'])){?>
				 <h4>Education Details</h4>

				 <table border="0" class="table  " id="tab0">
					  <thead style="font-size: 12px; font-weight: 300;line-height: 0.9;">
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
					 <tbody id="table_append" class="table_append" style=" font-size: 13px;">
					 <div> 
					 
					<?php $i=1; foreach($data['intern_course_details'] as $v){?> 
					 <tr id='addr0'>
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






<?php $role_id  = Auth::user()->role; $login_officer_id  = Auth::user()->id;?>	

				<hr>
				<center>
					<div class="form-group" >
					<a   href="javascript:history.back()" class="btn btn-primary "style="background-color: #2384c6; color:white"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;  Cancel</a>
					
					
@if(Gate::check('admin-internship-status-considered') || Gate::check('considered-internship-by-level1-status-considered') || Gate::check('rejected-internship-status-considered') || Gate::check('forward-to-committee-internship-status-considered'))		
<button type="button" class="btn btn-primary" data-toggle="modal" style="border: #3c8424;background-color: #3c8424;" onclick="considered_nonconidered(1,'<?php echo $candidate_id;?>','<?php echo $data['internship_data']->application_cd;?>')">Considered</button>
@endif
 
@if(Gate::check('admin-internship-status-non-considered') || Gate::check('considered-internship-by-level1-status-non-considered') || Gate::check('rejected-internship-status-non-considered')  || Gate::check('forward-to-committee-internship-status-non-considered'))	
<button type="button" class="btn btn-primary" data-toggle="modal"  style="border: #d81a11;background-color: #d81a11; "  onclick="considered_nonconidered(2,'<?php echo $candidate_id;?>','<?php echo $data['internship_data']->application_cd;?>')">Non Considered</button>
@endif				
					
					
			
					</div> 
				</center>
					



                 </div> 
			   </div>
            </div>
			 <br>
         </div>
     </div>
	 
	
 


<style> 
div.ex2 {
	height: 63px;
	width: 100%;
	overflow-y: scroll;
	border: 1px solid #e5e5e5;
}
div.ex1 {
	height: 40px;
    width: 100%;
    overflow-y: scroll;
    border: 1px solid #e5e5e5;
}
</style>


<div class="modal" id="considered">
  <div class="modal-dialog">
    <div class="modal-content" style="width: 109%;">
      <div class="modal-header">
	  
	    
         <div class="card-header text-center" style="width: 100%;"><h4 style="color: #2384c6;" class="application_id"> </h4><button type="button" class="close" onclick="close_consider_non_cons()" style="padding: 15px;margin: -77px -31px -15px auto;">&times;</button></div>
		 
		
     </div>

      <!-- Modal body -->
    <form  action="{{ route('admin-internship-considered') }}" class=""  onsubmit="this.elements['submit'].disabled=true;" autocomplete="off" id="considered_from" method="POST" >
		<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
		<input type = "hidden" name ="status_application" id="status_application" value="">
		<input type = "hidden" name ="candidate_id" id="internship_candidate_id" value="">
		<input type = "hidden" name ="officer_id" id="officer_id" value="<?php echo $login_officer_id?>">
		<input type = "hidden" name ="role_id" id="role_id" value="<?php echo $role_id?>">
	   <div class="form-group">
			<div class="row"  style=" margin-right:0px; margin-left:0px;">  
			   <div class="col-md-12"> 
			     <div id="consider_success"></div>
			   </div>
			</div>
		</div>
		
		
		
		<div class="form-group" style="display:none" id="non_cons_show">
			<div class="row"  style=" margin-right:0px; margin-left:0px;">
				   <div class="col-md-4">
						<tr>
							<td><b>Select the reason for not considered: </b></td>
						</tr>
					</div>
					<div class="col-md-8">
						<tr>
							<td>
							<select class="form-control" name="reason" id="reason">
								<option value="">Select</option>
								<option value="Id Proof is not Valid">Id Proof is not Valid</option>
								<option value="Experience not matches">Experience not matches</option>
								<option value="Qualification not matches">Qualification not matches</option>
								<option value="Desired Internship place is already fulfil">Desired Internship place is already fulfil</option>
								<option value="Others">Others</option>
							</select>
							</td>
						</tr>
						<div id="non_reason_error"></div>
					</div> 
			
			</div> 
		</div>
		
		
	    <div class="form-group">
			<div class="row"  style=" margin-right:0px; margin-left:0px;">  
			   <div class="col-md-3">
					<tr>
						<td><b>Remarks: </b></td>
					</tr>
				</div>
				<div class="col-md-9">
					<tr>
						<td><textarea name="remarks" id="remarks" class="form-control" rows="5" col="10"></textarea></td>
					</tr>
					<div id="consider_error"></div>
				</div> 
			</div> 
		</div>
		<hr>
		<center>
			<div class="form-group" >
			    <button onclick="consider_form_sumbit()"  id="cons"  class="btn btn-primary icon-btn" type="button">Submit</button>
				<button type="button" class="btn btn-danger" onclick="close_consider_non_cons()">Close</button>
			</div> 
		</center>
	</form>

    </div>
  </div>
</div>
<!-- The Modal For Considered -->


<script type="text/javascript">
   
/*************Internhip Considered AND Non Considered popup open and popup close and form submit function*********/
function considered_nonconidered(status,candidate_id,application_id){
	if(status == "2"){
		$('#non_cons_show').show();
		$('.application_id').html('Non Considered Application: '+application_id);
	}else if(status =="1"){
		$('.application_id').html('Considered Application: '+application_id);
		$('#non_cons_show').hide();
	}
    $('#status_application').val(status);
	$('#internship_candidate_id').val(candidate_id);
	
    $('#considered').show();

}

function close_consider_non_cons(){
	$('#considered').hide("");$('#non_reason_error').html('');$('#consider_error').html('');
}
  
function consider_form_sumbit(){
  var status_application = $('#status_application').val();
  if(status_application == "2"){
	  var reason = $('#reason').val();
	  if(reason == ""){
		 $('#non_reason_error').html('Please select reason!!..');
		 $('#non_reason_error').css('color','red');
	  }
  }else if(status_application == "1"){
	  var reason = "";
  }
  var _token = $('input[name="_token"]').val();
  var internship_candidate_id = $('#internship_candidate_id').val();
  var officer_id = $('#officer_id').val();
  var role_id = $('#role_id').val();
  var remarks = $('#remarks').val();
  if(remarks == ""){
     $('#consider_error').html('Please enter your remarks!!..');
     $('#consider_error').css('color','red');
  }else{
    $.ajax({
            url:"{{ route('admin-internship-considered') }}",
            type: 'POST',
            data: {reason:reason,status_application: status_application,internship_candidate_id:internship_candidate_id,remarks:remarks,officer_id:officer_id,role_id:role_id,_token:_token},
             success: function(data) {
				  if(data == 1){
                  $('#cons').prop('disabled','true');
                  setTimeout(function(){ 
                    window.location.href = "{{URL('admin-internship')}}";
                   }, 3000);
				   $('#consider_error').html('');
                  $('#consider_success').html('Status Updated Successfully!!..');
                  $('#consider_success').css('color','green');
                }
            }
      });
    }
} 
	

/*************Internhip Considered AND Non Considered popup open and popup close and form submit function*********/

</script>

@endsection
	
	