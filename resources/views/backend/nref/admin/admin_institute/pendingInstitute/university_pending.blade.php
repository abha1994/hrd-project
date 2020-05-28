@extends('layouts.master')

@section('container')

<?php //echo "<pre>"; print_r($data['courses_list']); die; ?>

 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ url('home')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active"> View Institute</li>
      </ol>
<div class="card card-login mx-auto mt-5 " style="max-width: 100rem;">
	
	
<?php //dd($data['institute_data']);?>
<div class="card-header text-center"><h4 class="mt-2">Application - <?php if(!empty($data['institute_data']->application_cd)) { echo $data['institute_data']->application_cd;}?> </h4></div>
      <div class="card-body">

							<div class="form-group">
								<div class="row">
								    <div class="col-md-4">
									<label for="name"  style="font-size: 13px;" class="control-label">Name of the Institute</label>
									<p><?php if(!empty($data['institute_data'])) { echo $data['institute_data']->institute_name;} ?></p>
										
								    </div>
									
									<div class="col-md-4">
									<label for="name"  style="font-size: 13px;" class="control-label">Name of the Department</label>
										<p><?php if(!empty($data['institute_data'])) { echo $data['institute_data']->department_name;} ?></p>
								    </div>
									
									<div class="col-md-4">
									<label for="name"  style="font-size: 13px;" class="control-label">Coordinator of the Proposed Program</label>
										<p><?php if(!empty($data['institute_data'])) { echo $data['institute_data']->coordinate_prog;} ?></p>
									</div>
								</div> 
							</div>
							
							<div class="form-group">
								<div class="row">
									<div class="col-md-3">
									<label for="name"  style="font-size: 13px;" class="control-label">Type of Institution</label>
										<p>
											@foreach($data['type_inst'] as $val)
											
											<?php 
											if(!empty($data['institute_data']->institute_type_id)){
												if($data['institute_data']->institute_type_id == $val->institute_type_id){
													echo $val->institute_desc;
												}
											} 
											?>
											@endforeach
											</p>
								   	    
									</div>
									
									
									
									
									<div class="col-md-4">
									<label for="name"  style="font-size: 13px;" class="control-label">University/Institute Ranking as per UGC/NIRF</label>
										<p><?php if(!empty($data['institute_data']->university_rank)){ ?>{{ $data['institute_data']->university_rank }} <?php } ?>
									</div>
									
									<!--<div class="col-md-4">
									<label for="name"  style="font-size: 13px;" class="control-label">Course offered by department : </label>
									
									<?php //$curse=explode(',',$data['institute_data']->lstCourse); ?>
									
									    @if(isset($data['courses_list']))
										@foreach($data['courses_list'] as $courseName)
										
						<?php /* if(count($curse)>0) { for($k=0;$k<count($curse);$k++) { if($curse[$k]==$courseName->course_id) { ?>
										<p>{{$k+1}}.{{$courseName->course_name}}</p>
						<?php } } } */ ?>
										@endforeach
										@endif
										
									</div>-->
									
								</div> 
							</div>
							
							<div class="form-group">
								<div class="row">
								
								<div class="col-md-4">
									<label for="name"  style="font-size: 13px;" class="control-label">Last annual report</label>
									@if(isset($data['institute_data']->annual_report))
									<a href="{{ asset('public/uploads/nref/'.$data['institute_data']->annual_report) }}" download><?php if($data['institute_data']->annual_report) { echo $data['institute_data']->annual_report; } ?></a>
								@endif
									
									</div>
								
								<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;" class="control-label">Years of Establishment</label>
										<p><?php if(!empty($data['institute_data']->year_establishment)){ ?>{{$data['institute_data']->year_establishment}}<?php } ?></p>
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">Approx. Number of Students in Proposed Program</label>
										<p><?php if(!empty($data['institute_data']->no_student)){ ?>{{$data['institute_data']->no_student}}<?php } ?></p>
									</div>
								
								</div> 
							</div>
							
							<!--- NEW Functionality Add more -->
							
							<table border="0" class="table table-bordered table-striped table-hover" id="tab0">
                    <thead style="font-size: 14px; font-weight: 300;line-height: 0.9;">
						<tr>
                             
                            <th>Course Offered by department</th>
                            <th class="text-center">Approx. Number of Students</th>
                        </tr>
                    </thead>
                    <tbody id="table_append" class="table_append">
						<div> 
						

						
						<?php 
						$crseDtls=json_decode($data['institute_data']->course_offered_dept);
												
							if(isset($crseDtls)) { foreach($crseDtls as $key=>$value)
							{ ?>
							
							<tr class="record">
							
                                <td class="text-center">
	                             
						@foreach($data['courses_offered'] as $val) 
					<?php if($key==$val->course_id) { ?>{{$val->course_name}}<?php } ?>
											@endforeach 
									
									@if ($errors->has('course_id'))courses_offered
										<span class="invalid-feedback " role="alert">
											<strong>{{ $errors->first('course_id') }}</strong>
										</span>
									@endif
								</td>
                                <td class="text-center">
                                	<?php echo $crseDtls->$key; ?>
								</td>
								
								
                            </tr>
							
							<?php } } else {  ?>
							
							<tr>
                                 
                                <td colspan="3"><center>No data available</center></td>
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
									
									@if(isset($data['institute_data']->faculty_details))
										
									<a href="{{ asset('public/uploads/nref/'.$data['institute_data']->faculty_details) }}" download><?php if($data['institute_data']->faculty_details) { echo $data['institute_data']->faculty_details; } ?></a>
										
									@endif
										
									</div>
									
									
									
									<div class="col-md-3">
									
             <label for="name"  style="font-size: 13px;" class="control-label">Any Collaborative Institute</label>
			 
			 <p>
			 <?php if(!empty($data['institute_data']->any_collaboration)) { 
			 if($data['institute_data']->any_collaboration=='yes')
			 {
				 echo "Yes";
			 }
			 
			 else 
			 {
				 echo "No";
			 }
			 
			 } ?></p>			
									</div>
									@if($data['institute_data']->any_collaboration=='yes')
										
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">Name of Collaborate Institute</label>
										<p><?php if(!empty($data['institute_data']->collab_institute)){ ?>{{$data['institute_data']->collab_institute}}<?php } ?></p>
									</div>
										
									<div class="col-md-4" style="padding:2em 0em 0em 1em">
									@if(isset($data['institute_data']->research_phd)) 
									<?php $ss=explode(',',$data['institute_data']->research_phd); ?>
									<input name="resrch_phd" type="checkbox" value="Research"   
									<?php if(count($ss)>0) { for($i=0;$i<count($ss);$i++) { if($ss[$i]=='Research') { echo "checked";} } } ?> > Research
									<input name="resrch_phd[]" type="checkbox" value="Ph. D Registration" 
									<?php if(count($ss)>0) { for($i=0;$i<count($ss);$i++) { if($ss[$i]=='Ph. D Registration') { echo "checked";} } }  ?>> Ph. D Registration
									
									<input name="resrch_phd[]" type="checkbox" value="Post Graduate Program" 
									<?php if(count($ss)>0) { for($i=0;$i<count($ss);$i++) { if($ss[$i]=='Post Graduate Program') { echo "checked";} } }  ?>> Post Graduate Program
									
                                     @endif
									</div>
									

									@endif
									
									
								</div>
							</div>
							
							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">Experience in Energy related courses</label>
										<p><?php if(!empty($data['institute_data']->energy_experience)){ ?>{{$data['institute_data']->energy_experience}}<?php } ?></p>
									</div>
									</div>
									
									<div class="row">
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">A) Date of approximate course Start</label>
										<p><?php if(!empty($data['institute_data']->course_start_date)){ ?>{{date('Y-m-d',strtotime($data['institute_data']->course_start_date))}}<?php } ?></p>
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">B) Number of Seats in each of the course</label>
										<P><?php if(!empty($data['institute_data']->no_of_seat)){ ?>{{$data['institute_data']->no_of_seat}}<?php } ?></P>
									</div>
									
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">C) Specialization offered</label>
										<p><?php if(!empty($data['institute_data']->specialization_offered)){ ?>{{$data['institute_data']->specialization_offered}}<?php } ?></p>
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">D) If any industry collaboration is there, if so details thereof</label>
										<p><?php if(!empty($data['institute_data']->industry_collaboration)){ ?>{{$data['institute_data']->industry_collaboration}}<?php } ?></p>
									</div>
									
									
									<div class="col-md-4">
									
                                  <label for="name"  style="font-size: 12px;" class="control-label">E) If placement service is being provided</label>
								  
								  <p><?php 
								  if(!empty($data['institute_data']->placement_details)){
									 
									if($data['institute_data']->placement_details=='yes')
									{
										echo "Yes";
									}

									elseif($data['institute_data']->placement_details=='no')
									{
										echo "No";
									}
									else
									{
										echo "Select";
									}	
								  } 
								  
								  ?></p>
                                        
									
										
									</div>
									
									
									
									@if($data['institute_data']->placement_details=='yes')
									<div class="col-md-4">
									<label for="name"  style="font-size: 13px;" class="control-label">F) Details of placement of previous students</label>
										@if(isset($data['institute_data']->file_prevStudent_proof))
										<a href="{{ asset('public/uploads/nref/'.$data['institute_data']->file_prevStudent_proof) }}" download><?php if($data['institute_data']->file_prevStudent_proof) { echo $data['institute_data']->file_prevStudent_proof; } ?></a>
										@endif
										
									</div>
									@endif
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">
									 <?php if($data['institute_data']->placement_details=='yes') { echo "G"; }
									       else
										   {
											   echo "F";
										   }
										 
										 ?>
										 
										 ) Any other details</label>
										<p><?php if(!empty($data['institute_data']->other_details)){ ?>{{$data['institute_data']->other_details}}<?php } ?></p>
									</div>
									
									
									<div class="col-md-6">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">Sponsored Projects in the area of Energy, Environment and Renewable Energy</label>
										<p><?php if(!empty($data['institute_data']->spon_project)){ ?>{{$data['institute_data']->spon_project}}<?php } ?></p>
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
									<p><?php if(!empty($data['institute_data']->fellowship_period)){ ?>{{$data['institute_data']->fellowship_period}}<?php } ?></p>
									</div>
									</div>
									
								<div class="row">
								<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">M.Tech.</label>
										<p><?php if(!empty($data['institute_data']->fellowship_mtech)){ ?>{{$data['institute_data']->fellowship_mtech}}<?php } ?></p>
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">JRF</label>
										<p><?php if(!empty($data['institute_data']->fellowship_jrf)){ ?>{{$data['institute_data']->fellowship_jrf}}<?php } ?></p>
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">SRF</label>
										<p><?php if(!empty($data['institute_data']->fellowship_srf)){ ?>{{$data['institute_data']->fellowship_srf}}<?php } ?></p>
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">M.SC. Renewable Energy</label>
										<p><?php if(!empty($data['institute_data']->fellowship_msc)){ ?>{{$data['institute_data']->fellowship_msc}}<?php } ?></p>
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">RA</label>
										<p><?php if(!empty($data['institute_data']->fellowship_ra)){ ?>{{$data['institute_data']->fellowship_ra}}<?php } ?></p>
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">PDF</label>
										<p><?php if(!empty($data['institute_data']->fellowship_pdf)){ ?>{{$data['institute_data']->fellowship_pdf}}<?php } ?></p>
									</div>
									
									<div class="col-md-4">
									 <label for="name"  style="font-size: 13px;color:#000" class="control-label">Total</label>
										<p><?php if(!empty($data['institute_data']->fellowship_total)){ ?>{{$data['institute_data']->fellowship_total}}<?php } ?></p>
									</div>
									
								
								</div>
								</div>
								
								<div class="form-group">
								<div class="row">
								<div class="col-md-12">
								
								<input disabled type="checkbox" value="1" <?php if(!empty($data['institute_data']->certified_status)){ if($data['institute_data']->certified_status==1) { echo 'checked'; } } ?> /> <span>We Certified that the information have been verified and correct</span>
					
								</div>
								</div>
								<div class="form-group">
								<div class="col-md-4">
									<label for="name"  style="font-size: 13px;" class="control-label">File With Signature</label>
									@if(isset($data['institute_data']->file_upload_signature))
									<a href="{{ asset('public/uploads/nref/'.$data['institute_data']->file_upload_signature) }}" download><?php if($data['institute_data']->file_upload_signature) { echo $data['institute_data']->file_upload_signature; } ?></a>
								@endif
									
									</div>
								
								
								</div>
								</div>
							
							<hr>
							
		<?php $role_id  = Auth::user()->role; $login_officer_id  = Auth::user()->id; ?>
		

	<?php if($role_id!=5) { ?>

	           <center>
								<div class="form-group" >
					 <a class="btn btn-secondary" href="{{ url()->previous() }}"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; Cancel</a>
			

								   <button type="button" class="btn btn-primary" data-toggle="modal" style="border: #3c8424;background-color: #3c8424;" onclick="considered_university(1,'<?php echo $data['institute_data']->institute_id;?>','<?php echo $data['institute_data']->application_cd;?>')">Considered</button>
								  
 
		   
								   <button type="button" class="btn btn-primary" data-toggle="modal"  style="border: #d81a11;background-color: #d81a11; "  onclick="considered_university(2,'<?php echo $data['institute_data']->institute_id;?>','<?php echo $data['institute_data']->application_cd;?>')">Non Considered</button>
							     
								   
								</div> 
							</center>
	<?php } ?>
                </div>
            </div>
         </div>
     </div>
	 


