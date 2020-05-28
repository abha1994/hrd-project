@extends('layouts.master')
@section('container')
<br />

<script>
var pageurl = "{{ url('attendanceAjaxadmin')}}";
</script>
	 <script src="{{ asset('public/js/attendanceAdmin_validation.js') }}"></script>
	 <div class="content-wrapper" >
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ url('dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Candidates Attendance Form</li>
      </ol>
     <div class="card mb-3">
	    <div class="card-header text-center"><h4 class="mt-2">Candidates Attendance Form</h4></div>
	       <div class="container-fluid border-top bg-white card-footer text-muted text-left" id="app"> 
	     

@include('includes/flashmessage')
	
	<form enctype="multipart/form-data" action="{{ route('attendanceAdmin-form-post') }}" autocomplete="off" id="attendance_form==" method="POST" onsubmit="return validate(this);">
			{!! csrf_field() !!}
			
			
		<br>
<?php //dd($institute_data);?>
      <div class="col-md-4" style="float:left">
		
		               <select class="form-control commoanPara" name="university_atten" id="university_atten">
						<option value="">Select University</option>
						<?php foreach($institute_data as $inst) { ?>
						<option value="<?php echo $inst->institute_id; ?>"><?php echo $inst->institute_name; ?></option>
						<?php } ?>
						</select> 
						
		</div>
		
		<div class="col-md-4" style="float:left">
		
		               <select class="form-control commoanPara" name="month_atten" id="month_attenAdmin">
						<?php $curMonth=date("n"); $currentYear= date("Y"); 
						$monthArray=array('1'=>'January','2'=>'February','3'=>'March','4'=>'April','5'=>'May','6'=>'June','7'=>'July','8'=>'August','9'=>'September','10'=>'October','11'=>'November','12'=>'December');
						?>
						<option value="">Select Month</option>
						<?php for($i=1;$i<=$curMonth;$i++) { ?>
						<option value="<?php echo $i; ?>" <?php ////if($curMonth==$i) { echo 'selected'; }?>><?php echo $monthArray[$i]; ?></option>
						<?php } ?>
						</select>
						
		</div>
		
		<div class="col-md-4" style="float:left">
		<select class="form-control" name="year_atten" id="year_atten">
		<option value="">Select Year</option>
						<option value="<?php echo $currentYear;?>"><?php echo $currentYear;?></option>
		</select>
		</div>
		<br>
		
		<input type="hidden" value="<?php echo $currentMonthDays=date('t'); ?>"  name="maxDays" id="maxDays" />
			
    	<div class="card-body" style="border:none;">
		
    		  <table  width="100%"  class="table table-bordered data-table" id="attend">
			    <thead>
				       <tr>
							<th class="filterhead">Student Name</th>
							<th class="filterhead">Course</th>
							<th class="filterhead">Working Days</th>
							<th class="filterhead">Holidays</th>
							<th class="filterhead">Present Days</th>
							<th class="filterhead">Absent Days</th>
							<th class="filterhead">Leave Approved Days</th>
							<th class="filterhead">Total Days</th>
							<th class="filterhead">Remarks</th>
							 
					  </tr>
				</thead>
				</table> 
				<!--   -->
        </div>
		
		<!--<center class="btnAvail">
								<div class="form-group" >
									<input class="btn btn-primary " type="submit"  value="Submit">
								</div> 
							</center>-->
							
		</form>
    </div>
</div></div></div>

<!-- /.container-fluid-->


@endsection
	
	