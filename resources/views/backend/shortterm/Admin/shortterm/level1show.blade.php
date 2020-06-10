@extends('layouts.master')
@section('container')
 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ url('dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Consider By Level 1 Application</li>
      </ol>
	 
      <!-- Example DataTables Card-->
    <div class="card mb-3">
		<div class="card-header text-center"><h4 class="mt-2"> Consider By Level 1 Application</h4></div>
	    <div class="container-fluid border-top bg-white card-footer text-muted text-left" id="app">   
		 
		<div class="pull-right" style="float: right;">
        
        
         <?php 
         $officer_id = Auth::id();
         $roleid = \App\User::with('roles')->find($officer_id);
         ?> 
         @if($roleid->role==3 && $record[0]->status_id==1)
<!--             <button type="button" class="btn btn-primary" data-toggle="modal"  style="border: #d81a11;background-color: #d81a11; " onclick="considered_nonconidered(2,'<?php echo $record[0]->short_term_id;?>')">Non Considered</button>
            -->
        @endif
         @if($roleid->role==3 && $record[0]->status_id==2)
            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" style="border: #3c8424;background-color: #3c8424;" onclick="considered_nonconidered(1,'<?php echo $record[0]->short_term_id;?>' )">Considered</button> -->
           
        @endif
        @if($roleid->role==5)

        @endif
        @if($roleid->role==2)
		<button type="button" class="btn btn-primary" data-toggle="modal" style="border: #3c8424;background-color: #3c8424;" onclick="considered_nonconidered(1,'<?php echo $record[0]->short_term_id;?>' )">Consider</button>
		<button type="button" class="btn btn-primary" data-toggle="modal"  style="border: #d81a11;background-color: #d81a11; " onclick="considered_nonconidered(2,'<?php echo $record[0]->short_term_id;?>')">Non Considered</button>
           
        @endif
		<a href="{{url('consider-by-level1')}}" class="btn btn-secondary">Back</a>
         
      </div><br />
           <div class="table-responsive card-box">
                <div class="card-body  mt-2">
					<table class="table">
						<tr>
							<td>Name of the proposed training program</td>
							<td>{{ $record[0]->name_proposed_training_program }}</td>
						</tr>
						<tr>
							<td>Coordinator Name</td>
							<td>{{ $record[0]->coordinator_name }}</td>
						</tr>
						<tr>
							<td>Coordinator Mobile</td>
							<td>{{ $record[0]->coordinator_mobile }}</td>
						</tr>
						<tr>
							<td>Coordinator Address</td>
							<td>{{ $record[0]->coordinator_address }}</td>
						</tr>
						<tr>
							<td>Background history of the Organization, Its activities in RE Development, especially capacity building </td>
							<td><a href="{{asset('public/uploads/short_term/'.$record[0]->history_organization_doc )}}"> Background history of the Organization</a></td>
						</tr>
						<tr>
							<td>Technology area of the proposed training program </td>
							<td>{{ $record[0]->technology_area }}</td>
						</tr>
						<tr>
							<td>other re area</td>
							<td>{{ $record[0]->other_re_area }}</td>
						</tr>
						<tr>
							<td>Objective of the Program </td>
							<td>{{ $record[0]->objective_program }}</td>
						</tr>
						<tr>
							<td>Target group to be addressed in proposed training program  </td>
							<td>{{ $record[0]->target_group }}</td>
						</tr>
						<tr>
							<td>Geographical area of operation </td>
							<td>{{ $record[0]->geographical_area }}</td>
						</tr>

						<tr>
							<td>Assessment of skilled manpower requirement in the area of operation based on projects implemented/systems installed as also the potential growth of penetration of renewable energy systems in the area of operation.</td>
							<td>{{ $record[0]->assessment_skilled }}</td>
						</tr>
						<tr>
							<td>Number of trainees proposed to be trained in one year (this should be based on assessment done in the area of operation) </td>
							<td>{{ $record[0]->no_student_trained_a_year }}</td>
						</tr>
						<tr>
							<td>No. of training programmers proposed in one year</td>
							<td>{{ $record[0]->proposed_programme_a_year }}</td>
						</tr>
						<tr>
							<td>Trainees proposed for batch/course/programmer</td>
							<td>{{ $record[0]->no_trainee_proposed_batch }}</td>
						</tr>
						<tr>
							<td>Duration of the proposed course</td>
							<td>{{ $record[0]->duration_proposed_course }}</td>
						</tr>
						<tr>
							<td>Selection Criteria of trainees </td>
							<td>{{ $record[0]->selection_criteria }}</td>
						</tr>
						<tr>
							<td>Faculty Name </td>
							<td>{{ $record[0]->faculty_name }}</td>
						</tr>
						<tr>
							<td>Faculty Designation </td>
							<td>{{ $record[0]->faculty_designation }}</td>
						</tr>
						<tr>
							<td>Faculty Level</td>
							<td>{{ $record[0]->faculty_level }}</td>
						</tr>
						<tr>
							<td>Infrastructure</td>
							<td>{{ $record[0]->infrastructure }}</td>
						</tr>
						<tr>
							<td>Course Material doc</td>
							<td><a href="{{asset('public/uploads/short_term/'.$record[0]->course_material_doc )}}">Course Material doc</a></td>
						</tr>
						<tr>
							<td>Methodology of imparting training</td>
							<td>{{ $record[0]->methodology_imparting_training }}</td>
						</tr>
						<tr>
							<td>Guest Faculty Doc  </td>
							<td><a href="{{asset('public/uploads/short_term/'.$record[0]->guest_faculty_doc )}}">Course Material doc</a></td>
						</tr>
						<tr>
							<td>Content Letter doc</td>
							<td><a href="{{asset('public/uploads/short_term/'.$record[0]->content_letter_doc )}}">Content Letter doc</a></td>
						</tr>
						<tr>
							<td>Core Guest Percentage Time </td>
							<td>{{ $record[0]->core_guest_percentage_time }}</td>
						</tr>
						<tr>
							<td>Tie up campus programmer </td>
							<td>{{ $record[0]->tieup_campus_programmer }}</td>
						</tr>

						<tr>
							<td>Engaging trained programmer </td>
							<td>{{ $record[0]->engaging_trained_programmer	 }}</td>
						</tr>
						<tr>
							<td>Fee charged traniees </td>
							<td>{{ $record[0]->fee_charged_traniees	 }}</td>
						</tr>

						<tr>
							<td>Anticipate impact </td>
							<td>{{ $record[0]->anticipated_impact	 }}</td>
						</tr>
						<tr>
							<td>Financial Proposal doc</td>
							<td><a href="{{asset('public/uploads/short_term/'.$record[0]->financial_proposal_doc )}}">Financial Proposal doc</a>
							</td>
						</tr>
					</table>
			
				  <!-- <div><a href="{{route('short-term-program.index')}}" class="btn btn-secondary">Back</a></div>        -->    
				</div>
			</div>
        </div> 
    </div>
</div>
</div>
<?php $role_id  = Auth::user()->role; $login_officer_id  = Auth::user()->id; ?>	

	
<div class="modal" id="considered">
  <div class="modal-dialog">
    <div class="modal-content" style="width: 109%;">
      <div class="modal-header">
	  
	    
         <div class="card-header text-center" style="width: 100%;"><h4 style="color: #FFF;" class="application_id"> </h4><button type="button" class="close" onclick="close_consider_non_cons()" style="padding: 15px;margin: -77px -31px -15px auto;">&times;</button></div>
		 
		
     </div>

      <!-- Modal body -->
    <form  action="{{ url('student-consider') }}" class=""  onsubmit="this.elements['submit'].disabled=true;" autocomplete="off" id="considered_from" method="POST" >
		<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
		<input type = "hidden" name ="status_application" id="status_application" value="">
		<input type = "hidden" name ="student_id" id="student_id" value="">
		<input type = "hidden" name ="institute_id" id="institute_id" value="">
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
						<td><textarea name="remarks" id="remarks" class="form-control" rows="5" col="10" maxlength="50"></textarea></td>
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
 
<script type="text/javascript">

   
/*************Student Considered AND Non Considered popup open and popup close and form submit function*********/
function considered_nonconidered(status,student_id){
	// alert("{{URL('get-instituteId/institute_id')}}");
	//alert(status);
	if(status == "2"){
		$('#non_cons_show').show();
		$('.application_id').html('Non Considered Application: ');
	}else if(status =="1"){
		$('.application_id').html('Considered Application: ');
		$('#non_cons_show').hide();
	}
    $('#status_application').val(status);
	$('#student_id').val(student_id);
	$('#institute_id').val(institute_id);
	$('#considered').show();

}

function close_consider_non_cons(){
	$('#considered').hide("");
	$('#non_reason_error').html('');
	$('#consider_error').html('');
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

  var student_id = $('#student_id').val();
  var institute_id = $('#institute_id').val();
  var officer_id = $('#officer_id').val();
  var role_id = $('#role_id').val();
  var remarks = $('#remarks').val();
   
  var page_url = "{{ url('short-term-application') }}"+"/"+student_id;
  //alert(page_url);return false;
  if(remarks == ""){
     $('#consider_error').html('Please enter your remarks!!..');
     $('#consider_error').css('color','red');
  }else{
    $.ajax({
            url:"{{ url('short-term-application-consider') }}",
            type: 'POST',
            data: {reason:reason,student_id:student_id,status_application: status_application,institute_id:institute_id,remarks:remarks,officer_id:officer_id,role_id:role_id,_token:_token},
             success: function(data) {
				  if(data == 1){
                  $('#cons').prop('disabled','true');
                  setTimeout(function(){ 
                    window.location.href = page_url;
                   }, 3000);
				   $('#consider_error').html('');
                  $('#consider_success').html('Status Updated Successfully!!..');
                  $('#consider_success').css('color','green');
                }
            }
      });
    }
} 
	

/*************Student Considered AND Non Considered popup open and popup close and form submit function*********/

$(document).ready(function () {
 
 
        $(".sidebar-menu li").removeClass("menu-open");
        $(".sidebar-menu li").removeClass("active");        
        $("#lishortterm").addClass('menu-open');        
        $("#ulshortterm").css('display', 'block');
        $(".nav-link").removeClass('active');
       // $("#liJobCategory").addClass("false");
       // $("#liCountry").addClass("false");
        $("#considerlevel1").addClass("active");
        // $("#rejectededit").addClass("active");
      });

</script>
@endsection
 