<div class="modal" id="considered_university">
  <div class="modal-dialog">
    <div class="modal-content" style="width: 109%;">
      <div class="modal-header">
	 
		  <div class="card-header text-center" style="width: 100%;"><h4  class="application_id mt-2"> </h4><button type="button" class="close" onclick="close_consider_university()" style="padding: 15px;margin: -77px -31px -15px auto;">&times;</button></div>
		  
		  
     </div>

      <!-- Modal body -->
    <form  action="{{ route('admin-institute-considered') }}" class=""  onsubmit="this.elements['submit'].disabled=true;" autocomplete="off" id="considered_from" method="POST" >

<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
		<input type = "hidden" name ="status_application" id="status_institute" value="">
		<input type = "hidden" name ="institute_id" id="institute_id" value="">
		<input type = "hidden" name ="officer_id" id="officer_id" value="<?php echo $login_officer_id?>">
		<input type = "hidden" name ="role_id" id="role_id" value="<?php echo $role_id?>">
	  
	

		<div class="form-group">
			<div class="row"  style=" margin-right:0px; margin-left:0px;">  
			   <div class="col-md-12"> 
			     <div id="consider_university_success"></div>
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
						<td><textarea name="remarks" id="remarks_inst_cons" class="form-control" rows="5" col="10"></textarea></td>
					</tr>
					<div id="consider_university_error"></div>
				</div> 
			</div> 
		</div>
		<hr>
		<center>
			<div class="form-group" >
			    <button onclick="consider_university_form_sumbit()"  id="cons_institute"  class="btn btn-primary icon-btn" type="button">Submit</button>
				<button type="button" class="btn btn-danger" onclick="close_consider_university()">Close</button>
			</div> 
		</center>
	</form>

    </div>
  </div>
