@extends('layouts.master')
@section('container')
 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ url('dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Student Registration
		 </li>
      </ol>
	 
      <!-- Example DataTables Card-->
    <div class="card mb-3">
		<div class="card-header text-center"><h4 class="mt-2">Student Registration</h4></div>
	    <div class="container-fluid border-top bg-white card-footer text-muted text-left" id="app">   
		<br /><br />
           <div class="table-responsive card-box">
                <div class="card-body">
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
     
@endsection
 