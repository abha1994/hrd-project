<?php //echo "<pre>"; print_r($courses); echo count($courses); die; ?>
 
 <div class="content-wrapper" style="margin-left: 13px;">
    <div class="container-fluid">
	 
	
      <!-- Icon Cards-->
	   <div class="card card-login mx-auto mt-5 " style="max-width: 65rem; margin-bottom: 28px;">
							

     <div class="card-header text-center"><h4 style="color: #2384c6;"><center>Student Registration</center></h4></div>
     <div class="card-body">
		<table>
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
				<td>{{ $record[0]->history_organization_doc }}</td>
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
				<td>No.of trainees proposed for batch/course/programmer</td>
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
				<td>Methodology of imparting training (both theoretical and practical) including pedagogy </td>
				<td>{{ $record[0]->methodology_imparting_training }}</td>
			</tr>
			<tr>
				<td>Percentage of time devoted by core faculty and guest faculty in a particular training program </td>
				<td>{{ $record[0]->core_guest_percentage_time }}</td>
			</tr>
			<tr>
				<td>In case of Off-campus programmes, tie-up with local organizations for venue and other infrastructure to be clearly spelt out  </td>
				<td>{{ $record[0]->tieup_campus_programmer }}</td>
			</tr>
			<tr>
				<td>If the organization has tied up with some industry, system integrators, installers, EPC etc. for engaging the trained manpower, the same may be spelt out.  </td>
				<td>{{ $record[0]->engaging_trained_programmer }}</td>
			</tr>
			<tr>
				<td>If any fees is being charged from the trainees, that may also be included  </td>
				<td>{{ $record[0]->fee_charged_traniees }}</td>
			</tr>
			<tr>
				<td>Anticipated impact of the training programme on life of trainees as well as in the quality improvement of RE programme  </td>
				<td>{{ $record[0]->anticipated_impact }}</td>
			</tr>


			<tr>
				<td colspan="2"><strong>Signature of program coordinator :</strong>   </td></tr>
				<tr><td colspan="2"><strong>Name and Signature of Concern authority with Seal: </strong></td>
			</tr>


		</table>
			
				             
		 
     </div>
	 
	 <div style="position: relative;top: 7em;">
	 <p><strong>Ministry of New and Renewable Energy</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Designed & Developed by National Informatics Centre</strong></p>
	 </div>
	</div>
</div>
</div>
	
	