</div>


<script type="text/javascript">
   


function consider_university_form_sumbit(){
	
	var urlRedirect = "<?php echo url()->previous(); ?>";
	
  var status_application = $('#status_institute').val();
  
  if(status_application == "2"){
	  var reason = $('#reason').val();
	  if(reason == ""){
		 $('#non_reason_error').html('Please select reason!!..');
		 $('#non_reason_error').css('color','red');
	  }
  }else if(status_application == "1"){
	  var reason = "";
  }
  var institute_id = $('#institute_id').val();
  var officer_id = $('#officer_id').val();
  var role_id = $('#role_id').val();
  var remarks = $('#remarks_inst_cons').val();
  var _token = $('input[name="_token"]').val();
  if(remarks == ""){
     $('#consider_university_error').html('Please enter your remarks!!..');
     $('#consider_university_error').css('color','red');
  }else{
    $.ajax({
            url:"{{ route('admin-institute-considered') }}",
            type: 'POST',
            data: {reason:reason,status_application: status_application,institute_id:institute_id,remarks:remarks,officer_id:officer_id,role_id:role_id,_token:_token},
             success: function(data) {
				  if(data == 1){
                  $('#cons_institute').prop('disabled','true');
                  setTimeout(function(){ 
                    window.location.href = urlRedirect;
                   }, 3000);
				   $('#consider_university_error').html('');
                  $('#consider_university_success').html('Status Updated Successfully!!..');
                  $('#consider_university_success').css('color','green');
                }
            }
      });
    }
}

