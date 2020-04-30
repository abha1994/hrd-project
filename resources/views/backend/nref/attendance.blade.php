@extends('layouts.master')

@section('container'))
<br />

  <script src="{{ asset('public/js/attendance_validation.js') }}"></script>

 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb" >
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
       <li class="breadcrumb-item active">Candidates Attendance Form</li>
      </ol>
    <!-- Icon Cards-->
    <div class="card card-login mx-auto mt-5 " style="max-width: 102rem; margin-bottom: 28px;">
	     
@include('includes/flashmessage')

	<div class="card-header text-center"><h4 style="color: #2384c6;">Candidates Attendance Form</h4></div>
    <div class="col-sm-6 text-right pull-right"></div>
	
	<form enctype="multipart/form-data" action="{{ route('attendance-form-post') }}" autocomplete="off" id="attendance_form" method="POST" onsubmit="return validate(this);">
    {!! csrf_field() !!}
			
			
		<br>	
		<div class="col-md-4" style="float:left">
		
		               <select class="form-control" name="month_atten" id="month_atten">
						<?php $curMonth=date("n"); $currentYear= date("Y"); 
						$monthArray=array('1'=>'January','2'=>'February','3'=>'March','4'=>'April','5'=>'May','6'=>'June','7'=>'July','8'=>'August','9'=>'September','10'=>'October','11'=>'November','12'=>'December');
						?>
						<?php for($i=1;$i<=$curMonth;$i++) { ?>
						<option value="<?php echo $i; ?>" <?php if($curMonth==$i) { echo 'selected'; }?>><?php echo $monthArray[$i]; ?></option>
						<?php } ?>
						</select>
						
		<!--<select class="form-control" name="month_atten" id="month_atten">
						<?php $curMonth=date("n"); $currentYear= date("Y"); ?>
						<option value="1" <?php if($curMonth=='1') { echo 'selected'; }?>>January</option>
						<option value="2" <?php if($curMonth=='2') { echo 'selected'; }?>>February</option>
						<option value="3" <?php if($curMonth=='3') { echo 'selected'; }?>>March</option>
						<option value="4" <?php if($curMonth=='4') { echo 'selected'; }?>>April</option>
						<option value="5" <?php if($curMonth=='5') { echo 'selected'; }?>>May</option>
						<option value="6" <?php if($curMonth=='6') { echo 'selected'; }?>>June</option>
						<option value="7" <?php if($curMonth=='7') { echo 'selected'; }?>>July</option>
						<option value="8" <?php if($curMonth=='8') { echo 'selected'; }?>>August</option>
						<option value="9" <?php if($curMonth=='9') { echo 'selected'; }?>>September</option>
						<option value="10" <?php if($curMonth=='10') { echo 'selected'; }?>>October</option>
						<option value="11" <?php if($curMonth=='11') { echo 'selected'; }?>>November</option>
						<option value="12" <?php if($curMonth=='12') { echo 'selected'; }?>>December</option>
						</select>-->
		</div>
		
		
		<div class="col-md-4" style="float:left">
		<select class="form-control" name="year_atten" id="year_atten">
						<option value="<?php echo $currentYear;?>"><?php echo $currentYear;?></option>
		</select>
		</div>
		<br>
		
		<input type="hidden" value="<?php echo $currentMonthDays=date('t'); ?>"  name="maxDays" id="maxDays" />
			
    	<div class="card-body ajaxPart">

    		  <table  width="100%"  class="table table-bordered data-table">
			    <thead>
				       <tr>
					        <!--th><input type="checkbox"  id="chk123" class="select_all" value=""></th-->
							<!--<th  class="filterhead">S. No.</th>-->
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
					 <?php $i=0; ?>
					 <?php //echo "<pre>"; print_r($attendanceList); ?>
					  @foreach($students as $student)
					  <tr class="">
					  	<!--<td>{{$loop->iteration}}</td>-->
					  	<td>
						<input type="hidden" name="user_id[]" value="{{$student->id}}" />
						{{$student->firstname}}</td>
						
						<td>
						{{$student->course}}</td>
						
					  	<td> 
						<input class="form-control" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" type="text" min="0" maxlength="2" value="<?php if(isset($attendanceList[$i]->working_days)) { echo $attendanceList[$i]->working_days; } ?>" id="working_days{{$i}}" placeholder="Working Days" name="working_days[]">
						</td>
						<td> 
						<input class="form-control" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" type="text" min="0" maxlength="2" value="<?php if(isset($attendanceList[$i]->holidays)) { echo $attendanceList[$i]->holidays; } ?>" id="holiday{{$i}}" placeholder="Holidays" name="holiday[]">
						</td>
						<td> 
						<input class="form-control" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" type="text" min="0" maxlength="2" value="<?php if(isset($attendanceList[$i]->present_days)) { echo $attendanceList[$i]->present_days; } ?>" id="present_days{{$i}}" placeholder="Present Days" name="present_days[]" onkeyup="sum()">
						</td>
						<td> 
						<input class="form-control" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" type="text" min="0" maxlength="2" value="<?php if(isset($attendanceList[$i]->absent_days)) { echo $attendanceList[$i]->absent_days; } ?>" id="absent_days{{$i}}" placeholder="Absent Days" name="absent_days[]" readonly> 
						</td>
						<td> 
						<input class="form-control" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" type="text" min="0" maxlength="2" value="<?php if(isset($attendanceList[$i]->leave_approved_days)) { echo $attendanceList[$i]->leave_approved_days; } ?>" id="leave_approval{{$i}}" placeholder="Leave Approved Days" name="leave_approval[]" onkeyup="sum()"> 
						</td>
						
						<td> 
						<input class="form-control" type="number" value="<?php if(isset($attendanceList[$i]->total_days)) { echo $attendanceList[$i]->total_days; } ?>" id="total_days{{$i}}" placeholder="Total Days" name="total_days[]" readonly> 
						</td>
						
						<td> 
						<input class="form-control" type="text" value="<?php if(isset($attendanceList[$i]->remarks)) { echo $attendanceList[$i]->remarks; } ?>" id="remarks{{$i}}" placeholder="Remarks" name="remarks[]"> 
						</td>
						
					  </tr>
					  <?php $i++; ?>
					  @endforeach
				</thead>
				</table> 
				<!--   -->
        </div>
		
		<center class="btnAvail">
			<div class="form-group" >
				<input class="btn btn-primary " type="submit"  value="Submit">
			</div> 
		</center>
							
		</form>
    </div>
</div></div>
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
	.has-error .form-control {
    border-color: #a94442;
}
</style>
<!-- /.container-fluid-->
@endsection
	
	