function considered_university(status,candidate_id,application_id){
$('#non_reason_error').html('');$('#consider_university_error').html('');
    if(status == "2"){
		$('#non_cons_show').show();
		$('.application_id').html('Non Considered Application: '+application_id);
	}else if(status =="1"){
		$('.application_id').html('Considered Application: '+application_id);
		$('#non_cons_show').hide();
	}
	
	$('#status_institute').val(status);
	$('#institute_id').val(candidate_id);
	$('#considered_university').show();
}

function close_consider_university() {
	
	$('#considered_university').hide("");
}

</script>

<script>
$(document).ready(function() { 

   var getUrl = window.location;
	var baseurl =  getUrl.origin + '/' +getUrl.pathname.split('/')[1];
	//var folderName= getUrl.pathname.split('/')[1];
	var URL1= '/university';
	var URL2= '/universityCons';
	var URL3= '/universityNocons';
	var URL4= '/universityConsAdmin';
	var URL5= '/universitySelected';
	var URL6= '/universityFinalSelected';
	var URL7= '/universityFinalReject';
	//alert(URL1)
	$('li.nav-item a[href*="'+ URL1 + '"]').addClass('active');
	$('li.nav-item a[href*="'+ URL2 + '"]').removeClass('active');
	$('li.nav-item a[href*="'+ URL3 + '"]').removeClass('active');
	$('li.nav-item a[href*="'+ URL4 + '"]').removeClass('active');
	$('li.nav-item a[href*="'+ URL5 + '"]').removeClass('active');
	$('li.nav-item a[href*="'+ URL6 + '"]').removeClass('active');
	$('li.nav-item a[href*="'+ URL7 + '"]').removeClass('active');


});
</script>

@endsection
	
	